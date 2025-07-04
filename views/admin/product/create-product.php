<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/create-product.css" />
    <title>Thêm sản phẩm mới</title>
</head>

<body>

    <div class="exit">
        <button onclick="history.back()">← Quay lại</button>
    </div>

    <div class="box_create_product">
        <h2 class="form-title">Thêm sản phẩm mới</h2>

        <form action="admin.php?controller=product&action=store" method="POST" enctype="multipart/form-data" class="product-form">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label><br>
                <input type="text" name="name" id="name" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="price">Giá:</label><br>
                <input type="number" name="price" id="price" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="image">Hình ảnh:</label><br>
                <input type="file" name="image" id="image" class="form-input" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="description">Mô tả:</label><br>
                <textarea name="description" id="description" class="form-textarea" required></textarea>
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục:</label><br>
                <select name="category_id" id="category_id" class="form-input" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['category_id']) ?>">
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="supplier_id">Nhà cung cấp:</label><br>
                <select name="supplier_id" id="supplier_id" class="form-input" required>
                    <option value="">-- Chọn nhà cung cấp --</option>
                    <?php foreach ($suppliers as $sup): ?>
                        <option value="<?= htmlspecialchars($sup['supplier_id']) ?>">
                            <?= htmlspecialchars($sup['supplier_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="submit-btn">Lưu</button>
        </form>
    </div>

</body>

</html>

<?php
$create_product = ob_get_clean();
include '../views/admin/layout.php';
?>