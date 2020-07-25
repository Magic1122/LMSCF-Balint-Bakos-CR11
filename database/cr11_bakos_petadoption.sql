-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2020 at 11:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cr11_bakos_petadoption`
--
CREATE DATABASE IF NOT EXISTS `cr11_bakos_petadoption` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `cr11_bakos_petadoption`;

-- --------------------------------------------------------

--
-- Table structure for table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE `animal` (
  `animal_id` int(11) NOT NULL,
  `animal_name` varchar(255) NOT NULL,
  `animal_age` int(11) NOT NULL,
  `animal_desc` text NOT NULL,
  `animal_img` text NOT NULL,
  `animal_hobbies` varchar(255) NOT NULL,
  `animal_date` date NOT NULL DEFAULT current_timestamp(),
  `fk_type_id` int(11) NOT NULL,
  `fk_breed_id` int(11) NOT NULL,
  `fk_location_id` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal`
--

INSERT INTO `animal` (`animal_id`, `animal_name`, `animal_age`, `animal_desc`, `animal_img`, `animal_hobbies`, `animal_date`, `fk_type_id`, `fk_breed_id`, `fk_location_id`, `fk_user_id`) VALUES
(1, 'Catty', 9, 'Really fluffy', 'https://katzenheim-freudenau.at/wp-content/uploads/katzenheim_slide_7.jpg', 'Sleeping', '2019-06-15', 3, 2, 3, 1),
(2, 'Mancs', 4, 'Really fluffy', 'https://katzenheim-freudenau.at/wp-content/uploads/katzenheim_slide_2.jpg', 'Bird-catching', '2020-07-15', 1, 2, 3, 1),
(3, 'Fluffy', 2, 'Really fluffy', 'https://katzenheim-freudenau.at/wp-content/uploads/katzenheim_slide_5l.jpg', 'Destroying things', '2020-07-04', 1, 2, 3, 1),
(4, 'Boby', 10, 'Best Dog ever, super fluffy', 'https://www.telegraph.co.uk/content/dam/Pets/spark/royal-canin/jasper-the-dog.jpg?imwidth=450', 'Cat-catching', '2020-05-04', 3, 1, 1, 1),
(5, 'Tucker', 4, 'Best Dog ever, super fluffy', 'https://jelenadogshows.com/eng/wp-content/uploads/2020/04/Labrador.jpg', 'Cat-catching', '2020-07-23', 2, 1, 2, 1),
(6, 'Lucy', 1, 'Best Dog ever, super fluffy', 'https://vetstreet-brightspot.s3.amazonaws.com/24/d78ff0a80311e0a0d50050568d634f/file/Samoyed-2-645mk062811.jpg', 'Cat-catching', '2020-07-01', 2, 1, 2, 1),
(7, 'Pety', 6, 'Flies like a bird', 'https://www.haziallat.hu/diszmadarak/3678/nagykep_916x515/allapitsuk-meg-a-papagaj-egeszseget-a-tollazatarol.jpg', 'Flying', '2020-07-27', 1, 3, 1, 1),
(8, 'Sophie', 9, 'Lovely cat lady', 'https://media.4-paws.org/8/e/6/2/8e62da6a9d8c3544e256ba650f90157678157b50/maine-coon-cat-2228866_1920-1920x1329.jpg', 'Catting', '2020-07-01', 3, 2, 3, 1),
(9, 'Corgi', 7, 'Small legs, big heart', 'https://i.imgur.com/ICSfqEZl.jpg', 'Running', '2020-07-21', 1, 1, 1, 1),
(12, 'Balint', 4, 'Super Dog', 'https://s3.amazonaws.com/cdn-origin-etr.akc.org/wp-content/uploads/2017/11/16105011/English-Cocker-Spaniel-Slide03.jpg', 'Coding', '2020-07-10', 2, 1, 1, 1),
(13, 'Birdy', 2, 'I am a yellow canary', 'https://cdn.packetlabs.net/wp-content/uploads/2020/01/22160433/canary-breach-detection.jpg', 'Worm cathing', '2020-06-02', 1, 3, 2, 1),
(14, 'Fernando', 4, 'My fur is the softest', 'https://alpakkagausdal.no/uploads/XHmD038H/767x0_2560x0/1476187030759.Scale.h-248.Save.png', 'Walking', '2020-05-15', 2, 8, 5, 1),
(15, 'Tema', 10, 'I like to eat everything from the trash', 'https://images.ladbible.com/thumbnail?type=jpeg&url=https://www.unilad.co.uk/wp-content/uploads/2018/09/Screen-Shot-2018-05-29-at-14.42.57-828x535.png&quality=70&height=700', 'Sleeping', '2020-07-22', 3, 9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

DROP TABLE IF EXISTS `breed`;
CREATE TABLE `breed` (
  `breed_id` int(11) NOT NULL,
  `breed` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breed_id`, `breed`) VALUES
(8, 'alpaca'),
(3, 'bird'),
(2, 'cat'),
(1, 'dog'),
(7, 'horse'),
(9, 'raccoon'),
(4, 'reptile');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `location_city` varchar(255) NOT NULL,
  `location_zip` int(11) NOT NULL,
  `location_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `location_address`, `location_city`, `location_zip`, `location_img`) VALUES
(1, 'TierQuarTier Wien', 'Süßenbrunner Straße 101', 'Vienna', 1220, 'https://www.tierquartier.at/assets/images/logo-tierquartier.png'),
(2, 'TIERSCHUTZHAUS IN VÖSENDORF', 'Triester Straße 8', 'Vösendorf', 2331, 'https://www.tierschutz-austria.at/wp-content/uploads/2020/06/WTV-wird-zu-TA-800x600-1.jpg'),
(3, 'Katzenheim Freudenau', 'Freudenau 69', 'Vienna', 1020, 'https://katzenheim-freudenau.at/wp-content/uploads/pate_bild-1-Kopie.png'),
(5, 'Alpakazucht Siebenhirten', 'Josefsweg 4 Beschilderung Schlösslgasse folgen', 'Siebenhirten', 2130, 'https://i.pinimg.com/originals/3d/80/bd/3d80bdae9f30d2665427afe16f244757.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE `type` (
  `type_id` int(11) NOT NULL,
  `type` enum('small','large','senior') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type`) VALUES
(1, 'small'),
(2, 'large'),
(3, 'senior');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `root` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `admin`, `root`) VALUES
(1, 'Balint Bakos', 'balint.bb@gmail.com', '$2y$10$PS3ur8zRfppX0wHEyssEeOYFk3pFWTnGPhxEOKWc606BkLylFzeO6', '2020-07-24 10:47:28', 1, 1),
(2, 'Magic', 'magic@gmail.com', '$2y$10$PQQAC5sx1fIA/qHY9F.5SuDcmZ0KWvB1pAnhEQMrFVDgYWbsEphS.', '2020-07-24 11:06:48', 1, 0),
(4, 'Test', 'user1@gmail.com', '$2y$10$0/T5dbnNC.5JpJqg1VttUeN6LNOT5NceCJaRtsvQVEyAXviUUVbyq', '2020-07-25 10:59:47', 0, 0),
(6, 'Test2', 'user2@gmail.com', '$2y$10$2xg18evGwB9lHTWFj6H1F.lsCSEYNQGuW3Par38n2rbuyiHL7gnc2', '2020-07-25 11:02:19', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `fk_type_id` (`fk_type_id`),
  ADD KEY `fk_breed_id` (`fk_breed_id`),
  ADD KEY `fk_location_id` (`fk_location_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breed_id`),
  ADD UNIQUE KEY `breed` (`breed`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animal`
--
ALTER TABLE `animal`
  MODIFY `animal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`fk_type_id`) REFERENCES `type` (`type_id`),
  ADD CONSTRAINT `animal_ibfk_2` FOREIGN KEY (`fk_breed_id`) REFERENCES `breed` (`breed_id`),
  ADD CONSTRAINT `animal_ibfk_3` FOREIGN KEY (`fk_location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `animal_ibfk_4` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
