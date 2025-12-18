<header class="header">
    <div class="left-header">
        <a class="logo" href="/Home">
            <img src="./public/assets/images/logo.png" alt="logo" class="logo-img">
            <h1 class="logo-name">Scholar</h1>
        </a>

        <div class="search">
            <form action="/Home/searchProductByName" method="get" class="search-input">
                <input name="keyword" class="search-input" placeholder="Search product">
            </form>
            <div class="search-icon">
                <img src="./public/assets/icons/search.svg" alt="icon-search" class="search-icon-img">
            </div>

        </div>
    </div>

    <div class="category">
        <div class="category-item"><a href="/Home" class="link">Home</a></div>
        <div class="category-item"><a href="/Home/getWrites" class="link">Writes</a></div>
        <div class="category-item"><a href="/Home/getNotes" class="link">Notes</a></div>
        <div class="category-item"><a href="/Home/getGears" class="link">Gears</a></div>
    </div>
    <div class="right-header">
        <a href="/Orders/viewCart" class="cart"><img src="./public/assets/icons/Cart.svg" alt="cart"></a>

        <?php if (isset($_SESSION['user'])): ?>
            <div class="account" id="account">
                <button class="account-icon" id="account-icon"><img src="./public/assets/icons/Account.svg" alt="icon-account"></button>
                <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                    <ul>
                        <li><a href="/User/profile">My profile</a></li>
                        <li><a href="/Orders/historyOrders">My orders</a></li>
                        <li><a href="/User/logout">Log out</a></li>
                    </ul>
                </div>
            </div>
        <?php else: ?>
            <div class="authentication" id="authentication">
                <a href="/User/register" class="sign-in">Sign up</a>
                <a href="/User/login" class="log-in">Log in</a>
            </div>
        <?php endif; ?>
    </div>
</header>