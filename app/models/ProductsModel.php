<?php

class ProductsModel extends Database
{
    public function getProducts()
    {
        $qr = "SELECT * FROM products";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getProductsByCategory($categoryId)
    {
        $qr = "SELECT * FROM products WHERE category_id = $categoryId";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getProductById($productId)
    {
        $qr = "SELECT * FROM products WHERE product_id = $productId";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_assoc($result);
    }

    // ProductsModel.php
    public function searchProductsByKeyword($searchKeyword, $sortOrder = '')
    {
        // Làm sạch từ khóa tìm kiếm
        $searchKeyword = mysqli_real_escape_string($this->con, $searchKeyword);
        $searchTerm = "%$searchKeyword%";
    
        // Xử lý tham số sắp xếp
        $sortQuery = match ($sortOrder) {
            'high-to-low' => 'ORDER BY price DESC',
            'low-to-high' => 'ORDER BY price ASC',
            default => ''
        };
    
        // Tạo câu truy vấn
        $query = "SELECT * FROM products WHERE name LIKE '$searchTerm' $sortQuery";
    
        // Thực hiện truy vấn và trả về kết quả
        $result = mysqli_query($this->con, $query) 
            or die('MySQL Error: ' . mysqli_error($this->con));
    
        return mysqli_fetch_all($result, MYSQLI_ASSOC);

    }
}


    
    

