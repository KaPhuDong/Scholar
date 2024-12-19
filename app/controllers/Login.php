<?php
class Login extends Controller
{
    public function default()
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
            "Page" => "login"
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
}
