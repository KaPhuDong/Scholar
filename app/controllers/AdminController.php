<?php
class Admin extends Controller
{
    public function index()
    {
        $this->view("admin", [
            "Page" => "admin/productManage"
        ]);
    }

    public function UserManager() {
        // Tải Model cần thiết
        $usersModel = $this->model("UsersModel");
    
        // Lấy danh sách người dùng từ Model
        $getUser = $usersModel->getAllUsers();
    
        if (empty($getUser)) {
            echo "Không có dữ liệu từ cơ sở dữ liệu.";
            exit; // Dừng tiếp tục nếu không có dữ liệu
        }
    
        // Kiểm tra và truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/userManage",
            "userData" => $getUser // Truyền dữ liệu đúng tên biến
        ]);
    }

    public function ProductManager() {
        // Tải Model cần thiết
        $usersModel = $this->model("UsersModel");
    
        // Lấy danh sách người dùng từ Model
        $getUser = $usersModel->getAllUsers();
    
        if (empty($getUser)) {
            echo "Không có dữ liệu từ cơ sở dữ liệu.";
            exit; // Dừng tiếp tục nếu không có dữ liệu
        }
    
        // Kiểm tra và truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/productManage",
            "userData" => $getUser // Truyền dữ liệu đúng tên biến
        ]);
    }
    
    
}


