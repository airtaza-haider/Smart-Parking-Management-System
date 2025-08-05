<?php
require 'connect.php';

$sql = "
  SELECT p.*, r.check_in_time, u.name AS user_name
  FROM payment p
  LEFT JOIN reservation r ON p.res_id = r.res_id
  LEFT JOIN user u ON r.user_id = u.user_id
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Payments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>All Payments</h2>
  <a href="add_payment.php" class="btn btn-success mb-3">Add Payment</a>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>User</th>
        <th>Reservation</th>
        <th>Amount</th>
        
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= $row['payment_id'] ?></td>
        <td><?= $row['user_name'] ?></td>
        <td><?= $row['check_in_time'] ?></td>
        <td><?= $row['amount'] ?> PKR</td>
        
        <td>
          <a href="update_payment.php?id=<?= $row['payment_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="dlt_payment.php?id=<?= $row['payment_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this payment?')">Delete</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
