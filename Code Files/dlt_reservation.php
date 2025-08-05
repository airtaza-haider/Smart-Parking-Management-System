<?php
require 'connect.php';

if (isset($_GET['id'])) {
    $res_id = $_GET['id'];

    $conn->query("DELETE FROM payment WHERE res_id = $res_id");

    $conn->query("DELETE FROM reservation WHERE res_id = $res_id");

    header("Location: all_reservations.php");
    exit();
}
?>
