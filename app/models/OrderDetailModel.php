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

    public function getOrderDetails()
    {
        $qr = "SELECT 
                o.order_id AS ID, 
                d.recipient_name AS Recipient, 
                d.phone_number AS Phone, 
                d.delivery_address AS Delivery_Address,
                od.product_id AS Product_ID,
                p.name AS Product_Name,
                pi.image_url AS Product_Image,
                o.order_date AS Order_Date,
                o.status AS Status
            FROM 
                orders o
            JOIN 
                delivery_information d ON o.order_id = d.order_id
            JOIN 
                order_detail od ON o.order_id = od.order_id
            JOIN 
                products p ON od.product_id = p.product_id
            LEFT JOIN 
                product_images pi ON p.product_id = pi.product_id
            GROUP BY 
                o.order_id, od.product_id"; // Đảm bảo lấy 1 ảnh đại diện cho mỗi sản phẩm

        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    public function searchOrdersByTime($searchKeyword)
    {
        $searchTerm = !empty($searchKeyword) ? "%$searchKeyword%" : '%';
    
        $query = "SELECT 
                    o.order_id AS ID, 
                    d.recipient_name AS Recipient, 
                    d.phone_number AS Phone, 
                    d.delivery_address AS Delivery_Address,
                    od.product_id AS Product_ID,
                    p.name AS Product_Name,
                    pi.image_url AS Product_Image,
                    o.order_date AS Order_Date,
                    o.status AS Status
                FROM 
                    orders o
                JOIN 
                    delivery_information d ON o.order_id = d.order_id
                JOIN 
                    order_detail od ON o.order_id = od.order_id
                JOIN 
                    products p ON od.product_id = p.product_id
                LEFT JOIN 
                    product_images pi ON p.product_id = pi.product_id
                WHERE 
                    o.order_date LIKE '%$searchTerm%'
                GROUP BY 
                    o.order_id, od.product_id"; 
    
        $result = mysqli_query($this->con, $query);
    
        if (!$result) {
            die('MySQL Error: ' . mysqli_error($this->con));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function countOrdersByTime($searchKeyword)
    {
        $searchTerm = !empty($searchKeyword) ? "%$searchKeyword%" : '%';
        
        $query = "SELECT COUNT(DISTINCT o.order_id) AS order_count
                FROM orders o
                JOIN delivery_information d ON o.order_id = d.order_id
                JOIN order_detail od ON o.order_id = od.order_id
                JOIN products p ON od.product_id = p.product_id
                LEFT JOIN product_images pi ON p.product_id = pi.product_id
                WHERE o.order_date LIKE '$searchTerm'";

        $result = mysqli_query($this->con, $query);

        if (!$result) {
            die('MySQL Error: ' . mysqli_error($this->con));
        }

        $row = mysqli_fetch_assoc($result);
        return $row['order_count'];
    }

}
