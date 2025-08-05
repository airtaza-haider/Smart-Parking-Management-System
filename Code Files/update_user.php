<?php
require 'connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("Invalid ID");
}

$result = $conn->query("SELECT * FROM user WHERE user_id = $id");
$user = $result->fetch_assoc();
if (!$user) {
  die("User not found");
}


$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $country_code = $_POST['country_code'];
  $area_code = $_POST['area_code'];
  $phone = $_POST['phone'];

  $stmt = $conn->prepare("UPDATE user SET name=?, country_code=?, area_code=?, phone_number=? WHERE user_id=?");
  $stmt->bind_param("ssssi", $name, $country_code, $area_code, $phone, $id);
  $stmt->execute();

  $message = "User is being updated...";
  header("refresh:2;url=all_users.php"); // Wait 2 seconds then redirect
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container mt-5">
  <h2>Update User</h2>

  <?php if (!empty($message)): ?>
    <div class="alert alert-info"><?= $message ?></div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label>Name:</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Country Code:</label>
      <input type="text" name="country_code" class="form-control" value="<?= htmlspecialchars($user['country_code']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Area Code:</label>
      <input type="text" name="area_code" class="form-control" value="<?= htmlspecialchars($user['area_code']) ?>" required>
    </div>
    <div class="mb-3">
      <label>Phone Number:</label>
      <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone_number']) ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="all_users.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>
</body>
</html>
