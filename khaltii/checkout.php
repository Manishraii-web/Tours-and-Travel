<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign POST values to SESSION variables
    $_SESSION['name'] = $_POST['name'] ?? '';
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['phone'] = $_POST['phone'] ?? '';
    $_SESSION['package'] = $_POST['package'] ?? '';
    $_SESSION['amount'] = $_POST['amount'] ?? '';
} else {
    // Redirect if accessed directly without form submission
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khalti Payment Integration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="m-4">
    <h1 class="text-center">Confirm Your Payment</h1>
    <div class="d-flex justify-content-center mt-3">
        <form class="row g-3 w-50 mt-4" action="payment-request.php" method="POST">
            <label for="">Product Details:</label>
            <div class="col-md-6">
                <label class="form-label">Amount</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['amount']); ?>" name="amount" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Package</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars(ucfirst($_SESSION['package'])); ?>" name="package" readonly>
            </div>
            <label for="">Customer Details:</label>
            <div class="col-12">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" name="name" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" name="email" readonly>
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($_SESSION['phone']); ?>" name="phone" readonly>
            </div>
            <div class="col-12">
                <button type="submit" name="submit" class="btn btn-primary">Pay with Khalti</button>
            </div>
        </form>
    </div>
</body>
</html>
