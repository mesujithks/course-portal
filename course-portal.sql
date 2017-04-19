-- phpMyAdmin SQL Dump
-- version 4.6.6deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2017 at 09:03 PM
-- Server version: 5.6.27-2
-- PHP Version: 5.6.17-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `course-portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `conentId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(1000) NOT NULL,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`conentId`, `cId`, `title`, `body`, `post_date`) VALUES
(1, 2, 'test', 'test body', '2017-04-19 20:11:32'),
(2, 1, 'title c++', 'body c++', '2017-04-19 20:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseId` int(11) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `shortD` varchar(100) NOT NULL,
  `longD` varchar(1000) NOT NULL,
  `courseImage` varchar(100) NOT NULL DEFAULT 'images/default-c.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseId`, `courseName`, `shortD`, `longD`, `courseImage`) VALUES
(1, 'C++', 'Basic C++', 'simple c++', 'images/default-c.jpg'),
(2, 'Java', 'basic java', 'simple', 'images/default-c.jpg'),
(4, 'Php', 'basic php', 'simple php', 'images/default-c.jpg'),
(5, 'Python', 'basic python', 'simple python', 'images/default-c.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courses_taken`
--

CREATE TABLE `courses_taken` (
  `stdId` int(11) NOT NULL,
  `crsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentId` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `college` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT 'Male'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentId`, `fname`, `lname`, `address`, `phone`, `college`, `dob`, `gender`) VALUES
(15, 'Sujith', 'K S', '17/2053, Kandathiparambu,\r\nPalluruthy PO, Perumpadappu,\r\nKochi-682006', '9656008103', 'College of engineering, Cherthala', '1997-12-05', 'Male'),
(20, 'George', 'Martin', '', '9876543210', 'College of engineering, Cherthala', '1997-07-10', 'Male'),
(22, 'Ajaydev', 'K U', 'kandathiparambu', '9037861390', 'College of engineering, Cherthala', '1997-04-22', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type`, `trn_date`) VALUES
(4, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2017-04-13 07:48:53'),
(15, 'sujith', 'mesujithks@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'student', '2017-04-15 04:36:13'),
(20, 'george', 'george@gmail.com', 'c37bf859faf392800d739a41fe5af151', 'student', '2017-04-17 20:12:08'),
(22, 'ajay', 'ajaydev842@gmail.com', '9e94b15ed312fa42232fd87a55db0d39', 'student', '2017-04-17 20:22:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`conentId`),
  ADD KEY `cId` (`cId`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseId`),
  ADD UNIQUE KEY `courseName` (`courseName`);

--
-- Indexes for table `courses_taken`
--
ALTER TABLE `courses_taken`
  ADD KEY `courses_taken_ibfk_1` (`stdId`),
  ADD KEY `courses_taken_ibfk_2` (`crsId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `conentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`cId`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses_taken`
--
ALTER TABLE `courses_taken`
  ADD CONSTRAINT `courses_taken_ibfk_1` FOREIGN KEY (`stdId`) REFERENCES `students` (`studentId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_taken_ibfk_2` FOREIGN KEY (`crsId`) REFERENCES `courses` (`courseId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
