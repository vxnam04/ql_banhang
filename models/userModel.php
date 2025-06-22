<?php
require_once "../config/database.php";

class UserModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::connect();
    }


    public function insertUser($name, $email, $password)
    {
        $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $this->conn->prepare($sql);
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        return $stmt->execute([$name, $email, $passwordHash]);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getAllUsers()
    {
        $stmt = $this->conn->query("SELECT id, name, email, role FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateRole($id, $role)
    {
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$role, $id]);
    }

    public function createUser($name, $email, $password, $role)
    {
        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $password,
            ':role'     => $role
        ]);
    }
    // sua user
    public function updateUser($id, $name, $email, $password)
    {
        $sql = $this->conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $sql->execute([$id, $name, $email, $password]);
    }

    public function find($id)
    {
        $sql = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    // delete
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
