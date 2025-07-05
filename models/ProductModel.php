<?php
require_once "../config/database.php";

class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // ✅ Lấy tất cả sản phẩm (JOIN categories + suppliers)
    public function getAll()
    {
        $sql = "SELECT p.*, c.category_name, s.supplier_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
                ORDER BY p.product_id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Lấy sản phẩm theo ID (JOIN categories + suppliers)
    public function getById($id)
    {
        $sql = "SELECT p.*, c.category_name, s.supplier_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
                WHERE p.product_id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Tìm sản phẩm theo ID (giống getById)
    // public function find($id)
    // {
    //     return $this->getById($id);
    // }
    public function find($category_id)
    {
        $sql = "SELECT p.*, c.category_name, s.supplier_name
            FROM products p
            JOIN categories c ON p.category_id = c.category_id
            JOIN suppliers s ON p.supplier_id = s.supplier_id
            WHERE p.category_id = :category_id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // ✅ Thêm sản phẩm
    public function insertProduct($name, $price, $image, $description, $category_id, $supplier_id)
    {
        $sql = "INSERT INTO products (product_name, price, image, description, category_id, supplier_id)
                VALUES (:name, :price, :image, :description, :category_id, :supplier_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'description' => $description,
            'category_id' => $category_id,
            'supplier_id' => $supplier_id
        ]);
    }

    // ✅ Cập nhật sản phẩm
    public function updateProduct($name, $price, $image, $description, $category_id, $supplier_id, $id)
    {
        $sql = "UPDATE products 
                SET product_name = :name, price = :price, image = :image, description = :description,
                    category_id = :category_id, supplier_id = :supplier_id
                WHERE product_id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'description' => $description,
            'category_id' => $category_id,
            'supplier_id' => $supplier_id,
            'id' => $id
        ]);
    }

    // ✅ Xóa sản phẩm
    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE product_id = :id");
        return $stmt->execute(['id' => $id]);
    }

    // ✅ Tìm kiếm sản phẩm theo tên (JOIN categories + suppliers)
    public function searchProduct($keyword)
    {
        $sql = "SELECT p.*, c.category_name, s.supplier_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
                WHERE p.product_name LIKE :keyword
                ORDER BY p.product_id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Đếm tổng số sản phẩm
    public function countAllProducts()
    {
        $stmt = $this->db->query("SELECT COUNT(*) AS total FROM products");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // ✅ Lấy sản phẩm có phân trang (JOIN categories + suppliers)
    public function getProductsByPage($start, $limit)
    {
        $sql = "SELECT p.*, c.category_name, s.supplier_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
                ORDER BY p.product_id DESC
                LIMIT :start, :limit";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($keyword, $limit, $offset)
    {
        $sql = "SELECT p.*, c.category_name, s.supplier_name
            FROM products p
            LEFT JOIN categories c ON p.category_id = c.category_id
            LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id
            WHERE p.product_name LIKE :keyword
            ORDER BY p.product_id DESC
            LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countSearch($keyword)
    {
        $sql = "SELECT COUNT(*) AS total
            FROM products
            WHERE product_name LIKE :keyword";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
