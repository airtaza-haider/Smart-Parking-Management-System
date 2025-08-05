<?php
require 'connect.php';
$result = $conn->query("SELECT v.*, u.name AS owner FROM vehicle v LEFT JOIN user u ON v.user_id = u.user_id");
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Vehicles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container mt-5">
  <h2>Vehicle List</h2>
  <a href="add_vehicle.php" class="btn btn-success mb-3">Add New Vehicle</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Number Plate</th>
        <th>Type</th>
        <th>Owner</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['vehicle_id'] ?></td>
          <td><?= htmlspecialchars($row['number_plate']) ?></td>
          <td><?= $row['vehicle_type'] ?></td>
          <td><?= $row['owner'] ?></td>
          <td>
            <a href="update_vehicle.php?id=<?= $row['vehicle_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="dlt_vehicle.php?id=<?= $row['vehicle_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
