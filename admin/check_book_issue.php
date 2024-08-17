<?php
include '../connection.php';

// Decode JSON input
$json = json_decode(file_get_contents("php://input"));

// Extract student ID and book number
$studentId = $json->student_id;
$bookNumber = $json->book_number;

// Perform a database query to check if the book is already issued to the student
$query = "SELECT * FROM issued_books WHERE student_id = '$studentId' AND book_number = '$bookNumber'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Book is already issued to the student
    echo json_encode(array("issued" => true));
} else {
    // Book is not issued to the student yet
    echo json_encode(array("issued" => false));
}

$conn->close();
?>
