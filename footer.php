<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        /* Footer Styling */
        .footer {
            background-color: rgba(247, 111, 47, 0.5);
            color: black;
            padding: 40px 0;
            font-family: "Times New Roman", serif;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            flex-wrap: wrap;
        }

        .footer-section {
            flex: 1;
            min-width: 250px;
            margin: 20px;
        }

        .footer-section h3 {
            color: black;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 2px solid #555;
            padding-bottom: 10px;
        }

        .footer-section p {
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: black;
            text-decoration: none;
            font-size: 16px;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .footer-section ul li a:hover {
            transform: scale(1.1);
            color: rgb(134, 49, 10);
        }

        /* Social Media Links */
        .social-links {
            display: flex;
            gap: 10px;
        }

        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #555;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            color: white;
            font-size: 20px;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .social-links a:hover {
            transform: scale(1.2);
            background-color: rgb(134, 49, 10);
        }

        /* Footer Bottom */
        .footer-bottom {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #555;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-content">
            
            <!-- About Us Section -->
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We are committed to providing the best services to our customers. Your satisfaction is our top priority.</p>
            </div>
            
            <!-- Quick Links Section -->
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="package.php">Packages</a></li>
                    <li><a href="#">Hotel</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                </ul>
            </div>
            
            <!-- Contact Info Section -->
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>
                    Email: hamroyatra@gmail.com<br>
                    Phone: 9825829944<br>
                    Address: Kathmandu, Nepal
                </p>
            </div>
            
            <!-- Social Media Section -->
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>

        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
