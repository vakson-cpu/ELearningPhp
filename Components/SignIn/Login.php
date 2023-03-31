<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

require_once  '../../Shared/connection.php';
require_once '../../Functions/globalFuncs.php';
require_once '../../Shared/CustomResponse.php';
if (isset($_POST["Login"])) {
    $UserName = $_POST["username"];
    $Password = $_POST["password"];
    $data = LogInUser($con, $UserName);
    if ($data->tip != 'admin') {
        if ($data->user["Verified"] == false) {
            echo '<script>alert("User must be verified! Check your mail!")</script>';
            echo '<script>window.location.href="./LoginForm.php";</script>';
            return;
        }
        if ($data->user["Accepted"] == false) {
            echo '<script>alert("User must be accepted by admins")</script>';
            echo '<script>window.location.href="./LoginForm.php";</script>';
            return;
        }
        $User = $data->user["Password"];
        $pwdHashed = $data->user["Password"];
        $checkPwd = password_verify($Password, $pwdHashed);
        if (!$checkPwd) {
            echo '<script>window.location.href="./LoginForm.php";</script>';
            echo '<script>alert("Incorrect password")</script>';
            exit();
        }
        if ($checkPwd) {
            $_SESSION["UserName"] = $data->user["UserName"];
            $_SESSION["Name"] = $data->user["Name"];
            $_SESSION["Email"] = $data->user["Email"];
            $_SESSION["Id"] = $data->user["Id"];
            $_SESSION["tip"] = $data->tip;


            if (isset($_SESSION['UserName']) && isset($_SESSION["Name"]) && isset($_SESSION["Email"])) {
                echo '<script>window.location.href="/WebProgramiranje/Index.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Incorrect login credentials")</script>';
            echo '<script>window.location.href="./LoginForm.php";</script>';
            exit();
        }
    } else {
        if ($Password == $data->user['Password']) {
            $pomocna = $data->user["Id"];
            $_SESSION["UserName"] = $data->user["UserName"];
            $_SESSION["Name"] = $data->user["Name"];
            $_SESSION["Email"] = $data->user["Email"];
            $_SESSION["Id"] = $data->user["Id"];
            $_SESSION["tip"] = $data->tip;
            if (isset($_SESSION['UserName']) && isset($_SESSION["Name"]) && isset($_SESSION["Email"])) {
                echo '<script>window.location.href="/WebProgramiranje/Index.php";</script>';
                return;
            } else {
                echo '<script>alert("Incorrect login credentials")</script>';
                echo '<script>window.location.href="./LoginForm.php";</script>';
                exit();
            }
        } else {
            echo '<script>alert("Incorrect login credentials")</script>';
            echo '<script>window.location.href="./LoginForm.php";</script>';
            exit();
        }
    }
}
