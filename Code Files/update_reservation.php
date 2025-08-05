<?php
require 'connect.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Invalid reservation ID");


$res = $conn->query("SELECT * FROM reservation WHERE res_id = $id")->fetch_assoc();
if (!$res) die("Reservation not found");


$users = $conn->query("SELECT * FROM user");
$vehicles = $conn->query("SELECT * FROM vehicle");
$slots = $conn->query("SELECT * FROM parking_slot");

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_POST['user_id'];
  $vehicle_id = $_POST['vehicle_id'];
  $slot_id = $_POST['slot_id'];
  $check_in = $_POST['check_in'];
  $check_out = $_POST['check_out'];
  $is_reserved = $_POST['is_reserved'];

  $stmt = $conn->prepare("UPDATE reservation SET check_in_time=?, check_out_time=?, is_reserved=?, user_id=?, vehicle_id=?, slot_id=? WHERE res_id=?");
  $stmt->bind_param("ssiiiii", $check_in, $check_out, $is_reserved, $user_id, $vehicle_id, $slot_id, $id);
  $stmt->execute();

  $message = "Reservation updated...";
  header("refresh:2;url=all_reservations.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Reservation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h2>Edit Reservation</h2>
  <?php if (!empty($message)) echo "<div class='alert alert-info'>$message</div>"; ?>
  <form method="post">

    <div class="mb-3">
      <label>User:</label>
      <select name="user_id" class="form-control" required>
        <?php while($u = $users->fetch_assoc()): ?>
          <option value="<?= $u['user_id'] ?>" <?= $u['user_id'] == $res['user_id'] ? 'selected' : '' ?>><?= $u['name'] ?></option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Vehicle:</label>
      <select name="vehicle_id" class="form-control" required>
        <?php while($v = $vehicles->fetch_assoc()): ?>
          <option value="<?= $v['vehicle_id'] ?>" <?= $v['vehicle_id'] == $res['vehicle_id'] ? 'selected' : '' ?>>
            <?= $v['number_plate'] ?> (<?= $v['vehicle_type'] ?>)
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Slot:</label>
      <select name="slot_id" class="form-control" required>
        <?php while($s = $slots->fetch_assoc()): ?>
          <option value="<?= $s['slot_id'] ?>" <?= $s['slot_id'] == $res['slot_id'] ? 'selected' : '' ?>>
            <?= $s['block'] ?> <?= $s['is_available'] ? '(Available)' : '(Occupied)' ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Check-In Time:</label>
      <input type="datetime-local" name="check_in" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($res['check_in_time'])) ?>" required>
    </div>

    <div class="mb-3">
      <label>Check-Out Time:</label>
      <input type="datetime-local" name="check_out" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($res['check_out_time'])) ?>" required>
    </div>

    <div class="mb-3">
      <label>Status:</label>
      <select name="is_reserved" class="form-control">
        <option value="1" <?= $res['is_reserved'] ? 'selected' : '' ?>>Reserved</option>
        <option value="0" <?= !$res['is_reserved'] ? 'selected' : '' ?>>Completed</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="all_reservations.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
