<?php
require_once '../models/CategoryModel.php';

class CategoryController
{
    private $model;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }
    public function index()
    {
        if (isset($_GET['name']) && $_GET['name']) {
            $categories = $this->model->searchCategory($_GET['name']);
        } else {
            $categories = $this->model->getAll();
        }

        include "../views/admin/category/category.php";
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            if (!empty($name) && !empty($description)) {
                $this->model->create($name, $description);
                header("Location: ./admin.php?controller=category&action=index");
                exit;
            }
        }

        include '../views/admin/category/create-category.php';
    }
    public function edit()
    {
        $id = $_GET['category_id'] ?? null;

        if ($id) {
            $category = $this->model->getCategoryById($id);
            include '../views/admin/category/edit-category.php';
        } else {
            echo "Không tìm thấy ID danh mục.";
        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['category_id'] ?? null;
            $name = $_POST['category_name'] ?? null;
            $description = $_POST['description'] ?? null;

            if ($id && $name && $description) {
                $this->model->update($id, $name, $description);
                header('Location: admin.php?controller=category&action=index');
                exit;
            } else {
                echo "Vui lòng nhập đầy đủ thông tin.";
            }
        }
    }
    public function delete()
    {
        $category_id = $_GET['category_id'] ?? null;
        if ($category_id) {
            $this->model->delete($category_id);
        }
        header("Location: ./admin.php?controller=category&action=index");
        exit;
    }
}
