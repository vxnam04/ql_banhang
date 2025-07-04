<?php
require_once '../models/UserModel.php';
require_once '../models/ProductModel.php';

class dashboardController
{
    public function index()
    {
        $userModel = new UserModel();
        $productModel = new ProductModel();

        $totalUsers = $userModel->countUsers();
        $totalProducts = $productModel->countAllProducts();

        include '../views/admin/dashboard/dashboard.php';
    }
}
