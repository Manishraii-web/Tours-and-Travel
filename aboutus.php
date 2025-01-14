<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .aboutimg {
            background-image: url('images/muktinath.jpg');
            width: 100%;
            height: 600px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .aboutimg h1 {
            font-family: 'Cambria', serif;
            font-size: 36px;
            color: darkred;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .parasec {
            padding: 20px;
            text-align: center;
        }

        .parasec p {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #555;
            margin-top: 60px;
            margin-bottom: 60px;
        }

        .parasec h2 {
            font-size: 40px;
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .parasec ul {
            list-style-type: none;
            padding-left: 40px;
            text-align: left;
            margin-top: 30px;
        }

        .parasec ul li {
            font-size: 17px;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
        }

        .contact-info {
            margin-top: 40px;
            padding: 20px;
            background-color: #3b5998;
            color: white;
            text-align: center;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .contact-info i {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="aboutimg">
        <h1>Learn More About Us</h1>
    </div>

    <div class="parasec">
        <p>
            We love to share that your journey with us will be nothing less than a miracle. 
            We hope to provide you with all the happiness you seek during your travels with us. 
            Making your travels memorable with tons of smiles and fun is what we aim to do. 
            Our customers' satisfaction is the highest praise we can achieve. 
            Come and join this amazing, unforgettable journey with us. Thank you!
        </p>

        <h2>Why Choose Us?</h2>
        <ul>
            <li>Small groups, adventure travel, and trekking to the Himalayas, Nepal, Tibet, Bhutan, and India.</li>
            <li>Flexibility in trip, itinerary & dates; professional & friendly guides.</li>
            <li>Reasonably priced tours, climbing, trekking, and expeditions.</li>
            <li>Private or group tour options with 24/7 support.</li>
            <li>Customizable plans tailored to your interests.</li>
            <li>Experts in group and individual operations with 18 years of experience.</li>
            <li>Safety-first approach with well-paid and insured staff.</li>
        </ul>
    </div>

<?php
include "footer.php";
?>
</body>
</html>
