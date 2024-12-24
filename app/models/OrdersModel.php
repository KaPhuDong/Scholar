<?php

class OrdersModel extends Database
{
    public function insertOrder($user_id, $total_amount, $status)
    {
        $qr = "INSERT INTO users ($user_id, $total_amount, $status) 
        VALUES ($user_id, $total_amount, '$status')";
        return mysqli_query($this->con, $qr);
    }
}
