<?php
// Database connection
include '../connection.php';

// Fetch course data from the database based on different streams
$streams = array("SFC", "Degree", "Junior", "Masters");

$courses = array();
foreach ($streams as $stream) {
    $query = "SELECT * FROM courses WHERE stream='$stream'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[$stream][] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Page</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
        }

        /* Course list styles */
        .course-list {
            margin-bottom: 40px;
        }

        .course-list h1 {
            margin-bottom: 10px;
        }

        .course-list ul {
            display: flex;
            flex-wrap: wrap;
            /* gap: 10px; */
            justify-content: space-evenly;
        }

        /* .course-list li {
            flex: 1 1 200px;
        } */

        .course-list button {
            display: block;
            width: 11rem;
            padding: 10px;
            border: none;
            background-color: #039;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            height: 9rem;
            transition:  0.3s ease;
        }
        
        .course-list button:hover {
            background-color: #0056b3;
            transform: translateY(-10px);
            transition:  0.3s ease;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Close button styles */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Button styles */
        .button-container {
            text-align: center;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }


        /* Input styles */
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Styling for the overlay */
        body.modal-open {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; margin: 20px; ">Select Your Course</h1>
    <div class="container">
        <?php foreach ($streams as $stream): ?>
            <div class="course-list">
                <h1><?php echo $stream; ?> Courses</h1>
                <ul>
                    <?php foreach ($courses[$stream] as $course): ?>
                        <li><button
                                onclick="openModal('<?php echo $course['course_name']; ?>')"><?php echo $course['course_name']; ?></button>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal dialog -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Select Year and Semester</h2>
            <select id="year">
                <option value="FY">FY</option>
                <option value="SY">SY</option>
                <option value="TY">TY</option>
            </select>
            <select id="semester">
                <option value="SEM 1">SEM 1</option>
                <option value="SEM 2">SEM 2</option>
                <option value="SEM 3">SEM 3</option>
                <option value="SEM 4">SEM 4</option>
                <option value="SEM 5">SEM 5</option>
                <option value="SEM 6">SEM 6</option>
            </select>
            <div class="button-container">
                <button onclick="selectYearAndSemester()">Select</button>
            </div>
        </div>
    </div>

    <script>
        // Function to open modal
        function openModal(course) {
            document.getElementById('myModal').style.display = 'block';
            // Highlight the clicked button
            var courseButtons = document.querySelectorAll('.course-list button');
            for (var i = 0; i < courseButtons.length; i++) {
                if (courseButtons[i].textContent === course) {
                    courseButtons[i].classList.add('active');
                } else {
                    courseButtons[i].classList.remove('active');
                }
            }
        }

        // Function to close modal
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        // Function to select year and semester
        function selectYearAndSemester() {
            var year = document.getElementById('year').value;
            var semester = document.getElementById('semester').value;
            var course = ""; // Initialize the course variable

            // Get the selected course
            var activeButton = document.querySelector('.course-list button.active');
            if (activeButton) {
                course = activeButton.textContent;
            }

            if (year && semester && course) {
                // Redirect to the add book page with course, year, and semester parameters
                window.location.href = 'book.php?course=' + course + '&year=' + year + '&semester=' + semester;
            } else {
                alert('Please select course, year, and semester.');
            }

            // Close the modal
            closeModal();
        }
    </script>
</body>

</html>