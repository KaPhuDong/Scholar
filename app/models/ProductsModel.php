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
        $searchTerm = "%$searchKeyword%";
        $qr = "SELECT * FROM products WHERE name LIKE '$searchTerm' OR description LIKE '$searchTerm'";
        $result = mysqli_query($this->con, $qr);
    
        if (!$result) {
            die('MySQL Error: ' . mysqli_error($this->con));
        }
    
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    
    
}


    
    

