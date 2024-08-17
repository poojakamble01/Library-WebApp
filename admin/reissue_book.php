<?php
include '../connection.php';

// Decode JSON input
$json = json_decode(file_get_contents("php://input"));

// Extract student ID and book number
$studentId = $json->student_id;
$bookNumber = $json->book_number;

// Check if the book is issued to the student
$checkQuery = "SELECT * FROM issued_books WHERE student_id = '$studentId' AND book_number = '$bookNumber'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // Book is issued to the student, proceed with re-issuing it
    // Add 7 days to the current return date
    $updateQuery = "UPDATE issued_books 
                    SET return_date = DATE_ADD(return_date, INTERVAL 7 DAY) 
                    WHERE student_id = '$studentId' AND book_number = '$bookNumber'";

    if ($conn->query($updateQuery) === TRUE) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => $conn->error));
    }
} else {
    // Book is not issued to the student, cannot be re-issued
    echo json_encode(array("success" => false, "error" => "This book is not issued to the student."));
}

$conn->close();
?>
