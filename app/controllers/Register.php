<?php
class Register extends Controller
{
    public function default()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $full_name = $_POST['full-name'] ?? '';
            $phone_number = $_POST['phone-number'] ?? '';
            $email = $_POST['email'] ?? '';
            $address = $_POST['address'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm-password'] ?? '';

            if ($password !== $confirm_password) {
                echo "<script>
                    alert('Passwords do not match!');
                    window.location.href = '/Scholar/Register';
                </script>";
                exit;
            }

            // Model
            $usersModel = $this->model("UsersModel");

            $existingUser = $usersModel->getUserByEmail($email);
            if (!empty($existingUser)) {
                echo "<script>
                    alert('Email already exists. Please use a different one.');
                    window.location.href = '/Scholar/Register';
                </script>";
                exit;
            }

            $hashed_password = md5($password);
            $insertSuccess = $usersModel->insertUser($full_name, $phone_number, $email, $address, $hashed_password);

            if ($insertSuccess) {
                echo "<script>
                    alert('Registration successful!');
                    window.location.href = '/Scholar/Home';
                </script>";
                exit;
            } else {
                echo "<script>
                    alert('Failed to register. Please try again later.');
                    window.location.href = '/Scholar/Register';
                </script>";
                exit;
            }
        }

        $this->view("authentication", [
            "Page" => "register"
        ]);
    }
}
