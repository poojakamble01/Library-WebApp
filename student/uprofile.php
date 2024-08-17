<?php
// session_start();
include '../connection.php';
include '../student/nav.php';


if(!isset($_SESSION['username'])){
   header('location:login.php');
   exit();
  }
  
  $username = $_SESSION['username'];
  $query = mysqli_query($conn, "SELECT * FROM `reg` WHERE username = '$username'");
  $userData = mysqli_fetch_assoc($query);
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #e7eaf6;
    }

    .container {
      display: flex;
      flex-direction: column;
      height: 90vh;
      align-items: center;
    }

    .main {
      justify-content: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1), 0 5px 5px 0 rgba(0, 0, 0, 0.2);
      background: #FFFFFF;
      width: 650px;
      z-index: 1;
      padding: 25px;
      margin: 10px;
    }

    .main p {
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 1rem;
      font-size: 0.9rem;
    }

    .main button {
      text-transform: uppercase;
      outline: 0;
      background: #113f67;
      border: 0;
      padding: 15px;
      color: #FFFFFF;
      font-size: 1rem;
      -webkit-transition: all 0.3s ease;
      transition: all 0.3s ease;
      cursor: pointer;
      border-radius: 8px;
    }

    .button a {
      color: #FFFFFF;
      text-decoration: none;
    }

    .btn {
      display: flex;
      justify-content: space-around;
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Welcome to Profile Page</h2>
    <div class="main">
      <p>Email:
        <?php echo $userData['email']; ?>
      </p>
      <p>Contact Number:
        <?php echo $userData['contact_number']; ?>
      </p>
      <p>Barcode Number:
        <?php echo $userData['barcode_number']; ?>
      </p>
      <div class="btn">
        <button class="button">
          <a href="updtUprofile.php">Update Profile</a>
        </button>
        <button class="button">
          <a href="logout.php">Logout</a>
        </button>
      </div>


    </div>
  </div>
</body>

</html>