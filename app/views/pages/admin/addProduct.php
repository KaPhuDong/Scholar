<?php
$products = $data["Products"];
?>

<div class="update-product">
    <form action="/Scholar/Admin/updateProduct/<?php echo $products['product_id']; ?>" method="POST" enctype="multipart/form-data" class="infor-product">
        <div class="form-update-product">
            <h1 class="update-infor-product">Update Product</h1>
            <div class="form-group">
                <label for="productname">Product name:</label>
                <input type="text" name="productname" value="<?php echo $products['name']; ?>" placeholder="Enter product name">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" value="<?php echo $products['category_id']; ?>" placeholder="Enter category">
            </div>
            <div class="form-group">
                <label class="upload-image" for="productimage">Choose image:</label>
                <input type="file" id="productimage" name="productimage" class="update-image" accept="image/*">
                <img src="<?php echo $products['image_url']; ?>" alt="Current Image" class="current-product-image" />
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" value="<?php echo $products['description']; ?>" placeholder="Enter description">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" name="price" value="<?php echo $products['price']; ?>" placeholder="Enter price">
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="text" name="stock" value="<?php echo $products['stock']; ?>" placeholder="Enter stock">
            </div>

            <div class="form-group-btn">
                <button class="product-btn" type="submit" name="update">Update Product</button>
                <button class="product-btn" type="reset" name="cancel" onclick="cancelChanges()">Cancel</button>
            </div>
        </div>  
    </form>
</div>
