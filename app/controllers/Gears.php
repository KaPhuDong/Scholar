<?php
class Gears extends Controller
{
    function default()
    {
        $categoryID = 3;
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
            "Page" => "gears",
            "Products" => $products
        ]);
    }
}
