<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./css/create-product.css" />
    <title>Document</title>
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
        <input type="text" name="name" id="name" class="form-input">
    </div>

    <div class="form-group">
        <label for="price">Giá:</label><br>
        <input type="number" name="price" id="price" class="form-input">
    </div>

    <div class="form-group">
        <label for="image">Hình ảnh:</label><br>
        <input type="file" name="image" id="image" class="form-input">
    </div>

    <div class="form-group">
        <label for="description">Mô tả:</label><br>
        <textarea name="description" id="description" class="form-textarea"></textarea>
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