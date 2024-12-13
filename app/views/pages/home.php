<!-- Hero -->
<div class="hero">
    <div class="content">
        <div class="heading">Scholar</div>
        <div class="description">School Supplies</div>
    </div>
    <img src="https://img.freepik.com/premium-photo/school-supplies-grey-background_78621-574.jpg?w=826" alt="" class="img-hero">
</div>

<!-- Category -->
<div class="category-cards">
    <a href="/Scholar/Writes" class="category-card">
        <img src="./public/assets/images/Write.jpg" alt="Writes" class="img-item">
        <div class="text">Writes</div>
    </a>
    <a href="/Scholar/Notes" class="category-card">
        <img src="./public/assets/images/Note.jpg" alt="Notes" class="img-item">
        <div class="text">Notes</div>
    </a>
    <a href="/Scholar/Gears" class="category-card">
        <img src="./public/assets/images/Gear.jpg" alt="Gears" class="img-item">
        <div class="text">Gears</div>
    </a>
</div>

<!-- Card -->
<a href="#" class="cards">
    <?php
    $products = array_slice($data["Products"], 0, 4);
    ?>

    <?php foreach ($products as $product): ?>
        <div class="card ">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</a>

<div class="home-slider">
    <div class="slides">
        <div class="slide"><img src="./public/assets/images/home-slider.png" alt="Slide 1"></div>
        <div class="slide"><img src="./public/assets/images/home-slider.png" alt="Slide 2"></div>
        <div class="slide"><img src="./public/assets/images/home-slider.png" alt="Slide 3"></div>
        <div class="slide"><img src="./public/assets/images/home-slider.png" alt="Slide 1"></div>
    </div>
</div>

<a href="#" class="cards">
    <?php
    $products = array_slice($data["Products"], 3, 8);
    ?>

    <?php foreach ($products as $product): ?>
        <div class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</a>