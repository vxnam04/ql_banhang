<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <link rel="stylesheet" href="./css/category.css">
</head>

<body>
    <div class="category-table-container">

        <!-- Ô tìm kiếm sản phẩm -->
        <div class="search-box">
            <form action="./admin.php" method="GET">
                <input type="hidden" name="controller" value="category">
                <input type="hidden" name="action" value="index">
                <input type="text" name="name" placeholder="Tìm kiếm sản phẩm..."
                    value="<?= isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>">
                <button type="submit">Tìm kiếm</button>
            </form>
        </div>

        <!-- Tiêu đề và nút thêm -->
        <h2 class="category-title">Danh sách danh mục</h2>
        <a href="./admin.php?controller=category&action=create" class="add-category-btn">➕ Thêm mới</a>

        <!-- Bảng danh mục -->
        <table class="category-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['category_id'] ?></td>
                        <td><?= $category['category_name'] ?></td>
                        <td><?= $category['description'] ?></td>
                        <td>
                            <a href="./admin.php?controller=category&action=edit&category_id=<?= $category['category_id'] ?>" class="edit-btn">Sửa</a>
                            <a onclick="return confirm('Xác nhận xóa?')"
                                href="./admin.php?controller=category&action=delete&category_id=<?= $category['category_id'] ?>"
                                class="delete-btn">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</body>

</html>
<?php
$categories = ob_get_clean();
include './../views/admin/layout.php';
?>