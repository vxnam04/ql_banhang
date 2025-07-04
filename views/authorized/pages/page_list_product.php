<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/page_list_product.css">
    <title>Danh sách sản phẩm</title>
</head>

<body>

    <div class="row sm-gutter">
        <?php foreach ($show_product as $sp): ?>
            <div class="col l-2-4 m-4 c-6">
                <a class="home-product-item" href="?controller=product&action=productDetail&id=<?= $sp['product_id'] ?>">
                    <div class="home-product-item__img" style="background-image: url('<?= htmlspecialchars($sp['image']) ?>');"></div>
                    <h4 class="home-product-item__name"><?= htmlspecialchars($sp['product_name']) ?></h4>
                    <div class="home-product-item__price">
                        <span class="home-product-item__price-old">
                            <?= number_format($sp['price'] * 1.1, 0, ',', '.') ?>đ
                        </span>
                        <span class="home-product-item__price-current">
                            <?= number_format($sp['price'], 0, ',', '.') ?>đ
                        </span>
                    </div>
                    <div class="home-product-item__action">
                        <span class="home-product-item__like home-product-item__like--liked">
                            <i class="home-product-item__like--like-icon-fill fas fa-heart"></i>
                            <i class="home-product-item__like--like-icon-empty far fa-heart"></i>
                        </span>
                        <div class="home-product-item__rating">
                            <i class="home-product-item__gold fas fa-star"></i>
                            <i class="home-product-item__gold fas fa-star"></i>
                            <i class="home-product-item__gold fas fa-star"></i>
                            <i class="home-product-item__gold fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <span class="home-product-item__sold">88 đã bán</span>
                        </div>
                    </div>
                    <div class="home-product-item__origin">
                        <span class="home-product-item__brand"><?= htmlspecialchars($sp['supplier_name']) ?></span>
                        <span class="home-product-item__origin-name"><?= htmlspecialchars($sp['category_name']) ?></span>
                    </div>
                    <div class="home-product-item__favourite">
                        <i class="fas fa-check"></i>
                        <span>Yêu thích</span>
                    </div>
                    <div class="home-product-item__sele-off">
                        <span class="home-product-item__sele-off-percent">10%</span>
                        <span class="home-product-item__sele-off-label">GIẢM</span>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <ul class="pagination home-product__pagination">
        <?php if ($page > 1): ?>
            <li class="pagination-item">
                <a href="?controller=user&action=redichome&page=<?= $page - 1 ?>" class="pagination-item__link">
                    <i class="pagination-item__icon fas fa-chevron-left"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <li class="pagination-item <?= ($i == $page) ? 'pagination-item--active' : '' ?>">
                <a href="?controller=user&action=redichome&page=<?= $i ?>" class="pagination-item__link"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $total_page): ?>
            <li class="pagination-item">
                <a href="?controller=user&action=redichome&page=<?= $page + 1 ?>" class="pagination-item__link">
                    <i class="pagination-item__icon fas fa-chevron-right"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>

</body>

</html>
<?php
$home_list = ob_get_clean();
include '../views/authorized/pages/home.php';
?>