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

    public function getUserById($userId)
    {
        $qr = "SELECT * FROM users WHERE user_id = '$userId'";
        $result = mysqli_query($this->con, $qr);
        return mysqli_fetch_assoc($result);
    }

    public function updateUser($userId, $name, $phone_number, $email, $address, $avatar)
    {
        if ($avatar) {
            $qr = "
                UPDATE users 
                SET name = '$name', phone_number = '$phone_number', email = '$email', address = '$address', avatar = '$avatar'
                WHERE user_id = $userId
            ";
            return mysqli_query($this->con, $qr);
        } else {
            $qr = "
                UPDATE users 
                SET name = '$name', phone_number = '$phone_number', email = '$email', address = '$address' 
                WHERE user_id = $userId
            ";
            return mysqli_query($this->con, $qr);
        }
    }

    public function getUsers()
    {
        $qr = "SELECT * FROM users";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
