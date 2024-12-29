<!-- Hero -->
<div class="hero">
    <img src="https://zebrapeneu.com/wp-content/uploads/2024/04/pastel-supply-1-1024x768.webp" alt="" class="img-hero">
</div>

<!-- Category -->
<div class="category-cards">
    <a href="/Scholar/Home/getWrites" class="category-card">
        <img src="./public/assets/images/Write.jpg" alt="Writes" class="img-item">
        <div class="text">Writes</div>
    </a>
    <a href="/Scholar/Home/getNotes" class="category-card">
        <img src="./public/assets/images/Note.jpg" alt="Notes" class="img-item">
        <div class="text">Notes</div>
    </a>
    <a href="/Scholar/Home/getGears" class="category-card">
        <img src="./public/assets/images/Gear.jpg" alt="Gears" class="img-item">
        <div class="text">Gears</div>
    </a>
</div>

<!-- Card -->
<div class="cards">
    <?php
    $products = array_slice($data["Products"], 13, 4);
    ?>
    <?php foreach ($products as $product): ?>
        <a href="/Scholar/Products/getProductInformation/<?php echo $product['product_id']; ?>">
            <div class="card">
                <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="product" class="img">
                <div class="content">
                    <div class="product-name"><?php echo $product['name']; ?></div>
                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<!-- slider -->
<div class="slider-1">
    <div class="slides">
        <?php
        $products = array_slice($data["Products"], 15, 5);
        ?>
        <?php foreach ($products as $product): ?>
            <a href="/Scholar/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="slide">
                <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="<?php echo $product['name']; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Card -->
<div class="cards">
    <?php
    $products = array_slice($data["Products"], 8, 4);
    ?>

    <?php foreach ($products as $product): ?>
        <a href="/Scholar/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<div class="cards">
    <?php
    $products = array_slice($data["Products"], 30, 4);
    ?>

    <?php foreach ($products as $product): ?>
        <a href="/Scholar/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo ($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>