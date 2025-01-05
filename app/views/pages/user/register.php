<div class="form-container">
    <div class="form-header">
        <h1 class="heading">Register Yourself</h1>
        <p class="description">Begin your journey with us today</p>
    </div>
    <form action="/Scholar/User/register" method="post" class="form-register">
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

        <!-- Email -->
        <div class="email form-field">
            <p class="title">Email</p>
            <input name="email" type="email" id="email" class="input-form" placeholder="Enter your email address" required>
            <span class="error-message"><?= $errors['email'] ?? '' ?></span>
        </div>

        <!-- Address -->
        <div class="address form-field">
            <p class="title">Address</p>
            <input name="address" id="address" class="input-form" placeholder="Enter your address" required>
            <span class="error-message"><?= $errors['address'] ?? '' ?></span>
        </div>

        <!-- Password -->
        <div class="password form-field">
            <p class="title">Password</p>
            <input name="password" type="password" id="password" class="input-form" placeholder="Enter your password" required>
            <span class="error-message"><?= $errors['password'] ?? '' ?></span>
        </div>

        <!-- Confirm Password -->
        <div class="confirm-password form-field">
            <p class="title">Confirm your password</p>
            <input name="confirm-password" type="password" id="confirm-password" class="input-form" minlength="6"
                placeholder="Confirm your password" required>
            <span class="error-message"><?= $errors['confirm-password'] ?? '' ?></span>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-signin-submit" name="signin-submit">SIGN IN</button>
    </form>
    <p class="form-footer">
        <a class="btn-login" href="/Scholar/User/login">Login</a>
        if you already have account.
    </p>
</div>