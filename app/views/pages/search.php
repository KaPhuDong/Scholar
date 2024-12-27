<div class="search-results">
    <div class="header-search">
        <img src="https://zebrapeneu.com/wp-content/uploads/2024/04/pastel-supply-1-1024x768.webp" alt="Header Background">
        <div class="title">Search results for "<?php echo $data['SearchKeyword']; ?>"</div>
    </div>

    <div class="sort-container">
        <form action="/Scholar/Products/searchProductByName" method="get">
            <label for="sort">Sort by</label>
            <select id="sort" name="sort" onchange="this.form.submit()">
                <option value="">Price</option>
                <option value="high-to-low" <?php echo $data['SortOrder'] === 'high-to-low' ? 'selected' : ''; ?>>High to Low</option>
                <option value="low-to-high" <?php echo $data['SortOrder'] === 'low-to-high' ? 'selected' : ''; ?>>Low to High</option>
            </select>
            <input type="hidden" name="keyword" value="<?php echo $data['SearchKeyword']; ?>">
        </form>
    </div>

    <?php if (empty($data['Products'])): ?>
        <div class="no-search-result">
            <div class="title">No search results</div>
            <div class="content">Sorry, we couldn't find any results matching your search.</div>
            <div class="icon"><img src="./public/assets/icons/sad.svg" alt="Sad Icon"></div>
        </div>
    <?php endif; ?>
</div>

<div class="cards">
    <?php if (!empty($data['Products'])): ?>
        <?php foreach ($data['Products'] as $product): ?>
            <a href="/Scholar/Products/getProductInformation/<?php echo $product['product_id']; ?>">
                <div class="card">
                    <img src="<?php echo $product['images'][0]['image_url']; ?>" alt="product" class="img">
                    <div class="content">
                        <div class="product-name"><?php echo $product['name']; ?></div>
                        <div class="product-price">$<?php echo number_format($product['price'], 2); ?></div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
</div>