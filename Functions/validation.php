<?php
function emptyInputSignup($name, $lastname, $gender, $country, $placeOfBirth, $jmbg, $phone, $email, $password, $password2)
{

    if (
        empty($name) || empty($lastname) || empty($gender) || empty($country) || empty($placeOfBirth) || empty($jmbg) || empty($phone)
        || empty($email) || empty($password) || empty($password2)
    ) return false;
    return true;
}
function CheckName($name)
{
    if (!preg_match('/^([A-Z]{1}[a-z]+)$/', $name))
        return false;
    else
        return true;
}

function CheckLastName($lastname)
{
    if (!preg_match('/^([A-Z]{1}[a-z]+)$/', $lastname))
        return false;
    else
        return true;
}

function CheckPlace($placeOfBirth)
{
    if (!preg_match('/^[A-Za-z]+$/', $placeOfBirth))
        return false;
    return true;
}

function CheckCountry($country)
{
    if (!preg_match('/^[A-Za-z]+$/', $country))
        return false;
    return true;
}

function CheckDatum($date)
{   

    $gornjaGranica = '2004-07-25';
    $donjaGranica = '1930-07-25';
    if ($gornjaGranica<$date  || $donjaGranica>$date || preg_match('/^[0-9]*$/',$date))
        return false;
    return true;
}

function CheckPhone($phone)
{
    if (!preg_match('/^(\d{6,10})$/', $phone))
        return false;
    return true;
}

function CheckEmail($email)
{
    if (!preg_match('/^([A-Z])?([a-z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/', $email))
        return false;
    return true;
}


function pwdMatch($password, $password2)
{
    if ($password !== $password2 && $password!="")
        return false;
    return true;
}
function CheckJmbg($con,$jmbg)
{


    $sql = "SELECT * FROM user WHERE Jmbg='$jmbg'";

    $result = $con->query($sql);
    // if ($result == null)
    //     return true;
    if ($result->num_rows > 0)
        return false;
    return true;
}

function CheckUserName($con,$username){
    $sql = "SELECT * FROM user WHERE UserName='$username'";
    $result = $con->query($sql);
    if ($result->num_rows > 0)
        return false;
    return true;
}
function GenerateUserName($con,$name,$lastName){
    $a = 0;
    $username = $name . $lastName . $a;
    while (CheckUserName($con, $username) == false) {
        $a++;
        $a = strval($a);
        $username .= $a;
    }
    return $username;
}