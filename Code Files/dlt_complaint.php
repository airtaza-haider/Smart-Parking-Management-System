<?php
require 'connect.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $conn->prepare("DELETE FROM complaints WHERE complain_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: all_complaints.php");
