<?php
ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../publics/css/create-user.css" />
    <title>Document</title>
</head>
<body>
      <div class="exit">
      <button onclick="history.back()">← Quay lại</button>
   </div>
   <form action="./admin.php?controller=user&action=insertUser" method="POST" class="user-form">
  <h2 class="form-title">Tạo tài khoản người dùng</h2>

  <div class="form-group">
    <label for="name">Tên người dùng:</label>
    <input type="text" id="name" name="name" placeholder="Nhập tên người dùng" required>
  </div>

  <div class="form-group">
    <label for="email">Địa chỉ Email:</label>
    <input type="email" id="email" name="email" placeholder="Nhập email" required>
  </div>

  <div class="form-group">
    <label for="password">Mật khẩu:</label>
    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
  </div>

  <!-- <div class="form-group">
    <label>Phân quyền:</label>
    <div class="role-options">
      <label><input type="radio" name="role" value="admin" checked> Quản trị viên (Admin)</label>
      <label><input type="radio" name="role" value="user"> Người dùng thường (User)</label>
    </div>
  </div> -->

  <div class="form-group">
    <button type="submit" class="submit-btn">Tạo tài khoản</button>
  </div>
</form>
</body>
</html>
<?php
$contentuser = ob_get_clean();
include './../views/admin/layout.php';
?>