<?php
include('../includes/connect.php');
if(isset($_POST['cat_insert'])){
  $category_title=$_POST['cat_title'];
  $insert_query="INSERT INTO `categories`(`category_id`, `category_title`) VALUES (null,'$category_title')";
  $result=mysqli_query($conn,$insert_query);
  if($result){
    echo"<script>alert('Category has been added successfully');</script>";
  }
}
?>
<form action="" method="POST">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-info" id="addon-wrapping"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title"placeholder="Insert Category" aria-label="Username" aria-describedby="addon-wrapping">
</div>
<div class="input-group w-10 mb-2 m-auto">
  <input type="submit" class="bg-info border-0 p-2 my-3" name="cat_insert" value="Insert Category">
</div>
    
</form>