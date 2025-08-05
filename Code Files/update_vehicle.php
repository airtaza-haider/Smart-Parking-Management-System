<?php
require 'connect.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
  die("❌ Invalid vehicle ID.");
}

$result = $conn->prepare("SELECT * FROM vehicle WHERE vehicle_id = ?");
$result->bind_param("i", $id);
$result->execute();
$vehicleResult = $result->get_result();
$vehicle = $vehicleResult->fetch_assoc();

if (!$vehicle) {
  die("❌ Vehicle not found.");
}

$users = $conn->query("SELECT * FROM user");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $plate = $_POST['plate'];
  $type = $_POST['type'];
  $user_id = $_POST['user_id'];

  $stmt = $conn->prepare("UPDATE vehicle SET number_plate=?, vehicle_type=?, user_id=? WHERE vehicle_id=?");
  $stmt->bind_param("ssii", $plate, $type, $user_id, $id);
  $stmt->execute();

  echo "<div class='alert alert-success'>Vehicle is being updated...</div>";
  header("refresh:2;url=all_vehicles.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Vehicle</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Edit Vehicle</h2>

  <form method="post">
    <div class="mb-3">
      <label>Number Plate:</label>
      <input type="text" name="plate" class="form-control" value="<?= htmlspecialchars($vehicle['number_plate']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Vehicle Type:</label>
      <input type="text" name="type" class="form-control" value="<?= htmlspecialchars($vehicle['vehicle_type']) ?>" required>
    </div>

    <div class="mb-3">
      <label>Owner:</label>
      <select name="user_id" class="form-control" required>
        <?php while ($u = $users->fetch_assoc()): ?>
          <option value="<?= $u['user_id'] ?>" <?= $u['user_id'] == $vehicle['user_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($u['name']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Vehicle</button>
    <a href="all_vehicles.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
