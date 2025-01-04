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
        $searchKeyword = mysqli_real_escape_string($this->con, $searchKeyword);
        $searchTerm = "%$searchKeyword%";

        $sortQuery = match ($sortOrder) {
            'high-to-low' => 'ORDER BY price DESC',
            'low-to-high' => 'ORDER BY price ASC',
            default => ''
        };

        $categoryQuery = '';
        if ($categoryId && $categoryId !== 'all') {
            $categoryId = mysqli_real_escape_string($this->con, $categoryId);
            $categoryQuery = "AND category_id = '$categoryId'";
        }

        $query = "SELECT * FROM products WHERE name LIKE '$searchTerm'  $categoryQuery  $sortQuery";
        $result = mysqli_query($this->con, $query);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function countProductsByKeyword($searchKeyword, $categoryId = null)
    {

        $searchKeyword = mysqli_real_escape_string($this->con, $searchKeyword);
        $searchTerm = "%$searchKeyword%";

        // Xử lý lọc theo danh mục
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

    public function deleteProduct($product_id){
        $qr = "DELETE FROM products WHERE product_id = $product_id";
        return mysqli_query($this->con, $qr);
    }
}
