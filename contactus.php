<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0;
        }     
     .header {
            display: flex;
            background-color: #34549b;
            align-items: center;
            max-width: 100%;
            justify-content: space-between;
            height: 40px;
            position: sticky;
            top: 0;


        }

        .header img {
            margin-top: 2 px;
            height: 35px;
        }

        .header p {
            color: white;
            position: absolute;
            left: 4%;
            top: 1;
            display: flex;
            font-size: 14px;
        }



        .foot {
            display: flex;
            margin: 0;
            margin-right: 20px;
            justify-content: end;
            height: 100px;
            background-color: #34549b;
            color: white;
            width: 100%;
           


        }

        .foot img {
            margin-top: 40px;
            height: 30px;
            /* justify-content: flex-end; */
        }

        .option {
            margin-right: 20px;
            display: flex;
            /* position: relative; */
        }

        .option p {
            margin-top: 45px;
            display: inline-block;
        }
       
    main {
        /* display: flex; */
        /* flex-direction: column; */
        align-items: center;
        justify-content: center;
        padding: 20px;
        background-color: #f7f9fc;
        margin: 20px auto;
        width: 90%;
        max-width: 1200px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    main h2 {
        color: #34549b;
        text-align: center;
        font-size: 1.8em;
        margin-bottom: 20px;
    }

    main section {
        width: 100%;
        margin-bottom: 30px;
    }

    main .contact-form {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    main .contact-info {
        text-align: left;
        color: #333;
    }

    main .contact-info p {
        font-size: 1em;
        margin: 10px 0;
    }

    main .contact-info a {
        color: #34549b;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    main .contact-info a:hover {
        color: #2b3e7d;
    }



        #bookhere {
            color: rgb(5, 5, 142);
            font-weight: bold;
            height: 40px;
            margin-top: 30px;
            border-radius: 200px;
            width: 150px;
            background-color: rgba(255, 0, 0, 0.889);
        }

        .contact-info p {
            margin: 5px 0;
            color: white;
        }

        .contact-info p i {
            margin-right: 8px;
        }
         .body{ 
             height:83vh; 
         } 
    </style>

</head>

<body>
    <div class="container">
        <div class="header">
            <img src="images/logo.png" id="logo">
            <p id="para1">Yatra tours & <br>travels</p>


        </div>

        <div class="body">
            <main>
                <section class="contact-form">
                    <h2>Send Us a Message</h2>
                    <form action="#" method="post">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" required>
    
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
    
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
    
                        <button type="submit">Send Message</button>
                    </form>
                </section>
                <section class="contact-info">
                    <h2>Contact Information</h2>
                    <p>Email: <a href="mailto:info@yatra.com">info@example.com</a></p>
                    <p>Phone: <a href="tel:+9779810101010">+9779801110101</a></p>
                    <p>Address: 123 Main, kathmandu, Nepal</p>
                </section>
            </main>
    
        </div>

        <div class="foot ">

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