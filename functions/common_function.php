<?php
// Include connect file
include('./includes/connect.php');

function getproducts() {
    global $conn;
    $select_query = "SELECT product_id, product_title, product_description, product_image1, price FROM products ORDER BY rand() LIMIT 0, 9";
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
                    <a href='product_detail.php?id=$product_id' class='btn btn-secondary'>View more</a>
                    <a href='#' class='btn btn-success'>Add to cart</a>
                </div>
            </div>
        </div>
        ";
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
?>
