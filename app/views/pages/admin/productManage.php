<?php
$products = $data["Products"];
?>
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
                <?php foreach ($products as $product): ?>
                    <tr class="product_content">
                        <td><?php echo $product['product_id'] ?></td>
                        <td><?php echo $product['name'] ?></td>
                        <td><?php echo $product['category_id'] ?></td>
                        <td><img src="<?php echo $product['images'][0]['image_url'] ?>" alt="product-img"></td>
                        <td><?php echo $product['description'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['stock'] ?></td>
                        <td class="description"><?php echo $product['description'] ?></td>
                        <!-- <td class="img"><img src="" alt="product_image" class="product_image"></td> -->
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
            </tbody>
        </table>
    </div>
</div>