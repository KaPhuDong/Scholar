<?php
class Admin extends Controller
{
    public function index()
    {
        $usersModel = $this->model("UsersModel");
        $users = $usersModel->getUsers();

        // Truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/userManage",
            "userData" => $users
        ]);
    }

    public function userManage()
    {
        $usersModel = $this->model("UsersModel");
        $users = $usersModel->getUsers();

        // Truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/userManage",
            "userData" => $users
        ]);
    }

    public function orderManage()
    {
        $usersModel = $this->model("UsersModel");

        // Lấy danh sách người dùng
        $getUser = $usersModel->getAllUsers();

        if (empty($getUser)) {
            echo "Không có dữ liệu từ cơ sở dữ liệu.";
        }

        // Truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/orderManage",
        ]);
    }

    public function productManage()
    {
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProducts();

        // Lấy ảnh cho từng sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }

        // Truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/productManage",
            "Products" => $products
        ]);
    }
}
