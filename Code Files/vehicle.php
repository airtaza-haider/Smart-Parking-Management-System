<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Vehicle Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>

<div class="container mt-5">
  <h2 class="text-center mb-4">Vehicle Management</h2>
  <div class="row g-4 justify-content-center">

    
    <div class="col-md-3">
      <div class="card text-white bg-success text-center p-3">
        <div class="card-body">
          <h5 class="card-title">Add New Vehicle</h5>
          <a href="add_vehicle.php" class="btn btn-light">Go</a>
        </div>
      </div>
    </div>

    
    <div class="col-md-3">
      <div class="card text-white bg-primary text-center p-3">
        <div class="card-body">
          <h5 class="card-title">View All Vehicles</h5>
          <a href="all_vehicles.php" class="btn btn-light">Go</a>
        </div>
      </div>
    </div>

  
    <div class="col-md-3">
      <div class="card text-white bg-dark text-center p-3">
        <div class="card-body">
          <h5 class="card-title">Back to Home</h5>
          <a href="index.php" class="btn btn-light">Go</a>
        </div>
      </div>
    </div>

  </div>
</div>

</body>
</html>
