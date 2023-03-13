<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
// class Response
//     {
//         public $user;
//         public $tip;
//         function set_user($user)
//         {
//             $this->user = $user;
//         }
//         function set_tip($tip)
//         {
//             return $this->tip = $tip;
//         }
//     }
function LogInUser($con, $username)
{
    

    $sql = "SELECT * FROM korisnik WHERE (UserName='$username' || Email='$username' )";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $User = $result->fetch_assoc();
        $data = new Response();
        $data->set_tip("korisnik");
        $data->set_user($User);
        return $data;
    }
    $sql2 = "SELECT * FROM predavac WHERE (UserName='$username' || Email='$username' )";
    $result2 = $con->query($sql2);
    if ($result2->num_rows > 0) {
        $User = $result2->fetch_assoc();
        $data = new Response();
        $data->set_tip("predavac");
        $data->set_user($User);
        return $data;
    }
    $sql3 = "SELECT * FROM `admin` WHERE (UserName='$username' || Email='$username' )";
    $result2 = $con->query($sql3);
    if ($result2->num_rows > 0) {
        $User = $result2->fetch_assoc();
        $data = new Response();
        $data->set_tip("admin");
        $data->set_user($User);

        return $data;
    }
    echo"GRESKA ";
    return 0;
}


function GetUserByID($username, $con)
{

    $sql = "SELECT * FROM korisnik WHERE UserName='$username' OR Email='$username' ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $User = $result->fetch_assoc();
        $data = new Response();
        $data->set_tip("korisnik");
        $data->set_user($User);
        return $data;
    }
    $sql = "SELECT * FROM predavac WHERE UserName='$username' OR Email='$username' ";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $User = $result->fetch_assoc();
        $data = new Response();
        $data->set_tip("predavac");
        $data->set_user($User);
        return $data;
    }
    $sql2 = "SELECT * FROM `admin`  WHERE UserName='$username'  OR Email='$username' ";
    $result = $con->query($sql2);
    if ($result->num_rows > 0) {
        $User = $result->fetch_assoc();
        $data = new Response();
        $data->set_tip("admin");
        $data->set_user($User);
        return $data;
    }
    return 0;
}
