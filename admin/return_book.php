<?php
include '../connection.php';

// Decode JSON input
$json = json_decode(file_get_contents("php://input"));

// Extract student ID and book number
$studentId = $json->student_id;
$bookNumber = $json->book_number;

// Perform database operation to return the book
$updateQuery = "UPDATE issued_books
                SET return_date = CURDATE()
                WHERE student_id = '$studentId' AND book_number = '$bookNumber'";

if ($conn->query($updateQuery) === TRUE) {
    // Fetch the book name from issued_books table
    $fetchBookNameQuery = "SELECT book_name FROM issued_books
                           WHERE student_id = '$studentId' AND book_number = '$bookNumber'";
    $result = $conn->query($fetchBookNameQuery);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bookName = $row['book_name'];
        
        // Insert the returned book information into the returned_books table
        $insertQuery = "INSERT INTO returned_books (student_id, book_number, book_name, return_date)
                        VALUES ('$studentId', '$bookNumber', '$bookName', CURDATE())";

        if ($conn->query($insertQuery) === TRUE) {
            // Once the book is returned, delete its entry from the issued_books table
            $deleteQuery = "DELETE FROM issued_books
                            WHERE student_id = '$studentId' AND book_number = '$bookNumber'";
            
            if ($conn->query($deleteQuery) === TRUE) {
                echo json_encode(array("success" => true, "message" => "Book returned successfully!"));
            } else {
                echo json_encode(array("success" => false, "message" => "Error returning book: " . $conn->error));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Error returning book: " . $conn->error));
        }
    } else {
        echo json_encode(array("success" => false, "message" => "Error fetching book name: " . $conn->error));
    }
} else {
    echo json_encode(array("success" => false, "message" => "Error returning book: " . $conn->error));
}

$conn->close();
?>
