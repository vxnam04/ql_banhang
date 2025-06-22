<?php
require_once "../config/database.php";

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
     public function insertproduct($name, $price, $image,$description) {
        $sql = "INSERT INTO products (name, price, image, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $price, $image,$description]);
    }
      // ✅ Lấy sản phẩm có phân trang
     public function countAllProducts()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM products");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    public function getProductsByPage($start, $limit)
    {
        $stmt = $this->db->prepare("SELECT * FROM products LIMIT :start, :limit");
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // edit
   public function updateProduct($name, $price, $image, $description, $id) {
    $stmt = $this->db->prepare("UPDATE products SET name = ?, price = ?, image = ?, description = ? WHERE id = ?");
    $stmt->execute([$name, $price, $image, $description, $id]);
}

public function find($id) {
    $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// delete
public function deleteProduct($id) {
    $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);
}

}
