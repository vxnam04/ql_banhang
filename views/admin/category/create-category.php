<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/create-category.css">
    <title>Thêm danh mục</title>
</head>

<body>

    <div class="exit">
        <button onclick="history.back()">← Quay lại</button>
    </div>

    <div class="box_create_product">
        <form method="POST" class="product-form">
            <h2 class="form-title">Thêm danh mục</h2>
            <div class="form-group">
                <label for="name">Tên danh mục:</label>
                <input type="text" id="name" name="name" required class="form-input" />
            </div>
            <div class="form-group">
                <label for="description">Mô tả danh mục:</label>
                <input type="text" id="description" name="description" required class="form-input" />
            </div>
            <button type="submit" class="submit-btn">Thêm</button>
        </form>
    </div>

</body>

</html>

<?php
$create_category = ob_get_clean();
include '../views/admin/layout.php';
?>