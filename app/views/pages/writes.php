<!-- Hero -->
<div class="hero-write">
    <div class="left-content">
        <div class="content-title">
            <span class="highlight">Empower</span>
            Your Learning Journey!
        </div>
        <div class="content-description">
            Start work with us
        </div>
        <div class="button-write">
            Scholar
        </div>
    </div>
    <div class="right-content">
        <img src="https://i.pinimg.com/736x/65/a0/87/65a0873b4fb2f353f4323b2a18db2050.jpg" alt="" class="img-write">
        <img src="https://i.pinimg.com/736x/2d/be/ea/2dbeeab9a026621cd7505387d5ac4e6a.jpg" alt="" class="img-write">
    </div>
</div>

<!-- Write-Product -->
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

<!-- Write-Product -->
<a href="#" class="cards">
    <?php
    $products = array_slice($data["Products"], 4, 4);
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