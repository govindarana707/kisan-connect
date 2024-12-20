<?php
include('includes/connect.php');
include('functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kisan Connect: Cart Details</title>
  <!-- Bootstrap CSS Link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- Font Awesome Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <!-- Navbar -->
  <div class="container-fluid p-0">
    <!-- First Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
        </li>
      </ul>
    </nav>

    <!-- Second Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-success">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Kisan Connect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Header -->
    <div class="bg-light py-3">
      <h3 class="text-center">Kisan Connect Store</h3>
      <p class="text-center">Fully Organic Store</p>
    </div>

    <!-- Cart Details Section -->
    <div class="container my-5">
      <h2 class="text-center">Your Cart</h2>
      <div class="table-responsive">
        <form action="update_cart.php" method="post">
          <table class="table table-bordered text-center">
            <thead class="bg-success text-white">
              <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Remove</th>
              </tr>
            </thead>
            <tbody>
              <?php
              global $conn;
              $ip = getIPAddress();
              $total = 0;
              $cart_query = "SELECT * FROM cart_details WHERE ip_address='$ip'";
              $result = mysqli_query($conn, $cart_query);

              while ($row = mysqli_fetch_array($result)) {
                  $product_id = $row['product_id'];
                  $quantity = $row['quantity'];
                  $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
                  $product_result = mysqli_query($conn, $product_query);

                  while ($product_row = mysqli_fetch_array($product_result)) {
                      $product_name = $product_row['product_title'];
                      $product_price = $product_row['price'];
                      $product_image = $product_row['product_image1'];
                      $subtotal = $product_price * $quantity;
                      $total += $subtotal;
                      echo "<tr>
                        <td><img src='./admin_panel/product_images/$product_image' alt='$product_name' class='img-fluid' style='width: 80px;'></td>
                        <td>$product_name</td>
                        <td><input type='number' name='quantity[$product_id]' value='$quantity' min='1' class='form-control'></td>
                        <td>Rs $subtotal/-</td>
                        <td><a href='remove_cart_item.php?product_id=$product_id' class='btn btn-danger btn-sm'>Remove</a></td>
                      </tr>";
                  }
              }
              ?>
              <!-- Total Row -->
              <tr class="bg-light">
                <td colspan="3" class="text-end fw-bold">Total:</td>
                <td colspan="2">Rs <?php echo $total; ?>/-</td>
              </tr>
            </tbody>
          </table>
          <div class="text-center">
            <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <?php
    include('./includes/footer.php');
    ?>
  </div>

  <!-- Bootstrap JS Link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
    crossorigin="anonymous"></script>
</body>
</html>
