<?php
include '../connection.php';
include '../student/nav.php';

// Fetch form data
if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    // Fetch form data


    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Escape special characters to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $message = mysqli_real_escape_string($conn, $message);

    // Insert data into database
    $sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        <@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e7eaf6;
            margin: 0;
            
        }

        .container {
            display: flex;
            justify-content: center;
            height: 90vh;
            align-items: center;
        }

        .form {
            display: flex;
            justify-content: center;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1), 0 5px 5px 0 rgba(0, 0, 0, 0.2);
            background: #FFFFFF;
            width: 500px;
            z-index: 1;
        }

        .register-form h2 {
            text-align: center;
        }

        .form input {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 1rem;
            font-size: 0.9rem;
        }

        .form textarea {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 1rem;
            font-size: 0.9rem;
        }


        .form button {
            text-transform: uppercase;
            outline: 0;
            background: #113f67;
            width: 100%;
            border: 0;
            padding: 15px;
            margin: 20px;
            color: #FFFFFF;
            font-size: 1rem;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <form class="form" method="post">
            <div class="register-form">
                <h2>Feedback Form</h2>
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" placeholder="Type your message here"
                        required></textarea>
                </div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>