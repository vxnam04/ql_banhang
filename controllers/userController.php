<?php
require_once '../models/UserModel.php';
require_once __DIR__ . '/productController.php';
class UserController {
    private $model;
     public function __construct() {
        $this->model = new UserModel();
    }
    public function getuser(){
        $user = $this->model->getAllUsers();
        include "../views/admin/user/user.php";
    }
    
    public function redichome() {
    $productController = new ProductController();
    $data = $productController->getProductList();

    // Giải nén biến để truyền vào view
    $show_product = $data['show_product'];
    $page = $data['page'];
    $total_page = $data['total_page'];

    include "../views/authorized/pages/page_list_product.php";
}
public function create(){
    include "../views/admin/user/create-user.php";
}
   public function insertUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name     = $_POST['name'] ?? '';
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role     = $_POST['role'] ?? 'user';
             if ($this->model->getUserByEmail($email)) {
            echo "<script>alert('Email đã tồn tại. Vui lòng chọn email khác.'); history.back();</script>";
            return;
        }

            // Mã hóa mật khẩu (bắt buộc)
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

}
