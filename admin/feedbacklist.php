<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Feedback Information</h2>
    <?php
    include 'connection.php';

    // Query to fetch all data from the feedback table
    $query = "SELECT * FROM feedback";
    $result = mysqli_query($conn, $query);

    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Time</th></tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["message"]."</td><td>".$row["created_at"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No feedback available";
    }

    // Close connection
    mysqli_close($conn);
    ?>
</body>
</html>
