<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cart.css" />
    <title>Document</title>
</head>

<body>

    <div class="cart-container">
        <div class="cart-header">🛒 Giỏ hàng</div>

        <form action="admin.php?controller=cart&action=update" method="post">
            <?php foreach ($cart_items as $item): ?>
                <div class="title-cart">
                    <?= $item['product_name'] ?>
                </div>
                <div class="cart-item">
                    <input type="checkbox" class="item-checkbox" data-id="<?= $item['product_id'] ?>">
                    <img src="<?= $item['image'] ?>" alt="<?= $item['product_name'] ?>">
                    <div class="item-info">
                        <div class="name"><?= htmlspecialchars($item['product_name']) ?></div>
                    </div>
                    <div class="item-price"><?= number_format($item['price'], 0, ',', '.') ?>đ</div>
                    <div class="item-quantity">
                        <div class="quantity-control">
                            <button type="button" class="decrease" data-id="<?= $item['product_id'] ?>">−</button>
                            <input type="number" name="quantity[<?= $item['product_id'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="qty-input" data-id="<?= $item['product_id'] ?>" data-price="<?= $item['price'] ?>" style="width: 50px; text-align: center;">
                            <button type="button" class="increase" data-id="<?= $item['product_id'] ?>">+</button>
                        </div>
                    </div>
                    <div class="item-total" data-id="<?= $item['product_id'] ?>">0đ</div>
                    <div class="item-remove">
                        <a href="admin.php?controller=cart&action=remove&id=<?= $item['product_id'] ?>" onclick="return confirm('Xóa sản phẩm này?')">🗑️</a>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="cart-footer">
                <div class="total-price">
                    Tổng cộng: <span id="cart-total">0đ</span>
                </div>
                <div>
                    <button type="submit" name="update_cart" class="checkout-btn">Cập nhật</button>
                    <a href="admin.php?controller=checkout" class="checkout-btn">Thanh toán</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateTotal = () => {
                let total = 0;
                document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                    const id = checkbox.dataset.id;
                    const input = document.querySelector('.qty-input[data-id="' + id + '"]');
                    const itemTotalElem = document.querySelector('.item-total[data-id="' + id + '"]');

                    if (checkbox.checked) {
                        const price = parseInt(input.dataset.price);
                        const quantity = parseInt(input.value);
                        const itemTotal = price * quantity;
                        itemTotalElem.textContent = itemTotal.toLocaleString('vi-VN') + 'đ';
                        total += itemTotal;
                    } else {
                        itemTotalElem.textContent = '0đ';
                    }
                });

                document.querySelector('#cart-total').textContent = total.toLocaleString('vi-VN') + 'đ';
            };

            document.querySelectorAll('.item-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });

            document.querySelectorAll('.increase').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const input = document.querySelector('.qty-input[data-id="' + id + '"]');
                    input.value = parseInt(input.value) + 1;
                    updateTotal();
                });
            });

            document.querySelectorAll('.decrease').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const input = document.querySelector('.qty-input[data-id="' + id + '"]');
                    if (parseInt(input.value) > 1) {
                        input.value = parseInt(input.value) - 1;
                        updateTotal();
                    }
                });
            });

            document.querySelectorAll('.qty-input').forEach(input => {
                input.addEventListener('input', () => {
                    if (parseInt(input.value) < 1 || isNaN(parseInt(input.value))) input.value = 1;
                    updateTotal();
                });
            });

            // Không gọi updateTotal() khi load - tổng mặc định là 0
        });
    </script>


</body>

</html>