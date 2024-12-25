<?php
$userData = $data["userData"];
?>
<div class="container-profile">
    <div class="user-infor">
        <div class="box">
            <img class="avatar-user" alt="Profile image" src="./public/assets/images/<?php echo $userData['avatar']; ?>">
            <div class="user-content">
                <h2 class="user-name"><?php echo $userData['name']; ?></h2>
                <p class="user-email"><?php echo $userData['email']; ?></p>
                <p class="user-phone"><?php echo $userData['phone_number']; ?></p>
                <p class="user-address"><?php echo $userData['address']; ?></p>
            </div>
            <div class="menu-profile">
                <a href="/Scholar/User/profile"><img src="./public/assets/icons/Account.svg" alt="icon-account" class="icon">My profile</a>
                <a href="/Scholar/Cart"><img src="./public/assets/icons/Cart.svg" alt="icon-cart" class="icon">My shopping cart</a>
                <a href=""><img src="./public/assets/icons/Order.svg" alt="icon-order" class="icon">My order</a>
            </div>
        </div>
    </div>

    <div class="profile-page">
        <form action="" method="POST" enctype="multipart/form-data" class="profile">

            <div class="form-infor">
                <h1 class="my-profile">My profile</h1>
                <div class="form-group">
                    <label for="username">User name</label>
                    <input type="text" name="username" value="<?php echo $userData['name']; ?>" placeholder="enter username">
                </div>
                <div class="form-group">
                    <label for="phonenumber">Phone number</label>
                    <input type="text" name="phonenumber" value="<?php echo $userData['phone_number']; ?>" placeholder="enter phone number">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?php echo $userData['email']; ?>" placeholder="enter email">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="<?php echo $userData['address']; ?>" placeholder="enter address">
                </div>
                <div class="form-group-btn">
                    <button class="save-changes" name="update">Save Changes</button>
                </div>
            </div>

            <div class="form-user-avatar">
                <div class="upload-image">Choose image</div>
                <img class="avatar-preview" alt="Profile image" src="/public/assets/images/<?php echo $userData["avatar"]?>">
                <input type="file" class="update-image" value="Choose image">
                <button class="save-changes" name="update">Cancel</button>
            </div>
        </form>
    </div>
</div>