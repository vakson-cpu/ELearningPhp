<?php include '../Navbar/Navbar.php'; ?>
<?php include '../../Shared/connection.php'; ?>
<?php include '../../Functions/validation.php'; ?>
<?php include '../../Functions/globalFuncs.php'; ?>
<?php include '../../Configs/MailerBot.php'; ?>
<?php require_once '../../Shared/CustomResponse.php'; ?>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

$Flags = array(false, false, false, false, false, false, false);
$Message = "";
if (isset($_POST["submit"])) {
    $zahtev = false;
    $name = $_POST["name"];
    $lastName = $_POST["lastname"];
    $email = $_POST["Email"];
    $sex = $_POST["sex"];
    $birthday = $_POST["birthday"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $mobile = $_POST["mobile"];
    $jmbg = $_POST["jmbg"];
    $country = $_POST["Country"];
    $place = $_POST["Pob"];
    $zahtev = $_POST["zahtev"];
    $ultimateFlag = false;

    $img_name = $_FILES['image']['name'];
    $img_size = $_FILES['image']['size'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $error = $_FILES['image']['error'];
    if (CheckName($name) == false)
        $Flags[0] = true;
    if (CheckLastName($lastName) == false)
        $Flags[1] = true;
    if (CheckEmail($email) == false)
        $Flags[2] = true;
    if (CheckCountry($country) == false)
        $Flags[3] = true;
    if (CheckDatum($birthday) == false)
        $Flags[4] = true;
    if (pwdMatch($password, $password2) == false)
        $Flags[5] = true;
    if (CheckJmbg($con, $jmbg) == false)
        $Flags[6] = true;
    for ($x = 0; $x < 7; $x++) {
        if ($Flags[$x] == true)
            $ultimateFlag = true;
    }
    if ($ultimateFlag == false) {
        $checkIfexists =  GetUserByID($email, $con);
        if ($checkIfexists != 0) {
            echo "<script>alert('Email already exsits, registration failed!')"; //OHHH LALALALA OH LALAL ALALLALAL:Skda
            return;
        }
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $username = GenerateUserName($con, $name, $lastName);
        $generatedCode = $key = substr(md5(time() . $username), 0, 10);

        if ($error === 0) {
            if ($img_size > 625000) {
                $em = "File to large!";
                header("Location:../login.php?error=$em");
            } else {

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION); //ekstenzijadokumenta
                $img_ex_lc = strtolower($img_ex);
                $allowed_exs = array("jpg", "jpeg", "png", "webp");
                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = './uploads/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $sql = "INSERT INTO korisnik (`Name`,LastName,DateOfBirth,PlaceOfBirth,Sex,Jmbg,Country,Email,`Password`,UserName,Verified,Mobile,`Image`,Code,Accepted)
                        VALUES ('$name','$lastName','$birthday','$place',true,'$jmbg','$country','$email','$hashedPwd','$username',true,'1231231231','$new_img_name','$generatedCode',false)";
                    $sql2 = "INSERT INTO predavac (`Name`,LastName,DateOfBirth,PlaceOfBirth,Sex,Jmbg,Country,`Password`,Email,UserName,Mobile,`Image`,Accepted,Code,Verified)
                        VALUES ('$name','$lastName','$birthday','$place',true,'$jmbg','$country','$hashedPwd','$email','$username','1231231231','$new_img_name',false,'$generatedCode',false)";
                    if ($zahtev == null || $zahtev != true) $zahtev = false;
                    if ($zahtev == false) {
                        if ($con->query($sql) === true) {
                            senfVerificationMail($email, $generatedCode, $username);
                            echo '<script>alert("Successfully Registered, check mail!")</script>';
                            echo '<script>window.location.href="../SignIn/LoginForm.php";</script>';
                        } else {
                            $Message = "Something went wrong, make sure to insert correct" . mysqli_connect_error();
                            echo '<script>alert("Failed!")</script>';
                            echo '<script>window.location.href="./Register.php";</script>';
                        }
                    }
                    if ($con->query($sql2) === true && $zahtev == true) {
                        senfVerificationMail($email, $generatedCode, $username);
                        echo '<script>window.location.href="../SignIn/LoginForm.php";</script>';
                    } else {
                        $Message = "Something went wrong, make sure to insert correct" . mysqli_connect_error();
                    }
                } else {
                    echo '<script>alert("Failed!")</script>';
                    echo '<script>window.location.href="./Register.php";</script>';
                }
            }
        } else {
            echo "GRESKA + $error";
        }
    }
}


?>
<style>
    <?php include 'Register.css'; ?>
</style>

<?php echo "<span class='Text_center'>$Message </span>"; ?>
<form enctype="multipart/form-data" class="form" method="POST">
    <div class="title">Welcome</div>
    <div class="subtitle">Let's create your account!</div>
    <div class="input-container ic2">
        <input id="firstname" name="name" class="<?php if ($Flags[0] == true) {
                                                        echo "  wrongInput input";
                                                    } else echo "input "; ?>" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="firstname" class="placeholder">First name</label>
    </div>
    <?php if ($Flags[0] == true) {
        echo "<span>Input must not be empty, only letters starting with capital.</span>";
    }  ?>
    <div class=" input-container ic2">
        <input id="lastname" name="lastname" class="<?php if ($Flags[1] == true) {
                                                        echo "  wrongInput input";
                                                    } else echo "input "; ?>" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Last name</label>
    </div>
    <?php if ($Flags[1] == true) {
        echo "<span>LastName  needs to be only letters starting with capital</span>";
    }  ?>
    <div class="input-container ic3">
        <input name="Email" class="<?php if ($Flags[2] == true) {
                                        echo "  wrongInput input";
                                    } else echo "input "; ?>" type="text" placeholder=" " />
        <div class="cut cut-short"></div>
        <label for="email" class="placeholder">Email</>
    </div>
    <?php if ($Flags[2] == true) {
        echo "<span>Email not valid</span>";
    }  ?>
    <div class="input-container ic4">
        <input id="country" class="<?php if ($Flags[3] == true) {
                                        echo "  wrongInput input";
                                    } else echo "input "; ?>" type="text" name="Country" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Country</label>
    </div>
    <div class="input-container ic5">
        <select id="email" class="input" type="select" name="sex" placeholder=" ">
            <option>Male</option>
            <option>Female</option>
        </select>
    </div>
    <?php if ($Flags[1] == true) {
        echo "<span>Field must not be empty, and you must be older than 18.</span>";
    }  ?>
    <div class="input-container ic6">
        <input class="<?php if ($Flags[4] == true) {
                            echo "  wrongInput input";
                        } else echo "input "; ?>" name="birthday" type="date" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Date of Birth</label>
    </div>

    <div class="input-container ic7">
        <input name="password" class="<?php if ($Flags[5] == true) {
                                            echo "  wrongInput input";
                                        } else echo "input "; ?>" type="password" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Password</label>
    </div>
    <div class="input-container ic8">
        <input name="password2" class="<?php if ($Flags[5] == true) {
                                            echo "  wrongInput input";
                                        } else echo "input "; ?>" type="password" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Repeat Password</label>
    </div>

    <div class="input-container ic9">
        <input name="mobile" class="input" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Mobile Phone</label>
    </div>

    <div class="input-container ic10">
        <input name="jmbg" class="<?php if ($Flags[6] == true) {
                                        echo "  wrongInput input";
                                    } else echo "input "; ?>" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">JMBG</label>
    </div>
    <div class="input-container ic11">
        <input name="Pob" class="<?php if ($Flags[3] == true) {
                                        echo "  wrongInput input";
                                    } else echo "input "; ?>" type="text" placeholder=" " />
        <div class="cut"></div>
        <label for="lastname" class="placeholder">Place Of Birth</label>
    </div>
    <div class="input-container ic12">
        <label style='margin-left:15px'>Pick a picure</label>
        <input type="file" name='image' />
    </div>
    <div class="input-container special">
        <label for="lastname" class="placeholder">Request for Professor</label>

        <input name="zahtev" class="" type="checkbox" placeholder=" " />
    </div>

    <span class='Link_center'><a href="/WebProgramiranje\Components\SignIn\LoginForm.php">Already have an account? Please Log in</a></span>
    <input type="submit" name="submit" class="submit" value="Submit" />
</form>
<?php include '../Footer/footer.php'; ?>