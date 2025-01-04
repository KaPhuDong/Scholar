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

    public function deleteProduct(){
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

    // public function addProduct() {
    //     $productsModel = $this->model("ProductsModel");
    //     $imagesModel = $this->model("ImagesModel");

    //     $products = $productsModel->getProducts();

    //     $this->view("admin", [
    //         "Page" => "admin/addProduct",
    //         "Products" => $products,
    //     ]);
    // }

    public function addProduct() {
        $productsModel = $this->model("ProductsModel");
        // $imagesModel = $this->model("ImagesModel");
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_name = $_POST['productname'];
            $category_id = $_POST['category'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            
            if (isset($_FILES['productimage']) && $_FILES['productimage']['error'] === 0) {
                $image = $_FILES['productimage'];
                $upload_dir = 'path/to/upload/';
                $image_path = $upload_dir . basename($image['name']);
                move_uploaded_file($image['tmp_name'], $image_path);
            } else {
                $image_path = ''; 
            }
    
            $result = $productsModel->addProduct($product_name, $price, $description, $stock, $image_path, $category_id);
    
            if ($result) {
                echo "Product added successfully!";
                header("Location: /Scholar/Admin/productManagement");  
            } else {
                echo "Failed to add product.";
            }
        }
    
        $this->view("admin", [
            "Page" => "admin/addProduct",
        ]);
    }
    
    }



    



