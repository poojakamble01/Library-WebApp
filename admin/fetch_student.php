<?php
include '../connection.php';

$json = json_decode(file_get_contents("php://input")); // json string
$student_id = $json->student_id;  

$sql = "SELECT * FROM reg WHERE student_id = '$student_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row); // Return student data as JSON
} else {
    echo json_encode(null); // Return null if no data found
}

$conn->close();
?>
