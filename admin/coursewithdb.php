<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Course</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 500px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-group input[type="text"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .form-group select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
    }
    .btn {
        display: inline-block;
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Add Course</h2>
    <form action="#" method="post">
        <div class="form-group">
            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" placeholder="Enter course name" required>
        </div>
        <div class="form-group">
            <label for="stream">Stream:</label>
            <select id="stream" name="stream" required>
                <option value="">Select stream</option>
                <option value="Degree">Degree</option>
                <option value="SFC">SFC</option>
                <option value="Junior">Junior</option>
                <option value="Masters">Masters</option>
            </select>
        </div>
        <button type="submit" class="btn">Add Course</button>
    </form>
</div>




<?php
include '../connection.php';
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $stream = $_POST['stream'];

    // Insert data into database
    $sql = "INSERT INTO courses (course_name, stream) VALUES ('$course_name', '$stream')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>New course added successfully!</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

</body>
</html>
