<?php
include('../includes/connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style.css">
</head>
<body class="bg-light">
    <div class="container mt-3 w-50 m-auto">
        <h1 class="text-center">Insert Product</h1>
        <!-- Product Insert Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" required>
            </div>
            <!-- Product Description -->
            <div class="form-outline mb-4">
                <label for="description" class="form-label">Product Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="Enter product description" autocomplete="off" required>
            </div>
            <!-- Product Keyword -->
            <div class="form-outline mb-4">
                <label for="product_keyword" class="form-label">Product Keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter product keyword" autocomplete="off" required>
            </div>
            <!-- Categories -->
            <div class="form-outline mb-4">
                <select name="product_category" class="form-select" required>
                    <option value="">Select a category</option>
                    <?php
                                    $select_query = "SELECT * FROM categories";
                                    $result_query = mysqli_query($conn, $select_query);
                                        while ($row = mysqli_fetch_assoc($result_query)) {
                                            $category_title = $row['category_title'];
                                            $category_id = $row['category_id'];
                                            echo "<option value='$category_id'>$category_title</option>";
                                        }
                      ?>

                </select>
            </div>
            <!-- Brands -->
            <div class="form-outline mb-4">
                <select name="product_brands" class="form-select" required>
                    <option value="">Select a brand</option>
                    <option value="Brand-1">Brand-1</option>
                    <option value="Brand-2">Brand-2</option>
                    <option value="Brand-3">Brand-3</option>
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
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" required>
            </div>
            <!-- Submit Button -->
            <div class="form-outline mb-4">
                <input type="submit" value="Insert Product" name="insert_product" class="btn btn-info mb-3 px-3">
            </div>
        </form>
    </div>
</body>
</html>
