<h2>Thêm sản phẩm mới</h2>
<form action="admin.php?controller=product&action=store" method="POST" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label><br>
    <input type="text" name="name"><br><br>

    <label>Giá:</label><br>
    <input type="number" name="price"><br><br>

    <label>Hình ảnh:</label><br>
    <input type="file" name="image"><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Lưu</button>
</form>
