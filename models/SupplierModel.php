<?php
require_once "../config/database.php";

class SupplierModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM suppliers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
