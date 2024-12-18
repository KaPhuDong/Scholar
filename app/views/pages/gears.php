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
            <a href="#" class="hero-link img-hero-<?php echo $index; ?>">
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
        <a href="#" class="slide">
            <img  src="<?php echo $product['images'][0]['image_url']; ?>" alt="<?php echo $product['name']; ?>">
        </a>
        <?php endforeach; ?>
    </div>
</div>
<!-- Card -->
<a href="#" class="cards">
    <?php
    $products = array_slice($data["Products"], 8, 8);
    ?>

    <?php foreach ($products as $product): ?>
        <div class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</a>