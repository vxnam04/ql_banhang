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
public function getProductList() {
    $limit = 10;
    $total = $this->model->countAllProducts();

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, $page);
    $total_page = ceil($total / $limit);
    $start = ($page - 1) * $limit;

    $products = $this->model->getProductsByPage($start, $limit);

    // ✅ return mảng dữ liệu để controller khác có thể dùng
    return [
        'show_product' => $products,
        'page' => $page,
        'total_page' => $total_page
    ];
    
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
public function edit(){
    $id = $_GET['id'];
    $product = $this->model->find($id);
    require_once '../views/admin/product/edit.php';
}
public function update() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? '';
        $description = $_POST['description'] ?? '';
        $image = $_POST['current_image'] ?? ''; // ảnh cũ

        // Nếu có upload ảnh mới
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
        $this->model->updateProduct($name, $price, $image, $description, $id);
        header("Location: admin.php?controller=product&action=index");
        exit;
    }
}
// delete
    public function delete() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $this->model->deleteProduct($id);
    }
    header("Location: admin.php?controller=product&action=index");
    exit;
}
}
