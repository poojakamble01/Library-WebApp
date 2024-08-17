<?php
require '../connection.php';

// Initialize session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $logged_in_username = $_SESSION['username'];
    // Fetch student_id based on the logged-in username
    $user_query = "SELECT student_id FROM reg WHERE username='$logged_in_username'";
    $user_result = mysqli_query($conn, $user_query);
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $row = mysqli_fetch_assoc($user_result);
        $student_id = $row['student_id'];
    } else {
        // Handle error if user's student_id is not found
        $alertMessage = "Error: Student ID not found for the logged-in user.";
    }
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Initialize alert message
$alertMessage = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book_id"])) {
    // Get the book ID from the form
    $book_id = $_POST["book_id"];

    // Check if the user has already issued the same book
    $check_query = "SELECT * FROM issuebookbyuser WHERE book_id='$book_id' AND student_id='$student_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // If the user has already issued the same book, display an error message
        $alertMessage = "You have already requested this book.";
    } else {
        // Get the book information from the database based on the book ID
        $query = "SELECT * FROM addbook WHERE id='$book_id'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            // Fetch the book information
            $row = mysqli_fetch_assoc($result);
            $book_name = $row['name'];
            $publisher = $row['publisher'];
            $course = $_POST["course"];
            $year = $_POST["year"];

            // Insert the issued book information into the database
            $insert_query = "INSERT INTO issuebookbyuser (student_id, book_id, book_name, publisher, username, course, year) VALUES ('$student_id', '$book_id', '$book_name', '$publisher', '$logged_in_username', '$course', '$year')";
            $result = mysqli_query($conn, $insert_query);

            if ($result) {
                $alertMessage = "Book requested successfully.";
            } else {
                $alertMessage = "Error issuing book: " . mysqli_error($conn);
            }
        } else {
            $alertMessage = "Book not found.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Request</title>
    <script>
        // JavaScript function to display alert message
        function showAlert(message) {
            alert(message);
        }

        // Display alert message
        <?php
        if (!empty($alertMessage)) {
            echo "showAlert('$alertMessage');";
        }
        ?>
    </script>
</head>

<body>
    <!-- Your HTML content here -->
</body>

</html>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 20px;
            display: flex;
            align-items: center;
        }

        img {
            width: 100px;
            height: auto;
            margin-right: 20px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        p {
            margin: 5px 0;
        }

        .request-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .request-btn:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_GET['course']) && isset($_GET['year']) && isset($_GET['semester'])) {
            $course = $_GET['course'];
            $year = $_GET['year'];
            $semester = $_GET['semester'];

            $query = "SELECT * FROM addbook WHERE course='$course' AND year='$year' AND semester='$semester'";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                // Handle query error
                echo "Query failed: " . mysqli_error($conn);
            } else {
                if (mysqli_num_rows($result) > 0) {
                    echo "<h2>Books for $year $course - $semester</h2>";
                    echo "<ul>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>";
                        echo "<img src='../Img/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                        echo "<div>";
                        echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
                        echo "<p><strong>Publisher:</strong> " . $row['publisher'] . "</p>";
                        echo "<p><strong>Availability:</strong> " . $row['availability'] . "</p>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='book_id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='course' value='$course'>";
                        echo "<input type='hidden' name='year' value='$year'>";
                        echo "<button type='submit' class='request-btn'>Request</button>";
                        echo "</form>";
                        echo "</div>";
                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No books found for $year $course - $semester";
                }
            }
        } else {
            echo "Invalid request";
        }
        ?>
    </div>
</body>

</html>