<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Books</title>
    <style>
        /* Your CSS styles here */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #e7eaf6;
        }

        .booksContainer {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .course-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .course-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .books {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .bok {
            width: 240px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .bok:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .book-img {
            width: 100%;
            height: 200px;
            /* Set a fixed height for the image container */
            overflow: hidden;
            /* Hide any overflow to prevent distortion */
            display: flex;
            align-items: center;
            /* Center the image vertically */
            justify-content: center;
            /* Center the image horizontally */
        }

        .book-img img {
            max-width: 100%;
            /* Make the image fill the container horizontally */
            max-height: 100%;
            /* Ensure the image does not exceed the container's height */
            height: auto;
            /* Maintain the aspect ratio */
            display: block;
            /* Ensure proper alignment */
        }

        .book-info {
            padding: 10px;
        }

        .book-info span {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
        }


        .book-info span:hover {
            color: #007bff;
            cursor: pointer;
        }

        .book-img img:hover {
            transform: scale(1.05);
        }

        h2:hover {
            color: #007bff;
            cursor: pointer;
        }

        h1:hover {
            color: #007bff;
            cursor: pointer;
        }

        .sfc:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="booksContainer">
        <?php
        // Include the database connection file
        include '../connection.php';

        // SQL query to fetch book details ordered by year in descending order
        $sql = "SELECT * FROM addbook ORDER BY 
        CASE
            WHEN year = 'TY' THEN 1
            WHEN year = 'SY' THEN 2
            WHEN year = 'FY' THEN 3
        END";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $books_by_course = array(); // Array to hold books grouped by course
        
            // Group books by course
            while ($row = $result->fetch_assoc()) {
                $course = $row["year"];
                $section = $row["course"];
                $books_by_course[$course][$section][] = $row;
            }

            // Output books grouped by course and section
            foreach ($books_by_course as $course => $sections) {
                echo '<div class="course-container">';
                echo '<h2 class="course-name">' . $course . '</h2>';
                foreach ($sections as $section => $books) {
                    echo '<div class="course-section">';
                    echo '<h3>' . $section . '</h3>';
                    echo '<div class="books">';
                    foreach ($books as $book) {
                        echo '<div class="bok">
                    <div class="book-img">
                        <img src="../Img/' . $book["image"] . '" width="100" title="' . $book["image"] . '">
                    </div>
                    <div class="book-info">
                        <span> Name: ' . $book["name"] . '</span>
                        <span> Publisher: ' . $book["publisher"] . '</span>
                        <span> Book Number: ' . $book["book_number"] . '</span>
                        <span> Year: ' . $book["year"] . '</span>
                        <span> Availability: ' . $book["availability"] . '</span>
                    </div>
                </div>';
                    }
                    echo '</div></div>';
                }
                echo '</div>';
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>


    </div>
</body>

</html>