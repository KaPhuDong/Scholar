<?php
class Admin extends Controller
{
    public function index()
    {
        $usersModel = $this->model("UsersModel");
        $users = $usersModel->getUsers();

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
        $searchKeyword = $_GET['keyword'] ?? '';
    
        if ($searchKeyword) {
            $orderDetails = $orderDetailsModel->searchOrdersByTime($searchKeyword);
        } else {
            $orderDetails = $orderDetailsModel->getOrderDetails();
        }
    
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
            "TotalOrders" => $totalOrders,
            "SearchKeyword" => $searchKeyword
        ]);
    }
    

    public function productManagement()
    {
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");
    
        // Lấy từ khóa tìm kiếm từ GET
        $searchKeyword = $_GET['keyword'] ?? '';
    
        // Nếu có từ khóa, tìm kiếm sản phẩm theo tên
        if ($searchKeyword) {
            $products = $productsModel->searchProductsByKeyword($searchKeyword);  // Tạo hàm searchProductsByName trong ProductsModel
        } else {
            $products = $productsModel->getProducts();  // Lấy tất cả sản phẩm nếu không có từ khóa
        }
    
        // Thêm hình ảnh vào mỗi sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }
    
        // Phân trang
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
            $currentProducts = array_slice($products, $startIndex, $perPage);  // Lấy sản phẩm của trang hiện tại
        }
    
        // Trả dữ liệu cho view
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
            "Users" => $currentUsers,
            "SearchKeyword" => $searchKeyword,
            "TotalPages" => $totalPages,
            "CurrentPage" => $page,
            "TotalUsers" => $totalUsers,
        ]);
    }  
    public function searchOrdersByTime()
    {
        $searchKeyword = trim($_GET['keyword'] ?? '');
        
        if (empty($searchKeyword)) {
            $this->orderManagement();
            return;
        }
        
        $orderDetailsModel = $this->model("OrderDetailModel");
        $matchingOrders = $orderDetailsModel->searchOrdersByTime($searchKeyword);
        
        $perPage = 10;
        $totalOrders = count($matchingOrders);
        $totalPages = ceil($totalOrders / $perPage);
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $startIndex = ($page - 1) * $perPage;
        $currentOrders = array_slice($matchingOrders, $startIndex, $perPage);
        
        $this->view("admin", [
            "Page" => "admin/orderManagement",
            "Orders" => $currentOrders,
            "SearchKeyword" => $searchKeyword,
            "TotalPages" => $totalPages,
            "CurrentPage" => $page,
            "TotalOrders" => $totalOrders,
        ]);
    }
    public function searchProductByName()
    {
        // Lấy từ khóa tìm kiếm, thể loại và sắp xếp từ GET
        $searchKeyword = trim($_GET['keyword'] ?? '');
        $sortOrder = $_GET['sortOrder'] ?? '';
        $categoryId = $_GET['category'] ?? 'all';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $productsPerPage = 10;  // Số sản phẩm mỗi trang
    
        // Nếu không có từ khóa tìm kiếm, quay lại trang quản lý sản phẩm
        if (empty($searchKeyword)) {
            $this->productManagement();
            return;
        }
    
        // Lấy model sản phẩm và hình ảnh
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");
    
        // Tìm kiếm sản phẩm theo từ khóa, thể loại, và sắp xếp (nếu có)
        $matchingProducts = $productsModel->searchProductsByKeyword(
            $searchKeyword,
            $sortOrder,
            ($categoryId !== 'all' ? $categoryId : null)
        );
    
        // Tổng số sản phẩm tìm được
        $totalProducts = count($matchingProducts);
    
        // Tính phân trang
        $totalPages = ceil($totalProducts / $productsPerPage);
        $startIndex = ($currentPage - 1) * $productsPerPage;
    
        // Lấy sản phẩm của trang hiện tại
        if ($startIndex >= $totalProducts) {
            $currentProducts = [];
        } else {
            $currentProducts = array_slice($matchingProducts, $startIndex, $productsPerPage);
        }
    
        // Thêm hình ảnh cho từng sản phẩm
        foreach ($currentProducts as &$product) {
            $product['images'] = $imagesModel->getImagesByProduct($product['product_id']);
        }
    
        // Trả dữ liệu cho view
        $this->view("admin", [
            "Page" => "admin/productManagement",
            "Products" => $currentProducts,
            "SearchKeyword" => $searchKeyword,
            "SortOrder" => $sortOrder,
            "Category" => $categoryId,
            "CurrentPage" => $currentPage,
            "TotalPages" => $totalPages,
            "TotalProducts" => $totalProducts
        ]);
    }
    

    
    
}
