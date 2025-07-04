<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/create-category.css">
    <title>Sửa danh mục</title>
</head>

<body>

    <div class="exit">
        <button onclick="history.back()">← Quay lại</button>
    </div>

    <div class="box_create_product">
        <form action="admin.php?controller=category&action=update" method="POST" class="category-form">
            <h2 class="form-title">Sửa danh mục ID: <?= $category['category_id'] ?></h2>

            <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>" />

            <div class="form-group">
                <label for="name">Tên danh mục:</label>
                <input type="text" id="category_name" name="category_name" value="<?= htmlspecialchars($category['category_name']) ?>" required class="form-input" />
            </div>

            <div class="form-group">
                <label for="description">Mô tả danh mục:</label>
                <input type="text" id="description" name="description" value="<?= htmlspecialchars($category['description']) ?>" required class="form-input" />
            </div>

            <button type="submit" class="submit-btn">Cập nhật</button>
        </form>

    </div>

</body>

</html>

<?php
$edit_category = ob_get_clean();
include '../views/admin/layout.php';
?>