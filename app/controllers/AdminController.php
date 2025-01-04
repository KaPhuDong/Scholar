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

    // public function addProduct() {
    //     $productsModel = $this->model("ProductsModel");
    //     $imagesModel = $this->model("ImagesModel");

    //     $products = $productsModel->getProducts();

    //     $this->view("admin", [
    //         "Page" => "admin/addProduct",
    //         "Products" => $products,
    //     ]);
    // }

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
        ]);
    }

    public function addProduct()
    {
        $this->view("admin", [
            "Page" => "admin/handleProduct",
        ]);
    }

    public function saveProduct()
    {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['productname'];
        $category_id = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $stock = $_POST['stock'];
        $product_image = $_FILES['productimage'];

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
}
