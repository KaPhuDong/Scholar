<?php
class Admin extends Controller
{
    public function index()
    {

        $usersModel = $this->model("UsersModel");
        $users = $usersModel->getUsers();
        $totalUsers = count($users);

        $orderDetailsModel = $this->model("OrderDetailModel");
        $orderDetails = $orderDetailsModel->getOrderDetails();
        $totalOrders = count($orderDetails);

        $productsModel = $this->model("ProductsModel");
        $products = $productsModel->getProducts();
        $totalProducts = count($products);


        $this->view("admin", [
            "Page" => "admin/dashBoard", 
            "TotalUsers" => $totalUsers,
            "TotalOrders" => $totalOrders,
            "TotalProducts" => $totalProducts
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
    
        $usersPerPage = 10;
        $totalUsers = count($users);
    
        $totalPages = ceil($totalUsers / $usersPerPage);
    
        $currentPage = $_GET['page'] ?? 1;
    
        $offset = ($currentPage - 1) * $usersPerPage;
    
        $paginatedUsers = array_slice($users, $offset, $usersPerPage);
    
        $this->view("admin", [
            "Page" => "admin/userManagement",
            "Users" => $paginatedUsers,
            "SearchKeyword" => $searchKeyword,
            "CurrentPage" => $currentPage,
            "TotalPages" => $totalPages,
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

    $page = isset($_GET['page']) && ($_GET['page']) ? (int)$_GET['page'] : 1;

    if ($page < 1) $page = 1;
    if ($page > $totalPages) $page = $totalPages;

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

        $searchKeyword = trim($_GET['keyword'] ?? '');
        $sortOrder = $_GET['sort'] ?? '';
        $categoryId = $_GET['category'] ?? 'all';
        $currentPage = $_GET['page'] ?? 1;
        $productsPerPage = 10;

        if ($searchKeyword || $sortOrder || $categoryId) {
            $products = $productsModel->searchProductsByKeyword($searchKeyword, $sortOrder, ($categoryId !== 'all' ? $categoryId : null));
        } else {
            $products = $productsModel->getProducts();
        }

        $totalProducts = count($products);

        // Thêm hình ảnh vào mỗi sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }

        // Phân trang
        $totalPages = ceil($totalProducts / $productsPerPage);
        $offset = ($currentPage - 1) * $productsPerPage;
        $paginatedProducts = array_slice($products, $offset, $productsPerPage);

        // Trả dữ liệu cho view
        $this->view("admin", [
            "Page" => "admin/productManagement",
            "Products" => $paginatedProducts,
            "SearchKeyword" => $searchKeyword,
            "SortOrder" => $sortOrder,
            "Category" => $categoryId,
            "CurrentPage" => $currentPage,
            "TotalPages" => $totalPages,
            "TotalProducts" => $totalProducts
        ]);
    }

    public function searchUserByName() {
        $searchKeyword = trim($_GET['keyword'] ?? '');
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $usersPerPage = 8;
        
        if (empty($searchKeyword)) {
            $this->userManagement();
            return;
        }
    
        $userModel = $this->model("UserModel");
    
        $matchingUsers = $userModel->searchUsersByName($searchKeyword);
        $totalUsers = count($matchingUsers);
        
        $totalPages = ceil($totalUsers / $usersPerPage);
    
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        } elseif ($currentPage < 1) {
            $currentPage = 1;
        }
    
        $offset = ($currentPage - 1) * $usersPerPage;
    
        $paginatedUsers = array_slice($matchingUsers, $offset, $usersPerPage);
    
        $this->view("admin", [
            "Page" => "admin/userManagement",
            "Users" => $paginatedUsers,
            "SearchKeyword" => $searchKeyword,
            "CurrentPage" => $currentPage,
            "TotalPages" => $totalPages,
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
    
        $page = isset($_GET['page']) && ($_GET['page']) ? (int)$_GET['page'] : 1;
    
        if ($page < 1) $page = 1;
        if ($page > $totalPages) $page = $totalPages;
    
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
        $searchKeyword = trim($_GET['keyword'] ?? '');
        $sortOrder = $_GET['sortOrder'] ?? '';
        $categoryId = $_GET['category'] ?? 'all';
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $productsPerPage = 10;

        if (empty($searchKeyword)) {
            $this->productManagement();
            return;
        }

        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $matchingProducts = $productsModel->searchProductsByKeyword(
            $searchKeyword,
            $sortOrder,
            ($categoryId !== 'all' ? $categoryId : null)
        );

        $totalProducts = count($matchingProducts);
        $totalPages = ceil($totalProducts / $productsPerPage);

        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        } elseif ($currentPage < 1) {
            $currentPage = 1;
        }

        $startIndex = ($currentPage - 1) * $productsPerPage;
        $currentProducts = array_slice($matchingProducts, $startIndex, $productsPerPage);
        foreach ($currentProducts as &$product) {
            $product['images'] = $imagesModel->getImagesByProduct($product['product_id']);
        }

        $this->view("admin/main", [
            "Page" => "productManagement",
            "Products" => $currentProducts,
            "SearchKeyword" => $searchKeyword,
            "SortOrder" => $sortOrder,
            "Category" => $categoryId,
            "CurrentPage" => $currentPage,
            "TotalPages" => $totalPages,
            "TotalProducts" => $totalProducts
        ]);
    }

    public function deleteProduct()
    {
        $productsModel = $this->model("ProductsModel");

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $product_id = intval($_POST['product_id']);

            $deleteProduct = $productsModel->deleteProduct($product_id);

            if ($deleteProduct) {
                echo "<script>
                    alert('Product deleted successfully!');
                    window.location.href = '/Scholar/Admin/productManagement';
                </script>";
                exit;
            }
        }
    }

    public function updateProduct($product_id)
    {
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $product = $productsModel->getProductById($product_id);

        // Lấy ảnh cho sản phẩm
        $images = $imagesModel->getImagesByProduct($product_id);
        $product['images'] = $images;

        $this->view("admin", [
            "Page" => "admin/handleProduct",
            "Product" => $product,
            "Action" => "update", 
        ]);
    }

    public function addProduct()
    {
        $this->view("admin", [
            "Page" => "admin/handleProduct",
            "Action" => "add", 
        ]);
    }

    public function saveProduct()
    {
        $product_id = $_POST['product_id'] ?? null;
        $product_name = $_POST['productname'] ?? '';
        $category_id = $_POST['category'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $product_image = null;

        if (empty($product_name) || empty($category_id) || empty($description) || empty($price) || empty($stock)) {
            echo "<script>
                    alert('Please fill in all required fields.');
                    window.history.back();
                </script>";
            return;
        }    
  
        if (isset($_FILES['productimage']) && $_FILES['productimage']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = './public/assets/images/products/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imageName = $_FILES['productimage']['name'];
            $imagePath = $uploadDir . $imageName;

            if (move_uploaded_file($_FILES['productimage']['tmp_name'], $imagePath)) {
                $product_image = './public/assets/images/products/' . $imageName;
            }
        }

        $productsModel = $this->model("ProductsModel");

        if ($product_id) {
            $productsModel->updateProduct($product_id, $product_name, $category_id, $description, $price, $stock, $product_image);
        } else {
            $productsModel->addProduct($product_name, $category_id, $description, $price, $stock, $product_image);
        }

        echo "<script>
                alert('Save product successfully!');
                window.location.href = '/Scholar/Admin/productManagement';
            </script>";
    }

    public function dashBoard()
    {
        $usersModel = $this->model("UsersModel");
        $users = $usersModel->getUsers();
        $totalUsers = count($users);

        $orderDetailsModel = $this->model("OrderDetailModel");
        $orderDetails = $orderDetailsModel->getOrderDetails();
        $totalOrders = count($orderDetails);

        $productsModel = $this->model("ProductsModel");
        $products = $productsModel->getProducts();
        $totalProducts = count($products);


        $this->view("admin", [
            "Page" => "admin/dashBoard", 
            "TotalUsers" => $totalUsers,
            "TotalOrders" => $totalOrders,
            "TotalProducts" => $totalProducts
        ]);
    }
}
