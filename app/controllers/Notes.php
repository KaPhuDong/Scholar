<?php
class Notes extends Controller
{
    function default()
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
            "Page" => "notes",
            "Products" => $products
        ]);
    }

    function getProducts($params)
    {
        //Model
        $products = $this->model("ProductsModel");

        //View
        $this->view("main", [
            "Page" => $params,
            "Products" => $products->getProducts()
        ]);
    }
}
