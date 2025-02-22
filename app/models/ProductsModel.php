<?php

class ProductsModel extends Database
{
    public function getProducts()
    {
        $qr = "
        SELECT 
            products.product_id, 
            products.name AS name, 
            products.description, 
            products.price, 
            products.stock, 
            categories.category_id, 
            categories.name AS category_name
        FROM 
            products
        LEFT JOIN 
            categories 
        ON 
            products.category_id = categories.category_id";

        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getProductsByCategory($category_id)
    {
        $qr = "SELECT * FROM products WHERE category_id = $category_id";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getProductById($product_id)
    {
        $qr = "SELECT * FROM products WHERE product_id = $product_id";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_assoc($result);
    }

    public function searchProductsByKeyword($searchKeyword, $sortOrder = '', $categoryId = null)
    {
        $searchTerm = "%$searchKeyword%";

        $sortQuery = match ($sortOrder) {
            'high-to-low' => 'ORDER BY products.price DESC',
            'low-to-high' => 'ORDER BY products.price ASC',
            default => ''
        };

        $categoryQuery = '';
        if ($categoryId && $categoryId !== 'all') {
            $categoryQuery = "AND products.category_id = '$categoryId'";
        }

        $query = "
            SELECT 
                products.product_id, 
                products.name AS name, 
                products.description, 
                products.price, 
                products.stock, 
                categories.category_id, 
                categories.name AS category_name
            FROM 
                products
            LEFT JOIN 
                categories 
            ON 
                products.category_id = categories.category_id
            WHERE 
                products.name LIKE '$searchTerm' 
            $categoryQuery
            $sortQuery
        ";

        $result = mysqli_query($this->con, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function countProductsByKeyword($searchKeyword, $categoryId = null)
    {

        $searchKeyword = mysqli_real_escape_string($this->con, $searchKeyword);
        $searchTerm = "%$searchKeyword%";

        $categoryQuery = '';
        if ($categoryId && $categoryId !== 'all') {
            $categoryId = mysqli_real_escape_string($this->con, $categoryId);
            $categoryQuery = "AND category_id = '$categoryId'";
        }

        $query = "SELECT COUNT(*) AS total FROM products WHERE name LIKE '$searchTerm' $categoryQuery";
        $result = mysqli_query($this->con, $query);

        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    public function deleteProduct($product_id)
    {
        $qr = "DELETE FROM products WHERE product_id = $product_id";
        return mysqli_query($this->con, $qr);
    }

    public function addProduct($name, $category_id, $description, $price, $stock, $image_url = null)
    {
        $qr = "INSERT INTO products (name, category_id, description, price, stock) 
               VALUES ('$name', $category_id, '$description', $price, $stock)";
        $result = mysqli_query($this->con, $qr);

        if ($result && $image_url) {
            $product_id = mysqli_insert_id($this->con);
            $qr_image = "INSERT INTO product_images (product_id, image_url) 
                         VALUES ($product_id, '$image_url')";
            mysqli_query($this->con, $qr_image);
        }

        return $result;
    }

    public function updateProduct($product_id, $name, $category_id, $description, $price, $stock, $image_url = null)
    {
        $qr = "UPDATE products 
            SET name = '$name', category_id = $category_id, description = '$description', 
                price = $price, stock = $stock 
            WHERE product_id = $product_id";
        $result = mysqli_query($this->con, $qr);

        if ($result && $image_url) {
            $qr_check = "SELECT * FROM product_images WHERE product_id = $product_id";
            $check_result = mysqli_query($this->con, $qr_check);

            if (mysqli_num_rows($check_result) > 0) {
                $qr_image = "UPDATE product_images 
                            SET image_url = '$image_url' 
                            WHERE product_id = $product_id";
            } else {
                $qr_image = "INSERT INTO product_images (product_id, image_url) 
                            VALUES ($product_id, '$image_url')";
            }

            mysqli_query($this->con, $qr_image);
        }

        return $result;
    }

    public function updateProductStock($product_id, $quantity_sold)
    {
        $qr = "UPDATE products 
           SET stock = stock - $quantity_sold 
           WHERE product_id = $product_id AND stock >= $quantity_sold";

        $result = mysqli_query($this->con, $qr);

        return $result;
    }
}
