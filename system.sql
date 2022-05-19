-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2022 at 05:13 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

CREATE TABLE `monitor` (
  `monitorID` int(11) NOT NULL,
  `monitorCode` varchar(50) NOT NULL,
  `monitorName` varchar(50) NOT NULL,
  `monitorType` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `monitorPassword` varchar(50) NOT NULL,
  `ipaddress` varchar(50) NOT NULL,
  `monitorStatus` varchar(50) NOT NULL,
  `statusConnect` varchar(50) NOT NULL,
  `serviceID` int(11) NOT NULL,
  `nameService` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monitor`
--

INSERT INTO `monitor` (`monitorID`, `monitorCode`, `monitorName`, `monitorType`, `username`, `monitorPassword`, `ipaddress`, `monitorStatus`, `statusConnect`, `serviceID`, `nameService`) VALUES
(94, '77', 'Kiosk', 'Display counter', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 19, 'Khám tai muỗi họng, Khám mắt'),
(95, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Ngưng hoạt động', 'Mất kết nối', 18, 'Khám tai muỗi họng, Khám răng'),
(96, '77', 'Kiosk', 'Kiosk', 'CMS', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 17, 'Khám tai muỗi họng'),
(97, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Mất kết nối', 17, 'Khám tim mạch, Khám tai muỗi họng'),
(98, '992', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Mất kết nối', 19, 'Khám tim mạch, Khám tai muỗi họng, Khám răng, Khám mắt'),
(99, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 17, 'Khám tim mạch, Khám tai muỗi họng'),
(100, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 16, 'Khám tim mạch');

-- --------------------------------------------------------

--
-- Table structure for table `progression`
--

CREATE TABLE `progression` (
  `progressID` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `sellDate` datetime NOT NULL,
  `useDate` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `supply` varchar(50) NOT NULL,
  `phone` int(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `serviceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progression`
--

INSERT INTO `progression` (`progressID`, `customerName`, `sellDate`, `useDate`, `status`, `supply`, `phone`, `email`, `serviceID`) VALUES
(213, '', '2022-05-03 16:33:32', '2022-05-03 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17),
(214, '', '2022-05-03 16:33:32', '2022-05-03 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17),
(215, '', '2022-05-03 16:33:33', '2022-05-03 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17),
(216, '', '2022-05-03 16:33:33', '2022-05-03 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17),
(217, '', '2022-05-03 16:33:33', '2022-05-03 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17),
(221, 'Phù Hiếu Tinh', '2022-05-03 16:35:05', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'con22441999@gmail.com', 17),
(222, 'Phù Hiếu Tinh', '2022-05-03 16:35:06', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'con22441999@gmail.com', 17),
(223, 'Phù Hiếu Tinh', '2022-05-03 16:35:07', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'con22441999@gmail.com', 17),
(224, 'Phù Hiếu Tinh', '2022-05-03 16:35:07', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'con22441999@gmail.com', 17),
(225, 'Phù Hiếu Tinh', '2022-05-03 16:35:07', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'con22441999@gmail.com', 17),
(226, 'Phù Hiếu Tinh', '2022-05-03 16:35:07', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'con22441999@gmail.com', 17),
(227, 'Phù Hiếu Tinh', '2022-05-03 17:25:09', '2022-05-03 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'toan22442244@gmail.com', 18),
(229, '', '2022-05-03 17:36:19', '2022-05-03 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19),
(230, '', '2022-05-09 14:22:06', '2022-05-09 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20),
(231, '', '2022-05-09 14:22:10', '2022-05-09 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 16),
(232, 'ProductID', '2022-05-09 14:23:55', '2022-05-09 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'tinhphgcs17226@fpt.edu.vn', 20),
(233, 'Tinh Hiếu Phù', '2022-05-09 14:24:02', '2022-05-09 17:30:00', 'Đang chờ', 'Kiosk', 834646929, 'tinhphu2244@gmail.com', 16),
(234, '', '2022-05-09 14:25:34', '2022-05-09 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17),
(235, '', '2022-05-09 14:28:04', '2022-05-09 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(11) NOT NULL,
  `roleName` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `descriptive` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `roleName`, `quantity`, `descriptive`, `function`) VALUES
(10, 'Admin', 1, 'Quản lý toàn bộ trang web', 'X,Y,Z'),
(11, 'Quản lý', 0, 'Hello quản lý', 'X,Y,Z'),
(12, 'User', 1, 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'A,B,C'),
(13, 'Kế Toán', 1, 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'X,Y,Z'),
(14, 'Bác sĩ', 1, 'Khám mắt', 'X,Y,Z'),
(15, 'Quản lý A', 1, 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'X,Y,Z');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceID` int(11) NOT NULL,
  `serviceName` varchar(50) NOT NULL,
  `descriptive` varchar(255) NOT NULL,
  `serviceStatus` varchar(50) NOT NULL,
  `serviceDate` datetime NOT NULL,
  `prefix_id` int(11) NOT NULL,
  `surfix_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceID`, `serviceName`, `descriptive`, `serviceStatus`, `serviceDate`, `prefix_id`, `surfix_id`) VALUES
(16, 'Khám tim mạch', 'kham tim', 'Hoạt động', '2022-05-01 21:17:55', 0, 0),
(17, 'Khám tai muỗi họng', 'Khám những bệnh liên quan về tai, muỗi, họng', 'Ngưng hoạt động', '2022-05-03 17:26:28', 0, 0),
(18, 'Khám răng', 'kham rang', 'Hoạt động', '2022-04-29 21:18:30', 0, 0),
(19, 'Khám mắt', 'Khám mắt', 'Hoạt động', '2022-04-28 21:18:45', 0, 0),
(20, 'Khám phụ khoa', 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'Hoạt động', '2022-05-09 11:45:40', 22, 0),
(223, 'Khám tai', 'Khám những bệnh liên quan về tai, muỗi, họng', 'Hoạt động', '2022-05-09 14:27:41', 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `phone` int(13) NOT NULL,
  `pw` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `username`, `phone`, `pw`, `email`, `status`, `picture`, `roleID`) VALUES
(54, 'Tinh', 'admin', 834646929, '123123', 'tinhphu2244@gmail.com', 'Hoạt động', 'OIP.jfif', 10),
(55, 'Phù Hiếu Tinh', 'user', 834646929, '123123', 'con22441999@gmail.com', 'Hoạt động', '', 12),
(56, 'ProductID', 'admin123', 834646929, '123123', 'tinhphgcs17226@fpt.edu.vn', 'Hoạt động', '', 13),
(57, 'ProductID', 'admin2222', 834646929, '123123', 'user11@gmail.com', 'Hoạt động', '', 14),
(58, 'ProductID', 'admin11112222', 834646929, '123123', 'tinhphgcs17226@fpt.edu.vnaaa', 'Hoạt động', '', 15);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `userlogID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `userlogTime` datetime NOT NULL,
  `IPaddress` int(11) NOT NULL,
  `userlogAction` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`userlogID`, `userID`, `userlogTime`, `IPaddress`, `userlogAction`) VALUES
(1, 54, '2022-05-03 12:10:27', 0, 'Upload file success File Name is 11111.jfif'),
(2, 54, '2022-05-03 13:53:11', 0, 'Add role success Role Name is Quản lý'),
(3, 54, '2022-05-03 14:28:03', 0, 'Update role success Role Name is Quản lý'),
(4, 54, '2022-05-03 16:33:29', 0, 'add progress success'),
(5, 54, '2022-05-03 16:33:31', 0, 'add progress success'),
(6, 54, '2022-05-03 16:33:32', 0, 'add progress success'),
(7, 54, '2022-05-03 16:33:32', 0, 'add progress success'),
(8, 54, '2022-05-03 16:33:32', 0, 'add progress success'),
(9, 54, '2022-05-03 16:33:32', 0, 'add progress success'),
(10, 54, '2022-05-03 16:33:33', 0, 'add progress success'),
(11, 54, '2022-05-03 16:33:33', 0, 'add progress success'),
(12, 54, '2022-05-03 16:33:33', 0, 'add progress success'),
(13, 54, '2022-05-03 16:33:33', 0, 'add progress success'),
(14, 54, '2022-05-03 16:33:33', 0, 'add progress success'),
(15, 54, '2022-05-03 16:33:33', 0, 'add progress success'),
(16, 54, '2022-05-03 16:34:19', 0, 'Add role success Role Name is User'),
(17, 54, '2022-05-03 16:34:27', 0, 'Update role success Role Name is User'),
(18, 54, '2022-05-03 16:34:52', 0, 'Add account success userName is user'),
(19, 55, '2022-05-03 16:35:05', 0, 'add progress success progressID'),
(20, 55, '2022-05-03 16:35:07', 0, 'add progress success progressID'),
(21, 55, '2022-05-03 16:35:07', 0, 'add progress success progressID'),
(22, 55, '2022-05-03 16:35:07', 0, 'add progress success progressID'),
(23, 55, '2022-05-03 16:35:07', 0, 'add progress success progressID'),
(24, 55, '2022-05-03 16:35:07', 0, 'add progress success progressID'),
(25, 54, '2022-05-03 16:37:06', 0, 'Add monitor Name success monitor Name is Kiosk'),
(26, 54, '2022-05-03 16:51:15', 0, 'Update role success Role Name is Quản lý'),
(27, 54, '2022-05-03 16:51:38', 0, 'Update role success Role Name is Quản lý'),
(28, 54, '2022-05-03 16:52:29', 0, 'Update role success Role Name is Quản lý'),
(29, 54, '2022-05-03 16:52:55', 0, 'Update role success Role Name is Quản lý'),
(30, 54, '2022-05-03 16:55:11', 0, 'Update role success Role Name is Quản lý'),
(31, 54, '2022-05-03 16:56:51', 0, 'Update role success Role Name is Admin'),
(32, 54, '2022-05-03 16:56:59', 0, 'Update role success Role Name is User'),
(33, 55, '2022-05-03 17:25:09', 0, 'add progress success progressID'),
(34, 54, '2022-05-03 17:25:25', 0, 'Upload file success File Name is 10330493_353888028114823_7905851435560148174_n.jpg'),
(35, 54, '2022-05-03 17:25:54', 0, 'Add monitor Name success monitor Name is Kiosk'),
(36, 54, '2022-05-03 17:26:04', 0, 'Update monitor Name success monitor Name is Kiosk'),
(37, 54, '2022-05-03 17:26:28', 0, 'Update service success Service Name is Khám tai muỗi họng'),
(38, 54, '2022-05-03 17:27:04', 0, 'Add role success Role Name is Kế Toán'),
(39, 54, '2022-05-03 17:27:13', 0, 'Update role success Role Name is Kế Toán'),
(40, 54, '2022-05-03 17:27:25', 0, 'Update role success Role Name is Kế Toán'),
(41, 54, '2022-05-03 17:27:41', 0, 'Update account success userName is user'),
(42, 54, '2022-05-03 17:27:46', 0, 'Update account success userName is user'),
(43, 54, '2022-05-03 17:28:02', 0, 'Add account success userName is admin123'),
(44, 54, '2022-05-03 17:34:07', 0, 'Upload file success File Name is 11111.jfif'),
(45, 54, '2022-05-03 17:34:28', 0, 'Add role success Role Name is Bác sĩ'),
(46, 54, '2022-05-03 17:34:58', 0, 'Add account success userName is admin2222'),
(47, 54, '2022-05-03 17:35:17', 0, 'Add monitor Name success monitor Name is Kiosk'),
(48, 54, '2022-05-03 17:35:23', 0, 'Update monitor Name success monitor Name is Kiosk'),
(49, 54, '2022-05-03 17:35:31', 0, 'Update monitor Name success monitor Name is Kiosk'),
(50, 55, '2022-05-03 17:36:03', 0, 'add progress success progressID'),
(51, 54, '2022-05-03 17:36:19', 0, 'add progress success'),
(52, 54, '2022-05-03 17:36:48', 0, 'Upload file success File Name is images.jfif'),
(53, 54, '2022-05-03 17:37:05', 0, 'Add monitor Name success monitor Name is Kiosk'),
(54, 54, '2022-05-03 17:37:17', 0, 'Update monitor Name success monitor Name is Kiosk'),
(55, 54, '2022-05-03 17:37:42', 0, 'Add service success Service Name is Khám phụ khoa'),
(56, 54, '2022-05-03 17:37:46', 0, 'Update service success Service Name is Khám phụ khoa'),
(57, 54, '2022-05-09 08:48:27', 0, 'Add monitor Name success monitor Name is Kiosk'),
(58, 54, '2022-05-09 11:25:34', 0, 'Add service success Service Name is Khám tim mạch'),
(59, 54, '2022-05-09 11:27:44', 0, 'Add service success Service Name is Khám tim mạch'),
(60, 54, '2022-05-09 11:27:49', 0, 'Add service success Service Name is Khám tim mạch'),
(61, 54, '2022-05-09 11:31:23', 0, 'Add service success Service Name is Khám tim mạch'),
(62, 54, '2022-05-09 11:32:28', 0, 'Add service success Service Name is Khám tim mạch'),
(63, 54, '2022-05-09 11:32:40', 0, 'Add service success Service Name is Khám tim mạch'),
(64, 54, '2022-05-09 11:33:17', 0, 'Add service success Service Name is Khám tim mạch'),
(65, 54, '2022-05-09 11:34:23', 0, 'Add service success Service Name is Khám tim mạch'),
(66, 54, '2022-05-09 11:34:37', 0, 'Add service success Service Name is Khám tim mạch'),
(67, 54, '2022-05-09 11:36:15', 0, 'Add service success Service Name is Khám tim mạch'),
(68, 54, '2022-05-09 11:37:34', 0, 'Add service success Service Name is Khám tai muỗi họng'),
(69, 54, '2022-05-09 11:38:09', 0, 'Add service success Service Name is Khám răng'),
(70, 54, '2022-05-09 11:39:29', 0, 'Add service success Service Name is Khám răng'),
(71, 54, '2022-05-09 11:40:24', 0, 'Add service success Service Name is asd'),
(72, 54, '2022-05-09 11:41:01', 0, 'Add service success Service Name is '),
(73, 54, '2022-05-09 11:43:56', 0, 'Add service success Service Name is Khám tim mạch'),
(74, 54, '2022-05-09 11:44:56', 0, 'Update service success Service Name is Khám phụ khoa'),
(75, 54, '2022-05-09 11:45:10', 0, 'Update service success Service Name is Khám phụ khoa'),
(76, 54, '2022-05-09 11:45:30', 0, 'Update service success Service Name is Khám phụ khoa'),
(77, 54, '2022-05-09 11:45:40', 0, 'Update service success Service Name is Khám phụ khoa'),
(78, 54, '2022-05-09 14:16:40', 0, 'Add service success Service Name is Khám tim mạch'),
(79, 54, '2022-05-09 14:22:06', 0, 'add progress success'),
(80, 54, '2022-05-09 14:22:10', 0, 'add progress success'),
(81, 55, '2022-05-09 14:23:56', 0, 'add progress success progressID'),
(82, 55, '2022-05-09 14:24:02', 0, 'add progress success progressID'),
(83, 54, '2022-05-09 14:24:18', 0, 'Upload file success File Name is OIP.jfif'),
(84, 54, '2022-05-09 14:24:52', 0, 'Add monitor Name success monitor Name is Kiosk'),
(85, 54, '2022-05-09 14:25:18', 0, 'Update monitor Name success monitor Name is Kiosk'),
(86, 54, '2022-05-09 14:25:34', 0, 'add progress success'),
(87, 54, '2022-05-09 14:25:46', 0, 'Add role success Role Name is Quản lý A'),
(88, 54, '2022-05-09 14:26:14', 0, 'Add account success userName is admin11112222'),
(89, 54, '2022-05-09 14:27:28', 0, 'Add service success Service Name is Khám tai'),
(90, 54, '2022-05-09 14:27:41', 0, 'Update service success Service Name is Khám tai'),
(91, 54, '2022-05-09 14:28:04', 0, 'add progress success');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`monitorID`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indexes for table `progression`
--
ALTER TABLE `progression`
  ADD PRIMARY KEY (`progressID`),
  ADD KEY `serviceID` (`serviceID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `roleID` (`roleID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`userlogID`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
  MODIFY `monitorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `progression`
--
ALTER TABLE `progression`
  MODIFY `progressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `userlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `monitor`
--
ALTER TABLE `monitor`
  ADD CONSTRAINT `monitor_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `service` (`serviceID`);

--
-- Constraints for table `progression`
--
ALTER TABLE `progression`
  ADD CONSTRAINT `progression_ibfk_1` FOREIGN KEY (`serviceID`) REFERENCES `service` (`serviceID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`);

--
-- Constraints for table `userlog`
--
ALTER TABLE `userlog`
  ADD CONSTRAINT `userlog_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
