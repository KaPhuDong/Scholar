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
        
        // Xử lý sắp xếp theo giá
        $sortQuery = match ($sortOrder) {
            'high-to-low' => 'ORDER BY products.price DESC',
            'low-to-high' => 'ORDER BY products.price ASC',
            default => ''
        };
        
        // Xử lý lọc theo danh mục
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
    
        // Thực thi truy vấn
        $result = mysqli_query($this->con, $query);
        
        // Trả về kết quả dưới dạng mảng
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
}
