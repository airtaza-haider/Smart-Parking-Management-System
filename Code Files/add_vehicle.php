<?php
include 'connect.php';

$users = $conn->query("SELECT * FROM user");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $plate = $_POST['number_plate'];
  $type = $_POST['vehicle_type'];
  $user_id = $_POST['user_id'];

  $stmt = $conn->prepare("INSERT INTO vehicle (number_plate, vehicle_type, user_id) VALUES (?, ?, ?)");
  $stmt->bind_param("ssi", $plate, $type, $user_id);
  $stmt->execute();

  echo "<div class='alert alert-success'>Vehicle is being added...</div>";
  header("refresh:2;url=all_vehicles.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Vehicle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Add Vehicle</h2>
  <form method="post">
    <div class="mb-3">
      <label>Number Plate:</label>
      <input type="text" name="number_plate" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Vehicle Type:</label>
      <input type="text" name="vehicle_type" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>User:</label>
      <select name="user_id" class="form-control" required>
        <option value="">-- Select User --</option>
        <?php while($row = $users->fetch_assoc()): ?>
          <option value="<?= $row['user_id'] ?>"><?= $row['name'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Add Vehicle</button>
    <a href="all_vehicles.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
