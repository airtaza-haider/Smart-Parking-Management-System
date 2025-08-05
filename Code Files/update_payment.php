<?php
require 'connect.php';


$payment_id = $_GET['id'] ?? null;
if (!$payment_id) {
    die("Payment ID is required");
}


$sql = "SELECT * FROM payment WHERE payment_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $payment_id);
$stmt->execute();
$result = $stmt->get_result();
$payment = $result->fetch_assoc();

if (!$payment) {
    die("Payment not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $res_id = $_POST['res_id'];
    $amount = $_POST['amount'];
   

    

    $update_sql = "UPDATE payment SET res_id = ?, amount = ? WHERE payment_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("isi", $res_id, $amount, $payment_id);
    if ($update_stmt->execute()) {
        header("Location: all_payments.php");
        exit;
    } else {
        $error = "Failed to update payment.";
    }
}

$res_sql = "SELECT res_id, check_in_time FROM reservation";
$res_result = $conn->query($res_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Payment #<?= htmlspecialchars($payment_id) ?></h2>
    <?php if (!empty($error)) : ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="res_id" class="form-label">Reservation</label>
            <select name="res_id" id="res_id" class="form-select" required>
                <option value="">Select Reservation</option>
                <?php while ($res = $res_result->fetch_assoc()) : ?>
                    <option value="<?= $res['res_id'] ?>" <?= ($res['res_id'] == $payment['res_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($res['check_in_time']) ?> (ID: <?= $res['res_id'] ?>)
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount (PKR)</label>
            <input type="number" step="0.01" name="amount" id="amount" class="form-control" value="<?= htmlspecialchars($payment['amount']) ?>" required>
        </div>

       

        <button type="submit" class="btn btn-primary">Update Payment</button>
        <a href="all_payments.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
