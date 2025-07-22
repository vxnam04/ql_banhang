<?php
require_once '../models/UserModel.php';
require_once '../models/ProductModel.php';
require_once '../models/CategoryModel.php';

class dashboardController
{
    public function index()
    {
        $userModel = new UserModel();
        $productModel = new ProductModel();
        $categoryModel = new CategoryModel();

        $totalUsers = $userModel->countUsers();
        $totalProducts = $productModel->countAllProducts();
        $totalCategory = $categoryModel->countCategories();

        include '../views/admin/dashboard/dashboard.php';
    }
}
