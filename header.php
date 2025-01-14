<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hover Zoom Navigation</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .Heading {
            background-color: rgba(247, 111, 47, 0.5);
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .TOGETHER-name-logo {
            display: flex;
            align-items: center;
        }

        .Logo img {
            width: 75px;
            height: auto;
        }

        .web-name h1 {
            font-size: 25px;
            margin-left: 15px;
            color: #333;
        }
        
        nav ul {
            display: flex;
            gap: 50px;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        nav ul li a {
            color: black;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
            position: relative;
            display: inline-block;
            transition: transform 0.3s ease, color 0.3s ease;
        }
        
        nav ul li a:hover {
            transform: scale(1.2); /* Zoom effect */
            color:rgb(134, 49, 10); /* Optional color change */
        }

        /* Optional underline effect on hover */
        nav ul li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 0;
            height: 3px;
            background-color: #f76f2f;
            transition: width 0.3s ease;
        }

        nav ul li a:hover::after {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="Heading">
        <div class="TOGETHER-name-logo">
            <div class="Logo">
                <img src="logoo.png" alt="logo">
            </div>
            <div class="web-name">
                <h1>Hamro Yatra</h1>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="contactus.php">Contact</a></li>
                <li><a href="package.php">Packages</a></li>
                <li><a href="hotel.php">Hotels</a></li>
            </ul>
        </nav>
    </div>
</body>
</html>
