<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Your CSS styles here */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Additional CSS for the bouncing animation */
        .animate__bounce {
            animation-duration: 2s;
        }
    </style>
</head>

<body>
    <table border="1" cellspacing="0" cellpadding="10" class="animate__animated animate__fadeIn">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Publisher</th>
            <th>Course</th>
            <th>Year</th>
            <th>Book Number</th>
            <th>Image</th>
        </tr>

        <?php
        include '../connection.php';
        $query = "SELECT * FROM addbook ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["publisher"]; ?></td>
                    <td><?php echo $row["course"]; ?></td>
                    <td><?php echo $row["year"]; ?></td>
                    <td><?php echo $row["book_number"]; ?></td>
                    <td><img src="../Img/<?php echo $row['image']; ?>" width="200" title="<?php echo $row['image']; ?>"></td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        ?>
    </table>
</body>

</html>
        