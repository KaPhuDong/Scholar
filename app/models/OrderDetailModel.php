<?php

class OrderDetailModel extends Database
{
    public function getOrderDetail($user_id, $product_id)
    {
        $qr = "SELECT * FROM order_detail WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $result = mysqli_query($this->con, $qr);
        return mysqli_fetch_assoc($result);
    }

    public function insertOrderDetail($user_id, $product_id, $quantity)
    {
        $qr = "INSERT INTO order_detail (user_id, product_id, quantity) 
        VALUES ('$user_id', '$product_id', '$quantity')";
        return mysqli_query($this->con, $qr);
    }

    public function updateOrderDetailQuantity($user_id, $product_id, $quantity)
    {
        $qr = "UPDATE order_detail SET quantity = '$quantity' 
        WHERE user_id = '$user_id' AND product_id = '$product_id'";
        return mysqli_query($this->con, $qr);
    }
}
