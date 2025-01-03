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
                    <th class="column-action">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users) && is_array($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['user_id'] ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <td><img class="avatar" alt="Avatar" src="./public/assets/images/avatar/<?php echo $user["avatar"] ?>"></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['phone_number'] ?></td>
                            <td><?php echo $user['address'] ?></td>
                            <td>
                                <!-- Delete Icon with Form -->
                                <form method="POST" action="/Scholar/admin/handleDeleteUser" style="display: inline;">
                                    <input type="hidden" name="user_Id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" name="deleteUser" onclick="return confirm('Are you sure you want to delete this user?');" style="background: none; border: none; cursor: pointer;">
                                        <img src="./public/assets/icons/remove.svg" alt="Remove Icon">
                                    </button>
                                </form>
                            </td>
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