<?php
class Detail extends Controller
{
    function getProduct($productId)
    {
        // Model
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $product = $productsModel->getProductById($productId);

        // Lấy ảnh cho từng sản phẩm

        $productId = $product['product_id'];
        $images = $imagesModel->getImagesByProduct($productId);
        $product['images'] = $images;

        $this->view("main", [
            "Page" => "detail",
            "Product" => $product
        ]);
    }
}
