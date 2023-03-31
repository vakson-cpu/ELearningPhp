<?php include '../Components/Navbar/Navbar.php' ?>
<?php


error_reporting(E_ERROR | E_WARNING | E_PARSE);
include '../Shared/CustomResponse.php';
include '../Shared/connection.php';
include '../Functions/globalFuncs.php';
$username = $_SESSION["UserName"];
if (isset($_POST['submit'])) {
    echo "<h1>Zadme</h1>";
    $tip = $_SESSION["tip"];
    $newPassword1 = $_POST["newPassword1"];
    $newPassword2 = $_POST["newPassword2"];
    $oldPassword = $_POST["oldPassword"];
    if ($newPassword1 != $newPassword2) {
        echo '<script>alert("Passwords do not match...")</script>';
        echo '<script>window.location.href="/WebProgramiranje/Pages/InsertPassword.php";</script>';

        return;
    }

    if ($tip == "korisnik") {
        $sql = "SELECT * FROM korisnik WHERE UserName ='$username'"; //fetch user.
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {

            $pwdHashed = $row["Password"];
            $checkPwd = password_verify($oldPassword, $pwdHashed); //Password check.
            if ($checkPwd == false) {
                echo '<script>alert("Old password didnt match.")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Pages/InsertPassword.php";</script>';
                return;
            }
            $newHashed = password_hash($newPassword1, PASSWORD_DEFAULT);
            $sql2 = "UPDATE korisnik SET  `Password` ='$newHashed' WHERE UserName = '$username'";
            if ($con->query($sql2)) {
                echo '<script>alert("You have changed your password.")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Index.php";</script>';
            } else {
                echo '<script>alert("Something went wrong, please try again!")</script>';
                return;
            }
        }
    }

    if ($tip == "admin") {
        $sql = "SELECT * FROM `admin` WHERE '$username' = UserName";

        $result = $con->query($sql);
        while ($row = $result->fetch_assoc()) {
            if ($oldPassword != $row["Password"]) {
                echo '<script>alert("Old password not correct.")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Pages/InsertPassword.php";</script>';
                return;
            }
            $sql2 = "UPDATE `admin` SET  `Password` ='$newPassword1' WHERE UserName = '$username'";
            if ($con->query($sql2)) {
                echo '<script>alert("You have changed your password.")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Index.php";</script>';
            } else {
                echo '<script>alert("Something went wrong, please try again!")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Pages/InsertPassword.php";</script>';

                return;
            }
        }
    }

    if ($tip == "predavac") {
        $sql = "SELECT * FROM predavac WHERE UserName ='$username'"; //fetch user.
        $result = $con->query($sql);

        while ($row = $result->fetch_assoc()) {

            $pwdHashed = $row["Password"];
            $checkPwd = password_verify($oldPassword, $pwdHashed); //Password check.
            if ($checkPwd == false) {
                echo '<script>alert("Old password didnt match.")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Pages/InsertPassword.php";</script>';
                return;
            }
            $newHashed = password_hash($newPassword1, PASSWORD_DEFAULT);
            $sql2 = "UPDATE predavac SET  `Password` ='$newHashed' WHERE UserName = '$username'";
            if ($con->query($sql2)) {
                echo '<script>alert("You have changed your password.")</script>';
                echo '<script>window.location.href="/WebProgramiranje/Index.php";</script>';
            } else {
                echo '<script>alert("Something went wrong, please try again!")</script>';
                return;
            }
        }
    }
}

?>
<style>
    <?php




    include_once 'InsertCode.css'
    ?>
</style>
<form class="form" method="POST">
    <div class='forma'>
        <h1 class='Code-Title'>Reset your password</h1>
        <div class='Form-Input'>
            <label>
                Insert your old password
            </label>
            <input class='text-input' name='oldPassword' type='password' />
        </div>
        <div class='Form-Input'>
            <label>
                Insert new password
            </label>
            <input class='text-input' name='newPassword1' type='password' />
        </div>
        <div class='Form-Input'>
            <label>
                Insert new password
            </label>
            <input class='text-input' name='newPassword2' type='password' />
        </div>
        <input type="submit" name="submit" class="button-submit" value="Submit" />
    </div>
</form>


<?php
include_once '../Components/Footer/footer.php' ?>