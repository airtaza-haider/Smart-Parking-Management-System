<?php
require 'connect.php';

$payment_id = $_GET['id'] ?? null;
if (!$payment_id) {
    die("Payment ID is required");
}

$sql = "DELETE FROM payment WHERE payment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $payment_id);

if ($stmt->execute()) {
    header("Location: all_payments.php");
    exit;
} else {
    echo "Error deleting payment.";
}
