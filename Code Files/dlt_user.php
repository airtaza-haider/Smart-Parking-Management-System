<?php
require 'connect.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    
    $sql = "DELETE FROM user WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
       
        header("Location: all_users.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
