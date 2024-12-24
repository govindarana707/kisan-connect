<?php
include('../includes/connect.php');

if (isset($_POST['cat_insert'])) {
    // Sanitize the input
    $category_title = trim($_POST['cat_title']);  // Trim any extra spaces

    // Use prepared statement to check if category already exists
    $select_query = "SELECT * FROM category WHERE category_title = ?";
    $stmt_select = mysqli_prepare($conn, $select_query);
    
    if ($stmt_select === false) {
        echo "<script>alert('Error in preparing select query');</script>";
        exit;
    }

    mysqli_stmt_bind_param($stmt_select, "s", $category_title); // 's' indicates a string parameter
    mysqli_stmt_execute($stmt_select);
    $result_select = mysqli_stmt_get_result($stmt_select);
    
    // Check if category already exists
    if (mysqli_num_rows($result_select) > 0) {
        echo "<script>alert('Category already exists');</script>";
    } else {
        // Insert the new category using a prepared statement
        $insert_query = "INSERT INTO category (category_title) VALUES (?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);

        if ($stmt_insert === false) {
            echo "<script>alert('Error in preparing insert query');</script>";
            exit;
        }

        mysqli_stmt_bind_param($stmt_insert, "s", $category_title); // 's' indicates a string parameter
        $result_insert = mysqli_stmt_execute($stmt_insert);

        // Check if the insertion was successful
        if ($result_insert) {
            echo "<script>alert('Category has been added successfully');</script>";
        } else {
            echo "<script>alert('Error adding category');</script>";
        }

        // Close the insert statement
        mysqli_stmt_close($stmt_insert);
    }

    // Close the select statement
    mysqli_stmt_close($stmt_select);
}
?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="addon-wrapping"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Category" aria-label="Category Title" aria-describedby="addon-wrapping" required>
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="bg-info border-0 p-2 my-3" name="cat_insert" value="Insert Category">
    </div>
</form>
