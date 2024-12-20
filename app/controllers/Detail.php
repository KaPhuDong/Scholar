<?php
class Detail extends Controller
{
    function getProduct($productId)
    {
        // Model
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        $product = $productsModel->getProductById($productId);

        $categoryId = $product['category_id'];
        $relatedProducts = $productsModel->getProductsByCategory($categoryId);

        // Lấy ảnh cho sản phẩm
        $images = $imagesModel->getImagesByProduct($productId);
        $product['images'] = $images;

        foreach ($relatedProducts as $index => $relatedProduct) {
            $productId = $relatedProduct['product_id'];
            $images = $imagesModel->getImagesByProduct($productId);
            $relatedProducts[$index]['images'] = $images;
        }

        $this->view("main", [
            "Page" => "detail",
            "Product" => $product,
            "relatedProducts" => $relatedProducts
        ]);
    }
}
