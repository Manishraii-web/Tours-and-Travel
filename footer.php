<!DOCTYPE html>
<html>
<head>
<style>
.footer {
    background-color:rgba(247, 111, 47, 0.5);
    color: black;
    padding: 40px 0;
    font-family:times new roman;
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
 position: relative;
 display: inline-block;
 transition: transform 0.3s ease, color 0.3s ease;
}

.footer-section ul li a:hover {
     transform: scale(1.2); /* Zoom effect */
     color:rgb(134, 49, 10); /* Optional color change */
 }


.social-links a {
    display: inline-block;
    width: 35px;
    height: 35px;
    background-color: #555;
    margin-right: 10px;
    text-align: center;
    line-height: 35px;
    border-radius: 50%;
    position: relative;
    transition: transform 0.3s ease, color 0.3s ease;
}

.social-links a:hover {
    transform: scale(1.2);
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #555;
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
    }
    
    .footer-section {
        margin: 10px 20px;
    }
}
</style>
</head>
<body>
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We are committed to providing the best services to our customers. Your satisfaction is our top priority.</p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="package.php">Packages</a></li>
                    <li><a href="#">Hotel</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>
                    Email: hamroyatra@gmail.com<br>
                    Phone: 9825829944
                    Address: Kathmandu, Nepal
                </p>
            </div>
            
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>