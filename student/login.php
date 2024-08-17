<?php
include '../connection.php';
session_start();

if (isset ($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, trim($_POST['username']));
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  // Check if username is "admin" and password is "admin2024"
  if ($username === 'admin' && $password === 'admin2024') {
    $_SESSION['admin'] = true; // Set admin session variable
    echo "<script>alert('Logged in as admin!');</script>";
    echo "<script>window.location.href = '../admin/adminhome.php';</script>";
    exit; // Exit to prevent further execution
  }

  // Query the database to find the user with the provided username
  $select = mysqli_query($conn, "SELECT * FROM `reg` WHERE username = '$username'") or die (mysqli_error($conn));

  if (mysqli_num_rows($select) > 0) {
    $row = mysqli_fetch_assoc($select);
    $stored_password = $row['password'];

    // Verify the hashed password
    if (password_verify($password, $stored_password)) {
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username']; // Store the username in session
      echo "<script>alert('Logged in successfully!');</script>";
      echo "<script>window.location.href = 'home.php';</script>";
      exit; // Exit to prevent further execution
    } else {
      echo "<script>alert('Incorrect password!');</script>";
    }
  } else {
    echo "<script>alert('User not found!');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- <link rel="stylesheet" href="login.css"> -->
  <style>
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
      background: #113f67;
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
      color:  #a2a8d3;
    }

    .form .message a {
      color: #38598b;
      text-decoration: none;
    }
    .register-form h2{
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <form class="form" method="post">
      <div class="register-form">
           <h2>Login YourSelf Here</h2>
        <div class="input-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="submit">Login</button>
        <p class="message">Don't have an account? <a href="register.php">Register</a></p>
      </div>
    </form>
  </div>
</body>

</html>