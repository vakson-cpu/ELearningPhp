<?php 
include_once '../../Shared/connection.php';
include_once '../../Components/Navbar/Navbar.php';



if(isset($_SESSION["Id"])){
$Id=$_SESSION["Id"];
$sql="SELECT * FROM userkurs WHERE  $Id=KorisnikId";
$result=$con->query($sql);
if($result->num_rows>0){
    while ($row = $result->fetch_assoc()) {
        $sql2="SELECT * FROM kurs JOIN  where $Id=".$row['KursId']."";
        if($con->query($sql2)){
            while($row2 = $result->fetch_assoc()){
                echo $row2["Naziv"];

            }
        }

    }
}

}





include_once '../../Components/Footer/footer.php';
?>
