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


}
