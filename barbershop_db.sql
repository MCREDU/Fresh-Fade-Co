-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2025 at 09:18 PM
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
-- Database: `barbershop`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(5) NOT NULL,
  `date_created` timestamp NULL DEFAULT NULL,
  `client_id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time_expected` timestamp NULL DEFAULT NULL,
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `date_created`, `client_id`, `employee_id`, `start_time`, `end_time_expected`, `canceled`, `cancellation_reason`) VALUES
(13, '2025-08-18 18:01:00', 19, 1, '2025-08-27 07:00:00', '2025-08-27 07:20:00', 0, NULL),
(14, '2025-08-18 18:28:00', 20, 3, '2025-08-27 09:30:00', '2025-08-27 09:50:00', 0, NULL),
(15, '2025-08-18 18:54:00', 20, 1, '2025-08-28 09:30:00', '2025-08-28 09:50:00', 0, NULL),
(16, '2025-08-18 19:00:00', 20, 1, '2025-08-28 09:30:00', '2025-08-28 09:50:00', 0, NULL),
(17, '2025-08-18 19:01:00', 20, 1, '2025-08-26 09:30:00', '2025-08-26 09:50:00', 0, NULL),
(18, '2025-08-18 19:13:00', 20, 1, '2025-08-26 09:30:00', '2025-08-26 09:50:00', 0, NULL),
(19, '2025-08-18 19:14:00', 20, 1, '2025-08-26 09:30:00', '2025-08-26 09:50:00', 0, NULL),
(20, '2025-08-18 19:16:00', 20, 1, '2025-08-26 09:30:00', '2025-08-26 09:50:00', 0, NULL),
(21, '2025-08-18 19:21:00', 21, 1, '2025-08-26 10:00:00', '2025-08-26 10:35:00', 0, NULL),
(22, '2025-08-21 16:35:00', 20, 1, '2025-08-29 09:45:00', '2025-08-29 10:05:00', 0, NULL),
(23, '2025-08-21 16:38:00', 20, 1, '2025-08-29 08:30:00', '2025-08-29 08:45:00', 0, NULL),
(24, '2025-08-21 16:42:00', 20, 1, '2025-08-29 10:15:00', '2025-08-29 10:35:00', 1, ''),
(25, '2025-08-21 16:43:00', 20, 1, '2025-08-29 10:15:00', '2025-08-29 10:35:00', 1, ''),
(26, '2025-08-21 16:45:00', 20, 1, '2025-08-29 10:15:00', '2025-08-29 10:35:00', 0, NULL),
(27, '2025-08-21 16:56:00', 20, 1, '2025-08-29 08:00:00', '2025-08-29 08:30:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barber_admin`
--

CREATE TABLE `barber_admin` (
  `admin_id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `barber_admin`
--

INSERT INTO `barber_admin` (`admin_id`, `username`, `email`, `full_name`, `password`) VALUES
(1, 'admin', 'admin.admin@gmail.com', 'Admin Admin', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(5) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `client_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `phone_number`, `client_email`) VALUES
(1, 'Dennis', 'S Embry', '651-779-6791', 'dennis_embry@gmail.com'),
(2, 'Bonnie', 'A Rivera', '714-327-5825', 'bonnie_rivera@yahoo.fr'),
(13, 'Driss', 'Jabiri', '0789342481', 'driss.jabiri@gmail.com'),
(19, 'Mikyle', 'Ramhari', '0732648997', 'mikyle@gmail.com'),
(20, 'Mikyle', 'Ramhari', '0732618446', 'mikyle.ramhari8@gmail.com'),
(21, 'Caleb', 'Ramhari', '0112354489', 'mikylecaleb12@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(2) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `phone_number`, `email`) VALUES
(1, 'Thabo', 'Mokoena', '0821234567', 'thabo.mokoena@example.co.za'),
(2, 'Lerato', 'Nkosi', '0832345678', 'lerato.nkosi@example.co.za'),
(3, 'Sipho', 'Dlamini', '0843456789', 'sipho.dlamini@example.co.za');

-- --------------------------------------------------------

--
-- Table structure for table `employees_schedule`
--

CREATE TABLE `employees_schedule` (
  `id` int(5) NOT NULL,
  `employee_id` int(2) NOT NULL,
  `day_id` tinyint(1) NOT NULL,
  `from_hour` time NOT NULL,
  `to_hour` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees_schedule`
--

INSERT INTO `employees_schedule` (`id`, `employee_id`, `day_id`, `from_hour`, `to_hour`) VALUES
(1, 1, 1, '11:30:00', '20:00:00'),
(2, 2, 1, '11:30:00', '20:00:00'),
(3, 1, 2, '11:30:00', '20:00:00'),
(4, 3, 2, '11:30:00', '20:00:00'),
(5, 2, 3, '11:30:00', '20:00:00'),
(6, 3, 3, '11:30:00', '20:00:00'),
(7, 1, 4, '11:30:00', '20:00:00'),
(8, 2, 4, '11:30:00', '20:00:00'),
(9, 1, 5, '11:30:00', '20:00:00'),
(10, 3, 5, '11:30:00', '20:00:00'),
(11, 2, 6, '08:00:00', '20:00:00'),
(12, 3, 6, '08:00:00', '20:00:00'),
(13, 1, 7, '08:00:00', '20:00:00'),
(14, 2, 7, '08:00:00', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(5) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `service_description` varchar(255) NOT NULL,
  `service_price` decimal(6,2) NOT NULL,
  `service_duration` int(5) NOT NULL,
  `category_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `service_description`, `service_price`, `service_duration`, `category_id`) VALUES
(1, 'Hair Cut', 'A professional haircut tailored to your style and preference, ensuring a clean and fresh look.', 60.00, 20, 4),
(2, 'Hair Styling', 'Modern and trendy hair styling for any occasion, finished with premium products for a lasting look.', 70.00, 15, 4),
(3, 'Hair Trimming', 'Quick and precise trimming to maintain your hairstyle and keep it neat and well-groomed.', 80.00, 10, 4),
(4, 'Clean Shaving', 'A smooth and refreshing clean shave with attention to detail for a polished appearance.', 90.00, 20, 2),
(5, 'Beard Trimming', 'Shaping and trimming your beard to perfection for a sharp and stylish look.', 100.00, 15, 2),
(6, 'Smooth Shave', 'A gentle shave using quality products for a smooth, irritation-free finish.', 110.00, 20, 2),
(7, 'White Facial', 'A rejuvenating facial treatment designed to brighten and refresh your skin.', 120.00, 15, 3),
(8, 'Face Cleaning', 'Deep cleansing treatment to remove impurities and leave your skin refreshed and healthy.', 130.00, 20, 3),
(9, 'Bright Tuning', 'Specialized skincare treatment to enhance your natural glow and even skin tone.', 140.00, 20, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services_booked`
--

CREATE TABLE `services_booked` (
  `appointment_id` int(5) NOT NULL,
  `service_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `services_booked`
--

INSERT INTO `services_booked` (`appointment_id`, `service_id`) VALUES
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(23, 2),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(27, 3);

-- --------------------------------------------------------

--
-- Table structure for table `service_categories`
--

CREATE TABLE `service_categories` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_categories`
--

INSERT INTO `service_categories` (`category_id`, `category_name`) VALUES
(2, 'Shaving'),
(3, 'Face Masking'),
(4, 'Uncategorized');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text DEFAULT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `author_id` int(5) DEFAULT NULL,
  `status` enum('published','draft') DEFAULT 'published',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`post_id`, `title`, `content`, `excerpt`, `image_url`, `tags`, `author_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Classic Pompadour: A Timeless Style', 'The pompadour has been a symbol of confidence and style for decades. This classic cut features short sides and back with longer hair on top, styled upward and back. Perfect for men who want a sophisticated, retro look that never goes out of style.\n\nTo achieve the perfect pompadour, start with hair that is at least 3-4 inches long on top. The sides and back should be shorter, typically a #2 or #3 guard. Use a quality pomade or wax to style the top hair upward and back, creating volume and height.\n\nKey styling tips:\n- Use a fine-tooth comb for precise styling\n- Apply product to damp hair for better control\n- Start styling from the front and work backward\n- Don\'t be afraid to use a blow dryer for extra volume\n- Finish with hairspray for hold', 'The pompadour has been a symbol of confidence and style for decades. This classic cut features short sides and back with longer hair on top, styled upward and back.', 'pompadour.jpg', 'Classic,Pompadour,Retro', 1, 'published', '2024-12-15 00:00:00', '2024-12-15 00:00:00'),
(2, 'Modern Fade Techniques: From Skin to High', 'Fades have become the go-to style for modern men. From skin fades to high fades, these techniques create seamless transitions between different hair lengths. Learn about the different fade styles and which one suits your face shape best.\n\nSkin Fade: The most dramatic fade that goes all the way to the skin. Perfect for those who want a clean, sharp look.\n\nLow Fade: Starts just above the ear and creates a subtle transition. Great for professional settings.\n\nMid Fade: Begins around the middle of the head and offers a balanced look.\n\nHigh Fade: Starts higher up and creates a bold, modern appearance.\n\nFade maintenance:\n- Get touch-ups every 2-3 weeks\n- Use quality clippers for clean lines\n- Consider your hair texture when choosing fade type\n- Match the fade to your personal style', 'Fades have become the go-to style for modern men. From skin fades to high fades, these techniques create seamless transitions between different hair lengths.', 'fade.jpg', 'Modern,Fade,Technique', 1, 'published', '2024-12-12 00:00:00', '2024-12-12 00:00:00'),
(3, 'Beard Grooming: The Complete Guide', 'A well-groomed beard can transform your entire look. From trimming techniques to product recommendations, discover how to maintain a healthy, stylish beard that complements your haircut and enhances your overall appearance.\n\nBeard care essentials:\n- Wash your beard 2-3 times per week with beard shampoo\n- Use beard oil daily to moisturize and prevent itchiness\n- Invest in quality trimmers for precise shaping\n- Comb your beard regularly to train the hair growth direction\n- Trim split ends to maintain a healthy appearance\n\nBeard styles by face shape:\n- Round face: Go for angular shapes and longer sides\n- Square face: Soften angles with rounded edges\n- Oval face: Most styles work well\n- Triangle face: Keep the chin area fuller\n\nProduct recommendations:\n- Beard oil with natural ingredients\n- Beard balm for styling and hold\n- Quality scissors for trimming\n- Beard brush for daily grooming', 'A well-groomed beard can transform your entire look. From trimming techniques to product recommendations, discover how to maintain a healthy, stylish beard.', 'beard.jpg', 'Beard,Grooming,Guide', 1, 'published', '2024-12-10 00:00:00', '2024-12-10 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `FK_client_appointment` (`client_id`),
  ADD KEY `FK_employee_appointment` (`employee_id`);

--
-- Indexes for table `barber_admin`
--
ALTER TABLE `barber_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_email` (`client_email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employees_schedule`
--
ALTER TABLE `employees_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_emp` (`employee_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `FK_service_category` (`category_id`);

--
-- Indexes for table `services_booked`
--
ALTER TABLE `services_booked`
  ADD PRIMARY KEY (`appointment_id`,`service_id`),
  ADD KEY `FK_SB_service` (`service_id`);

--
-- Indexes for table `service_categories`
--
ALTER TABLE `service_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `barber_admin`
--
ALTER TABLE `barber_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees_schedule`
--
ALTER TABLE `employees_schedule`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_categories`
--
ALTER TABLE `service_categories`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `FK_client_appointment` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_employee_appointment` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE;

--
-- Constraints for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD CONSTRAINT `blog_posts_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `barber_admin` (`admin_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
