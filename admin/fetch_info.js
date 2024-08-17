// Fetch Student Data on Enter key press
document.getElementById("studentIdInput").addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        fetchStudentData();
    }
});

function fetchStudentData() {
    let studentId = document.getElementById("studentIdInput").value.trim();
    fetch('fetch_student.php', {
        method: 'POST',
        body: JSON.stringify({ student_id: studentId }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data !== null) {
                document.getElementById("studentName").value = data.username;
                document.getElementById("studentEmail").value = data.email;
                document.getElementById("studentContact").value = data.contact_number;
                document.getElementById("studentBarcode").value = data.barcode_number;

                // After fetching student data, fetch issued books and returned books
                fetchIssuedBooks(studentId);
                fetchReturnedBooks(studentId);
            } else {
                alert("Student not found");
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function fetchIssuedBooks(studentId) {
    fetch('fetch_assigned_book.php', {
        method: 'POST',
        body: JSON.stringify({ student_id: studentId }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data !== null) {
                displayIssuedBooks(data.books);
            } else {
                document.getElementById("issuedBooksList").innerHTML = "No books issued to this student.";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function displayIssuedBooks(books) {
    let issuedBooksList = document.getElementById("issuedBooksList");
    issuedBooksList.innerHTML = ""; // Clear previous content

    books.forEach(book => {
        let bookElement = document.createElement("div");
        // Concatenate all information into a single string
        let bookInfo = `Student Number: ${book.student_id}, Book Number: ${book.book_number}, Issue Date: ${book.issue_date}, Return Date: ${book.return_date}, Fine: ${book.fine}`;
        bookElement.textContent = bookInfo;
        issuedBooksList.appendChild(bookElement);
    });
}

// Function to fetch returned books
function fetchReturnedBooks(studentId) {
    fetch('fetch_returned_book.php', {
        method: 'POST',
        body: JSON.stringify({ student_id: studentId }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data !== null) {
                displayReturnedBooks(data.books);
            } else {
                document.getElementById("returnedBooksList").innerHTML = "No books returned by this student.";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Function to display returned books
function displayReturnedBooks(books) {
    let returnedBooksList = document.getElementById("returnedBooksList");
    returnedBooksList.innerHTML = ""; // Clear previous content

    books.forEach(book => {
        let bookElement = document.createElement("div");
        // Concatenate all information into a single string
        let bookInfo = `Student Number: ${book.student_id}, Book Number: ${book.book_number}, Return Date: ${book.return_date}, Fine: ${book.fine}`;
        bookElement.textContent = bookInfo;
        returnedBooksList.appendChild(bookElement);
    });
}

// Fetch Book Data on Enter key press
document.getElementById("bookNumberInput").addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        fetchBookData();
    }
});

function fetchBookData() {
    let bookNumber = document.getElementById("bookNumberInput").value;
    fetch('fetch_book.php', {
        method: 'POST',
        body: JSON.stringify({ book_number: bookNumber }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data !== null) {
                document.getElementById("bookName").value = data.name;
                document.getElementById("bookPublisher").value = data.publisher;
                document.getElementById("bookCourse").value = data.course;
                document.getElementById("bookYear").value = data.year;
            } else {
                alert("Book not found");
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// Issue Book on button click
document.getElementById("issueButton").addEventListener("click", function () {
    // Get student ID and book number
    var studentId = document.getElementById("studentIdInput").value.trim();
    var bookNumber = document.getElementById("bookNumberInput").value.trim();

    // Checking data
    if (studentId === "" || bookNumber === "") {
        alert("Please fill in all required fields.");
        return;
    }

    // Check if the book is already issued to the student
    fetch('check_book_issue.php', {
        method: 'POST',
        body: JSON.stringify({
            student_id: studentId,
            book_number: bookNumber
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.issued) {
                alert("This book is already issued to the student.");
            } else {
                // Get current date
                var currentDate = new Date().toISOString().slice(0, 10);

                // Calculate expiry date (add 2 weeks)
                var expiryDate = new Date();
                expiryDate.setDate(expiryDate.getDate() + 7);
                var expiryDateString = expiryDate.toISOString().slice(0, 10);

                // Issue book by sending a POST request
                fetch('issue_book.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        student_id: studentId,
                        book_number: bookNumber,
                        issue_date: currentDate,
                        expiry_date: expiryDateString
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (message) {
                        alert(message);
                        // After issuing the book, fetch issued books and returned books again
                        fetchIssuedBooks(studentId);
                        fetchReturnedBooks(studentId);
                    })
                    .catch(function (error) {
                        console.error("Error:", error);
                    });
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
});

// Re-issue Button Click Event
document.getElementById("reissueButton").addEventListener("click", function () {
    reissueBook();
});


// Function to re-issue the book
function reissueBook() {
    // Get student ID and book number
    var studentId = document.getElementById("studentIdInput").value.trim();
    var bookNumber = document.getElementById("bookNumberInput").value.trim();

    // Validate data
    if (studentId === "" || bookNumber === "") {
        alert("Please fill in all required fields.");
        return;
    }

    // Check if the book is issued to the student
    fetch('check_book_issue.php', {
        method: 'POST',
        body: JSON.stringify({
            student_id: studentId,
            book_number: bookNumber
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.issued) {
                // Re-issue the book
                fetch('reissue_book.php', {
                    method: 'POST',
                    body: JSON.stringify({ student_id: studentId, book_number: bookNumber }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            alert("Book re-issued successfully");
                            fetchIssuedBooks(studentId);
                        } else {
                            alert("Failed to re-issue book");
                        }
                    })
                    .catch(function (error) {
                        console.error("Error:", error);
                    });
            } else {
                alert("This book is not issued to the student.");
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
}

// Fetch Returned Books on Enter key press
document.getElementById("bookNumberInput").addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        fetchBookData();
        fetchIssuedBooks(document.getElementById("studentIdInput").value.trim());
        fetchReturnedBooks(document.getElementById("studentIdInput").value.trim());
    }
});
// Fetch Issued Books and Returned Books on page load
document.addEventListener("DOMContentLoaded", function () {
    let studentId = document.getElementById("studentIdInput").value.trim();
    fetchIssuedBooks(studentId);
    // Remove the fetchReturnedBooks call from here
});

// Return Button Click Event
document.getElementById("returnButton").addEventListener("click", function () {
    returnBook();
});

// Function to return the book
function returnBook() {
    // Get student ID and book number
    var studentId = document.getElementById("studentIdInput").value.trim();
    var bookNumber = document.getElementById("bookNumberInput").value.trim();

    // Validate data
    if (studentId === "" || bookNumber === "") {
        alert("Please fill in all required fields.");
        return;
    }

    // Check if the book is issued to the student
    fetch('check_book_issue.php', {
        method: 'POST',
        body: JSON.stringify({
            student_id: studentId,
            book_number: bookNumber
        }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.issued) {
                // Return the book
                fetch('return_book.php', {
                    method: 'POST',
                    body: JSON.stringify({
                        student_id: studentId,
                        book_number: bookNumber
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            alert("Book returned successfully");
                            // Fetch issued and returned books again
                            fetchIssuedBooks(studentId);
                            fetchReturnedBooks(studentId);
                        } else {
                            alert("Failed to return book");
                        }
                    })
                    .catch(function (error) {
                        console.error("Error:", error);
                    });
            } else {
                alert("This book is not issued to the student.");
            }
        })
        .catch(function (error) {
            console.error("Error:", error);
        });
}

