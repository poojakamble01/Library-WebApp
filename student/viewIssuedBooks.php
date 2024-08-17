<?php
// session_start();
include '../connection.php';
include 'nav.php';

if (!isset($_SESSION['username'])) {
    header('location:login.php');
    exit();
}

$username = $_SESSION['username'];

// Assuming 'reg' is the table containing student data and 'issued_books' is the table containing issued books data
$query = "SELECT ib.*, r.username FROM issued_books ib
          INNER JOIN reg r ON ib.student_id = r.student_id
          WHERE r.username = '$username'";
$query_returned = "SELECT rb.*, r.username FROM returned_books rb
          INNER JOIN reg r ON rb.student_id = r.student_id
          WHERE r.username = '$username'";

$result = mysqli_query($conn, $query);
$result_returned = mysqli_query($conn, $query_returned);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e7eaf6;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .issue_book_container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

       .issue_book_container h2 {
            text-align: center;
            text-transform: uppercase;
        }

        .issue_book_main {
            display: flex;
            justify-content: center;
        }

        .issue_book_box {
            width: 25%;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .issue_book_box p {
            margin-bottom: 10px;
            text-align: center;
        }

        .issue_book_box hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="issue_book_container">
        <h2>Books Issued </h2>
        <div class="issue_book_main">
            
                <?php
                if (!$result) {
                    // Query failed
                    echo "Error: " . mysqli_error($conn);
                } else {
                    // Query successful
                    if (mysqli_num_rows($result) > 0) {
                        // Data found, proceed to display
                        while ($issuedBook = mysqli_fetch_assoc($result)) {
                            echo"<div class='issue_book_box'>";
                            echo "<p>Student ID: " . $issuedBook['student_id'] . "</p>";
                            echo "<p>Book Name: " . $issuedBook['book_name'] . "</p>";
                            echo "<p>Book Number: " . $issuedBook['book_number'] . "</p>";
                            echo "<p>Return Date: " . $issuedBook['return_date'] . "</p>";
                            echo "<p>Issued Date: " . $issuedBook['issue_date'] . "</p>";
                            
                            echo"</div>";
                        }
                    } else {
                        // No data found
                        echo "<p>No books issued by this user.</p>";
                    }
                }
                ?>
            
        </div>
    </div>
    <div class="issue_book_container">
    <h2>Returned Books</h2>
    <div class="issue_book_main">
        <!-- Returned Books Section -->
        <?php
        if (!$result_returned) {
            // Query failed
            echo "Error: " . mysqli_error($conn);
        } else {
            // Query successful
            if (mysqli_num_rows($result_returned) > 0) {
                // Data found, proceed to display
                while ($returnedBook = mysqli_fetch_assoc($result_returned)) {
                    echo "<div class='issue_book_box'>";
                    echo "<p>Student ID: " . $returnedBook['student_id'] . "</p>";
                    echo "<p>Book Name: " . $returnedBook['book_name'] . "</p>";
                    echo "<p>Book Number: " . $returnedBook['book_number'] . "</p>";
                    echo "<p>Return Date: " . $returnedBook['return_date'] . "</p>";
                    // echo "<p>Issued Date: " . $returnedBook['issue_date'] . "</p>";
                    echo "</div>";
                }
            } else {
                // No data found
                echo "<p>No returned books by this user.</p>";
            }
        }
        ?>
    </div>
</div>
</body>

</html>
