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
}
