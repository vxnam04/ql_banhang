<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css">
</head>

<body>
    <div class="dashboard-container">
        <h1>📊 Bảng điều khiển</h1>

        <div class="stats-cards">
            <a href="admin.php?controller=user&action=getuser" class="card">
                <i class="fas fa-users"></i>
                <h3><?= $totalUsers ?></h3>
                <p>Người dùng</p>
            </a>

            <a href="./admin.php?controller=product&action=index" class="card">
                <i class="fas fa-box"></i>
                <h3><?= $totalProducts ?></h3>
                <p>Sản phẩm</p>
            </a>
        </div>
    </div>
</body>

</html>
<?php
$dashboard = ob_get_clean();
include '../views/admin/layout.php';
?>