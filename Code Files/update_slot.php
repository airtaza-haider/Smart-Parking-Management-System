<?php
require 'connect.php';

$id = $_GET['id'];
if (!$id) die("Invalid ID");

$result = $conn->query("SELECT * FROM parking_slot WHERE slot_id = $id");
$slot = $result->fetch_assoc();
if (!$slot) die("Slot not found.");

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $block = $_POST['block'];
  $is_available = $_POST['is_available'];

  $stmt = $conn->prepare("UPDATE parking_slot SET block=?, is_available=? WHERE slot_id=?");
  $stmt->bind_param("sii", $block, $is_available, $id);
  $stmt->execute();

  $message = "Slot is being updated...";
  header("refresh:2;url=all_slots.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Parking Slot</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Edit Parking Slot</h2>
  <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
  <form method="post">
    <div class="mb-3">
      <label>Block:</label>
      <input type="text" name="block" class="form-control" value="<?= $slot['block'] ?>" required>
    </div>
    <div class="mb-3">
      <label>Availability:</label>
      <select name="is_available" class="form-control">
        <option value="1" <?= $slot['is_available'] ? 'selected' : '' ?>>Available</option>
        <option value="0" <?= !$slot['is_available'] ? 'selected' : '' ?>>Occupied</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update Slot</button>
    <a href="all_slots.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
