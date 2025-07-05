<?php
require_once '../models/UserModel.php';
require_once '../models/ProductModel.php';
require_once __DIR__ . '/productController.php';
class UserController
{
    private $model;
    public function __construct()
    {
        $this->model = new UserModel();
    }
    public function getuser()
    {
        if (isset($_GET['name']) && $_GET['name']) {
            // trường hợp tồn tại , và trường hợp phải có giá trị
            // thì chạy vào đây
            $user = $this->model->finduser($_GET['name']);
        } else {
            $user = $this->model->getAllUsers();
        }
        include "../views/admin/user/user.php";
    }

    public function redichome()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $productController = new ProductController();
        $categoryModel = new CategoryModel();
        $categori = $categoryModel->getAll();
        $user = $_SESSION['user'] ?? null;


        // Trường hợp tìm kiếm
        if (!empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            $data = $productController->searchProduct($keyword);

            $show_product = $data['show_product'];
            $page = $data['page'];
            $total_page = $data['total_page'];

            include "../views/authorized/pages/page_list_product.php";
            return;
        }

        // Trường hợp lọc theo danh mục
        if (isset($_GET['id'])) {
            $category_id = $_GET['id'];
            $productModel = new ProductModel();
            $show_product = $productModel->find($category_id);
            $page = 1;
            $total_page = 1;
            include "../views/authorized/pages/page_list_product.php";
            return;
        }

        // Trường hợp mặc định: hiển thị tất cả sản phẩm
        $data = $productController->getProductList();
        $show_product = $data['show_product'];
        $page = $data['page'];
        $total_page = $data['total_page'];

        include "../views/authorized/pages/page_list_product.php";
    }
    public function create()
    {
        include "../views/admin/user/create-user.php";
    }
    public function insertUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = $_POST['name'] ?? '';
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role     = $_POST['role'] ?? 'user';
            if ($this->model->getUserByEmail($email)) {
                echo "<script>alert('Email đã tồn tại. Vui lòng chọn email khác.'); history.back();</script>";
                return;
            }
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $result = $this->model->createUser($name, $email, $hashedPassword, $role);

            if ($result) {
                header("Location: ./admin.php?controller=user&action=getuser");
                exit;
            } else {
                echo "Tạo tài khoản thất bại!";
            }
        }
    }
    // edit
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $user = $this->model->find($id);
            include './../views/admin/user/edit-user.php'; // file bạn đang viết ở trên
        } else {
            echo "Không tìm thấy ID người dùng.";
        }
    }
    // Xử lý cập nhật
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $this->model->updateUser($id, $name, $email, $password);
            header('Location: ./admin.php?controller=user&action=getuser');
            exit();
        }
    }
    // delete
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->delete($id);
        }
        header("Location: admin.php?controller=user&action=getuser");
        exit;
    }
}
