<header class="header">
    <div class="left-header">
        <a class="logo" href="/Scholar/Home">
            <img src="./public/assets/images/logo.png" alt="logo" class="logo-img">
            <h1 class="logo-name">Scholar</h1>
        </a>
        <div class="search">
            <input class="search-input" placeholder="Search product">
            <div class="search-icon">
                <img src="./public/assets/icons/search.svg" alt="icon-search" class="search-icon-img">
            </div>
        </div>
    </div>
    <div class="category">
        <div class="category-item"><a href="/Scholar/Home" class="link">Home</a></div>
        <div class="category-item"><a href="/Scholar/Writes" class="link">Writes</a></div>
        <div class="category-item"><a href="/Scholar/Notes" class="link">Notes</a></div>
        <div class="category-item"><a href="/Scholar/Gears" class="link">Gears</a></div>
    </div>
    <div class="right-header">
        <a href="/Scholar/Cart" class="cart"><img src="./public/assets/icons/Cart.svg" alt="cart"></a>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="account" id="account">
                <button class="account-icon" id="account-icon"><img src="./public/assets/icons/Account.svg" alt="icon-account"></button>
                <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                    <ul>
                        <li onclick="window.location.href = '/Scholar/User/profile'">View Profile</li>
                        <!-- <li onclick="window.location.href = '/order'">History Order</li> -->
                        <li><a href="/Scholar/User/logout">Log out</a></li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="authentication" id="authentication">
                <a href="/Scholar/User/register" class="sign-in">Sign up</a>
                <a href="/Scholar/User/login" class="log-in">Log in</a>
            </div>
        <?php endif; ?>
    </div>
</header>