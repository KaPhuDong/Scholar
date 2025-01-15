<?php
$totalUsers = $data["TotalUsers"];
$totalOrders = $data["TotalOrders"];
?>


<div class="dashboard">
  <div class="dashboard-header">
      <h1>Admin Dashboard</h1>
  </div>

  <div class="stats-container">
      <div class="stat-card">
          <h3>Total Users</h3>
          <p><?php echo $totalUsers; ?></p>
      </div>
      <div class="stat-card">
          <h3>Total Products</h3>
          <p><?php echo $data['TotalProducts'];; ?></p>
      </div>
      <div class="stat-card">
          <h3>Total Orders</h3>
          <p><?php echo $totalOrders; ?></p>
      </div>
  </div>

  <div class="chart-container">
      <h2>Category and Orders Overview</h2>
      <canvas id="categoryChart"></canvas>
  </div>
</div>
