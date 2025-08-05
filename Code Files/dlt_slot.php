<?php
require 'connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  die("Invalid Slot ID");
}

$stmt1 = $conn->prepare("DELETE FROM payment WHERE res_id IN (
  SELECT res_id FROM reservation WHERE slot_id = ?
)");
$stmt1->bind_param("i", $id);
$stmt1->execute();

$stmt2 = $conn->prepare("DELETE FROM reservation WHERE slot_id = ?");
$stmt2->bind_param("i", $id);
$stmt2->execute();

$stmt3 = $conn->prepare("DELETE FROM complaints WHERE slot_id = ?");
$stmt3->bind_param("i", $id);
$stmt3->execute();

$stmt4 = $conn->prepare("DELETE FROM parking_slot WHERE slot_id = ?");
$stmt4->bind_param("i", $id);
$stmt4->execute();

header("Location: all_slots.php");
exit();
?>
