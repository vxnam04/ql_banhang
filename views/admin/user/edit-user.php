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
  <form action="admin.php?controller=user&action=update" method="POST" class="user-form">
    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <h2 class="form-title">Chỉnh sửa tài khoản người dùng</h2>

    <div class="form-group">
      <label for="name">Tên người dùng:</label>
      <input type="text" id="name" name="name" placeholder="Nhập tên người dùng" value="<?= $user['name'] ?>" required>
    </div>

    <div class="form-group">
      <label for="email">Địa chỉ Email:</label>
      <input type="email" id="email" name="email" value="<?= $user['email'] ?>" placeholder="Nhập email" required>
    </div>

    <div class="form-group">
      <label for="password">Mật khẩu:</label>
      <div style="position: relative;">
        <input
          type="password"
          id="password"
          name="password"
          value="<?= $user['password'] ?>"
          placeholder="Nhập mật khẩu"
          required
          style="padding-right: 40px;">
        <span
          id="togglePassword"
          style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
          👁️
        </span>
      </div>
    </div>


    <!-- <div class="form-group">
    <label>Phân quyền:</label>
    <div class="role-options">
      <label><input type="radio" name="role" value="admin" checked> Quản trị viên (Admin)</label>
      <label><input type="radio" name="role" value="user"> Người dùng thường (User)</label>
    </div>
  </div> -->

    <div class="form-group">
      <button type="submit" class="submit-btn">Submit</button>
    </div>
  </form>
</body>
<script>
  const toggleIcon = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('password');

  toggleIcon.addEventListener('click', function() {
    const isHidden = passwordInput.type === 'password';
    passwordInput.type = isHidden ? 'text' : 'password';
    toggleIcon.textContent = isHidden ? '🙈' : '👁️'; // Đổi icon
  });
</script>

</html>
<?php
$contentuser = ob_get_clean();
include './../views/admin/layout.php';
?>