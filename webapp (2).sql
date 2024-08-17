-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 10:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `addbook`
--

CREATE TABLE `addbook` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `book_number` varchar(50) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `availability` varchar(20) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addbook`
--

INSERT INTO `addbook` (`id`, `name`, `publisher`, `image`, `book_number`, `course`, `year`, `semester`, `availability`) VALUES
(12, 'Communication & Soft Skills', 'Tech-Neo', 'Communication & Soft Skills.png', '1236', 'BSC.IT', 'FY', 'sem 1', 'Available'),
(13, 'Software Quality Assurance', 'Sheth', 'Software Quality Assurance.png', '1369', 'BSC.IT', 'TY', 'sem 6', 'Available'),
(14, 'Security in Computing', 'Tech Knowledge', 'Security in Computing.png', '1365', 'BSC.IT', 'TY', 'sem 6', 'available'),
(15, 'Business Intelligence', 'Sheth', 'Business Intelligence.png', '1368', 'BSC.IT', 'TY', 'sem 6', 'available'),
(16, 'Enterprise Networking', 'Tech Knoledege', 'Enterprise Networking.png', '1364', 'BSC.IT', 'TY', 'sem 6', 'available'),
(17, 'Cyber Laws', 'Sheth', 'Cyber Laws.png', '1367', 'BSC.IT', 'TY', 'sem 6', 'available'),
(18, 'Advanced Java', 'Tech-Neo', 'Advanced Java.png', '1501', 'BSC.IT', 'TY', 'sem 5', 'available'),
(19, 'Project Management', 'Tech Knowledge', 'Project Management.png', '1502', 'BSC.IT', 'TY', 'sem 5', 'available'),
(20, 'Digital Elecrronics', 'Sheth', 'Digital Elecrronics.png', '1105', 'BSC.IT', 'FY', 'sem 1', 'Available'),
(21, 'Core Java', 'Sheth', 'Core Java.png', '1401', 'BSC.IT', 'SY', 'sem 4', 'Available'),
(22, 'Operating System', 'Sheth', 'Operating System.png', '1105', 'BSC.IT', 'FY', 'sem 1', 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `stream` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `stream`) VALUES
(1, 'BSC.IT', 'SFC'),
(2, 'BAF', 'SFC'),
(3, 'BMS', 'SFC'),
(4, 'BMM', 'SFC'),
(5, 'BCOM', 'Degree'),
(6, 'BA', 'Degree'),
(7, 'FYJC', 'Junior'),
(8, 'SYJC', 'Junior'),
(9, 'MCVC', 'Junior'),
(10, 'MCOM', 'Masters');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(25, 'rohit', 'b@gmail.com', 'asd', '2024-03-22 15:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `issuebookbyuser`
--

CREATE TABLE `issuebookbyuser` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `issued_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expirydate` date DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issuebookbyuser`
--

INSERT INTO `issuebookbyuser` (`id`, `book_id`, `book_name`, `publisher`, `username`, `course`, `year`, `semester`, `issued_at`, `expirydate`, `student_id`) VALUES
(20, 20, 'Digital Elecrronics', 'Sheth', 'rohit', 'BSC.IT', 'FY', '', '2024-04-30 13:42:30', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `book_number` varchar(50) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date NOT NULL,
  `fine` decimal(10,2) DEFAULT 0.00,
  `student_name` varchar(255) DEFAULT NULL,
  `book_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`id`, `student_id`, `book_number`, `issue_date`, `return_date`, `fine`, `student_name`, `book_name`) VALUES
(12, 1, '3698', '2024-04-08', '2024-04-22', 0.00, 'rohit', 'EN'),
(13, 5, '0987', '2024-04-08', '2024-04-15', 0.00, 'roja', 'Iot'),
(14, 5, '3021', '2024-04-08', '2024-04-15', 0.00, 'roja', 'Computer Networking');

--
-- Triggers `issued_books`
--
DELIMITER $$
CREATE TRIGGER `calculate_fine_trigger` AFTER UPDATE ON `issued_books` FOR EACH ROW BEGIN
    DECLARE days_overdue INT;
    DECLARE fine_amount DECIMAL(10, 2);

    IF NEW.return_date > OLD.return_date AND OLD.fine IS NULL THEN
        SET days_overdue = DATEDIFF(NEW.return_date, OLD.return_date);
        SET fine_amount = days_overdue; 

        SET fine_amount = fine_amount * 1.0;  
        
        UPDATE issued_books
        SET fine = fine_amount
        WHERE id = NEW.id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `student_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `barcode_number` varchar(20) DEFAULT NULL,
  `type` enum('student','faculty','librarian') NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg`
--

INSERT INTO `reg` (`student_id`, `username`, `email`, `password`, `contact_number`, `barcode_number`, `type`) VALUES
(1, 'rohit', 'Rohit@gmail.com', '$2y$10$FXQXED.8xjpanVSE11hyRu90VIY4xcisPU/kyPaJHKJV0Yfw3oI3m', '9874563210', '0123698547', 'student'),
(5, 'roja', 'roja@gmail.com', '$2y$10$1BhRY/zctZ/1kEsRbgexvObulietWENbYk44g53g8no2ZNz6LwmxW', '9632587410', '45698741', 'student'),
(6, 'chaitanya', 'chakat@gmail.con', '$2y$10$uzntnqk92M4JevpHgkfajuarZwqhNsO7a4rHvhh38ab/.t25GLnAu', '9856445557', '45698741', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `email`, `password`) VALUES
('r', 'r@gmail.com', 'p'),
('rohit', 'poojasecondacc27@gmail.com', 'asd'),
('bhumi', 'b@gmail.com', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `returned_books`
--

CREATE TABLE `returned_books` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `book_number` int(11) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `fine` decimal(10,2) DEFAULT 0.00,
  `book_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returned_books`
--

INSERT INTO `returned_books` (`id`, `student_id`, `book_number`, `return_date`, `fine`, `book_name`) VALUES
(3, 5, 3698, '2024-04-08', 0.00, 'EN'),
(4, 1, 1236, '2024-04-11', 0.00, 'Communication & Soft Skills');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'rohit', 'rohitbari2027@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addbook`
--
ALTER TABLE `addbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issuebookbyuser`
--
ALTER TABLE `issuebookbyuser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `returned_books`
--
ALTER TABLE `returned_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addbook`
--
ALTER TABLE `addbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `issuebookbyuser`
--
ALTER TABLE `issuebookbyuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reg`
--
ALTER TABLE `reg`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `returned_books`
--
ALTER TABLE `returned_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issuebookbyuser`
--
ALTER TABLE `issuebookbyuser`
  ADD CONSTRAINT `issuebookbyuser_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `addbook` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
