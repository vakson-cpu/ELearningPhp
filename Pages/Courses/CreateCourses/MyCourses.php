<?php
include_once '../../../Shared/connection.php';
include '../../../Components/Navbar/Navbar.php';

error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

$UserName = $_SESSION["UserName"];

$sql = "SELECT  * FROM kurs WHERE Kreator='$UserName'";  //Uzmemo kurs 
$result = $con->query($sql);
echo "<h1 class='centerText marginica'>List of your Courses:</h1>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="course-card">';

        echo '<h2 class="course-name"> ' . $row["Naziv"] . '</h2>';
        echo '<p class="centerText">Opis</p>';
        echo '<p class="course-description">' . $row["Opis"] . '</p>';
        if ($row["Created"]){
            echo "<p>Status: Created</p>";
            echo "<a href='/WebProgramiranje/Pages/Courses/PickCourse.php?IdKursa=" . $row["Id"] . "' '>Visit...</a>";}
        else {
            echo "<p class='text-warning'>Status: In progress</p>";
            echo "<a class='text-danger' href='/WebProgramiranje/Pages/Courses/CreateCourses/DodajPitanja.php?IdKursa=" . $row["Id"] . "'>Finish</a>";
        }
        echo '</div>';
    }
} else {
    echo "<h1 class='centerText'>There are no courses made by you</h1>";
    echo "<div class='centerText'><a class='text-danger2' href='/WebProgramiranje/Pages/Courses/CreateCourses/CreateCourse.php'>Create Course</a></div>";
}
echo"<br/>";
echo"<br/>";
echo"<br/>";
echo"<br/>";
include '../../../Components/Footer/footer.php';
?>
<style>
    .course-card {
        width: 400px;
        padding: 20px;
        background-color: white;
        text-align: center;
        border-radius: 10px;
        border: 1px solid green;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        margin: 30px auto;
    }

    .course-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .course-description {
        font-size: 18px;
        text-align: left;
        margin: 0;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    }

    .centerText {
        text-align: center;

    }

    /* .center{
        margin:auto;
    } */
    .text-danger {
        color: red;
        text-decoration: none;
        text-decoration-style: none;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        background-color: lightgoldenrodyellow;
    }

    .text-danger2 {
        display: block;
        margin: auto;
        color: white;
        text-decoration: none;
        text-decoration-style: none;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        background-color: gray;
        margin-bottom: 50px !important;
        width: 200px;
        margin-top: 100px;
        transition: background 0.4s ease-in-out;

    }
    .text-danger2:hover{
        background-color: lightgray;
    }

    .text-warning {
        color: black;
    }

    .margina {
        margin-top: 30px;
    }
</style>