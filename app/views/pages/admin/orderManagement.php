<?php
$orders = $data["Orders"];
$totalPages = $data["TotalPages"];
$currentPage = $data["CurrentPage"];
$totalOrders = $data["TotalOrders"];
?>
<div class="order-management">
    <p class="title">Order Management</p>
    <div class="filter">
        <div class="filter-button">All (<?php echo $totalOrders; ?>)</div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="/Scholar/Admin/orderManagement?page=<?php echo $currentPage - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="/Scholar/Admin/orderManagement?page=<?php echo $i; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="/Scholar/Admin/orderManagement?page=<?php echo $currentPage + 1; ?>" class="next">Next</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="table-container">
        <table class="order-table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th class="column-recipient">Recipient</th>
                    <th class="column-phone">Phone</th>
                    <th class="column-delivery-address">Delivery Address</th>
                    <th class="column-product">Product</th>
                    <th class="column-order-date">Order Date</th>
                    <th class="column-status">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders) && is_array($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['ID']; ?></td>
                            <td><?php echo $order['Recipient']; ?></td>
                            <td><?php echo $order['Phone']; ?></td>
                            <td><?php echo $order['Delivery_Address']; ?></td>
                            <td>
                                <img src="<?php echo $order['Product_Image']; ?>" alt="Product Image" class="product-img">
                                <p><?php echo $order['Product_Name']; ?></p>
                            </td>
                            <td><?php echo $order['Order_Date']; ?></td>
                            <td><?php echo $order['Status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">There are no orders in the system.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>