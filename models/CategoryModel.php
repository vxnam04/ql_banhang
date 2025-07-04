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
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
