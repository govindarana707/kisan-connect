<?php
session_start();
include('includes/connect.php');

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$order_id = $_GET['order_id'];  // Get the order ID from the URL

// Fetch order details from the database
$order_query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$order_result = mysqli_query($conn, $order_query);

if ($order_result && mysqli_num_rows($order_result) > 0) {
    $order = mysqli_fetch_assoc($order_result);
} else {
    echo "Order not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisan Connect: Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Order Confirmation</h2>
    
    <div class="card">
        <div class="card-header">
            <h4>Your Order #<?php echo $order['order_id']; ?></h4>
        </div>
        <div class="card-body">
            <p><strong>Total Amount:</strong> Rs <?php echo $order['total_amount']; ?>/-</p>
            <p><strong>Shipping Address:</strong> <?php echo $order['shipping_address']; ?></p>
            <p><strong>Payment Status:</strong> <?php echo $order['payment_status']; ?></p>
        </div>
    </div>
    
    <div class="text-center my-4">
        <a href="index.php" class="btn btn-primary">Go to Home</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
        crossorigin="anonymous"></script>

</body>
</html>
