<?php
include"header.php"
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
    <div class="sign">
    <a href="sign_up.php">
        <button id="bookhere">
            SIGN-UP NOW <i class="fa-solid fa-circle-arrow-right"></i>
        </button>
    </a>
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
                <img src="images/mounteverest.jpg" alt="Mt. Everest">
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
        </div>
    </div>
</body>

</html>
<?php
include"footer.php"
?>