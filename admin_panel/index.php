<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>
<body>
    <!-- navbar -->
<div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <h3>Kisan Connect</h3>
            <nav class="navbar navbar-expand-lg">
<ul class="navbar-nav">
    <li class="navitem">
        <a href="#" class="nav-link">Welcome Guest</a>
    </li>
</ul>
</nav>
        </div>
    </nav>
<!-- End of first child ( navigation bar) -->
 <!-- second child started -->
  <div class="bg-light">
    <h3 class="text-center p-2">Manage Details</h3>
  </div>
  <!-- Second Chil ended -->
   <!-- Third Child Started -->
    <div class="row">
        <div class="col-md-12 bg-secondary p-1 d-flex align-items-center">
            <div class="mx-3 p-2">
                <a href="#"><img src="../images/apple.png" alt="Profile Picture" class="admin_image"></a>
                <p class="text-light text-center">Admin Name</p>
            </div>
            <!-- Different buttons are created -->
            <div class="button text-center">
                <button class="mx-3"><a href="./insert_product.php" class="nav-link text-light bg-info my-1">insert Product</a></button>
                <button><a href="" class="nav-link text-light bg-info my-1">View Products</a></button>
                <button><a href="./index.php?insert_category" class="nav-link text-light bg-info my-1">Insert category</a></button>
                <button><a href="" class="nav-link text-light bg-info my-1">View Category</a></button>
                <!-- brands -->
                <button><a href="./index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brand</a></button>
                <button><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>

                <button><a href="" class="nav-link text-light bg-info my-1">All Orders</a></button>
                <button><a href="" class="nav-link text-light bg-info my-1">All payment</a></button>
                <button><a href="" class="nav-link text-light bg-info my-1">List Users</a></button>
                <button><a href="" class="nav-link text-light bg-info my-1">Logout </a></button>
                <!-- <button><a href="" class="nav-link text-light bg-info my-1"></a></button>
                <button><a href="" class="nav-link text-light bg-info my-1"></a></button> -->
            </div>
        </div>
    </div>
<!-- fourth child -->
 <div class="container my-3">
    <?php
    if(isset($_GET['insert_category'])){
        include('insert_category.php');
    }
    if(isset($_GET['insert_brand'])){
        include('insert_brand.php');
    }
    ?>
 </div>
</div>    
 <!-- Bootstrap js Link -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>