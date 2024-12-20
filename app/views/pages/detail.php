<?php
$product = $data["Product"];
?>
<div class="detail-page">
    <div class="box-detail">
        <div class="detail">
            <div class="img-product-detail">
                <div class="main-product-detail">
                    <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="product" class="main-product">
                </div>
                <div class="recommend-product-detail">
                    <!-- Hiển thị các ảnh gợi ý -->
                    <?php foreach ($product['images'] as $image): ?>
                        <img src="<?php echo $image['image_url']; ?>" alt="product" class="recommend-product">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="infor-detail">
                <div class="content-detail">
                    <p class="title-detail"><?php echo $product['name']; ?></p>
                    <p class="des-detail">Available: <?php echo $product['stock']; ?> quantities in stock</p>
                    <p class="price-detail"><?php echo $product['price']; ?> đ</p>
                </div>

                <div class="quantity-detail">
                    <div class="underline-detail"></div>
                    <p class="quantity">Quantity:</p>
                    <div class="button-quantity">
                        <button type="button" class="btn-quantity" id="decrease">-</button>
                        <input type="number" value="1" min="1" id="quantity" class="btn-number-quantity">
                        <button type="button" class="btn-quantity" id="increase">+</button>
                    </div>
                </div>

                <div class="button-detail">
                    <button type="button" class="btn-add-to-cart">Add to cart</button>
                    <button type="button" class="btn-buy-now">Buy now</button>
                </div>
            </div>
        </div>
    </div>

    <div class="product-details">
        <h1 class="product-title">Product details</h1>
        <p class="product-subtitle">PRODUCT ADVANTAGES OF <?php echo $product['name']; ?>:</p>
        <ul class="product-benefits">
            <li><?php echo $product['description']; ?></li>
        </ul>
    </div>
</div>