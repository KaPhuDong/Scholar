<?php
$orders = $data["Orders"];
$totalPages = $data["TotalPages"];
$currentPage = $data["CurrentPage"];
$totalOrders = $data["TotalOrders"];
$searchKeyword = $data["SearchKeyword"] ?? '';
?>

<div class="order-management">
    <div class="header-order">
        <p class="title">Order Management</p>
        <div class="search-order">
            <form action="/Scholar/admin/orderManagement" method="GET">
                <input
                    type="text"
                    name="keyword"
                    class="input-order"
                    placeholder="Search for date..."
                    value="<?php echo $searchKeyword; ?>" />

                <button type="submit" class="button-order">
                    <img src="./public/assets/icons/search.svg" alt="Search Icon">
                </button>
            </form>
        </div>
    </div>

    <div class="filter">
        <div class="filter-button">All (<?php echo $totalOrders; ?>)</div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <!-- Previous Button -->
                <?php if ($currentPage > 1): ?>
                    <a href="/Scholar/admin/orderManagement?keyword=<?php echo $searchKeyword; ?>&page=<?php echo $currentPage - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <!-- Page Numbers -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="/Scholar/admin/orderManagement?keyword=<?php echo $searchKeyword; ?>&page=<?php echo $i; ?>"
                        class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <!-- Next Button -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="/Scholar/admin/orderManagement?keyword=<?php echo $searchKeyword; ?>&page=<?php echo $currentPage + 1; ?>" class="next">Next</a>
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
                            <td class="phone-number"><?php echo $order['Phone']; ?></td>
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