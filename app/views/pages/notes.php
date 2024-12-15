<!-- Hero -->
<div class="hero-note">
    <div class="left-content">
        <div class="title-hero">
            Best Selling Notes
        </div>
        <div class="description">
            The easiest way to feel happy is to buy the notebooks you love
        </div>
    </div>
    <div class="right-content">
        <?php
        $products = array_slice($data["Products"], 8, 3);
        ?>
        <?php foreach ($products as $product): ?>
        <div class="card-note">
            <a href="#" class="card-link">
                <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="Notebook" class="img-note">
                <div class="name"><?php echo htmlspecialchars($product['name']); ?></div>
                <div class="price">$<?php echo number_format($product['price'], 2); ?></div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Slider -->
<div class="slider-container">
    <!-- Slider 1  -->
    <div class="note-slider">
        <div class="slides">
            <?php
            $products = array_slice($data["Products"], 8, 4);
            ?>
            <?php foreach ($products as $product): ?>
                <a href="#" class="slide">
                    <img src="<?php echo htmlspecialchars($product['images'][0]['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
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
                <a href="#" class="slide">
                    <img src="<?php echo htmlspecialchars($product['images'][0]['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- Note Products -->
<a href="#" class="cards">
    <?php
    $products = array_slice($data["Products"], 0, 8);
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