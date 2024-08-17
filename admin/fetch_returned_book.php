<?php
include '../connection.php';

$json = json_decode(file_get_contents("php://input"));
$student_id = $json->student_id;  

$sql = "SELECT * FROM returned_books WHERE student_id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $books = array();
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    echo json_encode(['books' => $books]); // Return returned books data as JSON
} else {
    echo json_encode(['books' => null]); // Return null if no books returned by the student
}

$conn->close();
?>
