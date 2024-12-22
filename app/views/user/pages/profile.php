<div class="container-profile">
    <div class="user-infor">
        <div class="box">
            <img class="avatar-user" alt="Profile image" src=""> 
            <div class="user-content">
                <h2 class="user-name">Son Tung</h2>
                <p class="user-email">tung@gmail.com</p>
                <p class="user-phone">0123456789</p>
                <p class="user-address">Da Nang</p>
            </div>
            <div class="menu-profile">
                <a href=""><img src="./public/assets/icons/Account.svg" alt="icon-account" class="icon">My profile</a>
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
                    <label for="">User name</label>
                    <input type="text" name="username" value="" placeholder="enter username">
                </div>
                <div class="form-group">
                    <label for="">Phone number</label>
                    <input type="text" name="phonenumber" value="" placeholder="enter phone number">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="" placeholder="enter email">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" value="" placeholder="enter address">
                </div>
                <div class="form-group">
                    <button class="save-changes" name="update">Save Changes</button>   
                </div>
            </div>

            <div class="form-user-avatar">   
                <div><img class="avatar-preview" alt="Profile image" src=""></div>
                <div><input type="file" class="update-image" value="Choose image"></div>
                <button class="save-changes" name="update">Cancel</button>
            </div>
        
        </form>
    </div>
</div>