<div class="payment-container">
    <div class="left-content form-container">
        <form action="/Scholar/User/payment" method="post" class="form-register form-payment">
            <!-- Full Name -->
            <div class="name form-field">
                <p class="title">Full name</p>
                <input name="full-name" id="full-name" class="input-form" placeholder="Enter your full name" required>
                <span class="error-message"><?= $errors['full-name'] ?? '' ?></span>
            </div>

            <!-- Phone Number -->
            <div class="phone-number form-field">
                <p class="title">Phone number</p>
                <input name="phone-number" type="tel" id="phone-number" class="input-form"
                    placeholder="Enter your phone number" pattern="[0-9]{10}" title="Phone number should be 10 digits" required>
                <span class="error-message"><?= $errors['phone-number'] ?? '' ?></span>
            </div>

            <!-- Address -->
            <div class="address form-field">
                <p class="title">Address</p>
                <input name="address" id="address" class="input-form" placeholder="Enter your address" required>
                <span class="error-message"><?= $errors['address'] ?? '' ?></span>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-signin-submit" name="signin-submit">PAYMENT</button>
        </form>
    </div>
    <div class="right-content">
        <div class="orders">
            <div class="order-item">
                <img src="" alt="product" class="product-img">
                <div class="product-information">
                    <p class="title">Name</p>
                    <p class="description">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="order-item">
                <img src="" alt="product" class="product-img">
                <div class="product-information">
                    <p class="title">Name</p>
                    <p class="description">Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="order-item">
                <img src="" alt="product" class="product-img">
                <div class="product-information">
                    <p class="title">Name</p>
                    <p class="description">Lorem, ipsum dolor sit amet.</p>
                </div>
            </div>
        </div>
        <div></div>
    </div>
</div>