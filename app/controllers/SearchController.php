<?php
class Search extends Controller
{
    public function searchProductbyName()
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
        $this->view("user/main", [
            "Page" => "products/search",
            "Products" => $matchingProducts,
            "SearchKeyword" => $searchKeyword,
            "SortOrder" => $sortOrder
        ]);
    }
}
