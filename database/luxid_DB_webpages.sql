-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 10, 2024 at 09:17 AM
-- Server version: 10.6.16-MariaDB-1:10.6.16+maria~ubu2004
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luxid_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `topic`, `comment`, `date_time`, `user_id`) VALUES
(3, 'why game broken?', 'whyyyyyyyyyyy', '2024-02-22 08:34:20', 1),
(4, 'เกมแลคมาก', 'ทำไมเกมแลคครับ หรือเป็นที่เครื่องผม', '2024-02-22 08:49:04', 32),
(5, 'test katoo', 'katoo is work?', '2024-02-23 06:19:32', 32),
(6, 'Hello', 'how are you?', '2024-02-24 07:21:20', 32),
(8, 'how to pass hard mode', 'it\'s so hard', '2024-03-03 09:42:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `replies_id` int(11) NOT NULL,
  `replies_comment` varchar(255) NOT NULL,
  `replies_time` datetime NOT NULL DEFAULT current_timestamp(),
  `replies_username` varchar(255) NOT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`replies_id`, `replies_comment`, `replies_time`, `replies_username`, `post_id`) VALUES
(2, 'test agian', '2024-02-23 07:02:30', 'golf', 5),
(3, 'test 2', '2024-02-23 07:22:49', 'peepo', 5),
(4, 'meow', '2024-02-23 08:28:37', 'peepoo', 5),
(5, 'yawn', '2024-02-23 08:31:21', 'peepoo', 5),
(9, 'gg', '2024-02-23 08:37:10', 'peepoo', 5),
(10, 'hum', '2024-02-23 08:37:20', 'peepoo', 5),
(11, 'ayo\n', '2024-02-24 15:15:10', 'peepoo', 3),
(12, 'WTF', '2024-02-24 15:40:03', 'peepoo', 3),
(13, 'เปิด GPU รึยังครับ', '2024-02-24 16:38:35', 'peepoo', 4);

-- --------------------------------------------------------

--
-- Table structure for table `static_data`
--

CREATE TABLE `static_data` (
  `data_id` int(11) NOT NULL,
  `score_play` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `static_data`
--

INSERT INTO `static_data` (`data_id`, `score_play`, `user_id`) VALUES
(1, 5, 1),
(2, 1, 2),
(13, 0, 32),
(14, 0, 33),
(15, 0, 34),
(16, 0, 35),
(17, 0, 36);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone`) VALUES
(1, 'golf', '12345', 'peeranut5657@gmail.com', '0853487812'),
(2, 'MikoSama', '1166', 'peeranut6789@gmail.com', '0816540332'),
(32, 'peepoo', '1123', 'test@mail', '0897828265'),
(33, 'supakorn', '2233', 'eiei@gg', '0878451237'),
(34, 'frank', '0123', 'franky007@gmail.com', '0948537615'),
(35, 'test', '45678', 'longtest@gmail.com', '0853459725'),
(36, 'tong', '3456', 'tong@gmail.com', '0654897234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_c4f9a7bd77b489e711277ee5986` (`user_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`replies_id`),
  ADD KEY `FK_3f53ba89a89b9cea8b9dd9286dc` (`post_id`);

--
-- Indexes for table `static_data`
--
ALTER TABLE `static_data`
  ADD PRIMARY KEY (`data_id`),
  ADD UNIQUE KEY `REL_b7a3769650a85e61b695bb8842` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `replies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `static_data`
--
ALTER TABLE `static_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `FK_c4f9a7bd77b489e711277ee5986` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `FK_3f53ba89a89b9cea8b9dd9286dc` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `static_data`
--
ALTER TABLE `static_data`
  ADD CONSTRAINT `FK_b7a3769650a85e61b695bb8842e` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
