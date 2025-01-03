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

    public function handleDeleteUser()
    {
        if (isset($_POST['deleteUser'])) {
            
            $usersModel = $this->model("UsersModel"); 
            $userId = (int)$_POST['user_Id'];

            $usersModel->deleteUser($userId);
            echo "<script>
                    alert('User deleted successfully!');
                    window.location.href = '/Scholar/Admin/userManage';
                </script>";
            exit;
        }
    }

    public function orderManage()
    {
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
