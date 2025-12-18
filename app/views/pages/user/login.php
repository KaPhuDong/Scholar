<div class="form-container">
    <div class="form-header">
        <h1 class="heading">Log in</h1>
        <p class="description">Begin your journey with us today</p>
    </div>
    <form action="/User/login" method="post" class="form-register">

        <!-- Email -->
        <div class="email form-field">
            <p class="title">Email</p>
            <input name="email" type="email" id="email" class="input-form" placeholder="Enter your email address" required>
        </div>

        <!-- Password -->
        <div class="password form-field">
            <p class="title">Password</p>
            <input name="password" type="password" id="password" class="input-form" placeholder="Enter your password" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-signin-submit" name="signin-submit">LOG IN</button>
    </form>
    <p class="form-footer">
        <a class="btn-register" href="/User/register">Register</a>
        if you don't have account yet.
    </p>
</div>