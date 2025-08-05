<?php
require 'connect.php';


$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">Users List</h2>
  <a href="add_user.php" class="btn btn-primary mb-3">Add New User</a>

  <table class="table table-bordered table-striped">
    
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Actions</th>
      </tr>
    
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= $row['country_code'] . "-" . $row['area_code'] . "-" . $row['phone_number'] ?></td>
            <td>
              <a href="update_user.php?id=<?= $row['user_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="dlt_user.php?id=<?= $row['user_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="4" class="text-center">No users found.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

</body>
</html>
