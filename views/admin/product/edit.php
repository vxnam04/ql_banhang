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
      <h2 class="form-title">Chỉnh sửa sản phẩm ID: <?= $product['product_id'] ?></h2>

      <form action="admin.php?controller=product&action=update" method="POST" enctype="multipart/form-data" class="product-form">

         <div class="form-group">
            <input type="hidden" name="id" value="<?= $product['product_id'] ?>">

            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" id="name" class="form-input" value="<?= htmlspecialchars($product['product_name']) ?>">
         </div>

         <div class="form-group">
            <label for="price">Giá:</label>
            <input type="text" name="price" id="price" class="form-input" value="<?= $product['price'] ?>">
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

         <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select name="category_id" id="category_id" class="form-input">
               <?php foreach ($categories as $cat): ?>
                  <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                     <?= htmlspecialchars($cat['category_name']) ?>
                  </option>
               <?php endforeach; ?>
            </select>
         </div>

         <div class="form-group">
            <label for="supplier_id">Nhà cung cấp:</label>
            <select name="supplier_id" id="supplier_id" class="form-input">
               <?php foreach ($suppliers as $sup): ?>
                  <option value="<?= $sup['supplier_id'] ?>" <?= $sup['supplier_id'] == $product['supplier_id'] ? 'selected' : '' ?>>
                     <?= htmlspecialchars($sup['supplier_name']) ?>
                  </option>
               <?php endforeach; ?>
            </select>
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