<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <base href="/">
    <link rel="stylesheet" href="public/styles/main.css">
</head>

<body>
    <header class="header">
        <div class="admin-logo">
            <a class="logo" href="">
                <img src="./public/assets/images/logo.png" alt="logo" class="logo-img">
                <h4 class="logo-name">Scholar</h4>
            </a>
            <h1 class="admin">Admin</h1>
        </div>

        <div class="right-header">
            <div class="account" id="account">
                <button class="account-icon" id="account-icon"><img src="./public/assets/icons/Account.svg" alt="icon-account"></button>
                <div class="dropdown-menu" id="dropdownMenu" style="display: none;">
                    <ul>
                        <li><a href="/Scholar/User/logout">Log out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="admin-container">
        <div class="admin-sidebar">
            <ul class="sidebar-menu">
                <li class="menu-item"><a href="/Scholar/Admin/userManagement">User management</a></li>
                <li class="menu-item"><a href="/Scholar/Admin/productManagement">Product management</a></li>
                <li class="menu-item"><a href="/Scholar/Admin/orderManagement">Order management</a></li>
            </ul>
        </div>

        <div class="main-content">
            <?php require_once "./app/views/pages/" . $data["Page"] . ".php" ?>
        </div>
    </div>

    <script>
        const currentPage = "<?php echo $data['Page']; ?>";
    </script>
    <script src="./public/script/main.js" type="module"></script>
</body>

</html>