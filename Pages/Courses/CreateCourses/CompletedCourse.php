<?php
include_once '../../../Shared/connection.php';
$KursId = $_GET["IdKursa"];


$sql = "UPDATE kurs SET Created=true WHERE Id=$KursId ";
if($con->query($sql)){
    echo '<script>alert("Successfully added a course!")</script>';
    echo '<script>window.location.href="./MyCourses.php";</script>';
    
}


?>