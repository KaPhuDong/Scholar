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
        $qr = "SELECT * FROM users WHERE role = 'customer'";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function deleteUserById($user_Id)
    {
        $qr = "
            DELETE FROM users 
            WHERE user_id = $user_Id
        ";
        return mysqli_query($this->con, $qr);
    }

    public function searchUsersByName($searchKeyword)
    {
        $searchTerm = !empty($searchKeyword) ? "%$searchKeyword%" : '%';

        $query = "SELECT * FROM users WHERE role = 'customer' AND name LIKE '%$searchTerm%'";

        $result = mysqli_query($this->con, $query);

        if (!$result) {
            die('MySQL Error: ' . mysqli_error($this->con));
        }
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function countUsersByName($searchKeyword)
    {
        $searchKeyword = mysqli_real_escape_string($this->con, $searchKeyword);
        $searchTerm = "%$searchKeyword%";

        $query = "SELECT COUNT(*) AS total FROM users WHERE role = 'customer' AND name LIKE '$searchTerm'";

        $result = mysqli_query($this->con, $query);

        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }


}
