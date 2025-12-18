<!-- Hero -->
<div class="hero-note">
    <div class="left-content">
        <div class="hero-title">
            Best Selling Notes
        </div>
        <div class="hero-description">
            The easiest way to feel happy is to buy the notebooks you love
        </div>
    </div>
    <div class="right-content">
        <?php
        $products = array_slice($data["Products"], 8, 3);
        ?>
        <?php foreach ($products as $product): ?>
            <div class="card-note">
                <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="card-link">
                    <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="Notebook" class="img-note">
                    <div class="name"><?php echo $product['name']; ?></div>
                    <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- Slider -->
<div class="slider-2">
    <div class="note-slider">
        <div class="slides">
            <?php
            $products = array_slice($data["Products"], 8, 4);
            ?>
            <?php foreach ($products as $product): ?>
                <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="slide">
                    <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- Slider 2 -->
    <div class="note-slider">
        <div class="slides">
            <?php
            $products = array_slice($data["Products"], 2, 4);
            ?>
            <?php foreach ($products as $product): ?>
                <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="slide">
                    <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="<?php echo $product['name']; ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- Note Products -->
<div class="cards">
    <?php
    $products = array_slice($data["Products"], 0, 8);
    ?>

    <?php foreach ($products as $product): ?>
        <a href="/Products/getProductInformation/<?php echo $product['product_id']; ?>" class="card">
            <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
            <div class="content">
                <div class="product-name"><?php echo $product['name']; ?></div>
                <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>