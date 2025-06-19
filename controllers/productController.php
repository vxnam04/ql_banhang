<?php
require_once "../models/ProductModel.php";

class productController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        $products = $this->model->getAll();
        include "../views/admin/product/list.php";
    }

    // public function detail() {
    //     $id = $_GET['id'] ?? 0;
    //     $product = $this->model->getById($id);
    //     include "../views/product/detail.php";
    // }
}
