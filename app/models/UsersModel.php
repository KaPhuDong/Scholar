<?php

class UsersModel extends Database
{
    public function getUserByEmail($email)
    {
        $qr = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->con, $qr);
        return mysqli_fetch_assoc($result);
    }

    public function insertUser($full_name, $phone_number, $email, $address, $hashed_password)
    {
        $qr = "INSERT INTO users (name, phone_number, email, address, password, role) 
               VALUES ('$full_name', '$phone_number', '$email', '$address', '$hashed_password', 'customer')";
        return mysqli_query($this->con, $qr);
    }

    public function checkLogin($email, $password)
    {
        $hashed_password = md5($password);

        $qr = "SELECT * FROM users WHERE email = '$email' AND password = '$hashed_password'";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_assoc($result);
    }
}
