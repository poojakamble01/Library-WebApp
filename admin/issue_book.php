<?php
include '../connection.php';

// Retrieve raw POST data and decode it
$json = json_decode(file_get_contents("php://input"));

// Extract data from JSON object
$student_id = $json->student_id;
$book_number = $json->book_number;
$issue_date = $json->issue_date;
$expiry_date = $json->expiry_date;

// Fetch student name
$stmt_student = $conn->prepare("SELECT username FROM reg WHERE student_id = ?");
$stmt_student->bind_param("s", $student_id);
$stmt_student->execute();
$stmt_student->bind_result($student_name);
$stmt_student->fetch();
$stmt_student->close();

// Fetch book name
$stmt_book = $conn->prepare("SELECT name FROM addbook WHERE book_number = ?");
$stmt_book->bind_param("s", $book_number);
$stmt_book->execute();
$stmt_book->bind_result($book_name);
$stmt_book->fetch();
$stmt_book->close();

// Prepare and execute SQL query to insert data into the table
$sql_insert = "INSERT INTO issued_books (student_id, student_name, book_number, book_name, issue_date, return_date) VALUES (?, ?, ?, ?, ?, ?)";
$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssssss", $student_id, $student_name, $book_number, $book_name, $issue_date, $expiry_date);

// Check if the query executed successfully
if ($stmt_insert->execute()) {
    echo "Book issued successfully!";
} else {
    echo "Error issuing book: " . $conn->error;
}

// Close statement
$stmt_insert->close();

// Close connection
$conn->close();
?>
