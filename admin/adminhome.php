<?php
require ("functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.0.7/css/boxicons.min.css">
    <!-- Font Awesome for icons -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: grid;
            grid-template-columns: auto 1fr;
            /* Sidebar and main content */
        }
        .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            grid-gap: 15px;
            align-items: center;
            padding: 10px;
            grid-column: 2;
            max-width: 1130px;
            margin: 0px auto;
            height: 0px;
        }


        .col-md-3 {
            text-align: center;
            margin: 0 auto;
            padding: 18px;
            border: solid;
            color: white;
            width: 87%;
            height: 200px;
            /* border-radius: 20px; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        #users {
            background-color: rgb(118, 118, 118);


        }

        #book {
            background-color: rgb(44, 129, 39);

        }

        #r_book {
            background-color: rgb(19, 15, 94);

        }

        #i_book {
            background-color: rgb(212, 184, 0);

        }

        #book_stock {
            background-color: rgb(4, 129, 187);

        }

        #users:hover {
            background-color: rgb(167, 167, 167);


        }

        #book:hover {
            background-color: rgb(58, 183, 51);

        }

        #r_book:hover {
            background-color: rgb(46, 39, 163);

        }

        #i_book:hover {
            background-color: rgb(251, 224, 53);

        }

        #book_stock:hover {
            background-color: rgb(49, 169, 225);

        }

        .col-md-3:hover {
            transform: translateY(-10px);

        }

        .card .card-header i {
            font-size: 45px;
            /* Adjust the size as needed */
        }

        .card .card-header img {
            width: 60px;
        }

        .card .card-header {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .card .card-header i {
            margin-right: 10px;
            /* Adjust spacing between icon and text */
        }


        .card {
            max-width: 400px;
            margin: 0 auto;
            border-radius: 20px;
            overflow: hidden;
            /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        }

        .card-header {
            font-weight: bold;
            padding: 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .card-body {
            padding: 20px;
            /* background-color: #f8f9fa; */
        }


        .btn {
            display: inline-block;
            color: white;
            border: none;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>

<body>
    <?php
    include ("sidebar.php");
     ?>
    <div class="row">
        <div class="col-md-3" id="users">
            <div class="card bg-light">
                <div class="card-header"><i class="fa-solid fa-users"></i>
                    <div class="card-body">
                        <p class="card-text">Total Users: <?php echo get_user_count(); ?></p>
                        <a class="btn" href="users.php">View Registered Users

                    </div>
                </div>
                </a>
            </div>

        </div>
        <div class="col-md-3" id="book">
            <div class="card bg-light">
                <div class="card-header"><i class="fa-solid fa-book"></i>
                    <div class="card-body">
                        <p class="card-text">Total Books: <?php echo get_book_count(); ?></p>
                        <a class="btn" href="data.php">View All Books</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" id="r_book">
            <div class="card bg-light">
                <div class="card-header"><i class="fa-solid fa-id-card"></i>
                    <div class="card-body">
                        <p class="card-text">Books Request by Users: <?php echo get_category_count(); ?></p>
                        <a class="btn" href="issueBooksAdmin.php">View Requests</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" id="i_book">
            <div class="card bg-light">
                <div class="card-header"><i class="fa-solid fa-address-book"></i>
                    <div class="card-body">
                        <p class="card-text">Book Issued by Admin: <?php echo get_issue_book_count(); ?></p>
                        <a class="btn" href="">View Issued Books</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3" id="book_stock">
            <div class="card bg-light">
                <div class="card-header"><img src="../Images/book-stock.svg" alt="" srcset="">
                    <div class="card-body">
                        <p class="card-text">Book Out of Stock: <?php echo get_stock_book_count(); ?></p>
                        <a class="btn" href="data.php">Books</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        searchBtn.addEventListener("click", () => {
            sidebar.classList.toggle("open");
            menuBtnChange();
        });

        function menuBtnChange() {
            if (sidebar.classList.contains("open")) {
                closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
            } else {
                closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            }
        }
    </script>

</body>

</html>