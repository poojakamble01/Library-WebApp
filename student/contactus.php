<?php 
include '../student/nav.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
        *{
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e7eaf6;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;

        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            margin-bottom: 10px;
            text-align: center;
            /* Align center */
        }

        iframe {
            width: 100%;
            height: 300px;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .station {
            margin-top: 20px;
            text-align: left;
            /* Align left */
        }

       .container ul {
            list-style: none;
            padding: 0;
        }

        .container li {
            background-color: #f0f0f0;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .container li:hover {
            background-color: #e0e0e0;
            transform: scale(1.05);
        }

        .container a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .container a:hover {
            color: #0056b3;
        }

        .contact-info {
            margin-bottom: 20px;
            text-align: center;
            /* Align center */
        }

        .contact-info strong {
            color: #333;
        }

        .contact-numbers a {
            display: block;
            margin-bottom: 5px;
            color: #007bff;
            transition: color 0.3s ease;
        }

        .contact-numbers a:hover {
            color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <h1>Contact Us</h1>
        <p><strong>College Name:</strong> Chetana College</p>
        <p><strong>Address:</strong> New Bldg.,Survey No. 341, SD Mandir Rd, Government Colony, Bandra East, Mumbai,
            Maharashtra 400051</p>

        <p><strong>Contact Numbers:</strong>
        <ul>
            <li>
                <a href="tel:1234567890">SFC(BMS/BAF/BAMMC/BSCIT): (022) 62157867</a>,
            </li>
            <li>
                <a href="tel:0987654321">Degree College:  (022) 22 6215 7898</a>,
            </li>
            <li>
                <a href="tel:9876543210">Junior College: (+91) 7208698343, 9869247175 </a>
            </li>
        </ul>
        <p><strong>Official Website</strong><a href=" http://www.chetanacollege.in/"> http://www.chetanacollege.in/</a>
        </p>
        <h2>Map</h2>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3771.0562189440448!2d72.84592807520504!3d19.061265682140345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c91fa1b0129b%3A0xb7602700af261223!2sChetana%20College!5e0!3m2!1sen!2sin!4v1711163336831!5m2!1sen!2sin"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div class="station">
            <h2>Bus Stations near Chetana College</h2>
            <ul>
                <li>Kherwadi - 2 min walk </li>
                <li>Bandra Colony - 2 min walk </li>
                <li>Collector Office (Bandra-E) </li>
                <li>Kherwadi Junction - 4 min walk </li>
            </ul>
        </div>

        <div class="station">
            <h2>Train Stations near Chetana College</h2>
            <ul>
                <li>Bandra - 19 min walk </li>
                <li>Sion - 22 min walk </li>
            </ul>
        </div>
    </div>
</body>

</html>