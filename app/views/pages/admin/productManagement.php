<div class="product-management">
    <form action="/Scholar/Admin/productManagement" method="GET">
        <div class="header-product">
            <p class="title">Product Management</p>
            <div class="search-product">
                <input
                    type="text"
                    name="keyword"
                    class="input-product"
                    placeholder="Search for products..."
                    value="<?php echo $data['SearchKeyword']; ?>" />
                <button type="submit" class="button-product">
                    <img src="./public/assets/icons/search.svg" alt="Search Icon">
                </button>
            </div>
        </div>

        <!-- Sort block -->
        <div class="sort-filter">
            <div class="sort-block">
                <label for="sortOrder">Sort By</label>
                <select id="sortOrder" name="sort" class="input-user" onchange="this.form.submit()">
                    <option value="" <?php echo $data['SortOrder'] === '' ? 'selected' : ''; ?>>Price</option>
                    <option value="high-to-low" <?php echo $data['SortOrder'] === 'high-to-low' ? 'selected' : ''; ?>>High to Low</option>
                    <option value="low-to-high" <?php echo $data['SortOrder'] === 'low-to-high' ? 'selected' : ''; ?>>Low to High</option>
                </select>
            </div>

            <!-- Category filter dropdown -->
            <div class="category-block">
                <label for="category">Category</label>
                <select id="category" name="category" class="input-user" onchange="this.form.submit()">
                    <option value="all" <?php echo ($data['Category'] === 'all') ? 'selected' : ''; ?>>All</option>
                    <option value="1" <?php echo ($data['Category'] === '1') ? 'selected' : ''; ?>>Note</option>
                    <option value="2" <?php echo ($data['Category'] === '2') ? 'selected' : ''; ?>>Write</option>
                    <option value="3" <?php echo ($data['Category'] === '3') ? 'selected' : ''; ?>>Gear</option>
                </select>
            </div>
        </div>

        <!-- Hidden input to preserve keyword -->
        <input type="hidden" name="page" value="<?php echo $data['CurrentPage']; ?>">
        <button type="submit" class="button-user" style="display:none;"></button>
    </form>

    <div class="filter-product">
        <div class="left-content">
            <div class="filter-quantity">All (<?php echo $data['TotalProducts'];; ?>)</div>
            <div class="add-product">
                <a href="/Scholar/Admin/addProduct"><button type="submit">+ Add new product</button></a>
            </div>
        </div>

        <?php if ($data['TotalPages'] > 1): ?>
            <div class="pagination">
                <?php if ($data['CurrentPage'] > 1): ?>
                    <a href="/Scholar/Admin/productManagement?keyword=<?php echo $data['SearchKeyword']; ?>&category=<?php echo $data['Category']; ?>&sort=<?php echo $data['SortOrder']; ?>&page=<?php echo $data['CurrentPage'] - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $data['TotalPages']; $i++): ?>
                    <a href="/Scholar/Admin/productManagement?keyword=<?php echo $data['SearchKeyword']; ?>&category=<?php echo $data['Category']; ?>&sort=<?php echo $data['SortOrder']; ?>&page=<?php echo $i; ?>" class="<?php echo ($i == $data['CurrentPage']) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($data['CurrentPage'] < $data['TotalPages']): ?>
                    <a href="/Scholar/Admin/productManagement?keyword=<?php echo $data['SearchKeyword']; ?>&category=<?php echo $data['Category']; ?>&sort=<?php echo $data['SortOrder']; ?>&page=<?php echo $data['CurrentPage'] + 1; ?>" class="next">Next</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th class="column-productname">Product Name</th>
                    <th class="column-category">Category</th>
                    <th class="column-productimage">Product Image</th>
                    <th class="column-description">Description</th>
                    <th class="column-price">Price</th>
                    <th class="column-stock">Stock</th>
                    <th class="column-action">Action</th>
                </tr>
            </thead>
            <tbody class="products">
                <?php if (empty($data['Products'])): ?>
                    <tr>
                        <td colspan="8">No products found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($data['Products'] as $product): ?>
                        <tr class="product_content">
                            <td><?php echo $product['product_id']; ?></td>
                            <td><?php echo ($product['name']); ?></td>
                            <td><?php echo ($product['category_name']); ?></td>
                            <td><img src="<?php echo ($product['images'][0]['image_url']); ?>" alt="product-img" class="product-img"></td>
                            <td class="product-description"><?php echo ($product['description']); ?></td>
                            <td><?php echo ($product['price']); ?></td>
                            <td><?php echo ($product['stock']); ?></td>
                            <td class="action">
                                <form action="/Scholar/Admin/deleteProduct" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" class="delete-button">
                                        <img src="./public/assets/icons/remove.svg" alt="Delete" class="delete-icon">
                                    </button>
                                </form>

                                <form action="/Scholar/Admin/updateProduct/<?php echo $product['product_id'] ?>" method="POST" onsubmit="return confirm('Are you sure you want to edit this product?');">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button type="submit" class="edit-button">
                                        <img src="./public/assets/icons/Edit.svg" alt="Edit" class="edit-icon">
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>