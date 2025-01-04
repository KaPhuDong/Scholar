<?php

class OrdersModel extends Database
{
    public function getPendingOrders($user_id)
    {
        $qr = "SELECT * FROM orders 
        WHERE user_id = $user_id AND status = 'Pending'
        ORDER BY order_date DESC";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getOrderByStatus($user_id, $status)
    {
        $qr = "SELECT * FROM orders 
        WHERE user_id = $user_id AND status = '$status'
        ORDER BY order_date DESC";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getNewOrder($user_id)
    {
        $qr = "SELECT * FROM orders 
        WHERE user_id = $user_id AND status = 'Pending' 
        ORDER BY order_date DESC 
        LIMIT 1";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_assoc($result);
    }

    public function createOrder($user_id, $totalAmount)
    {
        $qr = "INSERT INTO orders (user_id, total_amount, status) 
        VALUES ('$user_id', '$totalAmount', 'Pending')";
        return mysqli_query($this->con, $qr);
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

    public function updateOrderStatus($order_id, $status)
    {
        $qr = "UPDATE orders SET status = '$status' WHERE order_id = $order_id";
        return mysqli_query($this->con, $qr);
    }

    public function deleteOrder($order_id)
    {
        $qr = "DELETE FROM orders WHERE order_id = $order_id";
        return mysqli_query($this->con, $qr);
    }

    public function getOrders()
    {
        $qr = "SELECT 
            o.order_id AS ID, 
            d.recipient_name AS Recipient, 
            d.phone_number AS Phone, 
            d.delivery_address AS Delivery_Address,
            o.status AS Status
        FROM 
            orders o
        JOIN 
            delivery_information d ON o.order_id = d.order_id;";

        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function searchOrdersByTime($searchKeyword)
    {
        $searchTerm = !empty($searchKeyword) ? "%$searchKeyword%" : '%';

        $query = "SELECT * FROM orders WHERE order_date LIKE '%$searchTerm%'";

        $result = mysqli_query($this->con, $query);

        if (!$result) {
            die('MySQL Error: ' . mysqli_error($this->con));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
