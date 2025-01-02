<?php
$users = $data["userData"];
?>
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
                    <th class="column-username">Username</th>
                    <th class="column-avatar">Avatar</th>
                    <th class="column-email">Email</th>
                    <th class="column-phone">Phone</th>
                    <th class="column-address">Address</th>
                    <th class="column-password">Password</th>
                    <th class="column-action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users) && is_array($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['user_id'] ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <td><img src="<?php echo $user['avatar'] ?>" alt="Avatar" class="avatar"></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['phone_number'] ?></td>
                            <td><?php echo $user['address'] ?></td>
                            <td>**********</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">Không có tài khoản nào trong Database</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>