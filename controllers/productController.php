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
public function createproduct(){
  require_once '../views/admin/product/create-product.php';
}
   public function store()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? '';
        $description = $_POST['description'] ?? '';
        $image = '';

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);

            // Dùng đường dẫn tuyệt đối để tránh lỗi move_uploaded_file
            $uploadDir = __DIR__ . '/../uploads/';
            $imagePath = $uploadDir . $imageName;

            // Kiểm tra thư mục tồn tại
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            // Di chuyển file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                // Lưu đường dẫn tương đối để hiển thị
                $image = '../uploads/' . $imageName;
            }
        }

        $model = new ProductModel();
        $model->insertproduct($name, $price, $image, $description);

        header("Location: admin.php?controller=product&action=index");
        exit;
    }
}


    // public function detail() {
    //     $id = $_GET['id'] ?? 0;
    //     $product = $this->model->getById($id);
    //     include "../views/product/detail.php";
    // }
}
