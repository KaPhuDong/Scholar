<div class="product-management">
    <p class="title">Product Management</p>
    <div class="filter">
        <div class="filter-button">All (5)</div>
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
            <tbody>
                <?php if (!empty($userData) && is_array($userData)): ?>
                    <?php foreach ($userData as $row): ?>
                        <tr>
                            <td><?= $row['product_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['category_id'] ?></td>
                            <!-- <td><img src="<?= $row['avatar'] ?>" alt="Avatar" class="avatar"></td> -->
                            <td><?= $row['description'] ?></td>
                            <td><?= $row['price'] ?></td>
                            <td><?= $row['stock'] ?></td>
                            <td>**********</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Không có sản phẩm  nào trong Database</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>