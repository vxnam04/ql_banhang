<h2>Danh sách danh mục</h2>
<a href="./admin.php?controller=category&action=create">➕ Thêm mới</a>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Mô tả</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?= $category['category_id'] ?></td>
            <td><?= $category['category_name'] ?></td>
            <td><?= $category['description'] ?></td>
            <td>
                <a href="./admin.php?controller=category&action=edit&category_id=<?= $category['category_id'] ?>">Sửa</a> |
                <a onclick="return confirm('Xác nhận xóa?')" href="./admin.php?controller=category&action=delete&category_id=<?= $category['category_id'] ?>">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>