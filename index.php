<!-- Connection  -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kisan Connect:</title>
  <!-- Bootstrap css link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- font awsome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./css/style.css">
</head>

<body>
  <!--navbar  -->
  <div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Welcome Guest</a>
        <li class="nav-item">
          <a class="nav-link" href="#">Login</a>
        <li class="nav-item">
          <a class="nav-link" href="#">Register</a>
      </ul>
    </nav>

    <!-- second navbar -->
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
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Products</a>

            <li class="nav-item">
              <a class="nav-link" href="#">contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Total price:100/-</a>
            </li>

          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-light" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- end of second navbar -->

    <!-- Third Child  -->
    <div class="bg-light">
      <h3 class="text-center">Kisan Connect Store</h3>
      <p class="text-center">Fully organic store </p>
    </div>


    <!-- Fourth child -->
    <div class="row px-1">
      <div class="col-md-10">
        <!-- Products  -->
        <div class="row">
          <!-- Fetching products -->
           <?php
  getproducts();
  getuniquecategory() ;
  getuniquebrand() ;
           ?>
          
          <!-- row ending -->
        </div>
        <!-- column end  -->
      </div>


      <!-- Side bar -->
      <div class="col-md-2 bg-secondary p-0">
        <!-- Category should be displayed here -->
        <ul class="navbar-nav me-auto text-center">
        <li class="nav-item  bg-info">
            <a href="#" class="nav-link text-light bg-success">Brand</a>
          </li>
          <!-- Extracting the category from database -->
          <?php
          getbrand();
          ?>
          <li class="nav-item  bg-info">
            <a href="#" class="nav-link text-light bg-success">category</a>
          </li>
          <!-- Extracting the category from database -->
          <?php
          getcategory();
          ?>
        </ul>
      </div>
    </div>


    <!-- footer section -->
    <div class="bg-success p-3 text-center">
      <p>All right reserved Kisan Connect -2024</p>
    </div>
  </div>


  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>