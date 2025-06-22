 <?php
 ob_start();
 ?>
 <div class="row sm-gutter">
    <?php foreach ($show_product as $sp): ?>
        <div class="col l-2-4 m-4 c-6">
            <a class="home-product-item" href="">
                <div class="home-product-item__img" style="background-image: url('<?= $sp['image'] ?>');"></div>
                <h4 class="home-product-item__name"><?= $sp['name'] ?></h4>
                <div class="home-product-item__price">
                    <span class="home-product-item__price-old"><?= number_format($sp['price'] * 1.1, 0, ',', '.') ?>đ</span>
                    <span class="home-product-item__price-current"><?= number_format($sp['price'], 0, ',', '.') ?>đ</span>
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
                    <span class="home-product-item__brand">Brand</span>
                    <span class="home-product-item__origin-name">Xuất xứ</span>
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
<?php
$home_list = ob_get_clean();
include '../views/authorized/pages/home.php'
?>