<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include '../../../Components/Navbar/Navbar.php';
include_once '../../../Shared/connection.php';
function generateRandomString()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    $length = rand(7, 12);
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}
$TestId;
$KursId = $_GET["IdKursa"];
$UserId = $_SESSION["UserName"];
$iterator = 0;
$check = "SELECT * FROM test WHERE UserName='$UserId' AND KursId='$KursId'";
$checkResult = $con->query($check);
$KeyArray = array();

if ($checkResult->num_rows > 0) {
    while ($row = $checkResult->fetch_assoc()) {
        $TestId = $row["Id"];
        $pitanjaQuery =  "SELECT * FROM  pitanje INNER JOIN pitanjetest on pitanje.Id = pitanjetest.PitanjaId WHERE pitanjetest.TestId= '$TestId'";
        $resultOfFetchingQuestions = $con->query($pitanjaQuery);
        while ($row2 = $resultOfFetchingQuestions->fetch_assoc()) {
            if ($row2["Odgovor"] != null || $row2["Odgovor"] != "")
                array_push($KeyArray, $row2["Odgovor"]);
        }
    }
} else {
    $sql = "SELECT pitanje.Id,pitanje.Odgovor FROM pitanje INNER JOIN kurs  ON pitanje.KursID = kurs.Id  WHERE '$KursId'=KursId ORDER BY RAND() LIMIT 5";
    $sql2 = "INSERT INTO test (KursId,UserName) VALUES ('$KursId','$UserId')";
    $con->query($sql2);
    $fetchTest =  "SELECT * FROM test  WHERE KursId = '$KursId' AND UserName='$UserId'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $testFetched = $con->query($fetchTest);
            $TestId;
            $pitanjeID = $row["Id"];

            while ($row2 = $testFetched->fetch_assoc())
                $TestId = $row2["Id"];
            $sql3 = "INSERT INTO pitanjetest (TestId,PitanjaId) VALUES ('$TestId','$pitanjeID')";
            $con->query($sql3);
            if ($row["Odgovor"] != null)
                array_push($KeyArray, $row["Odgovor"]);
        }
    }
}

$QuestionCount = 0;


if ($result->num_rows > 0) {
    $count = mysqli_num_rows($result);
    $QuestionCount = $count;
}
if (isset($_POST["submit"])) {
  
    $answer1 = $_POST[$KeyArray[0]];
    $answer2 = $_POST[$KeyArray[1]];
    $answer3= $_POST[$KeyArray[2]];
    $answer4= $_POST[$KeyArray[3]];
    $answer5= $_POST[$KeyArray[4]];
    $brojpoena=0;
    if (strtolower($answer1) == strtolower($KeyArray[0])) {
        $brojpoena++;
    }
    if (strtolower($answer2) == strtolower($KeyArray[1])) {
        $brojpoena++;
    }
    if (strtolower($answer3) == strtolower($KeyArray[2])) {
        $brojpoena++;
    }
    if (strtolower($answer4) == strtolower($KeyArray[3])) {
        $brojpoena++;
    }
    if (strtolower($answer5) == strtolower($KeyArray[4])) {
        $brojpoena++;
    }

    if($brojpoena>=3){
        $update = "UPDATE test SET Completed = 1,Points='$brojpoena' WHERE  UserName = '$UserId' AND KursId = '$KursId'";
        $updateKurs=  "UPDATE userkurs  SET Completed= 1 WHERE KursId='$KursId' AND KorisnikId='$UserId'";
        $con->query($update);
        $con->query($updateKurs);

        echo '<script>alert(Successfully submited answers!")</script>';
        echo '<script>window.location.href="../Course.php";</script>';


    }
    else {
        echo '<script>alert("You have failed this test, you can retake it.")</script>';
        
    }

}

echo "<h2 class='alignText'>This test has 5 questions with different difficulties, make sure to answer every question in order to proceed!</h2>";
echo"</br>";
echo " <form method='POST'>";
echo '<div class="quiz-container">';
echo "<div>";
$Questions =  "SELECT pitanje.Id, pitanje.Odgovor, pitanje.Text FROM  pitanje INNER JOIN pitanjetest on pitanje.Id = pitanjetest.PitanjaId WHERE pitanjetest.TestId = '$TestId' ";

$result = $con->query($Questions);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $questionNumber = $iterator + 1;
        echo'<label for="text-input" class="custom-label">' . $questionNumber . '. ' . $row["Text"] . '?</label>';
        echo'<input type="text" name="' . $KeyArray[$iterator] . '"  id="text-input" class="custom-input">';
        echo "</br>";
        $iterator = $iterator + 1;
    }
}
echo '<input type="submit" name="submit" class="submit" value="Submit" />';

echo '</div>';
echo '</div>';
echo " </form>";
echo "</br>";


include '../../../Components/Footer/footer.php';
?>
<style>
    .quiz-container {
        width: 50%;
        margin: 0 auto;
        text-align: center;
    }

    .quiz-question {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .quiz-options {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .quiz-option {
        margin-bottom: 20px;
    }

    input[type="radio"] {
        margin-right: 10px;
    }

    .custom-label {
  display: block;
  font-size: 18px;
  font-weight: bold;
  color: white;
  background-color: green;
  padding: 10px;
  border-radius: 5px;
}

.custom-input {
  display: block;
  font-size: 16px;
  color: green;
  border: 2px solid green;
  padding: 10px;
  border-radius: 5px;
  margin-top: 5px;
  width: 100%;
  margin-bottom: 50px;
  border-top: 0;
  border-left: 0;
  border-right: 0;
  margin-top: 10px;
}

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .alignText {
        text-align: center;
    }
</style>