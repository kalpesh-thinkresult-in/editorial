-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2023 at 08:04 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `editorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorymaster`
--

CREATE TABLE `categorymaster` (
  `id` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `category` varchar(150) NOT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'eng',
  `parent_cate_id` int(11) NOT NULL DEFAULT 0,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorymaster`
--

INSERT INTO `categorymaster` (`id`, `clientid`, `guid`, `category`, `lang`, `parent_cate_id`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 2, 'a7bc36d3-84c6-4df6-bb28-1dedffb754f7', 'Fashion World', 'eng', 0, 1, 1, '2023-03-14', 1, '2023-03-14'),
(2, 2, 'b4b3bf6f-33d5-4b02-9b83-d837820a7374', 'Asia', 'eng', 1, 1, 1, '2023-03-14', NULL, NULL),
(3, 2, 'e5052868-0134-4597-bd26-24b82b6338f0', 'India', 'eng', 1, 1, 1, '2023-03-14', NULL, NULL),
(4, 2, '64c36a55-8cb9-4dbf-8a37-222af5b1e109', 'Europe', 'eng', 1, 1, 1, '2023-03-14', 1, '2023-03-14'),
(5, 2, '9f5fa185-e72e-460a-b6d8-28ff15da9811', 'Sports', 'eng', 0, 1, 1, '2023-03-14', NULL, NULL),
(6, 2, '2da3824f-6cca-40d9-b7c8-e3d91feff2e4', 'Cricket', 'eng', 5, 1, 1, '2023-03-14', 1, '2023-03-14'),
(7, 2, 'dec193d6-f460-4765-83b6-6a1559de134b', 'Chess', 'eng', 5, 1, 1, '2023-03-14', NULL, NULL),
(8, 2, '85a44bae-814d-4fdc-b4e0-c75bfe2bfa22', 'IPL [Indian Premier League]', 'eng', 5, 1, 1, '2023-03-14', NULL, NULL),
(9, 2, '5347af9c-b6ac-47f0-bce0-fe1a2c361cda', 'Market', 'eng', 0, 1, 1, '2023-03-14', NULL, NULL),
(10, 1, 'f6df05e9-234d-451c-b384-51d2c6d8d71f', 'Travel', 'eng', 0, 1, 1, '2023-03-14', NULL, NULL),
(11, 1, '156827dd-0137-45a7-a386-77ef3d59f75d', 'India', 'eng', 10, 1, 1, '2023-03-14', NULL, NULL),
(12, 1, 'f890b482-d55d-4a49-91b5-f6830f2dc725', 'Singapore', 'eng', 10, 1, 1, '2023-03-14', NULL, NULL),
(13, 1, '3528b8fe-124a-4738-8250-6f1b0e5f0b4f', 'Japan', 'eng', 10, 1, 1, '2023-03-14', NULL, NULL),
(14, 1, 'e0bbc29f-b802-4fed-9019-9a25ccb1034b', 'Fashion', 'eng', 0, 1, 1, '2023-03-14', NULL, NULL),
(15, 1, '456a50ef-951e-4c35-9e81-1b04a4bb7b7a', 'Women', 'eng', 14, 1, 1, '2023-03-14', NULL, NULL),
(16, 1, 'e9f3a580-8dc8-4c63-9e76-7f8db4849666', 'Men', 'eng', 14, 1, 1, '2023-03-14', NULL, NULL),
(17, 1, '39c54f7e-4eee-4d27-add5-e8afb747c7fd', 'Children', 'eng', 14, 1, 1, '2023-03-14', NULL, NULL),
(18, 2, 'caf43610-58b7-427f-a59c-8a90cf8c8429', 'फॅशन', 'hindi', 0, 1, 1, '2023-03-15', NULL, NULL),
(19, 2, '1227e146-c418-4999-9eee-25c6754cd53d', 'जागतिक', 'hindi', 18, 1, 1, '2023-03-15', NULL, NULL),
(20, 2, '39976ed0-2176-453d-8524-d303c6ffbeb1', 'भारतीय', 'hindi', 18, 1, 1, '2023-03-15', NULL, NULL),
(21, 2, 'e143ed66-11b8-4d37-b852-2b35e4fa3b80', 'महिला', 'hindi', 18, 1, 1, '2023-03-15', NULL, NULL),
(22, 2, 'c1dbc499-e189-485d-b943-58412ef3402d', 'पुरुष', 'hindi', 18, 1, 1, '2023-03-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clientmaster`
--

CREATE TABLE `clientmaster` (
  `id` int(11) NOT NULL,
  `guid` varchar(255) NOT NULL,
  `clientname` varchar(150) NOT NULL,
  `baseurl` varchar(255) NOT NULL,
  `isactive` bigint(20) NOT NULL DEFAULT 1,
  `createdby` int(11) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientmaster`
--

INSERT INTO `clientmaster` (`id`, `guid`, `clientname`, `baseurl`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, '7de9c6d5-6c60-49e5-9a37-56612747fa98', 'Investment Guru India.', 'https://investmentguruindia.in', 1, 1, '2023-03-14', 1, '2023-03-14'),
(2, '82c8c38e-c55a-4de9-b844-72a85acbcb6e', 'Google', 'https://www.google.com', 1, 1, '2023-03-14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keywordmaster`
--

CREATE TABLE `keywordmaster` (
  `id` bigint(20) NOT NULL,
  `company` varchar(255) NOT NULL,
  `keywords` text DEFAULT NULL,
  `stockcode` varchar(255) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keywordmaster`
--

INSERT INTO `keywordmaster` (`id`, `company`, `keywords`, `stockcode`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 'Reliance Infra Ltd', 'Reliance Infra; Reliance Infrastructure; Reliance ltd', 'REL219080901', 1, 1, '2023-03-15', 1, '2023-03-15'),
(2, 'Remove me', 'sdf 43 w; 245; 23;52 ', 'qweqwe234234', 1, 1, '2023-03-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) NOT NULL,
  `lang` varchar(10) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `news` text NOT NULL,
  `hashtags` text DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `imageurl` varchar(255) DEFAULT NULL,
  `imagetitle` varchar(255) DEFAULT NULL,
  `videolink` varchar(255) DEFAULT NULL,
  `showinrss` int(11) NOT NULL DEFAULT 0,
  `stockcodes` text DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `lang`, `heading`, `slug`, `news`, `hashtags`, `source`, `author`, `imageurl`, `imagetitle`, `videolink`, `showinrss`, `stockcodes`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 'eng', 'Reliance Industries shares hit fresh one-year low; time to buy, sell or hold?', 'Reliance-Industries-shares-hit-fresh-one-year-low-time-to-buy-sell-or-hold', 'Shares of Reliance Industries fell for the fifth straight session to hit their fresh one-year low level in Wednesday\'s trade. The stock today slipped 1.14 per cent to touch a day low -- also its 52-week low -- of Rs 2,250.50 against a previous close of Rs 2,276.50. So far, this hasn\'t been the year that the oil-to-telecom conglomerate would have been anticipating. The RIL stock has fallen around 12.50 per cent on a year-to-date (YTD) basis. A total of 2.83 lakh shares changed hands today on BSE, which was higher than the two-week average volume of 2.34 lakh shares. Turnover on the counter stood at Rs 64.18 crore, commanding a market capitalisation (m-cap) of Rs 15,25,550.01 crore.\r\n\r\nAnalysts said that Reliance has been hovering near Rs 2,300 level and resistance on the counter could be seen at Rs 2,344, followed by Rs 2,345, Rs 2,355 and Rs 2,424 levels. Yet, one analyst suggested traders against initiating any fresh longs for now, while another said the stock may slip below Rs 2,200 in the near term.', '#reliance #gadgets', 'business today', NULL, NULL, NULL, NULL, 0, NULL, 1, 1, '2023-03-15', NULL, NULL),
(2, 'eng', 'Reliance Industries shares hit fresh one-year low; time to buy, sell or hold?', 'Reliance-Industries-shares-hit-fresh-one-year-low-time-to-buy-sell-or-hold', 'Shares of Reliance Industries fell for the fifth straight session to hit their fresh one-year low level in Wednesday\'s trade. The stock today slipped 1.14 per cent to touch a day low -- also its 52-week low -- of Rs 2,250.50 against a previous close of Rs 2,276.50. So far, this hasn\'t been the year that the oil-to-telecom conglomerate would have been anticipating. The RIL stock has fallen around 12.50 per cent on a year-to-date (YTD) basis. A total of 2.83 lakh shares changed hands today on BSE, which was higher than the two-week average volume of 2.34 lakh shares. Turnover on the counter stood at Rs 64.18 crore, commanding a market capitalisation (m-cap) of Rs 15,25,550.01 crore.\r\n\r\nAnalysts said that Reliance has been hovering near Rs 2,300 level and resistance on the counter could be seen at Rs 2,344, followed by Rs 2,345, Rs 2,355 and Rs 2,424 levels. Yet, one analyst suggested traders against initiating any fresh longs for now, while another said the stock may slip below Rs 2,200 in the near term.', '#reliance #gadgets', 'business today', NULL, NULL, NULL, NULL, 0, NULL, 1, 1, '2023-03-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newscategory_mapping`
--

CREATE TABLE `newscategory_mapping` (
  `id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `newsid` bigint(20) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newscategory_mapping`
--

INSERT INTO `newscategory_mapping` (`id`, `categoryid`, `newsid`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 9, 1, 1, 1, '2023-03-14', NULL, NULL),
(2, 13, 1, 1, 1, '2023-03-16', NULL, NULL),
(3, 13, 2, 1, 1, '2023-03-14', NULL, NULL),
(4, 6, 2, 1, 1, '2023-03-16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rolemaster`
--

CREATE TABLE `rolemaster` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rolemaster`
--

INSERT INTO `rolemaster` (`id`, `role`, `description`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 'System Admin', 'This role will always have all access. ', 1, 1, '2023-03-08', NULL, NULL),
(2, 'Admin', 'General Admin', 1, 1, '2023-03-08', 1, '2023-03-08'),
(3, 'Data-entry Operator', 'Role for data-entry users.', 1, 1, '2023-03-08', 1, '2023-03-08'),
(4, 'Tele-caller', 'No desc', 1, 1, '2023-03-09', NULL, NULL),
(5, 'Test Role 1234', 'Test description 1234', 0, 1, '2023-03-09', 1, '2023-03-09'),
(6, '3451111', '3453451111111111', 0, 1, '2023-03-10', 1, '2023-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `rolemenu_mapping`
--

CREATE TABLE `rolemenu_mapping` (
  `id` bigint(20) NOT NULL,
  `roleid` int(11) NOT NULL,
  `menucode` varchar(10) NOT NULL,
  `allowadd` int(11) NOT NULL DEFAULT 0,
  `allowedit` int(11) NOT NULL DEFAULT 0,
  `allowdelete` int(11) NOT NULL DEFAULT 0,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rolemenu_mapping`
--

INSERT INTO `rolemenu_mapping` (`id`, `roleid`, `menucode`, `allowadd`, `allowedit`, `allowdelete`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(33, 4, 'ROLES', 0, 0, 0, 1, 1, '2023-03-09', NULL, NULL),
(34, 4, 'USERS', 0, 0, 0, 1, 1, '2023-03-09', NULL, NULL),
(35, 4, 'ROLEACC', 1, 0, 1, 1, 1, '2023-03-09', NULL, NULL),
(36, 4, 'CLIENT', 1, 1, 1, 1, 1, '2023-03-09', NULL, NULL),
(37, 4, 'CATE', 0, 0, 0, 1, 1, '2023-03-09', NULL, NULL),
(38, 4, 'NEWS', 0, 0, 0, 1, 1, '2023-03-09', NULL, NULL),
(81, 3, 'ROLES', 0, 0, 0, 1, 1, '2023-03-11', NULL, NULL),
(82, 3, 'USERS', 0, 0, 0, 1, 1, '2023-03-11', NULL, NULL),
(83, 3, 'ROLEACC', 0, 0, 0, 1, 1, '2023-03-11', NULL, NULL),
(84, 3, 'CLIENT', 0, 0, 0, 1, 1, '2023-03-11', NULL, NULL),
(85, 3, 'CATE', 0, 1, 0, 1, 1, '2023-03-11', NULL, NULL),
(86, 3, 'NEWS', 1, 1, 1, 1, 1, '2023-03-11', NULL, NULL),
(87, 2, 'ROLES', 0, 0, 0, 1, 1, '2023-03-13', NULL, NULL),
(88, 2, 'USERS', 0, 0, 0, 1, 1, '2023-03-13', NULL, NULL),
(89, 2, 'ROLEACC', 0, 1, 0, 1, 1, '2023-03-13', NULL, NULL),
(90, 2, 'CLIENT', 1, 1, 1, 1, 1, '2023-03-13', NULL, NULL),
(91, 2, 'CATE', 1, 1, 1, 1, 1, '2023-03-13', NULL, NULL),
(92, 2, 'TAGS', 1, 1, 1, 1, 1, '2023-03-13', NULL, NULL),
(93, 2, 'NEWS', 0, 0, 0, 1, 1, '2023-03-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tagmaster`
--

CREATE TABLE `tagmaster` (
  `id` bigint(20) NOT NULL,
  `tag` varchar(150) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagmaster`
--

INSERT INTO `tagmaster` (`id`, `tag`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 'Stocks', 1, 1, '2023-03-13', 1, '2023-03-13'),
(2, 'Stock', 0, 1, '2023-03-13', 1, '2023-03-13'),
(3, 'Market', 1, 1, '2023-03-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `roleid` int(11) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT 1,
  `createdby` bigint(20) NOT NULL,
  `createdon` date NOT NULL,
  `modifiedby` bigint(20) DEFAULT NULL,
  `modifiedon` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `roleid`, `isactive`, `createdby`, `createdon`, `modifiedby`, `modifiedon`) VALUES
(1, 'Mahesh Thakurdas', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, 1, '2023-03-07', NULL, NULL),
(2, 'General Admin User', 'admin2', 'e10adc3949ba59abbe56e057f20f883e', 2, 1, 1, '2023-03-08', NULL, NULL),
(3, 'Test User US', 'test@email.us', 'e10adc3949ba59abbe56e057f20f883e', 3, 1, 1, '2023-03-09', 1, '2023-03-09'),
(4, 'Test User Two', 'two@email.com', '202cb962ac59075b964b07152d234b70', 2, 0, 1, '2023-03-09', 1, '2023-03-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorymaster`
--
ALTER TABLE `categorymaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientmaster`
--
ALTER TABLE `clientmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywordmaster`
--
ALTER TABLE `keywordmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newscategory_mapping`
--
ALTER TABLE `newscategory_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolemaster`
--
ALTER TABLE `rolemaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rolemenu_mapping`
--
ALTER TABLE `rolemenu_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagmaster`
--
ALTER TABLE `tagmaster`
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
-- AUTO_INCREMENT for table `categorymaster`
--
ALTER TABLE `categorymaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `clientmaster`
--
ALTER TABLE `clientmaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keywordmaster`
--
ALTER TABLE `keywordmaster`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `newscategory_mapping`
--
ALTER TABLE `newscategory_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rolemaster`
--
ALTER TABLE `rolemaster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rolemenu_mapping`
--
ALTER TABLE `rolemenu_mapping`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `tagmaster`
--
ALTER TABLE `tagmaster`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
