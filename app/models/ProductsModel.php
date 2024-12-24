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
    public function searchProductsByKeyword($searchKeyword)
    {
        // Thêm dấu phần trăm vào từ khóa tìm kiếm
        $searchTerm = "%" . mysqli_real_escape_string($this->con, $searchKeyword) . "%";
    
        // Tạo câu truy vấn
        $qr = "SELECT * FROM products WHERE name LIKE '$searchTerm' OR description LIKE '$searchTerm'";
    
        // Thực thi truy vấn
        $result = mysqli_query($this->con, $qr);
    
        // Kiểm tra kết quả và trả về
        return $result ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
    }
    
    
}


    
    

