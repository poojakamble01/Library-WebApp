<?php
include '../connection.php';
session_start();

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $barcodeNumber = mysqli_real_escape_string($conn, $_POST['barcode_number']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);

    // Check if passwords match
    if ($password !== $cpassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Check if the username already exists
        $check_username = mysqli_query($conn, "SELECT * FROM `reg` WHERE username = '$name'");
        // Check if the email already exists
        $check_email = mysqli_query($conn, "SELECT * FROM `reg` WHERE email = '$email'");

        if (mysqli_num_rows($check_username) > 0) {
            echo "<script>alert('Username already exists!');</script>";
        } elseif (mysqli_num_rows($check_email) > 0) {
            echo "<script>alert('Email already exists!');</script>";
        } else {
            // Insert the new user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO `reg` (username, email, password, contact_number, barcode_number, type) VALUES ('$name', '$email', '$hashed_password', '$contactNumber', '$barcodeNumber', '$type')";
            if (mysqli_query($conn, $insert_query)) {
                $_SESSION['username'] = $name;
                echo "<script>alert('Registration successful!');</script>";
                echo "<script>window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Registration failed!');</script>";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

  * {
    box-sizing: border-box;
  }

  :root {
    --first-color: #e7eaf6;
    --second-color: #a2a8d3;
    --third-color: #38598b;
    --fourth-color: #113f67;
    --input-bgcolor: #f2f2f2;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #e7eaf6;
  }

  .container {
    display: flex;
    justify-content: center;
  }

  .form {
    display: flex;
    justify-content: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1), 0 5px 5px 0 rgba(0, 0, 0, 0.2);
    background: #FFFFFF;
    width: 600px;
    z-index: 1;
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

  .form button {
    text-transform: uppercase;
    outline: 0;
    background: var(--fourth-color);
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 1rem;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .form .message {
    color: #a2a8d3;
  }

  .form .message a {
    color: #38598b;
    text-decoration: none;
  }

  .register-from h2 {
    text-align: center;
  }

  .isStudent {
    display: flex;
    justify-content: space-between;
  }

  .input-group input[type="checkbox"] {
    width: 20px;
    height: 20px;
    margin-right: 5px;
  }
  .input-group-radio{
    display: flex;
    flex-direction: column;
  }
  .radiobtn{
    display: flex;
  }
</style>

<body>
  <div class="container">
    <form class="form" method="post">
      <div class="register-from">
        <h2>Register Yourself here</h2>
        <div class="input-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="input-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
          <label for="cpassword">Confirm Password:</label>
          <input type="password" id="cpassword" name="cpassword" required>
        </div>
        <div class="input-group">
          <label for="contact_number">Contact Number:</label>
          <input type="text" id="contact_number" name="contact_number" required>
        </div>
        <div class="input-group-radio">
          <label for="barcode_number">Barcode Number:</label>
          <input type="text" id="barcode_number" name="barcode_number" required>
        </div>
        <div class="input-group">
          <div class="radiobtnheading">
            <label for="type">Select your role:</label><br>
          </div>
          <div class="radiobtn">
            <input type="radio" id="student" name="type" value="student" required>
            <label for="student">Student</label><br>
            <input type="radio" id="faculty" name="type" value="faculty" required>
            <label for="faculty">Faculty</label><br>
            <input type="radio" id="librarian" name="type" value="librarian" required>
            <label for="librarian">Librarian</label>
          </div>
        </div>

        <button type="submit" name="submit">Register</button>
        <p class="message">Already have an account? <a href="login.php">Login</a></p>
      </div>
    </form>
  </div>

</body>

</html>