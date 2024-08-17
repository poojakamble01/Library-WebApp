<?php
require '../connection.php';

// Initialize session
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $logged_in_username = $_SESSION['username'];
} else {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the book ID, name, and publisher from the form
    $book_id = $_POST["book_id"];
    $book_name = $_POST["book_name"];
    $publisher = $_POST["publisher"];
    // Get the selected course and year from the popup window
    $course = $_POST["course"];
    $year = $_POST["year"];

    // Insert the issued book information into the database
    $insert_query = "INSERT INTO issuebookbyuser (book_id, book_name, publisher, username, course, year) VALUES ('$book_id', '$book_name', '$publisher', '$logged_in_username', '$course', '$year')";
    $result = mysqli_query($conn, $insert_query);

    if ($result) {
        echo "Book issued successfully.";
    } else {
        echo "Error issuing book: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <!-- Your CSS styles here -->
    <style>
        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .popup-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        /* Button */

        .issue_btn {
            padding: 8px 16px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Additional table styles */
        .issus_book_table {
            border-collapse: collapse;
            width: 100%;
        }

        .issus_book_table th,
        td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        .issus_book_table th {
            background-color: #f2f2f2;
        }

        .issus_book_table select {
            padding: 6px 10px;
            border-radius: 5px;
        }

        .issus_book_form button {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <table class="issus_book_table" border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Course</th>
            <th>Year</th>
            <th>Semester</th>
            <th>Name</th>
            <th>Book ID</th>
            <th>Publisher</th>
            <th>Availability</th>
            <th>Image</th>
            <!-- <th>Action</th> -->
        </tr>

        <?php
        $i = 1;
        $rows = mysqli_query($conn, "SELECT * FROM addbook ORDER BY availability ASC, id ASC");
        ?>

        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row["course"]; ?></td>
                <td><?php echo $row["year"]; ?></td>
                <td><?php echo $row["semester"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["book_number"]; ?></td>
                <td><?php echo $row["publisher"]; ?></td>
                <td><?php echo $row["availability"]; ?></td>
                <td><img src="../Img/<?php echo $row['image']; ?>" width="100" title="<?php echo $row['image']; ?>"></td>
                <td>
                    <!-- Button to open popup -->
                    <button class="issue_btn"  onclick="openPopup(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['publisher']; ?>')">Issue</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Popup for selecting course and year -->
    <div id="popup" class="popup">
        <div class="popup-content">
            <h2>Select Course and Year</h2>
            <form class="issus_book_form" id="issueForm" method="POST"
                action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="book_id" id="book_id">
                <input type="hidden" name="book_name" id="book_name">
                <input type="hidden" name="publisher" id="publisher">
                <label for="course">Course:</label>
                <select name="course" id="course">
                    <option value="Computer Science">Computer Science</option>
                    <option value="Engineering">Engineering</option>
                    <!-- Add more options as needed -->
                </select><br>
                <label for="year">Year:</label>
                <select name="year" id="year">
                    <option value="First Year">First Year</option>
                    <option value="Second Year">Second Year</option>
                    <option value="Last Year">Last Year</option>
                </select><br>
                <button type="submit">Issue</button>
            </form>
        </div>
    </div>

    <script>
        // Function to open the popup and set the book_id, book_name, and publisher
        function openPopup(book_id, book_name, publisher) {
            document.getElementById("popup").style.display = "block";
            document.getElementById("book_id").value = book_id;
            document.getElementById("book_name").value = book_name;
            document.getElementById("publisher").value = publisher;
        }

        // Close the popup when clicking outside of it
        window.onclick = function (event) {
            var popup = document.getElementById("popup");
            if (event.target == popup) {
                popup.style.display = "none";
            }
        }
    </script>
</body>

</html>