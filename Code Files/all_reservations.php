<?php

require 'connect.php';

$sql = "
  SELECT r.*, u.name AS user_name, v.number_plate, ps.block
  FROM reservation r
  LEFT JOIN user u ON r.user_id = u.user_id
  LEFT JOIN vehicle v ON r.vehicle_id = v.vehicle_id
  LEFT JOIN parking_slot ps ON r.slot_id = ps.slot_id
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Reservations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>All Reservations</h2>
  <a href="add_reservation.php" class="btn btn-success mb-3">Add Reservation</a>

  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Vehicle</th>
        <th>Slot</th>
        <th>Check-In</th>
        <th>Check-Out</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['res_id'] ?></td>
          <td><?= $row['user_name'] ?></td>
          <td><?= $row['number_plate'] ?></td>
          <td><?= $row['block'] ?></td>
          <td><?= $row['check_in_time'] ?></td>
          <td><?= $row['check_out_time'] ?></td>
          <td><?= $row['is_reserved'] ? 'Active' : 'Completed' ?></td>
          <td>
            <a href="update_reservation.php?id=<?= $row['res_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="dlt_reservation.php?id=<?= $row['res_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
