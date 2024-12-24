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

// Check if the form data (address and payment method) is received
if (isset($_POST['address'], $_POST['payment_method'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);  // Sanitize the address input
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);  // Sanitize the payment method input

    // Fetch the user's cart details to calculate the total
    $cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
    $cart_result = mysqli_query($conn, $cart_query);

    // Initialize total variable
    $total = 0;

    while ($row = mysqli_fetch_array($cart_result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        // Fetch product details
        $product_query = "SELECT * FROM products WHERE product_id = '$product_id'";
        $product_result = mysqli_query($conn, $product_query);
        $product = mysqli_fetch_assoc($product_result);

        // Calculate the subtotal for each product and add it to the total
        $total += $product['price'] * $quantity;
    }

    // Insert order details into the orders table (This can vary depending on your structure)
    $order_query = "INSERT INTO orders (user_id, total_amount, shipping_address, payment_method, order_date) 
                    VALUES ('$user_id', '$total', '$address', '$payment_method', NOW())";

    $order_result = mysqli_query($conn, $order_query);

    if ($order_result) {
        // If order is successfully created, you can redirect to the payment page
        // Here we're assuming you redirect to a payment page
        header('Location: payment.php');
        exit();
    } else {
        // Handle any error in inserting the order (optional)
        echo "Error: Could not create the order. Please try again.";
    }

} else {
    // Handle case when address or payment method is not set (optional)
    echo "Error: Please fill in all the required fields.";
}
?>
