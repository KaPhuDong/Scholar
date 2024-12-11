<?php

class ProductsModel extends Database
{
    public function getProducts()
    {
        $qr = "SELECT * FROM products";
        return mysqli_query($this->con, $qr);
    }
}
