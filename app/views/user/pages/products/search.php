<div class="header-search">
    <img src="https://zebrapeneu.com/wp-content/uploads/2024/04/pastel-supply-1-1024x768.webp" alt="Header Background">
    <div class="title">Kết quả tìm kiếm cho "<?php echo $data['SearchKeyword']; ?>"
    
</div>

</div>

<div class="sort-container">
    <label for="sort">Sort by</label>
    <select id="sort" name="sort">
        <option value="high-to-low">Price: High to Low</option>
        <option value="low-to-high">Price: Low to High</option>
    </select>
</div>

<div class="cards">
    <?php if (empty($data['Products'])): ?>
        <div class="no-search-result">
            <div class="title">Tìm kiếm không có kết quả</div>
            <div class="content">Xin lỗi, chúng tôi không thể tìm thấy kết quả phù hợp với tìm kiếm của bạn.</div>
        </div>
    <?php else: ?>
        <?php foreach ($data['Products'] as $product): ?>
            <a href="/Scholar/Products/getProductInformation/<?php echo $product['product_id']; ?>">
                <div class="card">
                    <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="product" class="img">
                    <div class="content">
                        <div class="product-name"><?php echo htmlspecialchars($product['name']); ?></div>
                        <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
