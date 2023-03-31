<?php include '../../Shared/connection.php'; ?>
<?php include '../../Functions/globalFuncs.php' ?>
<?php include '../MailerBot.php' ?>
<?php include '../../Shared/CustomResponse.php' ?>
<?php
if (isset($_POST['Reset'])) {

    $email = $_POST['email'];
    $user = GetUserByID($email, $con);
    $generatedCode = $key = substr(md5(time() . $user->user['UserName']), 0, 10);
    $hashedPwd = password_hash($generatedCode, PASSWORD_DEFAULT);

    if ($user->tip == 'admin') {
        $sql = "UPDATE `admin` SET `Password`='$hashedPwd'";
        if ($con->query($sql)) {
            PasswordReset($user->user['Email'], $generatedCode, $user->user['UserName']);
            // echo "<script>alert('Uspesno Poslat mejl')</script>";
            echo '<script>window.location.href="/WebProgramiranje/index.php";</script>';
            return;
        } else {
            echo "<script>alert('BezUspesno Poslat mejl')</script>";
            return;
        }
    }
    if ($user->tip == 'korisnik') {
        $sql = "UPDATE korisnik SET `Password`='$hashedPwd'";
        if ($con->query($sql)) {
            PasswordReset($user->user['Email'], $generatedCode, $user->user['UserName']);
            // echo "<script>alert('Uspesno Poslat mejl')</script>";
            echo '<script>window.location.href="/WebProgramiranje/index.php";</script>';
            return;
        } else {
            echo "<script>alert('BezUspesno Poslat mejl')</script>";
            return;
        }
    }
    if ($user->tip == 'Predavac') {
        $sql = "UPDATE Predavac SET `Password`='$hashedPwd'";
        if ($con->query($sql)) {
            PasswordReset($user->user['Email'], $generatedCode, $user->user['UserName']);
            // echo "<script>alert('Uspesno Poslat mejl')</script>";
            echo '<script>window.location.href="/WebProgramiranje/index.php";</script>';
            return;
        } else {
            echo "<script>alert('BezUspesno Poslat mejl')</script>";
            return;
        }
    }
}

?>
<style>
    <?php include '../../Components/Registration/Register.css'; ?>
</style>
<?php include '../../Components/Navbar/Navbar.php'; ?>
<form class="form" method="POST">
    <div class="title">Forgot password?</div>
    <div class="subtitle">Provide us your email</div>
    <div class="input-container ic2">
        <input id="firstname" name="email" class="<?php echo "input "; ?>" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="firstname" class="placeholder">Email</label>
    </div>
    <input type="submit" name="Reset" value="Submit" class="submit" />
</form>
<br>
<br>
<br>
<br>
<?php include '../../Components/Footer/footer.php'; ?>