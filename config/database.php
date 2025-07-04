<?php
class Database
{
    public static function connect()
    {
        $host = 'localhost';
        $database = 'qlbanhang';
        $username = 'root';
        $password = '';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // ✅ sửa ở đây
            return $pdo;
        } catch (Exception $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
}
