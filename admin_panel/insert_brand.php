<?php
include('../includes/connect.php');

if (isset($_POST['brand_insert'])) {
    // Sanitize the input
    $brand_title = $_POST['brand_title'];

    // Use prepared statement to check if category already exists
    $select_query = "SELECT * FROM brand WHERE category_title = ?";
    $stmt = mysqli_prepare($conn, $select_query);
    mysqli_stmt_bind_param($stmt, "s", $category_title); // 's' indicates a string parameter
    mysqli_stmt_execute($stmt);
    $result_select = mysqli_stmt_get_result($stmt);
    
    // Check if category already exists
    if (mysqli_num_rows($result_select) > 0) {
        echo "<script>alert('brand already exists');</script>";
    } else {
        // Insert the new category using a prepared statement
        $insert_query = "INSERT INTO brand (category_title) VALUES (?)";
        $stmt = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt, "s", $brand_title); // 's' indicates a string parameter
        $result = mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if ($result) {
            echo "<script>alert('Brand has been added successfully');</script>";
        } else {
            echo "<script>alert('Error adding brand');</script>";
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>
<h2 class="text-center">Insert Brands</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="addon-wrapping"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Brand" aria-label="Category Title" aria-describedby="addon-wrapping" required>
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="brand_insert" value="Insert Brand">
    </div>
</form>
