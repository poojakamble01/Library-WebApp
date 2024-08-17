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

if(isset($_POST['submit'])){
   $newEmail = mysqli_real_escape_string($conn, $_POST['email']);
   $newContactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
   $newBarcodeNumber = mysqli_real_escape_string($conn, $_POST['barcode_number']);
   $isStudent = isset($_POST['is_student']) ? 1 : 0;

   mysqli_query($conn, "UPDATE `reg` SET email = '$newEmail', contact_number = '$newContactNumber', barcode_number = '$newBarcodeNumber' WHERE username = '$username'");
   header('location:Uprofile.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body{
      font-family: 'Poppins', sans-serif;
      background-color: #e7eaf6;
    }
    .container {
      display: flex;
      flex-direction:column;
      height: 90vh;
      align-items: center;
    }
    .update-form {
      justify-content: center;
      box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1), 0 5px 5px 0 rgba(0, 0, 0, 0.2);
      background: #FFFFFF;
      width: 500px;
      z-index: 1;
      padding: 25px;
      margin: 10px;
    }
    .update-form input {
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      text-align: center;
      border: 0;
      margin: 0 0 15px;
      padding: 1rem;
      font-size: 0.9rem;
    }
    .update-form .button {
      text-transform: uppercase;
      outline: 0;
      background:#113f67;
      border: 0;
      padding:15px;
      color:#FFFFFF;
      font-size: 1rem;
      -webkit-transition: all 0.3s ease;
      transition: all 0.3s ease;
      cursor: pointer;
      border-radius: 8px;
    }
    .button a{
      color:#FFFFFF;
      text-decoration:none;
    }
    .btn{
      display: flex;
      justify-content: space-around;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Update your Profile</h2>
    <form class="update-form" method="post">
      <div class="input-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
      </div>
      <div class="input-group">
        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" value="<?php echo $userData['contact_number']; ?>" required>
      </div>
      <div class="input-group">
        <label for="barcode_number">Barcode Number:</label>
        <input type="text" id="barcode_number" name="barcode_number" value="<?php echo $userData['barcode_number']; ?>" required>
      </div>
    
      <div class="btn">
        <button class="button" type="submit" name="submit"> 
        Update
        </button>
        <button class="button">
          <a href="uprofile.php">Cancel</a>
        </button>

      </div>
    </form>
  </div>
</body>
</html>
