<?php
class Admin extends Controller
{
    public function index()
    {
        $this->view("admin", [
            "Page" => "admin/userManage"
        ]);
    }

   
    public function UserManager() {
        $usersModel = $this->model("UsersModel");
    
        // Lấy danh sách người dùng
        $getUser = $usersModel->getAllUsers();
    
        if (empty($getUser)) {
            echo "Không có dữ liệu từ cơ sở dữ liệu.";
        }
    
        // Truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/userManage",
            "userData" => $getUser
        ]);
    }
    
    
    
}


