<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once '../../Shared/connection.php';
$UserName =  $_GET["UserName"];
$sql = "DELETE FROM predavac WHERE  UserName='$UserName'";



if($con->query($sql)){
    echo"<script>alert('Successfully Removed')</script>";
    echo '<script>window.location.href="./UserProfile.php";</script>';

}else{
    echo '<script>alert("Failed to Remove!")</script>';
    echo '<script>window.location.href="./UserProfile.php";</script>';

}
?>