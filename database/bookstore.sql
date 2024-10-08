-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 12:23 PM
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
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT '/placeholder.svg',
  `in_stock` tinyint(1) DEFAULT 1,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `price`, `image`, `in_stock`, `image_path`) VALUES
(1, 'The Great Gatsby', 'F. Scott Fitzgerald', 12.99, 'TheGreatGatsby.png', 1, 'images/TheGreatGatsby.png'),
(2, 'To Kill a Mockingbird', 'Harper Lee', 9.99, 'ToKillaMockingbird.png', 1, 'images/ToKillaMockingbird.png'),
(3, '1984', 'George Orwell', 8.99, '/placeholder.svg', 0, 'images/1984.jpg'),
(4, 'Pride and Prejudice', 'Jane Austen', 11.99, '/placeholder.svg', 1, 'images/PrideandPrejudice.jpg'),
(5, 'The Catcher in the Rye', 'J.D. Salinger', 10.99, '/placeholder.svg', 1, 'images/TheCatcherintheRye.jpg'),
(6, 'Moby Dick', 'Herman Melville', 14.99, '/placeholder.svg', 1, 'images/MobyDick.jpg'),
(7, 'The Hobbit', 'J.R.R. Tolkien', 13.99, '/placeholder.svg', 1, 'images/TheHobbit.jpg'),
(8, 'The Adventures of Sherlock Holmes', 'Arthur Conan Doyle', 7.99, '/placeholder.svg', 1, 'images/The Adventures of Sherlock Holmes.jpg'),
(9, 'The Brothers Karamazov', 'Fyodor Dostoevsky', 15.99, '/placeholder.svg', 0, 'images/The Brothers Karamazov.jpg'),
(11, 'Frankenstein', 'Mary Shelley', 6.99, '/placeholder.svg', 1, 'images/51rLBY062KL._SY780_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
