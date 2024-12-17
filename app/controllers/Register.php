<?php
class Register extends Controller
{
    function default()
    {
        // // Model
        // $productsModel = $this->model("ProductsModel");
        // $imagesModel = $this->model("ImagesModel");

        // $products = $productsModel->getProducts();

        // // Lấy ảnh cho từng sản phẩm
        // foreach ($products as $index => $product) {
        //     $productId = $product['product_id'];
        //     $images = $imagesModel->getImagesByProduct($productId);
        //     $products[$index]['images'] = $images;
        // }

        $this->view("authentication", [
            "Page" => "register",
        ]);
    }
}
