<!-- Hero -->
<div class="hero-gear">
    <div class="content-left">
        <div class="text">We picked some <span class="special">cool things</span> for you!*</div>
    </div>
    <div class="content-right">
        <?php
        $products = array_slice($data["Products"], 1, 4);
        $index = 1;
        ?>
        <?php foreach ($products as $product): ?>
            <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="hero-link img-hero-<?php echo $index; ?>">
                <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="Product">
            </a>
            <?php $index++; ?>
        <?php endforeach; ?>
    </div>
</div>

<!-- Slider -->
<div class="slider-1">
    <div class="slides">
        <?php
        $products = array_slice($data["Products"], 5, 4);
        ?>
        <?php foreach ($products as $product): ?>
            <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="slide">
                <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="<?php echo $product['name']; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- Card -->
<div class="cards">
    <?php
    $products = array_slice($data["Products"], 6, 4);
    ?>
    <?php foreach ($products as $product): ?>
        <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo ($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </a>
    <?php endforeach; ?>

    <?php
    $products = array_slice($data["Products"], 11, 4);
    ?>
    <?php foreach ($products as $product): ?>
        <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo ($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>