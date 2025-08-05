<?php

require 'connect.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Parking Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Parking System</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="user.php">Users</a></li>
          <li class="nav-item"><a class="nav-link" href="vehicle.php">Vehicles</a></li>
          <li class="nav-item"><a class="nav-link" href="slot.php">Parking Slots</a></li>
          <li class="nav-item"><a class="nav-link" href="reservation.php">Reservations</a></li>
          <li class="nav-item"><a class="nav-link" href="payment.php">Payments</a></li>
          <li class="nav-item"><a class="nav-link" href="complaint.php">Complaints</a></li>
        </ul>

      </div>
    </div>
  </nav>

  <div class="text-center my-4">
    <h1 class="header-title">Parking Management System</h1>
    <p class="lead">A web-based platform for efficient reservation, payment, and monitoring of parking slots</p>
  </div>

  <div class="container mb-5">
    <div class="row align-items-center">
      
      <div class="col-md-6">
        <h4>About the System</h4>
        <p>
          The Parking Management System is designed to help users efficiently reserve, manage, and monitor parking slots in real time.
          It allows administrators to manage users, vehicles, parking slots, reservations, handle complaints, and oversee payments.
          The system ensures a seamless experience for users.
        </p>
      </div>

      <div class="col-md-6 text-center">
        <img src="img1.png" class="img-fluid rounded shadow" alt="Parking Image" style="max-height: 300px;">
      </div>

    </div>
  </div>

  <footer class="footer">
    <div class="container">
      <p>&copy; 2025 Parking Management System. All rights reserved</p>
    </div>
  </footer>

</body>
</html>
