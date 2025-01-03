<?php
$products = $data["Products"];
$totalPages = $data["TotalPages"];
$currentPage = $data["CurrentPage"];
$totalProducts = $data["TotalProducts"];
?>
<div class="product-management">
    <p class="title">Product Management</p>
    <div class="filter">
        <div class="filter-button">All (<?php echo $totalProducts; ?>)</div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="/Scholar/Admin/productManagement?page=<?php echo $currentPage - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="/Scholar/Admin/productManagement?page=<?php echo $i; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="/Scholar/Admin/productManagement?page=<?php echo $currentPage + 1; ?>" class="next">Next</a>
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
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="8">No products found.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr class="product_content">
                            <td><?php echo $product['product_id'] ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['category_name'] ?></td>
                            <td><img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product-img" class="product-img"></td>
                            <td class="product-description"><?php echo $product['description'] ?></td>
                            <td><?php echo $product['price'] ?></td>
                            <td><?php echo $product['stock'] ?></td>
                            <td class="action">
                                <form action="/Scholar/Admin/deleteProduct" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <button class="delete-btn" type="submit"><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                                </form>
                                <a href="/Scholar/Admin/editProduct?id=<?php echo $product['product_id'] ?>">
                                    <button type="button" class="edit-btn">
                                        <i class="fa fa-pencil-square-o" style="font-size:20px"></i>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>