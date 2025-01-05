<?php
$product = $data["Product"] ?? null;
$action = $data["Action"] ?? 'add';
?>

<div class="update-product">
    <form action="/Scholar/Admin/saveProduct/" method="POST" enctype="multipart/form-data" class="infor-product">
        <div class="form-update-product">
            <?php if ($action === "update"): ?>
                <h1 class="update-infor-product">Update Product</h1>
            <?php else: ?>
                <h1 class="add-infor-product">Add Product</h1>
            <?php endif; ?>

            <!-- Hidden field to store product ID -->
            <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?? ''; ?>">

            <div class="form-product">
                <label for="productname">Product name:</label>
                <input type="text" name="productname" value="<?php echo $product['name'] ?? ''; ?>" placeholder="Enter product name">
            </div>
            <div class="form-product">
                <label for="category">Category:</label>
                <input type="text" name="category" value="<?php echo $product['category_id'] ?? ''; ?>" placeholder="Enter category">
            </div>
            <div class="form-product">
                <label for="productimage">Choose image:</label>
                <input type="file" id="productimage" name="productimage" class="update-image">
            </div>
            <div class="form-product">
                <label for="description">Description:</label>
                <input type="text" name="description" value="<?php echo $product['description'] ?? ''; ?>" placeholder="Enter description">
            </div>
            <div class="form-product">
                <label for="price">Price:</label>
                <input type="text" name="price" value="<?php echo $product['price'] ?? ''; ?>" placeholder="Enter price">
            </div>
            <div class="form-product">
                <label for="stock">Stock:</label>
                <input type="text" name="stock" value="<?php echo $product['stock'] ?? ''; ?>" placeholder="Enter stock">
            </div>

            <div class="form-product-btn">
                <button class="btn" type="submit" name="update">Save</button>
                <button class="btn" type="reset" name="cancel" onclick="cancelChanges()">Cancel</button>
            </div>
        </div>
    </form>
</div>