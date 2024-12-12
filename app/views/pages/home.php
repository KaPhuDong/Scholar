<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>

<body>
    <div class="cards extra-cards">
        <?php
        $products = array_slice($data["Products"], 0, 3);
        ?>

        <?php foreach ($products as $product): ?>
            <div class="card extra-card">
                <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
                <div class="content">
                    <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <div class="cards extra-cards">
        <?php
        $products = array_slice($data["Products"], 3, 9);
        ?>

        <?php foreach ($products as $product): ?>
            <div class="card extra-card">
                <img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product" class="img">
                <div class="content">
                    <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                    <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- Slider -->
    <div class="home-slider">
        <div class="slides">
            <div class="slide"><img src="https://i.pinimg.com/736x/2c/37/c6/2c37c6df47e05a3c75e6e7d7fbfbafeb.jpg" alt="Slide 1"></div>
            <div class="slide"><img src="https://i.pinimg.com/736x/2c/37/c6/2c37c6df47e05a3c75e6e7d7fbfbafeb.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="https://i.pinimg.com/736x/2c/37/c6/2c37c6df47e05a3c75e6e7d7fbfbafeb.jpg" alt="Slide 3"></div>
            <div class="slide"><img src="https://i.pinimg.com/736x/2c/37/c6/2c37c6df47e05a3c75e6e7d7fbfbafeb.jpg" alt="Slide 1"></div>
        </div>
    </div>
</body>

</html>