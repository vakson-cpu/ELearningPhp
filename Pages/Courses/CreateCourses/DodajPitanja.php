<?php
$QuestionCount = 0;
include_once '../../../Shared/connection.php';
include '../../../Components/Navbar/Navbar.php';

error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

$KursId = $_GET["IdKursa"];

$sql = "SELECT  * FROM kurs WHERE Id='$KursId'";  //Uzmemo kurs 
$result = $con->query($sql);




if (isset($_POST["submit"])) {

    $textValue = $_POST["questionText"];
    $answer = $_POST["questionAnswer"];
    $difficulty = $_POST["diff"];
    $sql3 = "INSERT INTO pitanje  (`Text`,Tezina,KursId,Odgovor) VALUES ('$textValue','$difficulty',$KursId,'$answer')";
    if ($con->query($sql3) == true) {
        echo '<script>alert("Successfully added Question!")</script>';
    }
}

?>
<style>
    <?php
    include 'CreateCourse.css'
    ?>
</style>

<div class='marginica'>
    <form enctype="multipart/form-data" method="POST">
        <div class="form-container">
            <h2 class="form-heading">Enter Course Questions Info</h2>
            <span><?php
                    $KursId = $_GET["IdKursa"];

                    $sql2 = "SELECT * FROM pitanje WHERE KursId='$KursId'";
                    $result = $con->query($sql2);
                    if ($result->num_rows > 0) {
                        $count = mysqli_num_rows($result);
                        $QuestionCount = $count;
                    }
                    echo "<p class='countText' >Number of question:<span class='countDesign'> $QuestionCount</span><span class='redText'>/10</span></p>";
                    if ($QuestionCount == 10) {
                        echo '<script>window.location.href="./CompletedCourse.php?IdKursa=' . $KursId  . '";</script>';
                    }
                    ?></span>
            <div class="form-field">
                <label for="course-name">Enter Text of a question</label>
                <input type="text" id="course-name" name="questionText" required>
            </div>
            <div class="form-field">
                <label for="course-name">Answer</label>
                <input type="text" id="course-name" name="questionAnswer" required>
            </div>
            <div class="form-field">
                <label for="course-name">Difficulty</label>
                <select name='diff'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                </select>
            </div>
            <input type="submit" name="submit" class="form-submit" value="Submit" />

        </div>
    </form>
</div>



<?php
include '../../../Components/Footer/footer.php'


?>