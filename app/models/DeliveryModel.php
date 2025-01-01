<?php

class DeliveryModel extends Database
{
    public function insertDelivery($order_id, $full_name, $phone_number, $address)
    {
        $qr = "INSERT INTO delivery_information (order_id, recipient_name, phone_number, delivery_address) 
        VALUES ('$order_id', '$full_name', '$phone_number', '$address')";

        return mysqli_query($this->con, $qr);
    }
}
