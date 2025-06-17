-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2025 at 11:17 PM
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
-- Database: `e-project`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpri_tests`
--

CREATE TABLE `cpri_tests` (
  `id` int(11) NOT NULL,
  `product_id` varchar(10) DEFAULT NULL,
  `test_id` varchar(20) DEFAULT NULL,
  `sent_at` datetime DEFAULT current_timestamp(),
  `approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpri_tests`
--

INSERT INTO `cpri_tests` (`id`, `product_id`, `test_id`, `sent_at`, `approved`) VALUES
(1, 'FMZ1400047', 'FMZ1-XX-0001', '2025-06-15 14:37:47', 'Pending'),
(3, 'TES3400987', 'TES3-XX-0001', '2025-06-17 12:27:17', 'Pending'),
(4, 'RES2300876', 'RES2-XX-0001', '2025-06-17 12:56:21', 'Pending'),
(5, 'BlB2300876', 'BlB2-XX-0001', '2025-06-17 13:37:30', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `cpri_test_results`
--

CREATE TABLE `cpri_test_results` (
  `id` int(11) NOT NULL,
  `cpri_test_id` int(11) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `status` enum('Passed','Failed') NOT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpri_test_results`
--

INSERT INTO `cpri_test_results` (`id`, `cpri_test_id`, `test_date`, `status`, `remarks`) VALUES
(2, 1, '2025-06-16', 'Passed', 'etgsfds'),
(3, 4, '2025-06-17', 'Passed', 'kmlmsda'),
(4, 5, '2025-06-17', 'Passed', 'nkksadas');

--
-- Triggers `cpri_test_results`
--
DELIMITER $$
CREATE TRIGGER `update_approval_status` AFTER UPDATE ON `cpri_test_results` FOR EACH ROW BEGIN
    IF NEW.status = 'passed' THEN
        UPDATE cpri_tests
        SET approved = 'approved'
        WHERE test_id = NEW.cpri_test_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `passed_products`
-- (See below for the actual view)
--
CREATE TABLE `passed_products` (
`id` int(11)
,`product_id` char(10)
,`product_name` varchar(50)
,`product_type_id` int(11)
,`revision_code` char(2)
,`manufacturing_number` char(5)
,`manufactured_date` date
,`created_at` timestamp
,`Uploaded_by` varchar(30)
,`test_result` enum('Passed','Failed')
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` char(10) DEFAULT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `revision_code` char(2) NOT NULL,
  `manufacturing_number` char(5) NOT NULL,
  `manufactured_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Uploaded_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_name`, `product_type_id`, `revision_code`, `manufacturing_number`, `manufactured_date`, `created_at`, `Uploaded_by`) VALUES
(13, 'FMZ1400047', 'Fuse Model Z', 12, '14', '47', '2025-06-15', '2025-06-15 21:36:46', 'ali'),
(19, 'TES3400987', 'Test Product', 15, '34', '987', '2025-06-17', '2025-06-17 14:53:36', 'kamran'),
(21, 'RES2300876', 'Resistor', 17, '23', '876', '2025-06-17', '2025-06-17 19:53:46', 'umer'),
(22, 'BlB2300876', 'Bulb', 18, '23', '876', '2025-06-17', '2025-06-17 20:37:05', 'umer');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `before_insert_product_id` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
  DECLARE type_code VARCHAR(5);
  
  -- Fetch product type short code from product_types table
  SELECT code INTO type_code
  FROM product_types
  WHERE id = NEW.product_type_id;

  -- Generate product_id = type_code + revision_code + padded manufacturing_number
  SET NEW.product_id = CONCAT(
    type_code,
    NEW.revision_code,
    LPAD(NEW.manufacturing_number, 5, '0')
  );
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `generate_product_id` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
  DECLARE code CHAR(3);

  -- Try fetching product code
  SELECT code INTO code
  FROM product_types
  WHERE id = NEW.product_type_id;

  -- Temporary debug: Force it to show result
  SET NEW.product_id = code; -- Just assign the code only to check
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL,
  `code` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `type_name`, `code`) VALUES
(12, 'Fuse Model Z', 'FMZ'),
(15, 'Test Product', 'TES'),
(17, 'Resistor', 'RES'),
(18, 'Bulb', 'BlB');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`user_id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(7, 'umer', 'nadeem', 'umer@gmail.com', '6a8d11f37a9ece9ebc851ea11331160e', 'Admin'),
(8, 'amir', 'salman', 'amir@gmail.com', '63eefbd45d89e8c91f24b609f7539942', 'Normal User'),
(9, 'kamran', 'ali', 'kamran@gmail.com', 'c812e5bec4e315c9cf7ba3165016bcc3', 'Tester');

-- --------------------------------------------------------

--
-- Table structure for table `remanufacturing`
--

CREATE TABLE `remanufacturing` (
  `id` int(11) NOT NULL,
  `product_id` varchar(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `remanufacturing`
--

INSERT INTO `remanufacturing` (`id`, `product_id`, `test_id`, `remarks`, `created_at`) VALUES
(2, 'TES3400987', 28, '\'kfkdsnfadf', '2025-06-17 14:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `retested_products`
--

CREATE TABLE `retested_products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `test_id` varchar(50) NOT NULL,
  `test_type` varchar(100) NOT NULL,
  `test_criteria` text NOT NULL,
  `observed_output` text NOT NULL,
  `tested_by` varchar(100) NOT NULL,
  `test_result` enum('Passed','Failed') NOT NULL,
  `remarks` text NOT NULL,
  `retest_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retested_products`
--

INSERT INTO `retested_products` (`id`, `product_id`, `test_id`, `test_type`, `test_criteria`, `observed_output`, `tested_by`, `test_result`, `remarks`, `retest_date`) VALUES
(1, 'TES3400987', 'TES3-XX-0001', 'Insulation Test', 'nkk;j;', 'lm\'mln', 'umer', 'Passed', 'ml\'m\'ln', '2025-06-17 19:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_id` varchar(20) DEFAULT NULL,
  `product_id` varchar(10) DEFAULT NULL,
  `test_type` varchar(50) DEFAULT NULL,
  `test_criteria` text DEFAULT NULL,
  `observed_output` text DEFAULT NULL,
  `test_result` enum('Passed','Failed') NOT NULL,
  `remarks` text DEFAULT NULL,
  `tested_by` varchar(100) DEFAULT NULL,
  `tested_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_id`, `product_id`, `test_type`, `test_criteria`, `observed_output`, `test_result`, `remarks`, `tested_by`, `tested_at`) VALUES
(12, 'FMZ1-XX-0001', 'FMZ1400047', 'Voltage Test', 'jfafaefa', 'asdfadf', 'Passed', 'gergsddfqq', 'Umer', '2025-06-15 14:37:47'),
(28, 'TES3-XX-0001', 'TES3400987', 'Insulation Test', 'nkk;j;', 'kkfndnf', 'Failed', '\'kfkdsnfadf', 'amir', '2025-06-17 07:54:04'),
(29, 'RES2-XX-0001', 'RES2300876', 'Voltage Test', 'j;iaf;dnewf', 'efwds', 'Passed', 'defdscd', 'umer', '2025-06-17 12:56:21'),
(30, 'BlB2-XX-0001', 'BlB2300876', 'Voltage Test', 'nnfdn', 'mlkenwdld', 'Passed', 'kfelnf', 'umer', '2025-06-17 13:37:30');

--
-- Triggers `tests`
--
DELIMITER $$
CREATE TRIGGER `after_test_fail` AFTER INSERT ON `tests` FOR EACH ROW BEGIN
    IF NEW.test_result = 'Failed' THEN
        INSERT INTO remanufacturing (test_id, product_id, remarks)
        VALUES (NEW.id, NEW.product_id, NEW.remarks);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_test_insert_send_to_cpri` AFTER INSERT ON `tests` FOR EACH ROW BEGIN
  IF NEW.test_result = 'Passed' THEN
    INSERT INTO cpri_tests (
      product_id,
      test_id,
      sent_at
    ) VALUES (
      NEW.product_id,
      NEW.test_id,
      NOW()
    );
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_insert_test_id` BEFORE INSERT ON `tests` FOR EACH ROW BEGIN
  DECLARE p_code VARCHAR(10);
  DECLARE rev_code VARCHAR(10);
  DECLARE t_code VARCHAR(5);
  DECLARE roll_number INT;

  -- Get product code and revision from products table
  SELECT 
    LEFT(product_id, 2),           -- product code (e.g., SG)
    SUBSTRING(product_id, 3, 2)    -- revision code (e.g., R1)
  INTO p_code, rev_code
  FROM products
  WHERE product_id = NEW.product_id;

  -- Derive test type code from test_type
  IF NEW.test_type = 'Electrical' THEN
    SET t_code = 'EL';
  ELSEIF NEW.test_type = 'Thermal' THEN
    SET t_code = 'TH';
  ELSEIF NEW.test_type = 'Mechanical' THEN
    SET t_code = 'ME';
  ELSE
    SET t_code = 'XX'; -- fallback
  END IF;

  -- Get roll number (incremental count per product + test type)
  SELECT COUNT(*) + 1 INTO roll_number
  FROM tests
  WHERE product_id = NEW.product_id AND test_type = NEW.test_type;

  -- Generate test_id
  SET NEW.test_id = CONCAT(
    p_code, rev_code, '-', t_code, '-', LPAD(roll_number, 4, '0')
  );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `passed_products`
--
DROP TABLE IF EXISTS `passed_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `passed_products`  AS SELECT `p`.`id` AS `id`, `p`.`product_id` AS `product_id`, `p`.`product_name` AS `product_name`, `p`.`product_type_id` AS `product_type_id`, `p`.`revision_code` AS `revision_code`, `p`.`manufacturing_number` AS `manufacturing_number`, `p`.`manufactured_date` AS `manufactured_date`, `p`.`created_at` AS `created_at`, `p`.`Uploaded_by` AS `Uploaded_by`, `t`.`test_result` AS `test_result` FROM (`products` `p` join `tests` `t` on(`p`.`product_id` = `t`.`product_id`)) WHERE `t`.`test_result` = 'Passed' ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpri_tests`
--
ALTER TABLE `cpri_tests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `cpri_test_results`
--
ALTER TABLE `cpri_test_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpri_test_id` (`cpri_test_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `products_ibfk_1` (`product_type_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- Indexes for table `remanufacturing`
--
ALTER TABLE `remanufacturing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indexes for table `retested_products`
--
ALTER TABLE `retested_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_id` (`test_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpri_tests`
--
ALTER TABLE `cpri_tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cpri_test_results`
--
ALTER TABLE `cpri_test_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `remanufacturing`
--
ALTER TABLE `remanufacturing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `retested_products`
--
ALTER TABLE `retested_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpri_tests`
--
ALTER TABLE `cpri_tests`
  ADD CONSTRAINT `cpri_tests_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `cpri_tests_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `tests` (`test_id`);

--
-- Constraints for table `cpri_test_results`
--
ALTER TABLE `cpri_test_results`
  ADD CONSTRAINT `cpri_test_results_ibfk_1` FOREIGN KEY (`cpri_test_id`) REFERENCES `cpri_tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `remanufacturing`
--
ALTER TABLE `remanufacturing`
  ADD CONSTRAINT `remanufacturing_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `fk_tests_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
