<?php
$userData = $data["userData"];
?>
<div class="container-profile">
    <div class="user-infor">
        <div class="box">
            <img class="avatar-user" alt="Profile image" src="./public/assets/images/avatar/<?php echo $userData["avatar"] ?>">
            <div class="user-content">
                <h2 class="user-name"><?php echo $userData['name']; ?></h2>
                <p class="user-email"><?php echo $userData['email']; ?></p>
                <p class="user-phone"><?php echo $userData['phone_number']; ?></p>
                <p class="user-address"><?php echo $userData['address']; ?></p>
            </div>
            <div class="menu-profile">
                <a href="/Scholar/User/profile"><img src="./public/assets/icons/Account.svg" alt="icon-account" class="icon">My profile</a>
                <a href="/Scholar/Orders/viewCart"><img src="./public/assets/icons/Cart.svg" alt="icon-cart" class="icon">My shopping cart</a>
                <a href="/Scholar/Orders/historyOrders"><img src="./public/assets/icons/Order.svg" alt="icon-order" class="icon">My order</a>
            </div>
        </div>
    </div>

    <div class="profile-page">
        <form action="/Scholar/User/updateProfile" method="POST" enctype="multipart/form-data" class="profile">
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
                    <button class="save-changes" type="submit" name="update">Save Changes</button>
                </div>
            </div>

            <div class="form-user-avatar">
                <label class="upload-image" for="chooseImage">Choose image</label>
                <img class="avatar-preview" alt="Profile image" src="./public/assets/images/avatar/<?php echo $userData["avatar"] ?>">
                <input id="choose-image" name="avatar" type="file" class="update-image" accept="image/*" onchange="Avatar(event)">
                <button class="save-changes" type="reset" name="update" onclick="cancelChanges()">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    function Avatar(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.querySelector('.avatar-preview');
            output.src = reader.result;

            var userAvatar = document.querySelector('.avatar-user');
            if (userAvatar) {
                userAvatar.src = reader.result;
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.querySelector('.upload-image').addEventListener('click', function() {
        document.querySelector('.update-image').click();
    });

    function cancelChanges() {

        var originalAvatar = "/public/assets/images/avatar/<?php echo $userData["avatar"] ?>";
        document.querySelector('.avatar-preview').src = originalAvatar;
        document.querySelector('.avatar-user').src = originalAvatar;

        document.querySelector('input[name="username"]').value = "<?php echo $userData['name']; ?>";
        document.querySelector('input[name="phonenumber"]').value = "<?php echo $userData['phone_number']; ?>";
        document.querySelector('input[name="email"]').value = "<?php echo $userData['email']; ?>";
        document.querySelector('input[name="address"]').value = "<?php echo $userData['address']; ?>";

        document.querySelector('#choose-image').value = '';
    }
</script>