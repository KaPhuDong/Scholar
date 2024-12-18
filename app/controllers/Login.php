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
                echo "<script>alert('Login successful!');</script>";
                header('Location: /Scholar/Home');

                exit;
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
            }
        }

        $this->view("authentication", [
            "Page" => "login"
        ]);
    }
}
