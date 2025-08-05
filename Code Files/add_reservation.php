<?php
require 'connect.php';

$users = $conn->query("SELECT * FROM user");
$vehicles = $conn->query("SELECT * FROM vehicle");
$slots = $conn->query("SELECT * FROM parking_slot WHERE is_available = 1");

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $vehicle_id = $_POST['vehicle_id'];
  $slot_id = $_POST['slot_id'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $is_reserved = $_POST['is_reserved'];

  $stmt = $conn->prepare("INSERT INTO reservation (check_in_time, check_out_time, is_reserved, user_id, vehicle_id, slot_id)
                          VALUES (?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssiiii", $check_in, $check_out, $is_reserved, $user_id, $vehicle_id, $slot_id);
  $stmt->execute();

  $message = "Reservation is being added...";
  header("refresh:2;url=all_reservations.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Reservation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Add Reservation</h2>
  <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
  <form method="post">

    <div class="mb-3">
      <label>User:</label>
      <select name="user_id" class="form-control" required>
        <option value="">-- Select User --</option>
        <?php while($u = $users->fetch_assoc()): ?>
          <option value="<?= $u['user_id'] ?>"><?= $u['name'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Vehicle:</label>
      <select name="vehicle_id" class="form-control" required>
        <option value="">-- Select Vehicle --</option>
        <?php while($v = $vehicles->fetch_assoc()): ?>
          <option value="<?= $v['vehicle_id'] ?>"><?= $v['number_plate'] ?> (<?= $v['vehicle_type'] ?>)</option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Parking Slot:</label>
      <select name="slot_id" class="form-control" required>
        <option value="">-- Select Slot --</option>
        <?php while($s = $slots->fetch_assoc()): ?>
          <option value="<?= $s['slot_id'] ?>"><?= $s['block'] ?> <?= $s['is_available'] ? '(Available)' : '(Occupied)' ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Check-In Time:</label>
      <input type="datetime-local" name="check_in" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Check-Out Time:</label>
      <input type="datetime-local" name="check_out" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Status:</label>
      <select name="is_reserved" class="form-control">
        <option value="1">Reserved</option>
        <option value="0">Completed</option>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Add Reservation</button>
    <a href="all_reservations.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
