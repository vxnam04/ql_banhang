<?php
require_once '../models/UserModel.php';

class AuthenticationController
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($name && $email && $password) {
                $model = new UserModel();

                // Kiểm tra email đã tồn tại chưa
                $user = $model->getUserByEmail($email);
                if ($user) {
                    $error = "❌ Email đã tồn tại. Vui lòng chọn email khác.";
                } else {
                    // Mã hóa mật khẩu trước khi lưu
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                    if ($model->insertUser($name, $email, $hashedPassword)) {
                        $success = "✅ Đăng ký thành công. Vui lòng đăng nhập.";
                        include "../views/authentication/login.php";
                        return;
                    } else {
                        $error = "❌ Lỗi khi đăng ký.";
                    }
                }
            } else {
                $error = "⚠️ Vui lòng nhập đầy đủ thông tin.";
            }
        }

        include "../views/authentication/register.php";
    }

    public function login()
    {
        session_start();
        ob_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            if ($email && $password) {
                $model = new UserModel();
                $user = $model->getUserByEmail($email);

                if (!$user) {
                    $error = "❌ Không tìm thấy tài khoản với email $email.";
                } elseif (!password_verify($password, $user['password'])) {
                    $error = "❌ Email hoặc mật khẩu không đúng.";
                } else {
                    $_SESSION['user'] = $user;

                    $role = trim(strtolower($user['role']));
                    $redirectUrl = $role === 'admin'
                        ? 'https://localhost/MVC_QLBanHang/publics/admin.php?controller=admin&action=index'
                        : 'https://localhost/MVC_QLBanHang/publics/user.php';

                    header("Location: $redirectUrl");
                    exit;
                }
            } else {
                $error = "⚠️ Vui lòng nhập đầy đủ email và mật khẩu.";
            }
        }

        include "../views/authentication/login.php";
        ob_end_flush();
    }
}
?>
