<?php
$conn= mysqli_connect('localhost','root','','kisan_connect');
if($conn){
    // echo"Connection successfull";

}else{
    die(mysqli_eror($conn));
}
?>