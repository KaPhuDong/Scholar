<?php
class Home extends Controller
{
    function index()
    {
        // Model
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProducts();

        // Lấy ảnh cho từng sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }

        $this->view("main", [
            "Page" => "home",
            "Products" => $products
        ]);
    }

    function getNotes()
    {
        $categoryID = 1;
        // Model
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProductsByCategory($categoryID);

        // Lấy ảnh cho từng sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }

        $this->view("main", [
            "Page" => "products/notes",
            "Products" => $products
        ]);
    }

    function getWrites()
    {
        $categoryID = 2;
        //Model    
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProductsByCategory($categoryID);

        // Lấy ảnh cho từng sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }
        //View
        $this->view("main", [
            "Page" => "products/writes",
            "Products" => $products
        ]);
    }

    function getGears()
    {
        $categoryID = 3;
        // Model
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProductsByCategory($categoryID);

        // Lấy ảnh cho từng sản phẩm
        foreach ($products as $index => $product) {
            $productId = $product['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $products[$index]['images'] = $images;
        }

        $this->view("main", [
            "Page" => "products/gears",
            "Products" => $products
        ]);
    }

    public function searchProductByName()
    {
        // Lấy từ khóa tìm kiếm và tham số sắp xếp (mặc định giá trị rỗng)
        $searchKeyword = trim($_GET['keyword'] ?? '');
        $sortOrder = $_GET['sort'] ?? '';

        // Tải model sản phẩm
        $productsModel = $this->model("ProductsModel");

        // Tìm kiếm sản phẩm theo từ khóa và sắp xếp 
        $matchingProducts = $productsModel->searchProductsByKeyword($searchKeyword, $sortOrder);

        // Thêm hình ảnh vào từng sản phẩm
        $imagesModel = $this->model("ImagesModel");
        foreach ($matchingProducts as &$product) {
            $product['images'] = $imagesModel->getImagesByProduct($product['product_id']);
        }

        // Truyền dữ liệu vào view
        $this->view("main", [
            "Page" => "products/search",
            "Products" => $matchingProducts,
            "SearchKeyword" => $searchKeyword,
            "SortOrder" => $sortOrder
        ]);
    }
}
