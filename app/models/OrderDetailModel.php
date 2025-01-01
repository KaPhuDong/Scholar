<?php

class OrderDetailModel extends Database
{
    public function getOrderDetail($order_id, $product_id)
    {
        $qr = "SELECT * FROM order_detail 
        WHERE order_id = $order_id AND product_id = $product_id";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_assoc($result);
    }

    public function createOrderDetail($order_id, $product_id, $quantity)
    {
        $qr = "INSERT INTO order_detail (order_id, product_id, quantity) 
        VALUES ('$order_id', '$product_id', '$quantity')";
        return mysqli_query($this->con, $qr);
    }

    public function updateOrderDetailQuantity($order_id, $product_id, $newQuantity)
    {
        $qr = "UPDATE order_detail SET quantity = '$newQuantity' 
                WHERE order_id = $order_id AND product_id = $product_id";
        $result = mysqli_query($this->con, $qr);

        if ($result) {

            $this->updateOrderTotalAmount($order_id);
        }

        return $result;
    }

    public function getOrderDetailByOrderId($order_id)
    {
        $qr = "SELECT od.*, p.name, p.price, p.stock 
        FROM order_detail od 
        JOIN products p ON od.product_id = p.product_id
        WHERE od.order_id = $order_id";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function updateOrderTotalAmount($order_id)
    {
        $qr = "UPDATE orders SET total_amount = (
            SELECT SUM(od.quantity * p.price) 
            FROM order_detail od 
            JOIN products p ON od.product_id = p.product_id 
            WHERE od.order_id = $order_id
        ) WHERE order_id = $order_id";

        return mysqli_query($this->con, $qr);
    }

    public function getOrderDetailById($order_detail_id)
    {
        $qr = "SELECT * FROM order_detail WHERE order_detail_id = $order_detail_id";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_assoc($result);
    }

    public function getOrderDetailsByOrderId($order_id)
    {
        $qr = "SELECT * FROM order_detail WHERE order_id = $order_id";
        $result = mysqli_query($this->con, $qr);

        $details = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $details[] = $row;
        }

        return $details;
    }

    public function deleteOrderDetail($order_detail_id)
    {
        $qr = "DELETE FROM order_detail WHERE order_detail_id = $order_detail_id";
        return mysqli_query($this->con, $qr);
    }
}
