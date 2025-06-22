<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./css/create-product.css" />
    <title>Chỉnh sửa sản phẩm</title>
</head>
<body>
   <div class="exit">
      <button onclick="history.back()">← Quay lại</button>
   </div>

   <div class="box_create_product">
      <h2 class="form-title">Chỉnh sửa sản phẩm ID: <?= $product['id'] ?></h2>
      
      <form action="admin.php?controller=product&action=update" method="POST" enctype="multipart/form-data" class="product-form">
         
         <div class="form-group">
              <input type="hidden" name="id" value="<?= $product['id'] ?>">
    
            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" id="name" class="form-input" value="<?= htmlspecialchars($product['name']) ?>">
         </div>

         <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" name="price" id="price" class="form-input" value="<?= $product['price'] ?>">
         </div>

         <div class="form-group">
            <label for="image">Ảnh hiện tại:</label><br>
            <img src="<?= $product['image'] ?>" width="100"><br>
            <input type="hidden" name="current_image" value="<?= $product['image'] ?>">

            <label for="image_new">Chọn ảnh mới (nếu muốn đổi):</label>
            <input type="file" name="image" id="image_new" class="form-input">
         </div>

         <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" id="description" class="form-textarea"><?= htmlspecialchars($product['description']) ?></textarea>
         </div>

         <button type="submit" class="submit-btn">Cập nhật</button>
      </form>
   </div>
</body>
</html>
<?php
$edit_product = ob_get_clean();
include '../views/admin/layout.php';
?>
