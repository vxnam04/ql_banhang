<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../publics/css/list.css" />
</head>
<body>
    
<div class="product-table-container">
    <h2>Danh sách sản phẩm</h2>

<div class="user-actions">
    <a href="admin.php?controller=product&action=createproduct" class="ws-btn add-user-btn">Thêm mới</a>
</div>


    <table class="my_table product-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Mô tả sản phẩm</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $sp): ?>
            <tr class="table-list">
                <td><?= $sp['id'] ?></td>
                <td><?= $sp['name'] ?></td>
                <td><?= $sp['price'] ?></td>
                <td><img src="<?= $sp['image'] ?>" alt="img"></td>
                <td><?= $sp['description'] ?></td>
                <td>
                    <a class="ws-btn edit-btn" href="admin.php?controller=product&action=edit&id=<?= $sp['id'] ?>">Sửa</a>
                    <a class="ws-btn delete-btn" href="admin.php?controller=product&action=delete&id=<?= $sp['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>


<?php
$content = ob_get_clean();
include './../views/admin/layout.php';
?>