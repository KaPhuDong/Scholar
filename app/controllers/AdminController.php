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

    public function ProductManager(){
        $productmodel = $this->model("ProductsModel");
        
        // Lấy danh sách sản phẩm từ model
        $getProduct = $this->$productmodel->getProducts();
        
        if (empty($getProduct)){
            echo "Không có sản phẩm nào trong Database";
        }
        else{
            // Truyền dữ liệu sang view để hiển thị
            $this->view("./Admin/ProductsManager",["products"=>$getProduct]);
        }
    }

    public function deleteProduct(){
        $productmodel = $this->model("ProductsModel");
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])){
            $product_id = intval($_POST['product_id']);
            // Gọi phương thức deleteProduct trong model để xóa sản phẩm
            $isdelete = $this->$productmodel->deleteProduct($product_id);
            if($isdelete){
                header("Location: /Scholar/Admin/ProductManager");
                exit();
            }else{
                echo "Xóa sản phẩm thất bại!";
            }
        }else{
            echo "Invalid request.";
        }
    }

    public function editProduct() {
        $productmodel = $this->model("ProductsModel");
        
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];
            $product = $this->$productmodel->getProductById($product_id);
            $categories = $this->$productmodel->getAllCategories();
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product_name = $_POST['name'] ?? '';
                $category_id = $_POST['category_id'] ?? '';
                $image = $_POST['productimage'] ?? '';
                $description = $_POST['description'] ?? '';
                $price = $_POST['price'] ?? '';
                $stock = $_POST['stock'] ?? '';
                
                
    
                $result = $productmodel->editProduct(
                    $product_id,
                    $product_name,
                    $category_id,
                    $image,
                    $description,
                    $price,
                    $stock,
                );

                if ($result) {
                    header("Location: /Scholar/Admin/ProductManager");
                    exit();
                } else {
                    echo "Cập nhật sản phẩm thất bại!";
                }
            }
    
            $this->view("/Admin/EditProduct",['edit' => $product, 'categories' => $categories]);
        } else {
            echo "Không tìm thấy sản phẩm!";
        }
    }

    public function CreateProduct(){
        $productmodel = $this->model("ProductsModel");
        $categories = $this->$productmodel->getAllCategories();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $product_name = $_POST['name'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $image = $_POST['productimage'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $stock = $_POST['stock'] ?? '';
            
            // Thêm sản phẩm mới
            $result = $this->$productmodel->addProduct($product_name, $category_id, $image, $description, $price, $stock);
            
            if ($result) {
                header("Location: /Scholar/Admin/ProductManager");
                exit();
            } else {
                echo "Thêm sản phẩm thất bại";
            }
        }
        
        $this->view("/Admin/CreateProduct",['categories' => $categories]);
    }

    public function Categories(){
        $productmodel = $this->model("ProductsModel");
        $categories = $this->$productmodel->getAllCategories();
        
        if (empty($categories)){
            echo "Không có category nào trong Database cả";
        }
        else{
            $this->view("/Admin/CategorisManager",['category'=>$categories]);
        }
    }

    public function DeleteCategory(){
        $productmodel = $this->model("ProductsModel");
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])){
            $category_id = intval($_POST['category_id']);
            $delete = $this->$productmodel->deleteCategory($category_id);
            
            if($delete){
                header("Location: /Scholar/Admin/Categories");
                exit();
            } else {
                echo "Xóa danh mục thất bại!";
            }
        }
        else{
            echo "Không có ID Category";
        }
}
}

