<?php include '../Components/Navbar/Navbar.php' ?>
<?php


error_reporting(E_ERROR | E_WARNING | E_PARSE);
include '../Shared/CustomResponse.php';
include '../Shared/connection.php';
include '../Functions/globalFuncs.php';
$username = $_GET["UserName"];
if (isset($_POST['submit'])) {
    $code = $_POST["code"];

    $user = GetUserByID($username, $con);

    if ($user == 0) {
        echo "<script>alert('Invalid URL!')</script>";
        return;
    }
    if ($user->user['Code'] == $code && $user->tip == 'korisnik') {
        $sql = "UPDATE korisnik SET Verified=true WHERE UserName='$username'";
        if ($con->query($sql) == true) {
            echo '<script>alert("Successfully verified your account!")</script>';
            echo '<script>window.location.href="/WebProgramiranje/index.php";</script>';

            return;
        } else {
            exit("FAILED");
        }
    }
    if ($user->user['Code'] == $code && $user->tip == 'predavac') {
        $sql = "UPDATE predavac SET Verified=true WHERE UserName='$username'";
        if ($con->query($sql) == true) {
            echo "<script>alert('Successfully verified your account!')</script>";
            echo '<script>window.location.href="/WebProgramiranje/index.php";</script>';
            return;
        } else {
            exit("FAILED");
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
        <h1 class='Code-Title'>Unesi Verifikacioni kod</h1>
        <div class='Form-Input'>
            <label>
                Verifikacioni Kod
            </label>
            <input class='text-input' name='code' type='text' />
        </div>
        <input type="submit" name="submit" class="button-submit" value="Submit" />
    </div>
</form>


<?php
include_once '../Components/Footer/footer.php' ?>