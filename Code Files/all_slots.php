<?php
require 'connect.php';
$result = $conn->query("SELECT * FROM parking_slot");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Parking Slots</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>All Parking Slots</h2>
  <a href="add_slot.php" class="btn btn-success mb-3">Add New Slot</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Block</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['slot_id'] ?></td>
          <td><?= htmlspecialchars($row['block']) ?></td>
          <td><?= $row['is_available'] ? 'Available' : 'Occupied' ?></td>
          <td>
            <a href="update_slot.php?id=<?= $row['slot_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="dlt_slot.php?id=<?= $row['slot_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
