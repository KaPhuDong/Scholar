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
        <div class="card-note">
            <a href="#" class="card-link">
                <img src="https://i.pinimg.com/736x/c9/89/f2/c989f2b5db54962255bbab00d7a65b7a.jpg" alt="Notebook" class="img-note">
                <div class="name">Notebook</div>
                <div class="price">$15.000</div>
            </a>
        </div>
        <div class="card-note">
            <a href="#" class="card-link">
                <img src="https://i.pinimg.com/736x/47/3e/be/473ebe76ee158faff4845a02db8727b5.jpg" alt="Notebook" class="img-note">
                <div class="name">Notebook</div>
                <div class="price">$15.000</div>
            </a>
        </div>
        <div class="card-note">
            <a href="#" class="card-link">
                <img src="https://i.pinimg.com/736x/c9/e9/3d/c9e93d58f5e53ac8f8e148bab72ec6a8.jpg" alt="Notebook" class="img-note">
                <div class="name">Notebook</div>
                <div class="price">$15.000</div>
            </a>
        </div>
    </div>
</div>

<!-- Slider -->
<div class="slider-container">
    <div class="note-slider">
        <div class="slides">
            <div class="slide"><img src="./public/assets/images/note-slide-1.png" alt="Slide 1"></div>
            <div class="slide"><img src="./public/assets/images/note-slide-1.png" alt="Slide 2"></div>
            <div class="slide"><img src="./public/assets/images/note-slide-1.png" alt="Slide 3"></div>
            <div class="slide"><img src="./public/assets/images/note-slide-1.png" alt="Slide 1"></div>
        </div>
    </div>
    <div class="note-slider">
        <div class="slides">
            <div class="slide"><img src="./public/assets/images/note-slide-2.png" alt="Slide 1"></div>
            <div class="slide"><img src="./public/assets/images/note-slide-2.png" alt="Slide 2"></div>
            <div class="slide"><img src="./public/assets/images/note-slide-2.png" alt="Slide 3"></div>
            <div class="slide"><img src="./public/assets/images/note-slide-2.png" alt="Slide 1"></div>
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