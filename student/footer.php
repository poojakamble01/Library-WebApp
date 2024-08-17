<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* CSS styles */
        .footer {
            background-color: #2c3e50;
            color: #fff;
            padding: 30px 0;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-column {
            flex: 1;
            margin: 0 20px;
        }

        .footer-column h3 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer-bottom {
            margin-top: 20px;
        }

        .footer-bottom p {
            font-size: 14px;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .social-icons a {
            color: #fff;
            font-size: 20px;
            margin: 0 10px;
        }

        .social-icons a:hover {
            color: #3498db;
        }
        .footer-column{
            display: flex;
            flex-direction: column;
            /* width:400px;
            border: 2px solid black; */
        }
        .allimp{
            display: flex;
            justify-content: space-evenly;
            gap:0.5px;
           
        }
    </style>
</head>
<body>

<footer class="footer">
    <div class="container">
        <div class="footer-column">
            <div class="header">
                <h3>Quick Links</h3>
            </div>
            <div class="allimp">
                <div class="imp"><ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="">About us</a></li>
                    <li><a href="contactus.php">Contact us</a></li>
                    <li><a href="events.php">Events And Functions</a></li>
                </ul></div>
                <div class="imp"><ul>
                    <li><a href="FAQ.php">FAQ</a></li>
                    <li><a href="register.php">Sign up</a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul></div>
                <div class="imp"><ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                </ul></div>
            </div>
            
            
        </div>


        <div class="footer-column">
            <h3>Follow Us</h3>
            <ul class="social-icons">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
            </ul>
            
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 chetana hazarinamal somani college of commerce and economics Smt kusumrai chaudhari college of Arts(Autonomous). All rights reserved.</p>
    </div>
</footer>

</body>
</html>