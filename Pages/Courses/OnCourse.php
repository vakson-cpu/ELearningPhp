<?php 
    include '../../Components/Navbar/Navbar.php';
    include_once '../../Shared/connection.php';
    include_once '../../Shared/CustomResponse.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$UserName = $_SESSION["UserName"];
function GetCompleted($number){
  if($number==0)
    return "Failed";
  return "Completed";
}
echo "<h1 class='centriraj'>Insights into courses attendants</h1>";
$sql = "SELECT korisnik.Name,kurs.Naziv,test.Points,test.Completed 
        FROM korisnik 
        INNER JOIN userkurs ON korisnik.UserName = userkurs.KorisnikId
        INNER JOIN kurs ON userkurs.KursId = kurs.Id
        INNER JOIN predavac ON kurs.Kreator = predavac.UserName
        INNER JOIN test ON test.UserName = korisnik.UserName AND test.KursId = kurs.Id
        WHERE kurs.Kreator = '$UserName'";

        
$result = $con->query($sql);
if($result->num_rows>0){
  echo "</br>";
      echo"<table>";
        echo"<thead>";
        echo"<tr>";
        echo"<th>Name</th>";
        echo"<th>Naziv Kursa</th>";
        echo"<th>Score</th>";
        echo"<th>Passed</th>";
        echo"<tr>";
        echo"</thead>";
        echo"<tbody>";
    while ($row = $result->fetch_assoc()) {
      $numb= $row["Completed"];

        echo'<tr>';
        echo'<td>'.$row['Name'].'</td>';
        echo'<td>'.$row['Naziv'].'</td>';
        echo'<td>'.$row['Points'].'</td>';
        echo'<td>'.GetCompleted($numb).'</td>';
        echo'</tr>';
    }
    echo"</tbody>";
    echo"</table>";


}


include '../../Components/Footer/footer.php';



?>

<style>
/* CSS styles for the table */
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
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
