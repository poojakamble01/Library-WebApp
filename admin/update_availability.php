<?php
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $availability = $_POST['availability'];
    
    // Update availability in the database
    $query = "UPDATE addbook SET availability='$availability' WHERE id=$book_id";
    mysqli_query($conn, $query);
    
    // Redirect back to the page
    header("Location: data.php");
    exit();
}
?>
