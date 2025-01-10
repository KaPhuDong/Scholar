<?php
class Home extends Controller
{
    function index()
    {
        // Model
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $products = $productsModel->getProducts();

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
        $searchKeyword = trim($_GET['keyword'] ?? '');
        $sortOrder = $_GET['sort'] ?? '';
        $categoryId = $_GET['category'] ?? 'all';
        $currentPage = $_GET['page'] ?? 1;
        $productsPerPage = 8;

        $productsModel = $this->model("ProductsModel");

        // Tính tổng số sản phẩm phù hợp với từ khóa và thể loại
        $matchingProducts = $productsModel->searchProductsByKeyword($searchKeyword, $sortOrder, ($categoryId !== 'all' ? $categoryId : null));
        $totalProducts = count($matchingProducts);

        // Phân trang
        $totalPages = ceil($totalProducts / $productsPerPage);
        $offset = ($currentPage - 1) * $productsPerPage;
        $paginatedProducts = array_slice($matchingProducts, $offset, $productsPerPage);

        // Lấy ảnh cho sản phẩm
        $imagesModel = $this->model("ImagesModel");
        foreach ($paginatedProducts as &$product) {
            $product['images'] = $imagesModel->getImagesByProduct($product['product_id']);
        }

        $this->view("main", [
            "Page" => "search",
            "Products" => $paginatedProducts,
            "SearchKeyword" => $searchKeyword,
            "SortOrder" => $sortOrder,
            "Category" => $categoryId,
            "CurrentPage" => $currentPage,
            "TotalPages" => $totalPages,
            "TotalProducts" => $totalProducts
        ]);
    }
}
