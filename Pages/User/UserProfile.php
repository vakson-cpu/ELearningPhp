<?php
include_once '../../Shared/connection.php';
include_once '../../Components/Navbar/Navbar.php';
include '../../Functions/globalFuncs.php';
include '../../Shared/CustomResponse.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// session_start();
$UserName = $_SESSION["UserName"];
$user = GetUserByID($UserName, $con);
$name = $user->user["Name"];
$lastName = $user->user["LastName"];
$email = $user->user["Email"];
$date = $user->user["DateOfBirth"];
$image = $user->user["Image"];
$tip=$_SESSION["tip"]
?>
<style>
    <?php
    include 'UserProfile.css'
    ?>
</style>

<div class="grid-container ">
    <div class="sidebar">
        <div class="user--profile">
            <div class="user--image">
                <img src="../../Components/Registration/Uploads/<?php echo $image ?>" alt="">
            </div>
            <div class="user--info">
                <?php
                echo "<h3>$user->tip </h3>";
                echo "<p>Name:$name</p>";
                echo "<p>LastName:$lastName</p>";
                echo "<p>Email:$email</p>";
                echo "<p>Date of birth:$date</p>";
                ?>
                <br />
                <br />
                <a href='../../Pages/InsertPassword.php'>Change Password</a>
                <br />
                <br />
            </div>



        </div>

    </div>
    <?php
    if($tip!='admin'){
    echo "<div class='contact-form'>";
    echo "<h1 class='centerTitle'>Contact form</h1>";
    echo " <form action='' method='POST'>";
    echo "  <label class='contact-label' >Title:</label>";
    echo '<input type="text" class="contact-inputs" name="title" required>';
    echo "<label class='contact-label'>Email:</label>";
    echo '<input type="email" class="contact-inputs" name="email" required>';

    echo "<label class='contact-label' >Description:</label>";
    echo " <textarea class='contact-inputs' name='description' rows='6' required></textarea>";

    echo "<input class='contact-button ' type='submit' value='Send'>";
    echo "</form>";
    echo "</div>";
    }else{
        echo"<div>";

        include './ApproveTeacher.php';
        echo"</div>";

    }
    ?>

</div>
</div>
</div>
<?php
include_once '../../Components/Footer/footer.php';
?>