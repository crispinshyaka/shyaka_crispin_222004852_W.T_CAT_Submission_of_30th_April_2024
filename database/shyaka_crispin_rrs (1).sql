-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 03:41 AM
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
-- Database: `shyaka_crispin_rrs`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteuser` (`p_user_id` INT)   begin
delete from users
where
user_id = p_user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `displayall` ()   begin
select * from users;
select * from ingredients;
select * from ratings;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertuser` (IN `p_first_name` VARCHAR(20), IN `p_emal` VARCHAR(100), IN `p_paword` VARCHAR(8))   begin
insert into users (first_name,emal,paword)
values (p_first_name,p_emal,p_paword);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatedat` (IN `p_user_id` INT, IN `p_new_name` VARCHAR(25), IN `p_new_cooking_level` VARCHAR(50))   begin
update users
set first_name = p_new_name,
cooking_level = p_new_cooking_level
where user_id = p_user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatedata` (IN `p_user_id` INT, IN `p_new_name` VARCHAR(25), IN `p_new_cooking_level` VARCHAR(50))   begin
update users
set first_name = new_name,
cooking_level = new_cookng_level
where user_id = p_user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatedatas` (IN `p_user_id` INT, IN `p_new_name` VARCHAR(25), IN `p_new_cooking_level` VARCHAR(50))   begin
update users
set first_name = p_new_name,
cooking_level = p_new_cookng_level
where user_id = p_user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `userwithmostrecipe` ()   begin
select u.first_name,u.emal
from users u
join(
select user_id, count(*)
as savedrecipecount
from saved_recipes
group by user_id
order by savedrecipecount desc
limit 1
)
as subquery
on u.user_id = subquery.user_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `userwithmostrecipes` ()   begin
select u.first_name,u.emal
from user u
join(
select user_id, count(*)
as savedrecipecount
from saved_recipes
group by user_id
order by savedrecipecount desc
limit 1
)
as subquery
on u.user_id = subquery.user_id;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `username`, `password`) VALUES
(1, 'crispin', 'cris001', 'crispin001');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredent_id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `category` varchar(10) DEFAULT NULL,
  `nutrition_informaton` varchar(50) DEFAULT NULL,
  `avalability` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredent_id`, `name`, `category`, `nutrition_informaton`, `avalability`) VALUES
(1, 'Onion', 'carbo', NULL, 'yes'),
(2, 'pillaw_masala', 'spices', 'vitaminA', 'yes'),
(3, 'tea_masala', 'spicies', 'vitamins', 'yes'),
(1, 'Onion', 'carbo', NULL, 'yes'),
(2, 'pillaw_masala', 'spices', 'vitaminA', 'yes'),
(3, 'tea_masala', 'spicies', 'vitamins', 'yes');

--
-- Triggers `ingredients`
--
DELIMITER $$
CREATE TRIGGER `updateingredients` AFTER UPDATE ON `ingredients` FOR EACH ROW begin
insert into ingredientlog(ingredent_id,action,timestamp)
values (new.ingredent_id,'user_updated',now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `revew` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `recipe_id`, `firstname`, `rating`, `revew`) VALUES
(1, 1, 'shyaka', 4, 'awesome'),
(2, 2, 'crispin', 4, 'great');

-- --------------------------------------------------------

--
-- Table structure for table `recipelog`
--

CREATE TABLE `recipelog` (
  `log_id` int(11) NOT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `timestamp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipelog`
--

INSERT INTO `recipelog` (`log_id`, `recipe_id`, `action`, `timestamp`) VALUES
(1, 2, 'recipe_added', '2024-02-16 01:43:07'),
(2, 3, 'recipe_added', '2024-02-17 15:12:20'),
(0, 1, 'recipe_added', '2024-02-19 07:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `recipe_id` int(11) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `ingredient_lst` varchar(100) DEFAULT NULL,
  `preparation_time` int(11) DEFAULT NULL,
  `cooking_time` int(11) DEFAULT NULL,
  `nutritional_info` varchar(100) DEFAULT NULL,
  `user_rating` int(11) DEFAULT NULL,
  `instructions` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `recipes`
--
DELIMITER $$
CREATE TRIGGER `insertafterrecipe` AFTER INSERT ON `recipes` FOR EACH ROW Begin
Insert into recipelog(recipe_id,action,timestamp)
Values (new.recipe_id,'recipe_added',now());
End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `recipestodelete`
-- (See below for the actual view)
--
CREATE TABLE `recipestodelete` (
`save_id` int(11)
,`user_id` int(11)
,`save_data` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `saved_recipes`
--

CREATE TABLE `saved_recipes` (
  `save_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_id` int(11) DEFAULT NULL,
  `save_data` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `saved_recipes`
--

INSERT INTO `saved_recipes` (`save_id`, `user_id`, `recipe_id`, `save_data`) VALUES
(1, 1, 1, 'breakfast_great_recipe'),
(1, 1, 1, 'breakfast_great_recipe');

-- --------------------------------------------------------

--
-- Stand-in structure for view `userinsert`
-- (See below for the actual view)
--
CREATE TABLE `userinsert` (
`user_id` binary(0)
,`frist_name` char(0)
,`last_name` char(0)
,`emal` char(0)
,`paword` char(0)
,`preferrence` char(0)
,`cooking_level``cooking_level``cooking_level``cooking_level` char(0)
);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `timestamp` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`log_id`, `user_id`, `action`, `timestamp`) VALUES
(1, 6, 'user added', '2023-09-09'),
(2, 4, 'user_updated', '2023-09-09'),
(3, 7, 'user added', '2024-02-13'),
(4, 8, 'user added', '2024-02-15'),
(6, 2, 'user_updated', '2024-02-17'),
(7, 2, 'user_updated', '2024-02-17'),
(1, 6, 'user added', '2023-09-09'),
(2, 4, 'user_updated', '2023-09-09'),
(0, 1, 'user added', '2024-02-19'),
(0, 2, 'user added', '2024-02-19'),
(0, 3, 'user added', '2024-02-19'),
(0, 4, 'user added', '2024-02-19'),
(0, 5, 'user added', '2024-02-19'),
(0, 6, 'user added', '2024-02-19'),
(0, 0, 'user added', '2024-04-28'),
(0, 1, 'user_deleted', '2024-04-28'),
(0, 2, 'user_deleted', '2024-04-28'),
(0, 3, 'user_deleted', '2024-04-28'),
(0, 4, 'user_deleted', '2024-04-28'),
(0, 5, 'user_deleted', '2024-04-28'),
(0, 6, 'user_deleted', '2024-04-28'),
(0, 7, 'user_deleted', '2024-04-28'),
(0, 8, 'user_deleted', '2024-04-28'),
(0, 1, 'user_deleted', '2024-04-28'),
(0, 2, 'user_deleted', '2024-04-28'),
(0, 3, 'user_deleted', '2024-04-28'),
(0, 4, 'user_deleted', '2024-04-28'),
(0, 5, 'user_deleted', '2024-04-28'),
(0, 6, 'user_deleted', '2024-04-28'),
(0, 0, 'user_deleted', '2024-04-28'),
(0, 1, 'user added', '2024-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `preferrences` varchar(20) DEFAULT NULL,
  `cooking_level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `preferrences`, `cooking_level`) VALUES
(1, 'shyaka', 'james', 'crispin@gmail.com', '12345', NULL, NULL);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `deleteuser` AFTER DELETE ON `users` FOR EACH ROW begin
insert into userlog(user_id,action,timestamp)
values (old.user_id,'user_deleted',now());
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertafter` AFTER INSERT ON `users` FOR EACH ROW begin
insert into userlog(user_id,action,timestamp)
values(new.user_id,'user added',now());
 end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `updateusers` AFTER UPDATE ON `users` FOR EACH ROW begin
insert into userlog(user_id,action,timestamp)
values (new.user_id,'user_updated',now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `usersingredients`
--

CREATE TABLE `usersingredients` (
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `ingredent_id` int(11) DEFAULT NULL,
  `name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL,
  `action_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`login_id`, `user_id`, `password`, `action_type`) VALUES
(1, 1, 'rita@123', 'chief'),
(1, 1, 'rita@123', 'chief');

-- --------------------------------------------------------

--
-- Structure for view `recipestodelete`
--
DROP TABLE IF EXISTS `recipestodelete`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `recipestodelete`  AS SELECT `saved_recipes`.`save_id` AS `save_id`, `saved_recipes`.`user_id` AS `user_id`, `saved_recipes`.`save_data` AS `save_data` FROM `saved_recipes` WHERE `saved_recipes`.`user_id` = 3333 ;

-- --------------------------------------------------------

--
-- Structure for view `userinsert`
--
DROP TABLE IF EXISTS `userinsert`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userinsert`  AS SELECT NULL AS `user_id`, '' AS `frist_name`, '' AS `last_name`, '' AS `emal`, '' AS `paword`, '' AS `preferrence`, '' AS `cooking_level``cooking_level``cooking_level``cooking_level` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
