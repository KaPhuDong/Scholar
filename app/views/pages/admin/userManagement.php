<?php
$users = $data["Users"];
$totalPages = $data["TotalPages"];
$currentPage = $data["CurrentPage"];
$totalUsers = $data["TotalUsers"];
?>
<div class="user-management">
    <div class="header-user">
        <p class="title">User Management</p>
        <div class="search-user">
            <form action="/Scholar/admin/userManagement" method="GET">
                <input 
                    type="text" 
                    name="keyword" 
                    class="input-user" 
                    placeholder="Search for users..." 
                    value="<?php echo $data['SearchKeyword'] ?? ''; ?>" />
                <button type="submit" class="button-user">
                    <img src="./public/assets/icons/search.svg" alt="Search Icon">
                </button>
            </form>
        </div>
    </div>


    <div class="filter">
        <div class="filter-button">All (<?php echo $totalUsers; ?>)</div>

        <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="/Scholar/Admin/userManagement?page=<?php echo $currentPage - 1; ?>" class="prev">Previous</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="/Scholar/Admin/userManagement?page=<?php echo $i; ?>" class="<?php echo ($i == $currentPage) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages): ?>
                    <a href="/Scholar/Admin/userManagement?page=<?php echo $currentPage + 1; ?>" class="next">Next</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
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
                            <td><img src="./public/assets/images/avatar/<?php echo $user["avatar"] ?>" alt="Avatar" class="avatar-user"></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['phone_number'] ?></td>
                            <td><?php echo $user['address'] ?></td>
                            <td>
                                <form method="POST" action="/Scholar/admin/deleteUser">
                                    <input type="hidden" name="user_Id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" name="deleteUserById"  style="cursor: pointer"; onclick="return confirm('Are you sure you want to delete this user?');">
                                        <img src="./public/assets/icons/remove.svg" alt="Remove Icon" class="btn-icon">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No account exists in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>