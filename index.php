<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: sign_up.php");
    exit();
}
$firstname = $_SESSION['firstname'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet"  href="index.css">

</head>

<body>
    <div class="container">
        <div class="header">
            <img src="images/logo.png" id="logo">
            <p id="para1">Yatra tours & <br>travels</p>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                    <li><a href="package.php">Packages</a></li>
                    <!-- <li><a href="destination">Destination</a></li> -->
                </ul>
            </nav>
        </div>

        <div class="hero">
            <h1>Dream Larger<br> Travel Smarter</h1>
            <div class="searchbar">
                <input type="text" name="search" id="search" placeholder="search here">

            </div>

        </div>
        <div class="section-header"><h1>TOP PACKAGES</h1></div>
        <div class="packages">
            <div class="image-container">
                <a href="package.php">
                <img src="images/Phewa_taal.jpg" alt="POKHARA">
                <p>Phewa-Taal Pokhara</p>
                <p class="price">Price: Rs 3500</p> </a>
            </div>
            <div class="image-container">
                <a href="package.php">
                <img src="images/newbg1.jpg" alt="Mt. Everest">
                <p>Mount Everest</p>
                <p class="price">Price: Rs 700000</p> </a>
            </div>
            <div class="image-container">
                <a href="package.php">
                <img src="images/janaki temple.webp" alt="Janaki Temple"> 
                <p>Janaki Temple</p>
                <p class="price">Price: Rs 10000</p></a>
            </div>
        </div>

        <div class="section-header"><h1>OTHER PACKAGES</h1></div>
        <div class="packages">
            <div class="image-container">
                <a href="package.php">
                <img src="images/muktinath.jpg" alt="Muktinath temple">
                <p>Muktinath Temple</p>
                <p class="price">Price: Rs 1200</p> </a>
            </div>
            <div class="image-container">
                <a href="package.php">
                <img src="images/bungy.jpeg" alt="Bungee Jumping">
                <p>Bungee Jumping Pokhara</p>
                <p class="price">Price: Rs 3400</p> </a>
            </div>
            <div class="image-container">
                <a href="package.php">
                <img src="images/skydive.jpg" alt="Skydiving">
                <p>Skydiving Everest</p>
                <p class="price">Price: Rs 60000</p> </a>
            </div>
            <div class="image-container">
                <a href="package.php">
                <img src="images/mustang.jpg" alt=" Upper Mustang Nilgiri">
                <p>Upper Mustang(Nilgiri)</p>
                <p class="price">Price: Rs 7000</p> </a>
            </div>
        </div>


        <div class="foot ">
            <div class="option">

                <a href="package.php"> 
                <img src="images/tour.png" id="tourlogo">
                <p id="paratour">Packages</p>
               </a>
               
             <a href="hotel.php">
                <img src="images/hotel.png" id="hotellogo">
                <p id="parahotel">Hotels</p>
             </a>
            </div>

            <!-- <a href="book.html">
                <button id="bookhere"> 
                    Book Your Trip Now <i class="fa-solid fa-circle-arrow-right"></i>
                </button>
            </a> -->
            <div class="sign">
                <a href="sign_up.php">
                    <button id="bookhere">
                        SIGN-UP NOW <i class="fa-solid fa-circle-arrow-right"></i>
                    </button>
                </a>
            </div>

            <div class="contact-info">
                <p> <i class="fa-solid fa-envelope"></i> yatru@gmail.com</p>
                <p><i class="fa-brands fa-instagram"></i> Yatru_Official</p>
                <p><i class="fa-brands fa-square-facebook"></i> Yatra Tours&Hotels</p>
                <p><i class="fa-solid fa-phone"></i> +977-957689547</p>
                        
            </div>
        </div>
    </div>
</body>

</html>