<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once '../../Shared/connection.php';
$UserName =  $_GET["UserName"];
$sql = "UPDATE korisnik SET Accepted = 1  WHERE UserName = '$UserName' AND Verified = 1";



if($con->query($sql)){
    echo"<script>alert('Successfully Approved')</script>";
    echo '<script>window.location.href="./UserProfile.php";</script>';

}else{
    echo '<script>alert("Failed to approve!")</script>';
    echo '<script>window.location.href="./UserProfile.php";</script>';

}
?>