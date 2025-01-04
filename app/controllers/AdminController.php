<?php
class Admin extends Controller
{
    public function index()
    {
        $usersModel = $this->model("UsersModel");
        $users = $usersModel->getUsers();

        // Truyền dữ liệu sang View
        $this->view("admin", [
            "Page" => "admin/userManagement",
            "userData" => $users
        ]);
    }

    public function userManagement()
    {
        $usersModel = $this->model("UsersModel");
        $searchKeyword = $_GET['keyword'] ?? '';
        
        if ($searchKeyword) {
            $users = $usersModel->searchUsersByName($searchKeyword);
        } else {
            $users = $usersModel->getUsers();
        }

        $perPage = 10;
        $totalUsers = count($users);
        $totalPages = ceil($totalUsers / $perPage);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $startIndex = ($page - 1) * $perPage;
        $currentUsers = array_slice($users, $startIndex, $perPage);

        $this->view("admin", [
            "Page" => "admin/userManagement",
            "Users" => $currentUsers,
            "TotalPages" => $totalPages,
            "CurrentPage" => $page,
            "TotalUsers" => $totalUsers
        ]);
    }

    public function deleteUser()
    {
        if (isset($_POST['deleteUserById'])) {
            
            $usersModel = $this->model("UsersModel"); 
            $userId = $_POST['user_Id'];

            $usersModel->deleteUserById($userId);
            echo "<script>
                    alert('User deleted successfully!');
                    window.location.href = '/Scholar/Admin/userManagement';
                </script>";
            exit;
        }
    }

    public function orderManagement()
    {
        $orderDetailsModel = $this->model("OrderDetailModel");
        $orderDetails = $orderDetailsModel->getOrderDetails();

        $perPage = 10;
        $totalOrders = count($orderDetails);
        $totalPages = ceil($totalOrders / $perPage);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $startIndex = ($page - 1) * $perPage;
        $currentOrders = array_slice($orderDetails, $startIndex, $perPage);

        $this->view("admin", [
            "Page" => "admin/orderManagement",
            "Orders" => $currentOrders,
            "TotalPages" => $totalPages,
            "CurrentPage" => $page,
            "TotalOrders" => $totalOrders
        ]);
    }

    public function productManagement()
    {
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProducts();
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }

        $perPage = 10;
        $totalProducts = count($products);
        $totalPages = ceil($totalProducts / $perPage);
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        if ($page > $totalPages) $page = $totalPages;
        $startIndex = ($page - 1) * $perPage;

        if ($startIndex >= $totalProducts) {
            $currentProducts = [];
        } else {
            $currentProducts = array_slice($products, $startIndex, $perPage); // Lấy sản phẩm của trang hiện tại
        }

        $this->view("admin", [
            "Page" => "admin/productManagement",
            "Products" => $currentProducts,
            "TotalPages" => $totalPages,
            "CurrentPage" => $page,
            "TotalProducts" => $totalProducts
        ]);
    }

    public function searchUserByName()
    {
        $searchKeyword = trim($_GET['keyword'] ?? '');
    
        if (empty($searchKeyword)) {
            $this->userManagement(); 
            return;
        }
    
        $userModel = $this->model("UserModel");
        $matchingUsers = $userModel->searchUsersByName($searchKeyword);
    
        $perPage = 10;
        $totalUsers = count($matchingUsers);
        $totalPages = ceil($totalUsers / $perPage);
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $startIndex = ($page - 1) * $perPage;
        $currentUsers = array_slice($matchingUsers, $startIndex, $perPage);
    
        $this->view("admin", [
            "Page" => "admin/userManagement",
            "Page" => "admin/orderManagement",
            "Users" => $currentUsers,
            "SearchKeyword" => $searchKeyword,
            "TotalPages" => $totalPages,
            "CurrentPage" => $page,
            "TotalUsers" => $totalUsers,
        ]);
    }  
}
