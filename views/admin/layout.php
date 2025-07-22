<?php
$current_controller = $_GET['controller'] ?? '';
$current_action = $_GET['action'] ?? '';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="./css/layout.css" />
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class="bx bxl-c-plus-plus"></i>
      <span class="logo_name">NABI</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="./admin.php?controller=dashboard&action=index"
          class="<?= $current_controller == 'dashboard' ? 'active' : '' ?>">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="./admin.php?controller=product&action=index"
          class="<?= $current_controller == 'product' ? 'active' : '' ?>">
          <i class="bx bx-box"></i>
          <span class="links_name">Product</span>
        </a>
      </li>
      <li>
        <a href="./admin.php?controller=user&action=getuser"
          class="<?= $current_controller == 'user' ? 'active' : '' ?>">
          <i class="bx bx-list-ul"></i>
          <span class="links_name">User</span>
        </a>
      </li>
      <li>
        <a href="./admin.php?controller=category&action=index"
          class="<?= $current_controller == 'category' ? 'active' : '' ?>">
          <i class="bx bx-pie-chart-alt-2"></i>
          <span class="links_name">Category</span>
        </a>
      </li>
      <li class="log_out">
        <a href="./admin.php?controller=authentication&action=logout">
          <i class="bx bx-log-out"></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>

  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class="bx bx-menu sidebarBtn"></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <!-- Profile -->
      <div class="profile-details" onclick="toggleDropdown()">
        <img src="./images/Game Account creation and Login page.jpg" alt="Avatar" class="avatar" />
        <div class="info">
          <span class="admin-name">ADMIN</span>
        </div>
        <i class="bx bx-chevron-down arrow-icon"></i>
        <div id="dropdown-menu" class="dropdown-menu">
          <a href="#"><i class="bx bx-user"></i><span>Trang cá nhân</span></a>
          <a href="#"><i class="bx bx-cog"></i><span>Cài đặt</span></a>
          <a href="#"><i class="bx bx-shield-quarter"></i><span>Quản lý tài khoản</span></a>
          <hr />
          <a href="./admin.php?controller=authentication&action=logout">
            <i class="bx bx-log-out"></i><span>Đăng xuất</span>
          </a>
        </div>
      </div>
    </nav>

    <div class="content">
      <?= $content ?? '' ?>
      <?= $dashboard ?? '' ?>
      <?= $contentuser ?? '' ?>
      <?= $categories ?? '' ?>
    </div>

    <div class="create_product">
      <?= $create_product ?? '' ?>
      <?= $edit_product ?? '' ?>
      <?= $create_category ?? '' ?>
      <?= $edit_category ?? '' ?>
    </div>
  </section>

  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function() {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };

    function toggleDropdown() {
      const dropdown = document.getElementById("dropdown-menu");
      const isVisible = dropdown.style.display === "block";
      document.querySelectorAll(".dropdown-menu").forEach(menu => {
        menu.style.display = "none";
      });
      if (!isVisible) {
        dropdown.style.display = "block";
      }
    }

    window.onclick = function(event) {
      if (!event.target.closest(".profile-details")) {
        document.querySelectorAll(".dropdown-menu").forEach(menu => {
          menu.style.display = "none";
        });
      }
    };
  </script>
</body>

</html>