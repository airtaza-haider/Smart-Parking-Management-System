<?php
require 'connect.php';

$user_id = 1; 

$slot_result = $conn->query("SELECT slot_id FROM parking_slot");

$success = $error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slot_id = $_POST['slot_id'];
    $message = $_POST['message'];
    $date_of_issue = $_POST['date_of_issue'];

    if (empty($message) || empty($date_of_issue) || empty($slot_id)) {
        $error = "All fields are required.";
    } else {
        $sql = "INSERT INTO complaints (message, date_of_issue, user_id, slot_id) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $message, $date_of_issue, $user_id, $slot_id);
        if ($stmt->execute()) {
            $success = "Complaint submitted successfully.";
            $_POST = [];
        } else {
            $error = "Failed to submit complaint.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Complaint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Submit a Complaint</h2>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <?php if ($success): ?><div class="alert alert-success"><?= $success ?></div><?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Slot ID</label>
            <select name="slot_id" class="form-select" required>
                <option value="">Select Slot</option>
                <?php while ($row = $slot_result->fetch_assoc()): ?>
                    <option value="<?= $row['slot_id'] ?>" <?= ($_POST['slot_id'] ?? '') == $row['slot_id'] ? 'selected' : '' ?>>
                        Slot #<?= $row['slot_id'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date of Issue</label>
            <input type="date" name="date_of_issue" class="form-control" value="<?= $_POST['date_of_issue'] ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea name="message" class="form-control" rows="5" required><?= $_POST['message'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Complaint</button>
        <a href="all_complaints.php" class="btn btn-secondary">View All</a>
    </form>
</div>
</body>
</html>
