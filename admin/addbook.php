<?php
require '../connection.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $publisher = $_POST["publisher"];
    $book_number = $_POST["book_number"];
    $course = $_POST["course"];
    $year = $_POST["year"];
    $semester = $_POST["semester"];

    if($_FILES["image"]["error"] === 4) {
        echo "<script> alert('Image does not exist'); </script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tempname = $_FILES["image"]["tmp_name"];

        $validImageExtension = ['jpg', 'png', 'jpeg'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if(!in_array($imageExtension, $validImageExtension)) {
            echo "<script> alert('Invalid Image Extension'); </script>";
        } elseif($fileSize > 1000000) {
            echo "<script> alert('Image is too large'); </script>";
        } else {
            $newImageName = $name . '.' . $imageExtension;
            move_uploaded_file($tempname, '../Img/' . $newImageName);
            $query = "INSERT INTO addBook (name, publisher, book_number, course, year, semester, image) VALUES ('$name', '$publisher', '$book_number', '$course', '$year', '$semester', '$newImageName')";
            mysqli_query($conn, $query);
            echo "<script> alert('Book added successfully'); document.location.href = 'data.php'; </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        .addbook_main {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            height: 100vh;
        }
        
        .addbook_form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
            animation: fadeIn 0.5s ease;
            height: 460px;
        }

        .addbook_form input[type="text"],
        input[type="file"],input[type="number"],
        select,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .addbook_form input[type="text"]:focus,
        input[type="file"]:focus,
        select:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .addbook_form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        .addbook_form input[type="submit"]:hover {
            background-color: #45a049;
        }

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
    <div class="addbook_main">

        <form class="addbook_form" action="" method="post" autocomplete="off" enctype="multipart/form-data">
            <input type="text" name="name" id="name" placeholder="Book Name" required><br>
        <input type="text" name="publisher" id="publisher" placeholder="Publisher" required><br>
        <input type="number" name="book_number" id="book_number" placeholder="Book Number" required><br>
        <select name="course" id="course" required>
            <option value="">Select Course</option>
            <option value="BSC.IT">BSC.IT</option>
            <option value="BAF">BAF</option>
            <option value="BMS">BMS</option>
            <option value="BMM">BMM</option>
            <option value="BCOM">BCOM</option>
            <option value="BA">BA</option>
            <option value="FYJC">FYJC</option>
            <option value="SYJC">SYJC</option>
            <option value="MCOM">MCOM</option>
            <!-- Add more options as needed -->
        </select><br>
        <select name="year" id="year" required>
            <option value="">Select Year</option>
            <option value="FY">FY</option>
            <option value="SY">SY</option>
            <option value="TY">TY</option>
            <!-- Add more options as needed -->
        </select><br>
        <select name="semester" id="semester" required>
            <option value="">Select Semester</option>
            <option value="sem 1">Semester 1</option>
            <option value="sem 2">Semester 2</option>
            <option value="sem 3">Semester 3</option>
            <option value="sem 4">Semester 4</option>
            <option value="sem 5">Semester 5</option>
            <option value="sem 6">Semester 6</option>
            <!-- Add more options as needed -->
        </select><br>
        <input type="file" name="image" id="image" required accept=".jpg, .png, .jpeg"><br>
        <input type="submit" name="submit" value="Add Book"><br>
    </form>
    
</div>
</body>
</html>
