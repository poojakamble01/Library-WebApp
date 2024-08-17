<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 80%;
            margin: 20px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .btn {
            background-color: #113f67;
            color: #fff;
            border: none;
            margin: 5px;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover{
            background-color: #165891;
        }
        

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Requested Books by Students</h1>
        <div class="table-container">
            <?php
            require '../connection.php';

            // Function to calculate expiry date and time
            function calculateExpiryDateTime($issued_at)
            {
                $expiry_datetime = date('Y-m-d H:i:s', strtotime($issued_at . ' + 1 days')); // Add 1 days to issued date
                return $expiry_datetime;
            }

         // Handle accept and delete actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["accept"])) {
        $issue_id = $_POST["accept"];
        // Update the status of the issued book to "Accepted"
        $update_query = "UPDATE issuebookbyuser SET status='Accepted' WHERE id='$issue_id'";
        mysqli_query($conn, $update_query);
        
        // Retrieve the accepted record from the database
        $select_query = "SELECT * FROM issuebookbyuser WHERE id='$issue_id'";
        $result = mysqli_query($conn, $select_query);
        $accepted_book = mysqli_fetch_assoc($result);

        // Insert the accepted record into the issued_books table
        $insert_query = "INSERT INTO issued_books (book_id, book_number, publisher, username, course, year, issued_at, expiry_date) VALUES ('".$accepted_book['book_id']."', '".$accepted_book['book_name']."', '".$accepted_book['publisher']."', '".$accepted_book['username']."', '".$accepted_book['course']."', '".$accepted_book['year']."', '".$accepted_book['issued_at']."', '".calculateExpiryDateTime($accepted_book['issued_at'])."')";
        mysqli_query($conn, $insert_query);
    } elseif (isset($_POST["delete"])) {
        $issue_id = $_POST["delete"];
        // Delete the issued book record
        $delete_query = "DELETE FROM issuebookbyuser WHERE id='$issue_id'";
        mysqli_query($conn, $delete_query);
    }
}


            // Fetch issued books data from the database
            $query = "SELECT * FROM issuebookbyuser";
            $result = mysqli_query($conn, $query);

            // Check if any records were returned
            if (mysqli_num_rows($result) > 0) {
                // Output the data in a table
                echo "<table>";
                echo "<tr>
                        <th>ID</th>
                        <th>Book ID</th>
                        <th>STUDENT ID</th>
                        <th>Book Name</th>
                        <th>Publisher</th>
                        <th>Username</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Request At</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    $expiry_datetime = calculateExpiryDateTime($row["issued_at"]);
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    echo "<td>" . $row["student_id"] . "</td>";
                    echo "<td>" . $row["book_name"] . "</td>";
                    echo "<td>" . $row["publisher"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["course"] . "</td>";
                    echo "<td>" . $row["year"] . "</td>";
                    echo "<td>" . $row["issued_at"] . "</td>";
                    echo "<td>" . $expiry_datetime . "</td>";
                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='accept' value='" . $row['id'] . "'>";
                    echo "<button class='btn' type='submit'>Accept</button>";
                    echo "</form>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='delete' value='" . $row['id'] . "'>";
                    echo "<button class='btn' type='submit'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No issued books found.";
            }
            ?>
        </div>
    </div>
</body>

</html>