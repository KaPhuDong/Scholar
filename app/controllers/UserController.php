<?php
class User extends Controller
{
    public function register()
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
                    window.location.href = '/Scholar/register';
                </script>";
                exit;
            }

            // Model
            $usersModel = $this->model("UsersModel");

            $existingUser = $usersModel->getUserByEmail($email);
            if (!empty($existingUser)) {
                echo "<script>
                    alert('Email already exists. Please use a different one.');
                    window.location.href = '/Scholar/register';
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
                    window.location.href = '/Scholar/register';
                </script>";
                exit;
            }
        }

        $this->view("authentication", [
            "Page" => "user/register"
        ]);
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Model
            $usersModel = $this->model("UsersModel");
            $user = $usersModel->checkLogin($email, $password);

            if ($user) {
                $_SESSION['user'] = [
                    'id' => $user['user_id'],
                    'name' => $user['name'],
                    'email' => $user['email']
                ];

                echo "<script>
                    alert('Login successful!');
                    window.location.href = '/Scholar/Home';
                </script>";
                exit;
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
            }
        }

        $this->view("authentication", [
            "Page" => "user/login"
        ]);
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        echo "<script>
            alert('You have been logged out successfully.');
            window.location.href = '/Scholar/Home';
        </script>";
        exit;
    }

    public function profile()
    {
        $userId = $_SESSION['user']['id'];
        $usersModel = $this->model("UsersModel");
        $userData = $usersModel->getUserById($userId);

        $this->view("main", [
            "Page" => "user/profile",
            "userData" => $userData
        ]);
    }

    public function updateProfile()
    {
        $userId = $_SESSION['user']['id'];
        $usersModel = $this->model("UsersModel");
        $userData = $usersModel->getUserById($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['username'] ?? $userData['name'];
            $phone_number = $_POST['phonenumber'] ?? $userData['phone_number'];
            $email = $_POST['email'] ?? $userData['email'];
            $address = $_POST['address'] ?? $userData['address'];

            $avatar = $userData['avatar'];
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $avatar = $_FILES['avatar']['name'];
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/public/assets/images/';
                $targetFilePath = $targetDir . basename($avatar);
                move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath);
            }

            $updateSuccess = $usersModel->updateUser($userId, $name, $phone_number, $email, $address, $avatar);

            if ($updateSuccess) {
                echo "<script>
                        alert('Profile updated successfully!');
                        window.location.href = '/Scholar/User/profile';
                      </script>";
                exit;
            } else {
                echo "<script>
                        alert('Failed to update profile.');
                    </script>";
            }
        }

        $this->view("main", [
            "Page" => "user/profile",
            "userData" => $userData
        ]);
    }
}
