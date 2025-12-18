<?php
$orders = $data["Orders"];
$status = $data["Status"];
?>
<div class="history-order-container">
    <h1 class="main-title">My orders</h1>
    <div class="status">
        <a class="status-item <?php echo ($status == 'Pending') ? 'active' : ''; ?>" href="/Orders/historyOrders?status=Pending">Pending</a>
        <a class="status-item <?php echo ($status == 'Processing') ? 'active' : ''; ?>" href="/Orders/historyOrders?status=Processing">Processing</a>
        <a class="status-item <?php echo ($status == 'Completed') ? 'active' : ''; ?>" href="/Orders/historyOrders?status=Completed">Completed</a>
    </div>

    <div class="order-histories">
        <?php if (!empty($orders) && is_array($orders)): ?>
            <?php foreach ($orders as $order): ?>
                <div class="order-item-history">
                    <div class="above-content">
                        <img
                            src="<?php echo $order['Product_Image']; ?>"
                            alt="Image of <?php echo $order['Product_Name']; ?>"
                            class="product-img">
                        <div class="product-information">
                            <h2 class="product-title"><?php echo $order['Product_Name']; ?></h2>
                            <p class="product-description"><?php echo $order['Product_Description']; ?></p>
                        </div>
                    </div>
                    <div class="below-content">
                        <p class="total-price">
                            <span class="title">Total Price:</span> $<?php echo $order['Total_Price']; ?>
                        </p>
                        <p class="order-date">
                            <span class="title">Order Date:</span> <?php echo $order['Order_Date']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No orders found for this status.</p>
        <?php endif; ?>
    </div>
</div>