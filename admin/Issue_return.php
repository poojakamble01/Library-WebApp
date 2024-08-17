<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Library Management System</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      height: 100vh;
      margin: 0;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 80%;
    }

    .half-page {
      flex: 1;
      padding: 20px;
    }

    .input-box {
      margin-bottom: 15px;
    }

    button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background-color: #007bff;
      color: #fff;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }

    input[type="text"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus {
      outline: none;
      border-color: #007bff;
    }

    input[disabled] {
      background-color: #f5f5f5;
    }

    .button-container {
      display: flex;
      gap: 10px;
      justify-content: end;
      width: 80%;
    }

    .issued-books {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
      /* Added margin for spacing */
    }

    /* Added CSS for the "Return Books" section */
    .return-books {
      display: flex;
      flex-direction: column;
      margin-top: 20px;
    }
    .display-books{
      width: 100%;
      display: flex;
      justify-content: space-around;
    }
  </style>
</head>

<body>
  <h1> Issue And Return Book</h1>
  <div class="button-container">
    <button id="issueButton">Issue</button>
    <button id="returnButton">Return</button>
    <button id="reissueButton">Re-issue</button>
  </div>
  <div class="container">
    <div class="half-page">
      <h2>Student Details</h2>
      <form id="studentForm" action="issue_book.php" method="POST">
        <div class="input-box">
          <input id="studentIdInput" type="text" name="student_id" placeholder="Student ID">
        </div>
      </form>
      <!-- Input boxes for displaying fetched student data -->
      <div class="input-box">
        <input id="studentName" type="text" name="student_name" placeholder="Name" >
      </div>
      <div class="input-box">
        <input id="studentEmail" type="text" name="student_email" placeholder="Email" disabled>
      </div>
      <div class="input-box">
        <input id="studentContact" type="text" name="student_contact" placeholder="Contact Number" disabled>
      </div>
      <div class="input-box">
        <input id="studentBarcode" type="text" name="student_barcode" placeholder="Barcode Number" disabled>
      </div>
    </div>
    <div class="half-page">
      <h2>Book Details</h2>
      <form id="bookForm" method="POST">
        <div class="input-box">
          <input id="bookNumberInput" type="text" name="book_number" placeholder="Book Number">
        </div>
      </form>
      <!-- Input boxes for displaying fetched book data -->
      <div class="input-box">
        <input id="bookName" type="text" name="book_name" placeholder="Book Name" >
      </div>

      <div class="input-box">
        <input id="bookPublisher" type="text" name="book_publisher" placeholder="Publisher" disabled>
      </div>

      <div class="input-box">
        <input id="bookCourse" type="text" name="book_course" placeholder="Course" disabled>
      </div>

      <div class="input-box">
        <input id="bookYear" type="text" name="book_year" placeholder="Year" disabled>
      </div>

    </div>
  </div>

  <div class="display-books" id="display-books">

    <div class="issued-books">
      <h2>Issued Books</h2>
      <div id="issuedBooksList"></div>
    </div>
    <div class="return-books"> <!-- Added "Return Books" section -->
      <h2>Returned Books</h2>
      <div id="returnedBooksList"></div>
    </div>
  </div>

  <script src="./fetch_info.js"></script>
</body>

</html>