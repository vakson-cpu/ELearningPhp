<?php 
include_once '../../Shared/connection.php';
include_once '../../Components/Navbar/Navbar.php';





$sql = "SELECT * FROM predavac  WHERE Accepted = 0  AND Verified = 1";

function GetCompleted($number){
    if($number==0)
      return "Approve";
    return "Completed";
  }


if($_SESSION["tip"]=="admin"){

$result = $con->query($sql);
echo"</br>";
echo "<h1 class='centriraj'>Teachers to be approved</h1>";
echo"<table>";
        echo"<thead>";
        echo"<tr>";
        echo"<th>Name</th>";
        echo"<th>LastName</th>";
        echo"<th>Email</th>";
        echo"<th>Approve</th>";
        echo"<th>Delete</th>";
        echo"<tr>";
        echo"</thead>";
        echo"<tbody>";
while($row= $result->fetch_assoc()){
    
$numb=$row['Accepted'];
    echo'<tr>';
    echo'<td>'.$row['Name'].'</td>';
    echo'<td>'.$row['LastName'].'</td>';
    echo'<td>'.$row['Email'].'</td>';
    echo'<td><a href="./Approve.php?UserName='.$row['UserName'].'">APPROVE</a></td>';
    echo'<td><a href="./DissApprove.php?UserName='.$row['UserName'].'">DELETE</a></td>';
    echo'</tr>';



}

echo "</table>";
echo "</br>";
$sql2 = "SELECT * FROM korisnik  WHERE Accepted = 0 ";
$result2 = $con->query($sql2);
echo"</br>";
echo "<h1 class='centriraj'>Users to be approved</h1>";
echo"<table>";
        echo"<thead>";
        echo"<tr>";
        echo"<th>Name</th>";
        echo"<th>LastName</th>";
        echo"<th>Email</th>";
        echo"<th>Approve</th>";
        echo"<th>Delete</th>";
        echo"<tr>";
        echo"</thead>";
        echo"<tbody>";
while($row= $result2->fetch_assoc()){
    
$numb=$row['Accepted'];
    echo'<tr>';
    echo'<td>'.$row['Name'].'</td>';
    echo'<td>'.$row['LastName'].'</td>';
    echo'<td>'.$row['Email'].'</td>';
    echo'<td><a href="./ApproveStudent.php?UserName='.$row['UserName'].'">APPROVE</a></td>';
    echo'<td><a href="./DissApproveStudent.php?UserName='.$row['UserName'].'">DELETE</a></td>';
    echo'</tr>';



}

echo "</table>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
echo "</br>";
}



include_once '../../Components/Footer/footer.php';
?>


<style>
    /* CSS styles for the table */
    table {
    border-collapse: collapse;
    width: 70%;
    margin-bottom: 20px;
    margin:auto;
    max-height: 500px;
    overflow-y: scroll;
    }
    .centriraj{
    text-align: center;
    }
    th, td {
    text-align: left;
    padding: 8px;
    border: 1px solid black;
    }

    th {
    background-color: #f2f2f2;
    font-weight: bold;
    }

    tr:nth-child(even) {
    background-color: #f2f2f2;
    }
</style>