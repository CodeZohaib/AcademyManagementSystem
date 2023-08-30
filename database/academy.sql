-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2023 at 05:55 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email_address`, `password`, `created_at`) VALUES
(1, 'admin@gmail.com', 'admin123', '2023-04-02 09:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `p_id` int NOT NULL,
  `c_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_fee` int NOT NULL,
  `c_duration` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `p_id`, `c_name`, `c_fee`, `c_duration`, `c_description`, `c_image`, `c_status`, `created_at`, `updated_at`) VALUES
(6, 3, 'communication skills', 4500, '6 month', 'Do you want to improve your communication skills and become a more effective communicator? This comprehensive communication skills course is designed to help you do just that!In this course, you\'ll learn about the different types of communication, including verbal, nonverbal, and written. You\'ll explore the importance of active listening and how to use it to build rapport and understanding with others.You\'ll also delve into the art of effective public speaking, learning how to prepare and deliver engaging presentations with confidence. You\'ll learn how to structure your presentation, use visual aids, and connect with your audience to ensure your message is heard loud and clear.', '7169_2.jpg', 'publish', '2023-04-03 10:18:15', '2023-04-03 10:18:15'),
(7, 13, 'picture sketch', 5000, '3 month', 'In this course, you\'ll learn how to transform photos into pencil sketches, charcoal drawings, and other artistic renderings using digital tools such as Photoshop and Procreate. You\'ll explore techniques for creating texture, shading, and depth to bring your sketches to life You\'ll also learn how to choose the right reference photo and how to adjust the composition to create a compelling sketch. You\'ll discover how to use lighting, contrast, and other elements to add drama and emotion to your drawings', '8023_5.JPG', 'p_private', '2023-04-03 10:21:49', '2023-04-03 10:21:49'),
(9, 1, 'php backend', 7000, '5 month', 'Are you interested in becoming a skilled PHP backend developer? Look no further than this comprehensive PHP backend course!In this course, you\'ll start with the basics of PHP, including syntax, data types, functions, and control structures. You\'ll learn how to work with arrays, loops, and conditionals, as well as how to manipulate strings and dates in PHP.Next, you\'ll dive into the world of backend development, learning how to work with databases and SQL to store and retrieve data. You\'ll explore how to create database connections, insert, update, and delete data, and perform advanced database queries', '9111_php.JPG', 'publish', '2023-04-03 10:27:06', '2023-04-03 10:27:06'),
(10, 2, 'management', 7800, '6 month', 'Are you interested in learning the skills and techniques necessary to become an effective manager? This comprehensive management course has got you covered!In this course, you\'ll learn the fundamentals of management, including how to plan, organize, lead, and control a team. You\'ll explore the different management styles and discover which style works best for you and your team.You\'ll also delve into the importance of effective communication, both verbal and written, as well as how to motivate and engage your team members. You\'ll learn how to set goals, delegate tasks, and provide feedback in order to maximize team performance.', '6989_0.JPG', 'publish', '2023-04-03 10:49:29', '2023-04-03 10:49:29'),
(11, 2, 'business economics', 780, '3 month', 'Khan Academy is a leading online educational platform that offers a diverse array of courses for learners of all ages and levels. Our courses cover a wide range of subjects, including math, science, computer programming, history, economics, and more. Our expert instructors use innovative teaching methods to help learners master new skills and concepts in an engaging and interactive wayKhan Academy is a leading online educational platform that offers a diverse array of courses for learners of all ages and levels. Our courses cover a wide range of subjects, including math, science, computer programming, history, economics, and more. Our expert instructors use innovative teaching methods to help learners master new skills and concepts in an engaging and interactive way', '9538_Scope-of-Business-Economics.jpg', 'c_delete', '2023-04-03 10:55:12', '2023-04-03 10:55:12'),
(12, 14, 'writing', 2000, '2 month', 'Urdu Writing', '1727_cooltext432833974694980_156x43.png', 'p_delete', '2023-04-03 11:22:31', '2023-04-03 11:22:31'),
(13, 5, 'java', 6000, '6 month', 'Advance Java', '9072_nameroute.JPG', 'p_private', '2023-04-03 11:23:20', '2023-04-03 11:23:20'),
(14, 5, 'c++', 6000, '6 month', 'Advance Java', '9072_nameroute.JPG', 'c_private', '2023-04-03 11:23:20', '2023-04-03 11:23:20'),
(19, 4, 'html & css', 890, '6 month', 'In this course, you\'ll start with the basics of HTML, including the structure of web pages, tags, attributes, and more. You\'ll learn how to create links, images, lists, tables, and forms, as well as how to organize your content with headings and paragraphs. Once you\'ve got a handle on HTML, you\'ll move on to CSS, where you\'ll learn how to style your web pages with fonts, colors, backgrounds, borders, and more. You\'ll also dive into CSS layout techniques, including using floats and positioning to create complex layouts', '1851_htmlcssjs-overview.png', 'p_private', '2023-04-03 14:09:03', '2023-04-03 14:09:03'),
(20, 1, 'mysqli &  jquery', 870, '3 month', 'In this course, you\'ll learn how to harness the power of two of the most essential technologies for building dynamic web applications: MySQLi and jQuery.First, you\'ll dive into the MySQLi extension for PHP, which allows you to connect to a MySQL database and perform database operations using object-oriented programming. You\'ll learn how to create and manage connections, execute queries, handle errors, and work with data using MySQLi. Next, you\'ll explore jQuery, a powerful JavaScript library that simplifies client-side scripting and manipulation of HTML DOM elements. You\'ll learn how to use jQuery to create interactive web pages, add effects and animations, handle events, and make AJAX requests to the server.', '7598_0_oFAcwKDFmIQFh_dx.jpg', 'c_private', '2023-04-03 14:52:47', '2023-04-03 14:52:47'),
(21, 4, 'bootstrap ', 3000, '2 month', 'Bootstrap is one of the most popular front-end development frameworks used by web developers to create responsive, mobile-first web pages and applications. In this course, you\'ll learn how to use Bootstrap to design and build modern, responsive websites that look great on any device.You\'ll start by learning the basics of Bootstrap, including its grid system, typography, forms, and components. You\'ll learn how to customize Bootstrap styles and create your own CSS rules to customize your design', '8560_download.jpg', 'p_private', '2023-04-03 14:57:00', '2023-04-03 14:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_allocation`
--

CREATE TABLE `course_allocation` (
  `ca_id` int NOT NULL,
  `p_id` int DEFAULT NULL,
  `c_id` int NOT NULL,
  `t_id` int NOT NULL,
  `start_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `end_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ct_shift` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ct_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_allocation`
--

INSERT INTO `course_allocation` (`ca_id`, `p_id`, `c_id`, `t_id`, `start_time`, `end_time`, `ct_shift`, `ct_created_at`) VALUES
(17, 1, 9, 11, '07:11 PM', '07:11 PM', 'Evening', '2023-07-14 10:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publish',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `program`, `status`, `created_at`, `updated_at`) VALUES
(1, 'web development', 'publish', '2023-04-02 14:07:03', '2023-04-02 19:09:04'),
(2, 'bba', 'publish', '2023-04-02 14:07:03', '2023-04-03 11:47:25'),
(3, 'english language', 'publish', '2023-04-02 14:07:03', '2023-04-02 14:34:13'),
(4, 'web desging', 'private', '2023-04-02 14:07:03', '2023-06-12 19:09:48'),
(5, 'bscs', 'private', '2023-04-02 14:07:03', '2023-04-03 11:59:26'),
(13, 'art & design', 'private', '2023-04-02 19:09:54', '2023-06-12 19:06:34'),
(14, 'urdu', 'delete', '2023-04-03 11:20:10', '2023-04-03 11:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int NOT NULL,
  `roll_no` int DEFAULT NULL,
  `p_id` int NOT NULL,
  `c_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `father_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dob` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `shifts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `updated_shift` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_fee` int NOT NULL,
  `u_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `roll_no`, `p_id`, `c_id`, `name`, `father_name`, `dob`, `gender`, `email_address`, `address`, `phone_number`, `shifts`, `updated_shift`, `u_fee`, `u_status`, `created_at`, `updated_at`) VALUES
(45, 1, 4, 21, 'zohaib khan', 'noorzali', '1999-03-19', 'male', 'kzohaib935@gmail.com', 'nowshera', '03139943227', 'Morning', 'Morning', 10000, 'enroll', '2023-06-12 18:35:28', '2023-06-12 18:36:24'),
(46, 1, 3, 6, 'zohaib khan', 'noorzali', '1999-03-19', 'male', 'kzohaib935@gmail.com', 'dheri katti khel nowshera', '03138765432', 'Evening', 'Evening', 4500, 'enroll', '2023-06-12 18:39:32', '2023-06-12 18:41:06'),
(47, 2, 3, 6, 'hamza khan', 'ali', '1999-03-19', 'male', 'hamza@gmail.com', 'dheri katti khel nowshera', '03138765432', 'Evening', 'Evening', 4500, 'enroll', '2023-06-12 18:42:12', '2023-06-12 18:42:30'),
(48, 1, 1, 9, 'zohaib khan', 'noorzali', '1999-03-19', 'male', 'kzohaib935@gmail.com', 'a', '03137654345', 'Morning', 'Morning', 7000, 'enroll', '2023-06-12 18:46:48', '2023-06-12 18:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `studentsfee`
--

CREATE TABLE `studentsfee` (
  `f_id` int NOT NULL,
  `u_id` int NOT NULL,
  `f_roll_no` int NOT NULL,
  `fee_pay` int NOT NULL,
  `pay_amount` int NOT NULL,
  `remaining_fee` int NOT NULL,
  `fee_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fee_update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` int NOT NULL,
  `t_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_father` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_phone_number` varbinary(20) NOT NULL,
  `t_salery` int NOT NULL,
  `t_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'employee',
  `t_bio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `t_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `t_name`, `t_father`, `t_gender`, `t_qualification`, `t_email`, `t_phone_number`, `t_salery`, `t_image`, `t_status`, `t_bio`, `t_created_at`, `t_updated_at`) VALUES
(3, 'engr. rizwan khan', 'shahzaib ali', 'male', 'bscs', 'rizwan@gmail.com', 0x33313339383736353433, 5000, '1763_person_7.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 10:14:45', '2023-04-04 10:14:45'),
(4, 'faizan shah', 'afaq shah', 'male', 'ms', 'faizan@gmail.com', 0x33313339383937363534, 7000, '8652_person_6.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 10:31:20', '2023-04-04 10:31:20'),
(5, 'ahmad zaib', 'jamal zaib', 'male', 'bscs', 'ahmadzaib@gmail.com', 0x33313335343332313233, 9000, '9891_person_1.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 10:32:29', '2023-04-04 10:32:29'),
(6, 'rida khan', 'mansoor khan', 'female', 'bba', 'rida@gmail.com', 0x33313337363532313233, 10000, '9912_img_sm_1.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 10:34:02', '2023-04-04 10:34:02'),
(7, 'hamza khan', 'abid khan', 'male', 'ma urdu', 'hamza@gmail.com', 0x33313339393838373737, 9870, '7509_person_5.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 11:00:43', '2023-04-04 11:00:43'),
(8, 'muhammad asif', 'muhammad kamal', 'male', 'master english', 'asif@gmail.com', 0x33313338373634353332, 7800, '7014_majeed.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 11:03:26', '2023-04-04 11:03:26'),
(10, 'afaq khan', 'jawad khan', 'male', 'bba', 'afaq@gmail.com', 0x33313338373634373737, 15000, '1160_person_10.jpg', 'employee', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2023-04-04 11:07:21', '2023-04-04 11:07:21'),
(11, 'noor ali', 'afzal ali', 'male', 'bachelor of technology', 'noor123@gmail.com', 0x33313338373636363638, 8700, '4082_pexels-max-fischer-5212345.jpg', 'employee', 'hi, there, my name is noor ali, and i am a bachelor of technology student currently pursuing my degree from nothern university. i am highly passionate about the field of technology and its practical applications, which has led me to pursue a career in this field. throughout my academic career, i have gained expertise in various technological areas such as programming languages, web development, data structures, and algorithms. i have also completed various projects and assignments, which have given me practical experience in applying these skills to real-world problems.', '2023-04-04 13:16:18', '2023-04-04 13:16:18');

-- --------------------------------------------------------

--
-- Table structure for table `teachersalery`
--

CREATE TABLE `teachersalery` (
  `id` int NOT NULL,
  `t_id` int NOT NULL,
  `salery` int NOT NULL,
  `salery_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachersalery`
--

INSERT INTO `teachersalery` (`id`, `t_id`, `salery`, `salery_date`) VALUES
(4, 11, 8700, '2023-04-09 19:44:44'),
(5, 10, 15000, '2023-04-09 19:44:55'),
(6, 6, 10000, '2023-04-12 05:15:00'),
(7, 8, 7800, '2023-04-12 05:24:27'),
(8, 11, 8700, '2023-06-05 17:46:08'),
(9, 11, 8000, '2023-07-25 12:57:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_allocation`
--
ALTER TABLE `course_allocation`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentsfee`
--
ALTER TABLE `studentsfee`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `teachersalery`
--
ALTER TABLE `teachersalery`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `course_allocation`
--
ALTER TABLE `course_allocation`
  MODIFY `ca_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `studentsfee`
--
ALTER TABLE `studentsfee`
  MODIFY `f_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `t_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teachersalery`
--
ALTER TABLE `teachersalery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
