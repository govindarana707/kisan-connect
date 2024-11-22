<?php
// Include connect file
include('./includes/connect.php');

function getproducts() {
    global $conn;
    if(!isset($_GET['category'])){
        // condition to check isset or not
        if(!isset($_GET['brand'])){
    $select_query = "SELECT product_id, product_title, product_description, product_image1, price FROM products ORDER BY rand() LIMIT 0, 6";
    $result_query = mysqli_query($conn, $select_query);
    
    if (!$result_query) {
        die('Query failed: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $price = $row['price'];

        echo "
        <div class='col-md-4 col-sm-6 col-12 mb-2'>
            <div class='card'>
                <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: Rs $price</p>
                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                    <a href='#' class='btn btn-success'>Add to cart</a>
                </div>
            </div>
        </div>
        ";
    }
}
    }
}
// Getting unique category
function getuniquecategory() {
    global $conn;
    if(isset($_GET['category'])){
        $category_id= $_GET['category'];
        // condition to check isset or not
    $select_query = "SELECT product_id, product_title, product_description, product_image1, price FROM products where category_id=$category_id";
    $result_query = mysqli_query($conn, $select_query);
    
    if (!$result_query) {
        die('Query failed: ' . mysqli_error($conn));
    }
$num_of_rows=mysqli_num_rows($result_query);
if($num_of_rows== 0){
    echo"<h2 class='text-center color-danger'>No Stock for this category</h2>";
}
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $price = $row['price'];

        echo "
        <div class='col-md-4 col-sm-6 col-12 mb-2'>
            <div class='card'>
                <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: Rs $price</p>
                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                    <a href='#' class='btn btn-success'>Add to cart</a>
                </div>
            </div>
        </div>
        ";
    }
}
    }
    // Display unique brand products
    function getuniquebrand() {
        global $conn;
        if(isset($_GET['brand'])){
            $brand_id= $_GET['brand'];
            // condition to check isset or not
        $select_query = "SELECT product_id, product_title, product_description, product_image1, price FROM products where brand_id=$brand_id";
        $result_query = mysqli_query($conn, $select_query);
        
        if (!$result_query) {
            die('Query failed: ' . mysqli_error($conn));
        }
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows== 0){
        echo"<h2 class='text-center color-danger'>No Stock for this Brand</h2>";
    }
        while ($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $price = $row['price'];
    
            echo "
            <div class='col-md-4 col-sm-6 col-12 mb-2'>
                <div class='card'>
                    <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                    <div class='card-body'>
                        <h5 class='card-title'>$product_title</h5>
                        <p class='card-text'>$product_description</p>
                        <p class='card-text'>Price: Rs $price</p>
                        <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                        <a href='#' class='btn btn-success'>Add to cart</a>
                    </div>
                </div>
            </div>
            ";
        }
    }
        }

// Displaying categories at side nav
function getcategory(){
    global $conn;

    $select_category = "SELECT * FROM categories";  
          $result_category = mysqli_query($conn, $select_category);
          while ($row_data = mysqli_fetch_assoc($result_category)) {
            $category_title = $row_data['category_title'];
            $category_id = $row_data['category_id'];
            echo " <li class='nav-item'>
            <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
        </li>";
          }
        }
    

// Brand function
function getbrand(){
    global $conn;
    $select_brand = "SELECT * FROM brand";  
          $result_brand = mysqli_query($conn, $select_brand);
          while ($row_data = mysqli_fetch_assoc($result_brand)) {
            $brand_title = $row_data['brand_title'];
            $brand_id = $row_data['brand_id'];
            echo " <li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
        </li>";
          }
}

// getting all products
function getallproduct(){
    global $conn;
    if(!isset($_GET['category'])){
        // condition to check isset or not
        if(!isset($_GET['brand'])){
    $select_query = "SELECT product_id, product_title, product_description, product_image1, price FROM products ORDER BY rand()";
    $result_query = mysqli_query($conn, $select_query);
    
    if (!$result_query) {
        die('Query failed: ' . mysqli_error($conn));
    }

    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $price = $row['price'];

        echo "
        <div class='col-md-4 col-sm-6 col-12 mb-2'>
            <div class='card'>
                <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: Rs $price</p>
                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                    <a href='#' class='btn btn-success'>Add to cart</a>
                </div>
            </div>
        </div>
        ";
    }
}
    }
}
// searching product
function search_product(){
    global $conn;
    if(isset($_GET["search_data_product"])){
        $search_data_value = $_GET["search_data"];
    $search_query="Select * from products where product_keyword like '%$search_data_value%'";
    $result_query = mysqli_query($conn, $search_query);
    
    if (!$result_query) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $num_of_rows=mysqli_num_rows($result_query);
    if($num_of_rows== 0){
        echo"<h2 class='text-center text-danger'>Sorry!! No product found related to $search_data_value</h2>";
    }
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_image1 = $row['product_image1'];
        $price = $row['price'];

        echo "
        <div class='col-md-4 col-sm-6 col-12 mb-2'>
            <div class='card'>
                <img src='./admin_panel/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_description</p>
                    <p class='card-text'>Price: Rs $price</p>
                    <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                    <a href='#' class='btn btn-success'>Add to cart</a>
                </div>
            </div>
        </div>
        ";
    }
}
}
    
?>
