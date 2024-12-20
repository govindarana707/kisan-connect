<?php
include('includes/connect.php');
include('functions/common_function.php');

// Check if the form is submitted
if (isset($_POST['update_cart'])) {
    // Get the IP address of the user
    $ip = getIPAddress();

    // Loop through the quantity array and update the cart
    foreach ($_POST['quantity'] as $product_id => $quantity) {
        // Ensure the quantity is greater than or equal to 1
        if ($quantity >= 1) {
            // Update the quantity of the product in the cart
            $update_query = "UPDATE cart_details SET quantity='$quantity' WHERE ip_address='$ip' AND product_id='$product_id'";
            $update_result = mysqli_query($conn, $update_query);

            // If the update was successful
            if ($update_result) {
                // Redirect to the cart page with a success message
                echo "<script>alert('Cart updated successfully!');</script>";
                echo "<script>window.location.href = 'cart.php';</script>";
            } else {
                // If there was an error updating the cart
                echo "<script>alert('Error updating cart!');</script>";
                echo "<script>window.location.href = 'cart.php';</script>";
            }
        }
    }
} else {
    // Redirect back to the cart if the update button was not pressed
    echo "<script>window.location.href = 'cart.php';</script>";
}
?>
