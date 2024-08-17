<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Management System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="../student/css/nav.css">
  <style>
    .login {
      display: flex;
      gap: 50px;
      align-items: center;
      
    }

    .navbar {
      position: relative; /* Ensure the navbar is positioned relative to its containing element */
      z-index: 2; /* Set a higher z-index to ensure the navbar appears above other elements */
    }
    .name{
      text-transform: uppercase;
    }
    .lgout{
      text-align: center;
    }
    
  </style>
</head>

<body>
  <nav class="navbar">
    <div class="logo">
      <img src="../Images/logo.png" alt="logo is not visible!!">
      <img class="alternate-logo" src="../Images/logo2.png" alt="logo is not visible">
    </div>
    <div class="search">
      <input type="text" placeholder="Search...">
      <button>Search</button>
    </div>
    <div class="login">
      <?php if (isset ($_SESSION['username'])): ?>
        <div>
          <h2 class="name">Welcome,
            <?php echo $_SESSION['username']; ?>
          </h2>
        </div>
        <div>
          <form class="lgout" action="logout.php" method="post">
            <button type="submit">Logout</button>
          </form>
        </div>
      <?php else: ?>
        <div>
          <a href="login.php"><button>Login</button></a>
        </div>
      <?php endif; ?>

      <!-- hamburger -->
      <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />
        <label class="menu__btn" for="menu__toggle">
          <span></span>
        </label>

        <ul class="menu__box">
          <li><a class="menu__item" href="home.php">Home</a></li>
          <li><a class="menu__item" href="uprofile.php">User profile</a></li>
          <li><a class="menu__item" href="course.php">Request Book</a></li>
          <li><a class="menu__item" href="issuebook.php">Available Book</a></li>
          <li><a class="menu__item" href="viewIssuedBooks.php">View I & R Book</a></li>
          <li><a class="menu__item" href="feedback.php">Feedback</a></li>
          <li><a class="menu__item" href="contactus.php">Contact</a></li>
          <!-- <li><a class="menu__item" href="FAQ.php">FAQ</a></li> -->
          <li><a class="menu__item" href="events.php">Events And Functions</a></li>
          <li><a class="menu__item" href="RR.php">Rules and Regulations</a></li>
          <li><a class="menu__item" href="logout.php">Logout</a></li>
         </ul>
      </div>
    </div>


  </nav>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const menuToggle = document.getElementById("menu__toggle");
      const menuBox = document.querySelector(".menu__box");

      menuToggle.addEventListener("change", function () {
        if (menuToggle.checked) {
          menuBox.style.display = "block"; // Show the menu box when checked
        } else {
          menuBox.style.display = "none"; // Hide the menu box when unchecked
        }
      });

      const menuItems = document.querySelectorAll(".menu__item");
      menuItems.forEach(function (item) {
        item.addEventListener("click", function () {
          menuToggle.checked = false; // Close the menu box
          menuBox.style.display = "none"; // Hide the menu box
        });
      });
    });
  </script>

</body>

</html>