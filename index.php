<?php include './Components/Navbar/Navbar.php' ?>
<?php include './Shared/connection.php'; ?>


<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            color: black;

        }
        .image_size {
            height: 300px;
        }

        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin: 8px;
            width: 33%;
        }

        .about-section {
            text-align: center;
            background-color: #d4d2d2;
            color: black;
            padding: 20px;
            font-weight: bold;
            margin: 10px;
        }

        .row {


            width: 100%;
            display: flex;
            flex-direction: row;
        }

        .container {
            padding: 0 16px;
        }



        .title {
            color: grey;
        }

        .button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            margin-bottom: 10px;
        }

        .button:hover {
            background-color: #555;
        }

        .banner {
            width: 100%;
            height: 700px;
            box-shadow: #000;
            margin-top: 30px;
            margin-bottom: 30px;
            
            display: flex;
            justify-content: center;
        }

        .banner img {
            width: 90%;
            height: 700px;


        }
    </style>
</head>

<body>

    <div class="about-section">
        <h1 class="text_color ">About Us Page</h1>
        <p class="text_color ">Cosmetic surgery is a surgical expertise that aims at correcting or improving body imperfections. These may be congenital, acquired, due to illness, or due to traumatic or para-physiological events such as aging. Cosmetic surgery also includes surgical procedures requested by patients to improve their appearance. In this regard, cosmetic surgery differs from reconstructive surgery, which deals with the treatment of morphological alterations that can be related to pathological conditions; in the specific nature of their respective areas, cosmetic surgery and reconstructive surgery both belong to plastic surgery. The aim of this discipline must be to keep the same aesthetic and scientific approach both in the resolution of body imperfections or in voluntary modifications to appearance</p>
        <p class="text_color ">Resize the browser window to see that this page is responsive by the way.</p>
    </div>
    <div class="Banner">
        <img class="Banner_Image" src="./Assets/Learning.png" alt="Klinika" />
    </div>

    <div>
        <h2 style="text-align:center">Founders of Elearning</h2>
        <div class="row">
            <div class="card">
                <img class="image_size" src="./images/Doctor1.jpeg" alt="Jane" style="width:100%">
                <div class="container">
                    <h2>Ashley</h2>
                    <p class="title">Director</p>
                    <p>Great Leader and owner</p>
                    <p>jane@example.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>


            <div class="card">
                <img class="image_size" src="./images/Doctor2.jpeg" alt="Mike" style="width:100%">
                <div class="container">
                    <h2>Mike Ross</h2>
                    <p class="title">Art Director</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>mike@example.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>

            <div class="card">
                <img class="image_size" src="./images/Doctor3.jpg" alt="John" style="width:100%">
                <div class="container">
                    <h2>John Doe</h2>
                    <p class="title">Designer</p>
                    <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                    <p>john@example.com</p>
                    <p><button class="button">Contact</button></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php include './Components/Footer/footer.php'; ?>