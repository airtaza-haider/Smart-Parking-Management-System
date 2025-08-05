<?php
require 'connect.php';

if (isset($_GET['id'])) {
    $vehicle_id = (int)$_GET['id'];

    $conn->query("DELETE FROM reservation WHERE vehicle_id = $vehicle_id");

    $conn->query("DELETE FROM vehicle WHERE vehicle_id = $vehicle_id");

    header("Location: all_vehicles.php");
    exit();
}
?>
