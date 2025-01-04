<?php
$cartItems = $data["CartItems"];
$totalQuantity = array_sum(array_column($cartItems, 'quantity'));
$totalPrice = array_reduce($cartItems, function ($sum, $item) {
    return $sum + ($item['product']['price'] * $item['quantity']);
}, 0);
?>

<div class="payment-container">
    <div class="left-content">
        <p class="order-heading">Your Order</p>
        <div class="orders">
            <?php foreach ($cartItems as $item): ?>
                <div class="order-item">
                    <img src="<?= $item['images'][0]['image_url'] ?>" alt="Product Image" class="product-img">
                    <div class="product-information">
                        <p class="title"><?= ($item['product']['name']) ?></p>
                        <p class="description"><?= ($item['product']['description']) ?></p>
                    </div>
                    <div class="quantity-price">
                        <p class="quantity">X<?= $item['quantity'] ?>:
                            $<?= number_format($item['product']['price'] * $item['quantity'], 2) ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="summary">
            <p class="totalProducts">Total Items: <?= $totalQuantity ?></p>
            <p class="totalPrice">Total Price: $<?= number_format($totalPrice, 2) ?></p>
        </div>
    </div>

    <div class="right-content">
        <div class="form-container form-container-payment">
            <p class="payment-heading">Confirmation</p>
            <form action="/Scholar/Orders/payMentSuccessful" method="post" class="form-register form-payment">
                <!-- Full Name -->
                <div class="form-field">
                    <label for="full-name" class="title">Full Name</label>
                    <input name="full-name" id="full-name" class="input-form" placeholder="Enter your full name"
                        value="<?= isset($data['UserInfo']['name']) ? $data['UserInfo']['name'] : '' ?>" required>
                </div>

                <!-- Phone Number -->
                <div class="form-field">
                    <label for="phone-number" class="title">Phone Number</label>
                    <input name="phone-number" type="tel" id="phone-number" class="input-form" placeholder="Enter your phone number"
                        pattern="[0-9]{10}" title="Phone number should be 10 digits"
                        value="<?= isset($data['UserInfo']['phone_number']) ? $data['UserInfo']['phone_number'] : '' ?>" required>
                </div>

                <!-- Address -->
                <div class="form-field">
                    <label for="address" class="title">Address</label>
                    <input name="address" id="address" class="input-form" placeholder="Enter your address"
                        value="<?= isset($data['UserInfo']['address']) ? $data['UserInfo']['address'] : '' ?>" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-signin-submit" name="payment-submit">PAYMENT</button>
            </form>
        </div>
    </div>


</div>