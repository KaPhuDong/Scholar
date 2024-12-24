<?php
class Search extends Controller
{
    public function searchProductbyName()
    {
        // Lấy từ khóa tìm kiếm (nếu không có từ khóa, gán chuỗi rỗng)
        $searchKeyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        
        // Tải model sản phẩm và hình ảnh
        $productsModel = $this->model("ProductsModel");
        $imagesModel = $this->model("ImagesModel");

        // Tìm kiếm sản phẩm theo từ khóa
        $matchingProducts = array_map(function ($product) use ($imagesModel) {
            $product['images'] = $imagesModel->getImagesByProduct($product['product_id']);
            return $product;
        }, $productsModel->searchProductsByKeyword($searchKeyword));

        // Truyền dữ liệu vào view
        $this->view("user/main", [
            "Page" => "products/search",
            "Products" => $matchingProducts,
            "SearchKeyword" => $searchKeyword
        ]);
    }
}
