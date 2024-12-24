<?php
session_start();
include('includes/connect.php');
include('functions/common_function.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect them to login page and save the current page URL
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];  // Store current URL
    header('Location: login.php');  // Redirect to login page
    exit();
}

// Get the user's ID from session
$user_id = $_SESSION['user_id'];
$ip = getIPAddress();  // Assuming getIPAddress() function is defined in your functions

// Fetch the user's shipping address
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// Get cart items
$cart_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
$cart_result = mysqli_query($conn, $cart_query);
$cart_items = [];
$total = 0;

while ($row = mysqli_fetch_array($cart_result)) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $product_query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $product_result = mysqli_query($conn, $product_query);
    $product = mysqli_fetch_assoc($product_result);

    $product_name = $product['product_title'];
    $product_price = $product['price'];
    $product_image = $product['product_image1'];
    $subtotal = $product_price * $quantity;

    $cart_items[] = [
        'product_name' => $product_name,
        'product_price' => $product_price,
        'quantity' => $quantity,
        'subtotal' => $subtotal,
        'product_image' => $product_image
    ];

    $total += $subtotal;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisan Connect: Checkout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" href="#">Kisan Connect</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome, <?= $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Checkout Section -->
    <div class="container my-5">
        <h2 class="text-center">Checkout</h2>
        
        <div class="row">
            <div class="col-md-8">
                <h4>Your Cart</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><img src="./admin_panel/product_images/<?= $item['product_image']; ?>" width="100" alt="<?= $item['product_name']; ?>"></td>
                            <td><?= $item['product_name']; ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>Rs <?= $item['subtotal']; ?>/-</td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Total</td>
                            <td>Rs <?= $total; ?>/-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <h4>Shipping Address</h4>
                <form action="process_checkout.php" method="POST">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" rows="4" required><?= $user_data['address']; ?></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-select" id="payment_method" name="payment_method" required>
                            <option value="COD">Cash on Delivery (COD)</option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Debit Card">Debit Card</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
