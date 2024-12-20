<?php
include('includes/connect.php');
include('functions/common_function.php');

if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $ip = getIPAddress();
    // Delete item from cart
    $delete_query = "DELETE FROM cart_details WHERE product_id='$product_id' AND ip_address='$ip'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        echo "<script>alert('Item removed from cart successfully.');</script>";
        echo "<script>window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Failed to remove item from cart.');</script>";
        echo "<script>window.location.href='cart.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
    echo "<script>window.location.href='cart.php';</script>";
}
?>
