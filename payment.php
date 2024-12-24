<?php
session_start();
include('includes/connect.php');
include('functions/common_function.php');
// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');  // Redirect to login if user is not logged in
    exit();
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID
$ip = getIPAddress();  // Assuming getIPAddress() is a function that returns user's IP address

// Fetch the user's most recent order
$order_query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_id DESC LIMIT 1";
$order_result = mysqli_query($conn, $order_query);

if ($order_result && mysqli_num_rows($order_result) > 0) {
    $order = mysqli_fetch_assoc($order_result);
    $order_id = $order['order_id'];
    $total_amount = $order['total_amount'];
    $shipping_address = $order['shipping_address'];
    $payment_method = $order['payment_method'];
} else {
    echo "No order found. Please make sure you've added products to your cart.";
    exit();
}

// Simple logic to simulate the payment (in a real system, you would integrate a payment gateway)
if (isset($_POST['pay'])) {
    // Simulate payment success
    $payment_status = 'Success';  // This would be the result from an actual payment gateway in a real-world scenario

    // Update the order status to paid (you can modify this status as needed)
    $update_order_query = "UPDATE orders SET payment_status = '$payment_status' WHERE order_id = '$order_id'";
    if (mysqli_query($conn, $update_order_query)) {
        // After updating the order, remove all items from the cart
        $remove_cart_items_query = "DELETE FROM cart_details WHERE ip_address = '$ip'"; // Clear cart based on user IP
        if (mysqli_query($conn, $remove_cart_items_query)) {
            // Redirect to a confirmation page or thank you page
            header('Location: order_confirmation.php?order_id=' . $order_id);  // Redirect to a confirmation page
            exit();
        } else {
            echo "Error clearing the cart. Please try again.";
        }
    } else {
        echo "Error updating the order status. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisan Connect: Payment</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Payment Page</h2>
    
    <div class="card">
        <div class="card-header">
            <h4>Order Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Order ID:</strong> <?php echo $order_id; ?></p>
            <p><strong>Total Amount:</strong> Rs <?php echo $total_amount; ?>/-</p>
            <p><strong>Shipping Address:</strong> <?php echo $shipping_address; ?></p>
            <p><strong>Payment Method:</strong> <?php echo $payment_method; ?></p>
        </div>
    </div>

    <div class="card my-4">
        <div class="card-header">
            <h4>Payment Options</h4>
        </div>
        <div class="card-body">
            <!-- Mock Payment Button -->
            <form action="payment.php" method="post">
                <div class="form-group text-center">
                    <button type="submit" name="pay" class="btn btn-success">Order Now</button>
                </div>
            </form>
            <!-- You can replace the above button with integration from a payment gateway -->
        </div>
    </div>
</div>

<!-- Bootstrap JS Link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
        crossorigin="anonymous"></script>

</body>
</html>
