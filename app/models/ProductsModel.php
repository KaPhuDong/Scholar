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

    public function getProductById($productId) {
        $sql = "SELECT * FROM Products WHERE product_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }
    public function getProductCategory($categoryId) {
        $sql = "SELECT * FROM Products WHERE category_id = ? LIMIT 4";
        $stmt = $this->con->prepare($sql); 
        $stmt->bind_param("i", $categoryId); 
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}


