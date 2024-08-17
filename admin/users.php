<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            animation: fadeIn 1s ease;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <h2>User Information</h2>

    <?php
    include ('../connection.php');

    // Function to sanitize input data
    function sanitize($conn, $data)
    {
        return mysqli_real_escape_string($conn, trim($data));
    }

    // Fetch and Display Users
    $query = "SELECT student_id, username, email,contact_number,barcode_number FROM reg";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Contact Number</th><th>Barcode Number</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["student_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["contact_number"] . "</td>";
            echo "<td>" . $row["barcode_number"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found";
    }
    // Close connection
    mysqli_close($conn);
    ?>
</body>

</html>
