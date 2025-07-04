<?php
require_once "../config/database.php";

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // <- cần return dữ liệu
    }

    public function getCategoryById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function create($category_name, $description)
    {
        $stmt = $this->db->prepare("INSERT INTO categories(category_name, description) VALUES (?, ?)");
        return $stmt->execute([$category_name, $description]);
    }

    public function update($id, $name, $description)
    {
        $stmt = $this->db->prepare("UPDATE categories SET category_name = ?, description = ? WHERE category_id = ?");
        return $stmt->execute([$name, $description, $id]);
    }



    public function delete($category_id)
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE category_id = ?");
        return $stmt->execute([$category_id]);
    }
}
