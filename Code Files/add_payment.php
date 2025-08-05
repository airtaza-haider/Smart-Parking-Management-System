<?php
require 'connect.php';

$error = '';
$success = '';


$res_sql = "SELECT res_id, check_in_time FROM reservation";
$res_result = $conn->query($res_sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res_id = $_POST['res_id'];
    $amount = $_POST['amount'];


    if (empty($res_id) || empty($amount)) {
        $error = "All fields are required.";
    } else {
        $insert_sql = "INSERT INTO payment (res_id, amount) VALUES (?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("id", $res_id, $amount);

        if ($stmt->execute()) {
            $success = "Payment added successfully.";
            $_POST = [];
        } else {
            $error = "Error adding payment.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add Payment</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="res_id" class="form-label">Reservation</label>
            <select name="res_id" id="res_id" class="form-select" required>
                <option value="">Select Reservation</option>
                <?php while ($res = $res_result->fetch_assoc()) : ?>
                    <option value="<?= $res['res_id'] ?>" <?= (isset($_POST['res_id']) && $_POST['res_id'] == $res['res_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($res['check_in_time']) ?> (ID: <?= $res['res_id'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (PKR)</label>
            <input type="number" step="0.01" name="amount" id="amount" class="form-control" 
                value="<?= $_POST['amount'] ?? '' ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Payment</button>
        <a href="all_payments.php" class="btn btn-secondary">Back to Payments</a>
    </form>
</div>
</body>
</html>
