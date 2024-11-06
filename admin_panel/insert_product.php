<?php
include('../includes/connect.php');
if (isset($_POST['insert_product'])) {
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $product_description = mysqli_real_escape_string($conn, $_POST['description']);
    $product_keyword = mysqli_real_escape_string($conn, $_POST['product_keyword']);
    $category_id = $_POST['product_category'];
    $brand_id = $_POST['product_brands'];
    $product_status = "true";
    $product_price = $_POST['product_price'];

    // Accessing images
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image temp names
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking empty condition
    if ($product_title == '' || $product_description == '' || $category_id == '' || $product_price == '' || $product_image1 == '') {
        echo "<script>alert('Please fill all the fields');</script>";
        exit();
    } else {
        // Moving uploaded files to destination folder
        move_uploaded_file($temp_image1, "./product_images/$product_image1");
        move_uploaded_file($temp_image2, "./product_images/$product_image2");
        move_uploaded_file($temp_image3, "./product_images/$product_image3");

        // Insert query
        $insert_products = "INSERT INTO products (product_title, product_description, product_keyword, category_id, brand_id, product_image1, product_image2, product_image3, price, date, status) 
                            VALUES ('$product_title', '$product_description', '$product_keyword', '$category_id', '$brand_id', '$product_image1', '$product_image2', '$product_image3', '$product_price', NOW(), '$product_status')";

        $result_query = mysqli_query($conn, $insert_products);

        if ($result_query) {
            echo "<script>alert('Product inserted successfully');</script>";
        } else {
            echo "<script>alert('Error inserting product');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Insert Product</h1>
        <!-- Product Insert Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Form Fields: Product Title, Description, etc. -->
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" required>
            </div>
            <div class="form-outline mb-4">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" required>
            </div>
            <div class="form-outline mb-4">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter product keyword" required>
            </div>
            <!-- Product Categories and Brands -->
            <div class="form-outline mb-4">
                <select name="product_category" class="form-select" required>
                    <option value="">Select a category</option>
                    <?php
                        $select_query = "SELECT * FROM categories";
                        $result_query = mysqli_query($conn, $select_query);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            echo "<option value='{$row['category_id']}'>{$row['category_title']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-outline mb-4">
                <select name="product_brands" class="form-select" required>
                    <option value="">Select a brand</option>
                    <option value="">jumla</option>
                    <!-- Brands Options -->
                </select>
            </div>
            <!-- Product Images -->
            <div class="form-outline mb-4">
                <label for="product_image1" class="form-label">Product Image 1</label>
                <input type="file" name="product_image1" id="product_image1" class="form-control" required>
            </div>
            <div class="form-outline mb-4">
                <label for="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2" class="form-control" required>
            </div>
            <div class="form-outline mb-4">
                <label for="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3" class="form-control" required>
            </div>
            <!-- Product Price -->
            <div class="form-outline mb-4">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" required>
            </div>
            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" value="Insert Product" name="insert_product" class="btn btn-info mb-3 px-3">
            </div>
        </form>
    </div>
</body>
</html>
