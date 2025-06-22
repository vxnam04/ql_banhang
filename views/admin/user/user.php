<?php
ob_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../publics/css/admin-user.css" />
    <title>Document</title>
</head>
<body>
    <div class="user-table-container">
   <h2>Danh sách User</h2>

<div class="user-actions">
    <a href="admin.php?controller=user&action=create" class="ws-btn add-user-btn">Thêm mới</a>
</div>

    <table class="my_table user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $users): ?>
            <tr>
                <td><?= $users['id'] ?></td>
                <td><?= $users['name'] ?></td>
                <td><?= $users['email'] ?></td>
                <td>
                    <a class="ws-btn user-edit-btn" href="index.php?controller=user&action=edit&id=<?= $users['id'] ?>">Sửa</a>
                    <a class="ws-btn user-delete-btn" href="index.php?controller=user&action=delete&id=<?= $users['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
    
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
<?php
$contentuser = ob_get_clean();
include './../views/admin/layout.php';
?>