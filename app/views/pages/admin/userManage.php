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
                <?php if (!empty($userData) && is_array($userData)): ?>
                    <?php foreach ($userData as $row): ?>
                        <tr>
                            <td><?= $row['user_id'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><img src="<?= $row['avatar'] ?>" alt="Avatar" class="avatar"></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['phone_number'] ?></td>
                            <td><?= $row['address'] ?></td>
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