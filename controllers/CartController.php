<?php
require_once '../models/ProductModel.php';

class CartController
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

            if ($product_id <= 0 || $quantity <= 0) {
                header("Location: admin.php?controller=user&action=redichome");
                exit;
            }

            // Khởi động session nếu chưa có
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Tạo giỏ hàng nếu chưa có
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Nếu sản phẩm đã tồn tại trong giỏ, tăng số lượng
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                $_SESSION['cart'][$product_id] = $quantity;
            }

            // Chuyển hướng đến trang giỏ hàng hoặc thông báo thành công
            header("Location: admin.php?controller=Cart&action=view");
            exit;
        }
    }

    public function view()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $productModel = new ProductModel();
        $cart_items = [];

        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $product = $productModel->getById($product_id);
                if ($product) {
                    $product['quantity'] = $quantity;
                    $product['total'] = $product['price'] * $quantity;
                    $cart_items[] = $product;
                }
            }
        }

        // Gửi dữ liệu đến view
        include '../views/authorized/giohang/cart.php';
    }
}
