

<h2>Danh sách sản phẩm</h2>

<a href="#" class="ws-btn mb-2">Thêm mới</a>

<table class="my_table">
    <tr>
        <th>ID</th>
        <th>Hình ảnh</th>
        <th>Tên</th>
        <th>Giá</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($products as $sp): ?>
    <tr>
        <td><?= $sp['id'] ?></td>
        <!-- <td><img class="avatar" src="<?= $sp['image'] ?>" alt=""></td> -->
        <td><?= $sp['name'] ?></td>
        <td><?= $sp['price'] ?></td>
        <td>
            <a class="ws-btn" href="index.php?controller=product&action=edit&id=<?= $sp['id'] ?>">Sửa</a>
            <a class="ws-btn" href="index.php?controller=product&action=delete&id=<?= $sp['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>



