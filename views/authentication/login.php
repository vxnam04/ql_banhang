<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="../views/authentication/login.css">
</head>
<body>
  <div class="container">
    <div class="login-box">
      <div class="logo">🐾</div>
      <h2>Welcome back</h2>
      <h3>Sign in </h3>

      <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
      <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>

      <form method="POST">
        <!-- THÊM name="email" và name="password" -->
        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="Password" required>
        
        <div class="options">
          <label><input type="checkbox"> Remember me</label>
          <a href="#">Forgot password?</a>
        </div>

        <button type="submit">Log in</button>

        <div class="social-login">
          <button class="google">G</button>
          <button class="facebook">f</button>
          <button class="discord">💬</button>
          <button class="apple"></button>
        </div>

        <p class="signup">
          Don't have an account?
          <a href="../publics/admin.php?controller=authentication&action=register">Sign up</a>
        </p>
      </form>
    </div>

    <div class="illustration">
      <img src="../publics/assets/img/anhlogin.jpg" alt="Game Character">
    </div>
  </div>
</body>
</html>
