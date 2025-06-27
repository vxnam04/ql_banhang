<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/product-detail.css">
    <title>Document</title>
</head>

<body>
    <div class="product-detail-page">
        <div class="breadcrumb">
            <a href="?controller=user&action=redichome">Trang chủ</a> >
            <a href="?controller=user&action=category&id=<?= $product['category_id'] ?? 1 ?>">Danh mục</a> >
            <span><?= htmlspecialchars($product['name']) ?></span>
        </div>

        <div class="product-detail-wrapper">
            <!-- Left: Hình ảnh sản phẩm -->
            <div class="product-gallery">
                <div class="product-main-image">
                    <img src="<?= $product['image'] ?>" alt="img">
                </div>
            </div>
            <!-- Right: Thông tin sản phẩm -->
            <div class="product-info">
                <h1 class="product-title"><?= htmlspecialchars($product['name']) ?></h1>
                <div class="product-rating">
                    <span>⭐ 4.8</span> | <span>37 Đánh giá</span> | <span>Đã bán 155</span>
                </div>

                <div class="product-price">
                    <?= number_format($product['price'], 0, ',', '.') ?>đ
                </div>

                <div class="product-options">
                    <p>Chọn loại:</p>
                    <div class="option-buttons">
                        <button>Hồng vip</button>
                        <button>Trắng vip</button>
                        <button>Hồng thường</button>
                        <button>Trắng thường</button>
                        <button>Hồng đen</button>
                    </div>
                </div>

                <div class="product-quantity">
                    <p>Số lượng:</p>
                    <button>-</button>
                    <input type="number" value="1" min="1">
                    <button>+</button>
                    <span>{kho}: Còn hàng</span>
                </div>

                <div class="product-actions">
                    <a href="?controller=cart&action=add&id=<?= $product['id'] ?>" class="btn btn-cart">🛒 Thêm Vào Giỏ Hàng</a>
                    <a href="#" class="btn btn-buy">Mua Ngay</a>
                </div>
            </div>
        </div>

        <!-- Quà tặng khuyến mãi -->
        <div class="product-gift">
            <h3>Mua ≥1.000 để nhận quà</h3>
            <div class="gift-content">
                <div>
                    <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="">
                    <p><?= htmlspecialchars($product['name']) ?></p>
                </div>
                <div>+</div>
                <div>
                    <img src="uploads/gift.jpg" alt="">
                    <p class="gift-label">🎁 Quà tặng: Bộ chăm sóc bé Hamster</p>
                </div>
            </div>
        </div>
    </div>
    <div class="product-extra-info">
        <!-- Chi tiết sản phẩm -->
        <div class="product-section">
            <h2>Chi Tiết Sản Phẩm</h2>
            <table class="product-details-table">
                <tr>
                    <td><strong>Danh Mục</strong></td>
                    <td>Chăm Sóc Thú Cưng > Phụ kiện > Nội thất</td>
                </tr>
                <tr>
                    <td><strong>Kho</strong></td>
                    <td><?= $product['stock'] ?? '2586' ?></td>
                </tr>
                <tr>
                    <td><strong>Gửi từ</strong></td>
                    <td>Bắc Ninh</td>
                </tr>
            </table>
        </div>

        <!-- Mô tả sản phẩm -->
        <div class="product-section">
            <h2>Mô Tả Sản Phẩm</h2>
            <div class="product-description-box">
                <?= nl2br(htmlspecialchars($product['description'])) ?>
            </div>
        </div>

        <!-- Đánh giá sản phẩm -->
        <div class="product-section">
            <h2>Đánh Giá Sản Phẩm</h2>
            <div class="product-rating-summary">
                <div class="rating-score">4.8 <span>/ 5</span></div>
                <div class="stars">
                    <span>⭐⭐⭐⭐☆</span>
                    <p>37 đánh giá</p>
                </div>
            </div>

            <div class="rating-filter-buttons">
                <button class="active">Tất Cả</button>
                <button>5 Sao (33)</button>
                <button>4 Sao (3)</button>
                <button>3 Sao (0)</button>
                <button>2 Sao (0)</button>
                <button>1 Sao (1)</button>
            </div>

            <div class="rating-comment">
                <p><strong>🌸 binhbabiixxloove</strong></p>
                <p>lắp xong xinh lắm nè, chất lượng cao nha 💕💕💕 nếu 1 người lắp thì cực, 2 người thì rất nhanh</p>
                <div class="rating-images">
                    <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="feedback">
                    <img src="uploads/<?= htmlspecialchars($product['image']) ?>" alt="feedback">
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
$product_detail = ob_get_clean();
include '../views/authorized/pages/home.php';
?>