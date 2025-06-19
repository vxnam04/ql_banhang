<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link rel="stylesheet" href="../views/authentication/register.css">
</head>
<body>
  <div class="container">
    <div class="box">
      <div class="logo">🐾</div>
      <h2>Welcome back</h2>
      <h3>Sign up </h3>

      <form method="POST" action="">
  <input type="text" name="name" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email address" required>
  <input type="password" name="password" placeholder="Password" required>

  <div class="options">
    <label><input type="checkbox" name="remember">Remember me</label>
    <a href="#">Forgot password?</a>
  </div>

  <button type="submit">Register</button>

  <div class="social-login">
    <button class="google">G</button>
    <button class="facebook">f</button>
    <button class="discord">💬</button>
    <button class="apple"></button>
  </div>

  <p class="signup">
    Already have an account? <a href="../publics/admin.php?controller=authentication&action=login">Sign in</a>
  </p>
</form>

    </div>

    <div class="illustration">
      <img src="../publics/assets/img/anhlogin.jpg" alt="Game Character">
    </div>
  </div>
</body>
</html>

