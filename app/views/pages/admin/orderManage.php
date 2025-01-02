<div class="user-management">
    <p class="title">User Management</p>
    <div class="filter">
        <div class="filter-button">All (5)</div>
    </div>
    <div class="table-container">
        <table class="user-table">
            <thead>
                <tr>
                    <th class="column-id">ID</th>
                    <th class="column-username">Recipient</th>
                    <th class="column-phone">Phone</th>
                    <th class="column-delivery_address">Delivery Address</th>
                    <th class="column-status">Status</th>
                    <th class="column-action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($userData) && is_array($userData)): ?>
                    <?php foreach ($userData as $row): ?>
                        <tr>
                            <td><?php echo ($row['user_id']); ?></td>
                            <td><?php echo ($row['name']); ?></td>
                            <td><?php echo ($row['phone_number']); ?></td>
                            <td><?php echo ($row['address']); ?></td>
                            <td>
                                <?php
                                // Hiển thị trạng thái trực tiếp từ cơ sở dữ liệu
                                $statusMap = [
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'completed' => 'Completed'
                                ];
                                echo $statusMap[$row['status']] ?? 'Unknown Status';
                                ?>
                            </td>
                            <td>
                                <a href="edit.php?id=<?php echo ($row['user_id']); ?>" class="btn btn-edit">Edit</a>
                                <a href="delete.php?id=<?php echo ($row['user_id']); ?>" class="btn btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Không có đơn hàng nào trong Database</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>