<?php
require_once "../models/ProductModel.php";
require_once "../models/CategoryModel.php";
require_once "../models/SupplierModel.php";

class ProductController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    // ✅ Admin: danh sách sản phẩm
    public function index()
    {
        if (isset($_GET['name']) && $_GET['name']) {
            $products = $this->model->searchProduct($_GET['name']);
        } else {
            $products = $this->model->getAll();
        }

        include "../views/admin/product/list.php";
    }

    // ✅ Trang chủ: hiển thị sản phẩm có phân trang
    public function getProductList()
    {
        $limit = 10;
        $total = $this->model->countAllProducts();

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $total_page = ceil($total / $limit);
        $start = ($page - 1) * $limit;

        $products = $this->model->getProductsByPage($start, $limit);

        return [
            'show_product' => $products,
            'page' => $page,
            'total_page' => $total_page
        ];
    }

    // ✅ Trang chủ: tìm kiếm sản phẩm có phân trang
    public function searchProduct($keyword)
    {
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;

        $products = $this->model->search($keyword, $limit, $offset);
        $total = $this->model->countSearch($keyword);
        $total_page = ceil($total / $limit);

        return [
            'show_product' => $products,
            'page' => $page,
            'total_page' => $total_page
        ];
    }

    // ✅ Trang chi tiết sản phẩm
    public function productDetail()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = $this->model->getById($id);

            if ($product) {
                $categoryModel = new CategoryModel();
                $categori = $categoryModel->getAll();
                include "../views/authorized/pages/product_detail.php";
            } else {
                echo "Không tìm thấy sản phẩm.";
            }
        } else {
            echo "Thiếu ID sản phẩm.";
        }
    }

    // ✅ Admin: form tạo sản phẩm
    public function createproduct()
    {
        $categoryModel = new CategoryModel();
        $supplierModel = new SupplierModel();

        $categories = $categoryModel->getAll();
        $suppliers = $supplierModel->getAll();

        require_once '../views/admin/product/create-product.php';
    }

    // ✅ Admin: xử lý lưu sản phẩm mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $description = $_POST['description'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $supplier_id = $_POST['supplier_id'] ?? null;
            $image = '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $uploadDir = __DIR__ . '/../uploads/';
                $imagePath = $uploadDir . $imageName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image = '../uploads/' . $imageName;
                }
            }

            $this->model->insertProduct($name, $price, $image, $description, $category_id, $supplier_id);
            header("Location: admin.php?controller=product&action=index");
            exit;
        }
    }

    // ✅ Admin: form chỉnh sửa
    public function edit()
    {
        $id = $_GET['id'];
        $product = $this->model->findById($id);


        $categoryModel = new CategoryModel();
        $supplierModel = new SupplierModel();

        $categories = $categoryModel->getAll();
        $suppliers = $supplierModel->getAll();

        require_once '../views/admin/product/edit.php';
    }

    // ✅ Admin: xử lý cập nhật
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? '';
            $description = $_POST['description'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            $supplier_id = $_POST['supplier_id'] ?? null;
            $image = $_POST['current_image'] ?? '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $uploadDir = __DIR__ . '/../uploads/';
                $imagePath = $uploadDir . $imageName;

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    $image = '../uploads/' . $imageName;
                }
            }

            $this->model->updateProduct($name, $price, $image, $description, $category_id, $supplier_id, $id);
            header("Location: admin.php?controller=product&action=index");
            exit;
        }
    }

    // ✅ Admin: xóa sản phẩm
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->deleteProduct($id);
        }
        header("Location: admin.php?controller=product&action=index");
        exit;
    }
}
