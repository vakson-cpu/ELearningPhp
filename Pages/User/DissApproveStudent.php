<?php 
include_once '../../Shared/connection.php';
$UserName =  $_GET["UserName"];
$sql = "DELETE FROM korisnik WHERE  UserName='$userName'";



if($con->query($sql)){
    echo"<script>alert('Successfully Approved')</script>";
    echo '<script>window.location.href="./ApproveTeacher.php";</script>';

}else{
    echo '<script>alert("Failed to approve!")</script>';
    echo '<script>window.location.href="./ApproveTeacher.php";</script>';

}
?>