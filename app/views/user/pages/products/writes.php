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
        <div class="slider-3">
            <div class="slides">
                <?php
                    $products = array_slice($data["Products"], 1, 4);
                ?>
                <?php foreach ($products as $product): ?>
                <a href="#" class="slide">
                    <img  src="<?php echo $product['images'][0]['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                </a>
                <?php endforeach; ?>
            </div>
        </div>
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
                <div class="product-name"><?php echo($product['name']); ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</a>