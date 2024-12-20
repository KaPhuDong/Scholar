<?php
require_once 'C:\xampp\htdocs\Scholar\app\models\ImagesModel.php';
require_once 'C:\xampp\htdocs\Scholar\app\models\ProductsModel.php';
class Details extends Controller {
    public $ProductsModel;

    public function default() {
        $productModel = new ProductsModel();
        $products = $productModel->getProducts();  

        $imagesModel = new ImagesModel();
        $images = []; 

        foreach ($products as $product) {
            $images[$product['product_id']] = $imagesModel->getImagesByProduct($product['product_id']);
        }
        $this->view("main", [
            "Page" => "details",
            "Product" => $products,
            "Images" => $images
        ]);
    }
    public function detail($productId) {
        $productModel = new ProductsModel();
        $product = $productModel->getProductById($productId);  

        if (!$product) {
            die("Sản phẩm không tồn tại");
        }

        $relatedProducts = $productModel->getProductCategory($product['category_id']);

        $imagesModel = new ImagesModel();
        $images = $imagesModel->getImagesByProduct($productId);

        var_dump($product);  
        var_dump($images);  

        $this->view("main", [
            "Page" => "details",
            "Product" => $product,
            "ProductImages" => $images,
            "RelatedProducts" => $relatedProducts
        ]);
    }
}
