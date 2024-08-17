<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <style>
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

        th {
            background-color: #f2f2f2;
        }

        select {
            padding: 6px 10px;
            border-radius: 5px;
        }

        button {
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
    <table>
        <tr>
            <th>No</th>
            <th>Course</th>
            <th>Year</th>
            <th>Semester</th>
            <th>Name</th>
            <th>Book ID</th>
            <th>Publisher</th>
            <th>Image</th>
            <th>Action</th>
        </tr>

        <?php
        include '../connection.php';
        $rows = mysqli_query($conn, "SELECT * FROM addbook ORDER BY availability DESC, id DESC");
        $i = 1;
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
                <td><img src="../Img/<?php echo $row['image']; ?>" width="100" title="<?php echo $row['image']; ?>"></td>
                <td>
                    <!-- Form for updating availability -->
                    <form method="POST" action="update_availability.php">
                        <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                        <select name="availability">
                            <option value="Available" <?php if ($row['availability'] == 'Available')
                                echo 'selected'; ?>>
                                Available</option>
                            <option value="Unavailable" <?php if ($row['availability'] == 'Unavailable')
                                echo 'selected'; ?>>
                                Unavailable</option>
                        </select>
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>