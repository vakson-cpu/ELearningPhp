<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include '../../../Components/Navbar/Navbar.php';
include_once '../../../Shared/connection.php';

$UserName=$_SESSION["UserName"];
$sql = "SELECT *
FROM kurs
WHERE kurs.Created= true AND kurs.Id IN (
  SELECT userkurs.KursId
  FROM userkurs
  WHERE userkurs.KorisnikId = '$UserName' AND userkurs.Completed = 0
)";



$result  = $con->query($sql);
echo"</br>";
echo "<div>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="course-card">';
        echo '<h2 class="course-name"> ' . $row["Naziv"] . '</h2>';
        echo '<p class="course-description">Description: ' . $row["Opis"] . '</p>';
        echo "<a class='btn' href='CourseDetails.php?IdKursa=" . $row["Id"] . "' >Continue</a>";
        echo '</div>';
        echo"</br>";
    }
} else
echo "<div class='message-wrapper '><h1 class='centerText marginBottom'>You havent started any courses!</h1></div>";


echo "</div>";
echo"<br/>";
echo"<br/>";
echo"<br/>";
echo"<br/>";
include '../../../Components/Footer/footer.php';

?>
<style>
    .Button-Enroll {
        padding: 15px;
        background-color: green;

    }

    .message-wrapper {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        width: 800px;
        margin: auto;
        align-items: center;
        text-align: center;
        margin-bottom: 50px;
        margin-top: 100px;
        border: 5px solid green;
        
    }
    .course-card {
        width: 400px;
        padding: 20px;
        background-color: white;
        text-align: center;
        border-radius: 10px;
        border: 3px solid green;
        -webkit-box-shadow: 0px 12px 89px -23px rgba(0, 0, 0, 0.75);
        -moz-box-shadow: 0px 12px 89px -23px rgba(0, 0, 0, 0.75);
        box-shadow: 0px 12px 89px -23px rgba(0, 0, 0, 0.75);
        margin: 30px auto;
    }

    .course-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .course-description {
        font-size: 18px;
        text-align: left;
        margin: 0;
        padding: 10px;
        border-radius: 10px;
        font-style: italic;


    }

    .marginBottom {
        margin-bottom: 100px !important;
    }

    .centerText {
        text-align: center;
        width: 700px;
        margin: auto;
        margin-top: 100px;

    }

    .text-danger {
        color: red;
        text-decoration: none;
        text-decoration-style: none;
        font-weight: bold;
        padding: 10px;
        border-radius: 5px;
        background-color: lightgoldenrodyellow;
    }

    .text-warning {
        color: black;
    }

    .margina {
        margin-top: 30px;
        margin-bottom: 30px;
    }



    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Koulen&family=Lato&family=Nunito&family=Playfair+Display:ital@1&family=Prata&family=Raleway:ital,wght@1,100&family=Roboto&family=Roboto+Condensed&family=Teko&display=swap');

    .btn {
        font-family: Roboto, sans-serif;
        font-weight: 0;
        font-size: 14px;
        color: #fff;
        background-color: #006e2a;
        padding: 10px 30px;
        border: solid #026112 2px;
        box-shadow: rgb(0, 0, 0) 0px 0px 0px 0px;
        border-radius: 0px;
        transition: 1672ms;
        transform: translateY(0);
        display: flex;
        flex-direction: row;
        align-items: center;
        cursor: pointer;
        text-align: center;

    }

    .btn:hover {
        transition: color 1672ms  ease-in ;
        background-color: #63e363;
        color: #000000;
        border: solid 2px #00541b;

    }
</style>