<?php
require 'connect.php';

$id = $_GET['id'] ?? null;
if (!$id) die("Complaint ID required");

$stmt = $conn->prepare("SELECT * FROM complaints WHERE complain_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$complaint = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $date_of_issue = $_POST['date_of_issue'];

    $update = "UPDATE complaints SET message = ?, date_of_issue = ? WHERE complain_id = ?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssi", $message, $date_of_issue, $id);
    if ($stmt->execute()) {
        header("Location: all_complaints.php");
        exit;
    } else {
        $error = "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Complaint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Complaint #<?= $id ?></h2>
    <form method="POST">
        <div class="mb-3">
            <label>Date of Issue</label>
            <input type="date" name="date_of_issue" class="form-control" value="<?= $complaint['date_of_issue'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Message</label>
            <textarea name="message" class="form-control" rows="5"><?= htmlspecialchars($complaint['message']) ?></textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="all_complaints.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
