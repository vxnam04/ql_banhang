<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../publics/css/list.css" />
    <style>
        img {
            max-width: 80px;
            max-height: 80px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="product-table-container">
        <div class="search-box">
            <form action="./admin.php" method="GET">
                <input type="hidden" name="controller" value="product">
                <input type="hidden" name="action" value="index">
                <input type="text" name="name" placeholder="Tìm kiếm sản phẩm..." value="<?= isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>">
                <button type="submit">Tìm kiếm</button>
            </form>
        </div>

        <h2>Danh sách sản phẩm</h2>

        <div class="user-actions">
            <a href="admin.php?controller=product&action=createproduct" class="ws-btn add-user-btn">Thêm mới</a>
        </div>

        <table class="my_table product-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Ảnh</th>
                    <th>Mô tả</th>
                    <th>Danh mục</th>
                    <th>Nhà cung cấp</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $sp): ?>
                        <tr class="table-list">
                            <td><?= htmlspecialchars($sp['product_id']) ?></td>
                            <td><?= htmlspecialchars($sp['product_name']) ?></td>
                            <td><?= number_format($sp['price'], 0, ',', '.') ?>₫</td>
                            <td>
                                <?php if (!empty($sp['image'])): ?>
                                    <img src="<?= htmlspecialchars($sp['image']) ?>" alt="img">
                                <?php else: ?>
                                    Không có ảnh
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($sp['description']) ?></td>
                            <td><?= htmlspecialchars($sp['category_name']) ?></td>
                            <td><?= htmlspecialchars($sp['supplier_name']) ?></td>
                            <td>
                                <a class="ws-btn edit-btn" href="admin.php?controller=product&action=edit&id=<?= $sp['product_id'] ?>">Sửa</a>
                                <a class="ws-btn delete-btn" href="admin.php?controller=product&action=delete&id=<?= $sp['product_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Không có sản phẩm nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>

<?php
$content = ob_get_clean();
include './../views/admin/layout.php';
?>