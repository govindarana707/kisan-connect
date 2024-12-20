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
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>
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
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>

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
                        <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>

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
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>

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
        die('Query failed: ' .mysqli_connect_error($result_query,$conn));
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
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-success'>Add to cart</a>

                </div>
            </div>
        </div>
        ";
    }
}
}
// View detail function
function view_detail() {
    global $conn;

    // Check if the product_id is set in the URL
    if (isset($_GET['product_id'])) {
        // If category and brand are not set, fetch product details
        if (!isset($_GET['category']) && !isset($_GET['brand'])) {
            $product_id = intval($_GET['product_id']); // Sanitize input

            // Prepared statement to fetch product details
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result_query = $stmt->get_result();

            // Check if any product is found
            if ($result_query->num_rows > 0) {
                while ($row = $result_query->fetch_assoc()) {
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $price = $row['price'];

                    // Display product details
                    echo "
                    <div class='product-detail'>
                        <h2>$product_title</h2>
                        <p>$product_description</p>
                        <p><strong>Price: Rs$price</strong></p>

                        <!-- Display images in a row -->
                        <div class='product-images d-flex justify-content-between'>
                            <img src='./admin_panel/product_images/$product_image1' alt='Image of $product_title' class='img-fluid' style='width: 30%;'>
                            <img src='./admin_panel/product_images/$product_image2' alt='Image of $product_title' class='img-fluid' style='width: 30%;'>
                            <img src='./admin_panel/product_images/$product_image3' alt='Image of $product_title' class='img-fluid' style='width: 30%;'>
                        </div>

                        <!-- Add to cart form -->
                        <form action='cart.php' method='POST'>
                            <input type='hidden' name='product_id' value='$product_id'>
                            <input type='hidden' name='product_title' value='$product_title'>
                            <input type='hidden' name='product_price' value='$price'>
                            <button type='submit' name='add_to_cart' class='btn btn-success mt-3'>Add to Cart</button>
                        </form>
                    </div>
                    ";
                }
            } else {
                echo "<p>No product found for the provided ID.</p>";
            }
        }
    } else {
        echo "<p>Product ID not provided. Please select a product.</p>";
    }
}


// Getting IP address
function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
 

// cart function
function cart() {
    if (isset($_GET['add_to_cart'])) {
        global $conn;
        $ip = getIPAddress();
        $get_product_id = intval($_GET['add_to_cart']); // Sanitize input
        
        // Check if the product is already in the cart
        $select_query = "SELECT * FROM `cart_details` WHERE ip_address = ? AND product_id = ?";
        $stmt = $conn->prepare($select_query);
        $stmt->bind_param('si', $ip, $get_product_id);
        $stmt->execute();
        $result_query = $stmt->get_result();
        
        if ($result_query->num_rows > 0) {
            echo "<script>alert('This item is already present in the cart');</script>";
            echo "<script>window.open('index.php', '_self');</script>";
        } else {
            // Insert the new item into the cart
            $insert_query = "INSERT INTO `cart_details` (product_id, ip_address, quantity) VALUES (?, ?, 1)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('is', $get_product_id, $ip);
            
            if ($stmt->execute()) {
                echo "<script>alert('Item added to cart successfully');</script>";
            } else {
                echo "<script>alert('Failed to add item to cart');</script>";
            }
            echo "<script>window.open('index.php', '_self');</script>";
        }
        
        $stmt->close();
    }
}

// function to get cart number
function cart_item() {
    global $conn; // Ensure the database connection is available
    $ip = getIPAddress(); // Fetch the IP address of the user
    
    // Check if the product is already in the cart
    $select_query = "SELECT * FROM `cart_details` WHERE ip_address = ?";
    $stmt = $conn->prepare($select_query);
    $stmt->bind_param("s", $ip); // Use parameterized query to prevent SQL injection
    $stmt->execute();
    $result_query = $stmt->get_result();
    $count_cart_items = $result_query->num_rows;
    
    echo $count_cart_items;
}



?>