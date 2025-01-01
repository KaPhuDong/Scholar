<?php
$cartItems = $data["CartItems"];
$totalAmount = 0;

// foreach ($cartItems as $item) {
//     $totalAmount += $item['product']['price'] * $item['quantity'];
// }
// 
?>

<form id="cart-checkout-form" action="/Scholar/Orders/checkout" method="POST">
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

                                <form action="/Scholar/Orders/updateQuantity" method="POST" class="quantity-form">
                                    <input type="hidden" name="order_detail_id" value="<?= $item['order_detail_id'] ?>">
                                    <div class="quantity" id="quantity-in-cart">
                                        <button type="submit" name="action" value="decrease" class="decrease">-</button>
                                        <input class="number" name="quantity" type="number" value="<?= $item['quantity'] ?>" min="1" max="<?= $item['product']['stock']; ?>">
                                        <button type="submit" name="action" value="increase" class="increase">+</button>
                                    </div>
                                </form>

                                <form action="/Scholar/Orders/removeFromCart" method="POST" class="delete-product-form">
                                    <input type="hidden" name="order_id" value="<?= $item['order_id'] ?>">
                                    <button type="submit" class="delete-product-btn">
                                        <img src="./public/assets/icons/remove.svg" alt="Delete" class="remove">
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="right-cart">
                <div class="total-title">Cart Totals</div>
                <div class="quantity">Quantity: <span id="total-quantity">0</span></div>
                <div class="total">Total: <span id="total-price">$0.00</span></div>
                <button type="submit" class="btn-checkout">Checkout</button>
            </div>
        </div>
    </div>
</form>