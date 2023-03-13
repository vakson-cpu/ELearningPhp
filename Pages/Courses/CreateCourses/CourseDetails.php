<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include '../../../Components/Navbar/Navbar.php';
include_once '../../../Shared/connection.php';
$KursId = $_GET["IdKursa"];
$UserName=$_SESSION["UserName"];
$sql = "SELECT * FROM kurs WHERE '$KursId'=Id";

echo '<div class="banner">';
echo "  <div>";
echo "    <h1>Welcome to our e-Learning platform</h1>";
echo "   <p>Learn new skills and achieve your goals with us!</p>";
echo "</div>";
echo "</div>";
// header("Content-Disposition: attachment; filename='" . basename($file_path) . "'");
$result = $con->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h1 class='centerTitle'>" . $row['Naziv'] . "</h1>";
    echo "<span class='paragraph-headers'>About:</span><p class='margin_left'> Lorem ipsum dolor sit amet consectetur adipisicing elit.
         Totam, molestias cupiditate? Voluptatem cupiditate asperiores,
          nulla eos debitis nihil et fugit. Eligendi quidem illo autem sunt sed dolor maxime veritatis necessitatibus</p>";
    echo "<br/>";

    echo "<span class='paragraph-headers'>Addional info:</span> <p class='margin_left'>Lorem ipsum dolor sit amet consectetur adipisicing elit.
         Totam, molestias cupiditate? Voluptatem cupiditate asperiores,
          nulla eos debitis nihil et fugit. Eligendi quidem illo autem sunt sed dolor maxime veritatis necessitatibus</p>";
    echo "<br/>";

    echo "<span class='paragraph-headers'>Opis</span>: <p class='margin_left'>" . $row['Opis'] . "</p> ";
    echo "<span class='paragraph-headers'>Literature: </span>";
    echo "<br/>";
    echo "<br/>";
    echo "<br/>";
    $file_name = $row['file_name'];
    $file_path = $row['file_path'];
    echo "<a class='btn2' href='$file_path' download><img src='https://www.htmlcssbuttongenerator.com/iconExample-cube-filled.svg' style='width:25px; margin-left:3px; margin-right:3px; flex-direction: row;'>$file_name</a><br>";
    echo "<div class='marginAuto'><span class='margin_left'>
    Do you think you are ready to take the test? 
    If so please proceed by clicking on begin test.</span>: 
    <div class='centerText'><a  class='btn'href='Test.php?IdKursa=" . $KursId . "'>Begin test!</a></div></div> ";

    echo "</div>";
  }
}

include '../../../Components/Footer/footer.php';
?>
<style>
  .download--button {
    padding: 10px;
    background-color: gray;
    color: white;
  }



  @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Koulen&family=Lato&family=Nunito&family=Playfair+Display:ital@1&family=Prata&family=Raleway:ital,wght@1,100&family=Roboto&family=Roboto+Condensed&family=Teko&display=swap');

  .margin_left {
    margin-left: 10px;
  }

  .marginAuto {
    margin: auto;
    text-align: center !important;
    margin-top: 40px
  }

  @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Koulen&family=Lato&family=Nunito&family=Playfair+Display:ital@1&family=Prata&family=Raleway:ital,wght@1,100&family=Roboto&family=Roboto+Condensed&family=Teko&display=swap');

  .centerTitle {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
  }

  .btn {

    /* margin-left: 10px;
 */
    display: block;

    margin: auto;
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: center !important;
    width: 200px;
    font-family: Roboto, sans-serif;
    font-weight: 100;
    font-size: 14px;
    color: #fff;
    background-color: #06800e;
    padding: 10px 10px;
    border: solid #06705f 2px;
    box-shadow: rgb(0, 0, 0) 0px 0px 0px 0px;
    border-radius: 50px;
    transition: 1000ms;
    transform: translateY(0);
    display: flex;
    flex-direction: row;
    align-content: center !important;
    align-items: center;
    cursor: pointer;

  }

  .btn:hover {
    transition: 1000ms;
    padding: 10px 10px;
    transform: translateY(-0px);
    background-color: #fff;
    color: #000000;
    border: solid 2px #00cc22;

  }

  @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Koulen&family=Lato&family=Nunito&family=Playfair+Display:ital@1&family=Prata&family=Raleway:ital,wght@1,100&family=Roboto&family=Roboto+Condensed&family=Teko&display=swap');

  .btn2 {
    margin-left: 20px;
    font-family: Roboto, sans-serif;
    font-weight: 100;
    font-size: 14px;
    color: #fff;
    background-color: #278b8f;
    padding: 10px 30px;
    border: solid #06705f 2px;
    box-shadow: rgb(0, 0, 0) 0px 0px 0px 0px;
    border-radius: 50px;
    transition: 1000ms;
    transform: translateY(0);
    display: flex;
    flex-direction: row;
    align-items: center;
    cursor: pointer;
    width: 150px;


  }

  .btn2:hover {
    transition: 1000ms;
    padding: 10px 0px;
    transform: translateY(-0px);
    background-color: #fff;
    color: #0066cc;
    border: solid 2px #0066cc;

  }

  .paragraph-headers {
    font-weight: bold;
    font-style: italic;
    margin-left: 20px;
  }
</style>

<style>
  .banner {
    background-image: url("../../../Assets//Learning.png");
    background-size: cover;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .banner h1 {
    padding: 10px;
    background-color: rgb(0, 0, 0, 0.4);
    color: #fff;
    font-size: 48px;
    text-shadow: 2px 2px #333;
    margin: 0;
  }

  .banner p {
    padding: 10px;
    background-color: rgb(0, 0, 0, 0.4);
    color: #fff;
    font-size: 18px;
    text-shadow: 1px 1px #333;
    font-weight: bolds;
    margin: 0;
  }
</style>