<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $country_code = $_POST['country_code'];
  $area_code = $_POST['area_code'];
  $phone = $_POST['phone'];

  if (!empty($name) && !empty($country_code) && !empty($area_code) && !empty($phone)) {
    $stmt = $conn->prepare("INSERT INTO user (name, country_code, area_code, phone_number) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $country_code, $area_code, $phone);
    $stmt->execute();
    header("Location: all_users.php");
    exit();
  } else {
    $error = "All fields are required.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  
  <h2>Add New User</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

  <form method="post">
    <div class="mb-3">
      <label>Name:</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Country Code:</label>
      <input type="text" name="country_code" class="form-control" placeholder="+92" required>
    </div>
    <div class="mb-3">
      <label>Area Code:</label>
      <input type="text" name="area_code" class="form-control" placeholder="300" required>
    </div>
    <div class="mb-3">
      <label>Phone Number:</label>
      <input type="text" name="phone" class="form-control" placeholder="1234567" required>
    </div>
    <button type="submit" class="btn btn-success">Add User</button>
    <a href="all_users.php" class="btn btn-secondary">Back</a>
  </form>
</div>
</body>
</html>
