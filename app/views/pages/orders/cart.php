<?php
$cartItems = $data["CartItems"];
$totalAmount = 0;
?>

<form class="cart-checkout-form" id="cart-checkout-form" action="/Scholar/Orders/checkout" method="POST">
    <div class="shopping-cart">
        <div class="cart-title">Shopping Cart</div>
        <div class="content-cart">
            <div class="left-cart">
                <div class="cart-header">
                    <div class="product">Product</div>
                    <div class="price">Price</div>
                    <div class="quantity">Quantity</div>
                    <div class="action">Action</div>
                </div>
                <div class="cart-items">
                    <?php foreach ($cartItems as $item): ?>
                        <div class="cart-item">
                            <div class="content-left-item">
                                <input type="checkbox" class="check-box" name="selected_items[]" value="<?= $item['order_detail_id'] ?>" data-price="<?= $item['product']['price'] ?>" data-quantity="<?= $item['quantity'] ?>">
                                <img src="<?= $item['images'][0]['image_url'] ?>" alt="Product Image" class="image-item">
                                <div class="product-name"><?= $item['product']['name'] ?></div>
                            </div>
                            <div class="content-right-item">
                                <div class="price">$<?= number_format($item['product']['price'], 2) ?></div>

                                <div class="quantity" id="quantity-in-cart">
                                    <a href="/Scholar/Orders/updateQuantity?order_detail_id=<?= $item['order_detail_id'] ?>&action=decrease&quantity=<?= $item['quantity'] ?>" class="decrease">-</a>
                                    <input class="number" name="quantity" type="number" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['product']['stock']; ?>" readonly>
                                    <a href="/Scholar/Orders/updateQuantity?order_detail_id=<?= $item['order_detail_id'] ?>&action=increase&quantity=<?= $item['quantity'] ?>" class="increase">+</a>
                                </div>

                                <a href="/Scholar/Orders/removeFromCart?order_id=<?= $item['order_id'] ?>" class="delete-product-btn">
                                    <img src="./public/assets/icons/remove.svg" alt="Delete" class="remove">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="right-cart">
                <div class="total-title">Cart Totals</div>
                <button type="submit" class="btn-checkout">Checkout</button>
            </div>
        </div>
    </div>
</form>