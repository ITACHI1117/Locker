-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 04:54 PM
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
-- Database: `locker`
--

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

CREATE TABLE `hod` (
  `id` varchar(300) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`id`, `password`) VALUES
('1', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expires_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uploaded_file`
--

CREATE TABLE `uploaded_file` (
  `id` varchar(300) NOT NULL,
  `matric` varchar(300) NOT NULL,
  `filename` varchar(300) NOT NULL,
  `file` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uploaded_file`
--

INSERT INTO `uploaded_file` (`id`, `matric`, `filename`, `file`) VALUES
('663e285f45f6dde2e', '200502009', 'My document2', 'uploads/100 1.docx'),
('663e2bb81e19bda24', '200502009', 'My document', 'uploads/188pj-01-10-2019-11-31-10.jpg'),
('663e2e585c5955ce4', '20052074', 'My document Ik', 'uploads/PETRO DATA SALARY ACCOUNT INFORMATION FORM_130116 (1).pdf'),
('663e2e78a4f65f9f2', '20052074', 'Ik 2', 'uploads/automata theory.txt'),
('663e35f88b52ed715', '20052074', 'DOCUMENT3', 'uploads/.gitignore'),
('663e7af5a3c6cda0e', '200502009', 'DOCUMENT3', 'uploads/400 1.docx'),
('66476003b09713a92', '200502009', 'document', 'uploads/300 1.docx'),
('664b629f59a60f92e', '200502047', 'My document', 'uploads/200 1.docx'),
('664cb6be567dd4783', '200502089', 'document1', 'uploads/firstfile.txt'),
('664e0e8c221d3971f', '200502047', 'CSC405', 'uploads/Transcript for 20052049.pdf'),
('664e11c914ba1bb80', '200502009', 'CSC405', 'uploads/automata theory.txt');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` varchar(300) NOT NULL,
  `firstname` varchar(300) NOT NULL,
  `lastname` varchar(300) NOT NULL,
  `matric` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `level` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `matric`, `email`, `level`, `password`) VALUES
('6658c5b7adaeb9dd4', 'Joseph', 'Ajogu', '200502009', 'ajogujoseph0317@gmail.com', '400', '$2y$10$Gwwz9q0LxgwK9mwyEAK.dezNPrsTyfrc4z5zIYB169xiTCSGh3Oly'),
('664e0e5dee851464a', 'Precious', 'Olabimi', '200502047', '', '400', '$2y$10$e9T8cOtfg1PBOMxuKNqA7OUfqndtsZOjYzfhnuMmzfa9TSwCYgjrS'),
('664cb61c8e9e3c5e8', 'Daniel', 'Anthony', '200502089', '', '100', '$2y$10$zj8Mn9Wj9cBm.t6PaHTWles.hnJHZZ6TRAa./Gk8tyfuWNhLoX6q.'),
('664d68d00a24a5029', 'Joy', 'Jannet', '200502099', '', '300', '$2y$10$7sGxYPkZqzP9Xv1QagNvJ./yp81YqJgP7zolsWVujaPgx2Zb080ye'),
('664d686e7225ef258', 'Daniel', 'Regina', '20050259', '', '100', '$2y$10$hH6vFksgsKBXrBsjUwzQKeBfnabxhK9LPR0vIl2IA.jPSuW5J5nvm'),
('664cb70130a7c3390', 'Real', 'Tems', '20050290', '', '400', '$2y$10$qxcjwbbuLsZnDyDijMULJeHRl3p1IoHbG991IUia6uES.KX1wIt/a'),
('664d6898bb10fd23a', 'John', 'jane', '2005080', '', '200', '$2y$10$2rZmZ7opTgeSSOxe0VPxf.xZor.i4FoNPBI060RPhzlm2.mlkM/2i');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uploaded_file`
--
ALTER TABLE `uploaded_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`matric`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
