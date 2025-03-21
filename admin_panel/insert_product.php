<?php
include('../includes/connect.php');

if (isset($_POST['insert_product'])) {
    // Collect and sanitize form data
    $product_title = $_POST['product_title'];
    $product_description = $_POST['description'];
    $product_keyword = $_POST['product_keyword'];
    $category_id = $_POST['product_category'];
    $brand_id = $_POST['product_brands'];
    $product_status = "true";
    $product_price = $_POST['product_price'];

    // Accessing image files
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image3 = $_FILES['product_image3']['name'];

    // Accessing image temporary names
    $temp_image1 = $_FILES['product_image1']['tmp_name'];
    $temp_image2 = $_FILES['product_image2']['tmp_name'];
    $temp_image3 = $_FILES['product_image3']['tmp_name'];

    // Checking empty fields
    if (empty($product_title) || empty($product_description) || empty($category_id) || empty($product_price) || empty($product_image1)) {
        echo "<script>alert('Please fill all the fields');</script>";
        exit();
    }

    // Validate image files
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $max_file_size = 5000000; // 5MB max file size
    $image_errors = [];

    // Check if images are valid
    foreach (['product_image1', 'product_image2', 'product_image3'] as $index => $image_name) {
        $file_tmp = $_FILES[$image_name]['tmp_name'];
        $file_size = $_FILES[$image_name]['size'];
        $file_extension = strtolower(pathinfo($_FILES[$image_name]['name'], PATHINFO_EXTENSION));

        if ($_FILES[$image_name]['error'] != 0) {
            $image_errors[] = "Error with image upload for $image_name.";
        }
        if (!in_array($file_extension, $allowed_extensions)) {
            $image_errors[] = "Invalid file type for $image_name. Allowed types: jpg, jpeg, png, gif.";
        }
        if ($file_size > $max_file_size) {
            $image_errors[] = "$image_name exceeds the maximum file size of 5MB.";
        }
    }

    // Display any image upload errors
    if (!empty($image_errors)) {
        foreach ($image_errors as $error) {
            echo "<script>alert('$error');</script>";
        }
        exit();
    }

    // Moving uploaded files to the correct directory
    move_uploaded_file($temp_image1, "./product_images/$product_image1");
    move_uploaded_file($temp_image2, "./product_images/$product_image2");
    move_uploaded_file($temp_image3, "./product_images/$product_image3");

    // Prepare the insert query using a prepared statement
    $insert_query = "INSERT INTO products (product_title, product_description, product_keyword, category_id, brand_id, product_image1, product_image2, product_image3, price, date, status) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $insert_query);

    if ($stmt === false) {
        echo "<script>alert('Error preparing the SQL statement');</script>";
        exit();
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, 'sssiissdss', $product_title, $product_description, $product_keyword, $category_id, $brand_id, $product_image1, $product_image2, $product_image3, $product_price, $product_status);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Product inserted successfully');</script>";
    } else {
        echo "<script>alert('Error inserting product');</script>";
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
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
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Product Fields: Title, Description, etc. -->
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
            <!-- Categories and Brands -->
            <div class="form-outline mb-4">
                <select name="product_category" class="form-select" required>
                    <option value="">Select a category</option>
                    <?php
                        $select_query = "SELECT * FROM category";
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
                    <?php
                        $select_query = "SELECT * FROM brand";
                        $result_query = mysqli_query($conn, $select_query);
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            echo "<option value='{$row['brand_id']}'>{$row['brand_title']}</option>";
                        }
                    ?>
                </select>
            </div>
            <!-- Image Fields -->
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
            <!-- Price Field -->
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
