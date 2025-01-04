<?php
class Orders extends Controller
{
    public function viewCart()
    {
        if (!isset($_SESSION['user'])) {
            echo "<script>
                alert('Please log in to view your cart.');
                window.location.href = '/Scholar/User/login';
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
            "Page" => "orders/cart",
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

    public function buyNow()
    {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        if (!isset($_SESSION['user'])) {
            echo "<script>
                alert('Please log in to buy this item.');
                window.location.href = '/Scholar/Products/getProductInformation/$product_id';
            </script>";
            exit;
        }

        $user_id = $_SESSION['user']['id'];
        $orderDetailModel = $this->model("OrderDetailModel");
        $ordersModel = $this->model("OrdersModel");
        $productModel = $this->model("ProductsModel");
        $product = $productModel->getProductById($product_id);
        $totalAmount = $product['price'] * $quantity;

        $ordersModel->createOrder($user_id, $totalAmount);
        $newOrder = $ordersModel->getNewOrder($user_id);
        $order_id = $newOrder['order_id'];
        $ordersModel->updateOrderStatus($order_id, 'Processing');

        $orderDetailModel->createOrderDetail($order_id, $product_id, $quantity);
        $orderDetail = $orderDetailModel->getOrderDetail($order_id, $product_id);

        $_SESSION['buy_now_item'] = [
            'order_id' => $order_id,
            'order_detail_id' => $orderDetail['order_detail_id'],
            'product_id' => $product_id,
            'quantity' => $quantity
        ];

        echo "<script>
                window.location.href = '/Scholar/Orders/payMent';
            </script>";
    }

    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $order_id = $_POST['order_id'];

            $ordersModel = $this->model("OrdersModel");
            $ordersModel->deleteOrder($order_id);

            echo "<script>
            window.location.href = '/Scholar/Orders/viewCart';
            </script>";
        }
    }

    public function updateQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderDetailId = $_POST['order_detail_id'];
            $action = $_POST['action'];

            $orderDetailModel = $this->model("OrderDetailModel");
            $productModel = $this->model("ProductsModel");

            if ($orderDetailId && $action) {
                $orderDetail = $orderDetailModel->getOrderDetailById($orderDetailId);

                if ($orderDetail) {
                    $productId = $orderDetail['product_id'];
                    $orderId = $orderDetail['order_id'];
                    $currentQuantity = $orderDetail['quantity'];

                    $product = $productModel->getProductById($productId);
                    $newQuantity = $currentQuantity;

                    if ($action === 'increase') {
                        if ($currentQuantity < $product['stock']) {
                            $newQuantity++;
                        } else {
                            echo "<script>alert('Cannot increase quantity. Stock limit reached.');</script>";
                        }
                    } elseif ($action === 'decrease') {
                        if ($currentQuantity > 1) {
                            $newQuantity--;
                        } else {
                            echo "<script>alert('Cannot decrease quantity below 1.');</script>";
                        }
                    }
                    $orderDetailModel->updateOrderDetailQuantity($orderId, $productId, $newQuantity);
                }
            }

            echo "<script>
                window.location.href = '/Scholar/Orders/viewCart';
            </script>";
            exit;
        }
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedItems = isset($_POST['selected_items']) ? (array) $_POST['selected_items'] : [];

            if (empty($selectedItems)) {
                echo "<script>
                alert('No items selected for checkout.');
                window.location.href = '/Scholar/Orders/viewCart';
                </script>";
                return;
            }

            $_SESSION['selected_items'] = $selectedItems;

            $order_ids = [];
            $ordersModel = $this->model("OrdersModel");
            $orderDetailModel = $this->model("OrderDetailModel");
            $totalAmountPerOrder = [];

            foreach ($selectedItems as $order_detail_id) {
                $orderDetail = $orderDetailModel->getOrderDetailById($order_detail_id);
                $order_id = $orderDetail['order_id'];
                $product_id = $orderDetail['product_id'];

                $newQuantity = isset($_POST["quantity_{$order_detail_id}"]) ? (int)$_POST["quantity_{$order_detail_id}"] : $orderDetail['quantity'];

                $orderDetailModel->updateOrderDetailQuantity($order_id, $product_id, $newQuantity);

                $product = $this->model("ProductsModel")->getProductById($product_id);
                $totalAmountPerOrder[$order_id] = isset($totalAmountPerOrder[$order_id]) ? $totalAmountPerOrder[$order_id] : 0;
                $totalAmountPerOrder[$order_id] += $product['price'] * $newQuantity;

                if (!in_array($order_id, $order_ids)) {
                    $order_ids[] = $order_id;
                }
            }

            foreach ($order_ids as $order_id) {
                $totalAmount = $totalAmountPerOrder[$order_id];

                $ordersModel->updateOrderTotalAmount($order_id, $totalAmount);
                $ordersModel->updateOrderStatus($order_id, 'Processing');
            }

            echo "<script>
                window.location.href = '/Scholar/Orders/payMent';
            </script>";
        }
    }

    public function payMent()
    {
        $user_id = $_SESSION['user']['id'];

        $orderDetailModel = $this->model("OrderDetailModel");
        $imagesModel = $this->model("ImagesModel");
        $productsModel = $this->model("ProductsModel");
        $UsersModel = $this->model("UsersModel");

        $userInfo = $UsersModel->getUserById($user_id);
        $selectedItems = isset($_SESSION['selected_items']) ? $_SESSION['selected_items'] : [];
        $buyNowItem = isset($_SESSION['buy_now_item']) ? $_SESSION['buy_now_item'] : null;

        if (empty($selectedItems) && !$buyNowItem) {
            echo "<script>
                alert('No items selected for payment.');
                window.location.href = '/Scholar/Orders/viewCart';
            </script>";
            return;
        }

        $cartItems = [];
        foreach ($selectedItems as $order_detail_id) {
            $orderDetail = $orderDetailModel->getOrderDetailById($order_detail_id);
            $product = $productsModel->getProductById($orderDetail['product_id']);
            $images = $imagesModel->getImagesByProduct($orderDetail['product_id']);

            $cartItems[] = [
                'product' => $product,
                'quantity' => $orderDetail['quantity'],
                'order_id' => $orderDetail['order_id'],
                'order_detail_id' => $orderDetail['order_detail_id'],
                'images' => $images
            ];
        }

        if ($buyNowItem) {
            $product = $productsModel->getProductById($buyNowItem['product_id']);
            $images = $imagesModel->getImagesByProduct($buyNowItem['product_id']);

            $cartItems[] = [
                'product' => $product,
                'quantity' => $buyNowItem['quantity'],
                'order_id' => $buyNowItem['order_id'],
                'order_detail_id' => $buyNowItem['order_detail_id'],
                'images' => $images
            ];
        }

        $this->view("authentication", [
            "Page" => "orders/payment",
            "CartItems" => $cartItems,
            "UserInfo" => $userInfo
        ]);
    }

    public function payMentSuccessful()
    {
        $ordersModel = $this->model("OrdersModel");
        $deliveryModel = $this->model("DeliveryModel");
        $orderDetailModel = $this->model("OrderDetailModel");

        $selectedItems = isset($_SESSION['selected_items']) ? $_SESSION['selected_items'] : [];
        $buyNowItem = isset($_SESSION['buy_now_item']) ? $_SESSION['buy_now_item'] : null;

        $orderIds = [];
        foreach ($selectedItems as $order_detail_id) {
            $orderDetail = $orderDetailModel->getOrderDetailById($order_detail_id);
            $orderIds[] = $orderDetail['order_id'];
        }

        if ($buyNowItem) {
            $orderIds[] = $buyNowItem['order_id'];
        }

        $full_name = $_POST['full-name'];
        $phone_number = $_POST['phone-number'];
        $address = $_POST['address'];

        foreach ($orderIds as $orderId) {
            $ordersModel->updateOrderStatus($orderId, 'Completed');
            $insertResult = $deliveryModel->insertDelivery($orderId, $full_name, $phone_number, $address);
            if (!$insertResult) {
                echo "<script>alert('An error occurred while inserting delivery information.');</script>";
                return;
            }
        }

        unset($_SESSION['buy_now_item']);
        unset($_SESSION['selected_items']);

        $this->view("authentication", [
            "Page" => "orders/paymentSuccessful"
        ]);
    }
}
