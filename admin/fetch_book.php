<?php
include '../connection.php';

 // Fetch book data based on the provided book number

$json = json_decode(file_get_contents("php://input")); // json string
$book_number = $json -> book_number;  
$sql = "SELECT * FROM addbook WHERE book_number = '$book_number'";
$result = $conn->query($sql);

// $book_number = $_POST['book_number'];  
// $sql = "SELECT * FROM book WHERE book_number = '$book_number'";
// $result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); // Return book data as JSON
} else {
    echo json_encode(null); // Return null if no data found
}

$conn->close();
?>
