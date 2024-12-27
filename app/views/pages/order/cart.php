<?php
$cartItems = $data["CartItems"];
$totalAmount = 0;
?>

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
                            <input type="checkbox" class="check-box" data-price="<?= $item['product']['price'] ?>" data-quantity="<?= $item['quantity'] ?>">
                            <img src="<?= $item['images'][0]['image_url'] ?>" alt="Product Image" class="image-item">
                            <div class="product-name"><?= $item['product']['name'] ?></div>
                        </div>
                        <div class="content-right-item">
                            <div class="price">$<?= number_format($item['product']['price'], 2) ?></div>
                            <div class="quantity-detail" id="quantity-detail-cart">
                                <div class="quantity" id="quantity-in-cart">
                                    <div class="decrease" id="decrease-in-cart">-</div>
                                    <input class="number" id="number-in-cart" name="quantity" type="number" value="<?= $item['quantity'] ?>" min="1" max="<?php echo $product['stock']; ?>">
                                    <div class="increase" id="increase-in-cart">+</div>
                                </div>
                            </div>
                            <button class="delete-product" data-order-detail-id="<?= $item['order_detail_id'] ?>">
                                <img src="./public/assets/icons/remove.svg" alt="Delete" class="remove">
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <div class="right-cart">
            <div class="total-title">Cart Totals</div>
            <div class="quantity">Quantity:</div>
            <div class="total">Total: <span class="price">$<?= number_format($totalAmount, 2) ?></span></div>
            <button class="btn-checkout">
                <a href="/Scholar/Orders/payMent">Checkout</a>
            </button>
        </div>
    </div>
</div>