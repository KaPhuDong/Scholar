<?php
class OrderDetail extends Controller
{
    public function addToOrderDetail()
    {
        if (!isset($_SESSION['user'])) {
            echo "<script>
                alert('Please log in to add items to your OrderDetail.');
            </script>";
            exit;
        }

        // window.location.href = '/Scholar/User/login';

        $user_id = $_SESSION['user']['id'];
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        // Model
        // $productModel = $this->model("ProductsModel");
        // $product = $productModel->getProductById($product_id);

        $orderDetailModel = $this->model("OrderDetailModel");
        $existingOrderDetail = $orderDetailModel->getOrderDetail($user_id, $product_id);

        if ($existingOrderDetail) {
            $newQuantity = $existingOrderDetail['quantity'] + $quantity;
            $orderDetailModel->updateOrderDetailQuantity($user_id, $product_id, $newQuantity);
        } else {
            $orderDetailModel->insertOrderDetailItem($user_id, $product_id, $quantity);
        }

        echo "<script>
            alert('Product added to OrderDetail successfully!');
            window.location.href = '/Scholar/Home';
        </script>";
    }
}
