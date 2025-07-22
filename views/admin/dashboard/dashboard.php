<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
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

            <a href="admin.php?controller=product&action=index" class="card">
                <i class="fas fa-box"></i>
                <h3><?= $totalProducts ?></h3>
                <p>Sản phẩm</p>
            </a>

            <a href="admin.php?controller=category&action=index" class="card">
                <i class="fas fa-list"></i>
                <h3><?= $totalCategory ?></h3>
                <p>Danh mục</p>
            </a>
        </div>

        <div class="charts-row">
            <div class="chart-box">
                <h3>Biểu đồ người dùng</h3>
                <canvas id="userChart"></canvas>
            </div>
            <div class="chart-box">
                <h3>Thống kê sản phẩm</h3>
                <canvas id="productChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart 1: Users over months
        const userChart = new Chart(document.getElementById('userChart'), {
            type: 'bar',
            data: {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5'],
                datasets: [{
                    label: 'Người dùng mới',
                    data: [30, 45, 60, 40, 80],
                    backgroundColor: '#FF7043'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Chart 2: Product categories
        const productChart = new Chart(document.getElementById('productChart'), {
            type: 'doughnut',
            data: {
                labels: ['Túi xách', 'Ví', 'Balo', 'Khác'],
                datasets: [{
                    label: 'Sản phẩm',
                    data: [150, 90, 70, 40],
                    backgroundColor: ['#42A5F5', '#66BB6A', '#FFA726', '#AB47BC']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>

</html>
<?php
$dashboard = ob_get_clean();
include './../views/admin/layout.php';
?>