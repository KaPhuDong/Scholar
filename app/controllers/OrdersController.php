<?php
class Orders extends Controller
{
    public function viewCart()
    {
        if (!isset($_SESSION['user'])) {
            echo "<script>
                alert('Please log in to view your cart.');
                window.location.href = '/Scholar/login';
            </script>";
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $ordersModel = $this->model("OrdersModel");
        $orderDetailModel = $this->model("OrderDetailModel");
        $imagesModel = $this->model("ImagesModel");

        $orders = $ordersModel->getPendingOrders($user_id);

        $cartItems = [];
        foreach ($orders as $order) {
            $orderDetails = $orderDetailModel->getOrderDetailByOrderId($order['order_id']);

            foreach ($orderDetails as $orderDetail) {
                $product = $this->model("ProductsModel")->getProductById($orderDetail['product_id']);
                $images = $imagesModel->getImagesByProduct($orderDetail['product_id']);

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $orderDetail['quantity'],
                    'order_id' => $order['order_id'],
                    'order_detail_id' => $orderDetail['order_detail_id'],
                    'images' => $images
                ];
            }
        }
        $this->view("main", [
            "Page" => "order/cart",
            "CartItems" => $cartItems
        ]);
    }

    public function addToCart()
    {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['user'])) {
            echo "<script>
                alert('Please log in to add items to your cart.');
                window.location.href = '/Scholar/Products/getProductInformation/$product_id';
            </script>";
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $orderDetailModel = $this->model("OrderDetailModel");
        $ordersModel = $this->model("OrdersModel");
        $productModel = $this->model("ProductsModel");

        $product = $productModel->getProductById($product_id);
        $existingOrders = $ordersModel->getPendingOrders($user_id);

        $totalAmount = $product['price'] * $quantity;
        $order_id = null;

        foreach ($existingOrders as $order) {
            $existingOrderDetail = $orderDetailModel->getOrderDetail($order['order_id'], $product_id);

            if ($existingOrderDetail) {
                $newQuantity = $existingOrderDetail['quantity'] + $quantity;
                $orderDetailModel->updateOrderDetailQuantity($order['order_id'], $product_id, $newQuantity);
                $order_id = $order['order_id'];
                break;
            }
        }

        if (!$order_id) {
            $ordersModel->createOrder($user_id, $totalAmount);
            $newOrder = $ordersModel->getNewOrder($user_id);

            $newOrderId = $newOrder['order_id'];
            $order_id = $newOrderId;
            $orderDetailModel->createOrderDetail($order_id, $product_id, $quantity);
        }

        $ordersModel->updateOrderTotalAmount($order_id);

        echo "<script>
            alert('Product added to cart successfully!');
            window.location.href = '/Scholar/Products/getProductInformation/$product_id';
        </script>";
    }

    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_detail_id = $_POST['order_detail_id'];

            $orderDetailModel = $this->model("OrderDetailModel");
            $orderDetailModel->deleteOrderDetail($order_detail_id);

            echo "<script>
            window.location.href = '/Scholar/Orders/viewCart';
            </script>";
        }
    }

    public function payMent()
    {
        $this->view("authentication", [
            "Page" => "order/payment"
        ]);
    }
}
