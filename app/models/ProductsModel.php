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

    // ProductsModel.php
    public function searchProductsByKeyword($searchKeyword, $sortOrder = '', $categoryId = null)
    {
        // từ khóa tìm kiếm
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
        // Tạo câu truy vấn
        $query = "SELECT * FROM products WHERE name LIKE '$searchTerm'  $categoryQuery  $sortQuery";

        // Thực hiện truy vấn và trả về kết quả
        $result = mysqli_query($this->con, $query)
            or die('MySQL Error: ' . mysqli_error($this->con));

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
