<?php
require 'connect.php';

$sql = "
SELECT c.*, u.name AS user_name
FROM complaints c
JOIN user u ON c.user_id = u.user_id
ORDER BY c.date_of_issue DESC
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Complaints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>All Complaints</h2>
    <a href="add_complaint.php" class="btn btn-success mb-3">Add Complain</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Slot ID</th>
                <th>Message</th>
                <th>Date of Issue</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['complain_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['slot_id'] ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td><?= $row['date_of_issue'] ?></td>
                <td>
                    <a href="update_complaint.php?id=<?= $row['complain_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="dlt_complaint.php?id=<?= $row['complain_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this complaint?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
