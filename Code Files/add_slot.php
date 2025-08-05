<?php
require 'connect.php';
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $block = $_POST['block'];
  $is_available = $_POST['is_available'];

  $stmt = $conn->prepare("INSERT INTO parking_slot (block, is_available) VALUES (?, ?)");
  $stmt->bind_param("si", $block, $is_available);
  $stmt->execute();

  $message = "Slot is being added...";
  header("refresh:2;url=all_slots.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Parking Slot</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Add New Parking Slot</h2>
  <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
  <form method="post">
    <div class="mb-3">
      <label>Block:</label>
      <input type="text" name="block" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Availability:</label>
      <select name="is_available" class="form-control">
        <option value="1">Available</option>
        <option value="0">Occupied</option>
      </select>
    </div>
    <button type="submit" class="btn btn-success">Add Slot</button>
    <a href="all_slots.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
