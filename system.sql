-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2022 at 01:11 PM
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
(94, '77', 'Kiosk', 'Display counter', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 19, 'Khám tim mạch, Khám răng, Khám mắt'),
(95, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Ngưng hoạt động', 'Mất kết nối', 18, 'Khám tai muỗi họng, Khám răng'),
(96, '77', 'Kiosk', 'Kiosk', 'CMS', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 17, 'Khám tai muỗi họng'),
(97, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Mất kết nối', 17, 'Khám tim mạch, Khám tai muỗi họng'),
(98, '992', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Mất kết nối', 19, 'Khám tim mạch, Khám tai muỗi họng, Khám răng, Khám mắt'),
(99, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 17, 'Khám tim mạch, Khám tai muỗi họng'),
(100, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 16, 'Khám tim mạch'),
(101, '99', 'Kiosk', 'Kiosk', 'admin', '123123', '128.172.308', 'Hoạt động', 'Kết nối', 18, 'Khám tim mạch, Khám tai muỗi họng, Khám răng');

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
  `serviceID` int(11) NOT NULL,
  `stt_progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progression`
--

INSERT INTO `progression` (`progressID`, `customerName`, `sellDate`, `useDate`, `status`, `supply`, `phone`, `email`, `serviceID`, `stt_progress`) VALUES
(308, '', '2022-05-15 14:19:38', '2022-05-18 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 17, 222),
(314, '', '2022-05-19 10:50:34', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 200),
(315, '', '2022-05-19 10:50:35', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 201),
(316, '', '2022-05-19 10:50:35', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 202),
(317, '', '2022-05-19 10:50:35', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 203),
(318, '', '2022-05-19 10:50:36', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 204),
(319, '', '2022-05-19 10:50:36', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 205),
(320, '', '2022-05-19 10:50:36', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 206),
(321, '', '2022-05-19 10:50:36', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 207),
(322, '', '2022-05-19 10:50:36', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 208),
(323, '', '2022-05-19 10:50:36', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 209),
(324, '', '2022-05-19 10:50:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 210),
(325, '', '2022-05-19 10:50:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 211),
(326, '', '2022-05-19 10:50:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 212),
(327, '', '2022-05-19 10:50:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 213),
(328, '', '2022-05-16 10:50:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 214),
(329, '', '2022-05-19 10:50:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 215),
(330, '', '2022-05-19 10:50:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 216),
(331, '', '2022-05-19 10:50:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 217),
(332, '', '2022-05-19 10:50:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 218),
(333, '', '2022-05-19 10:50:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 18, 219),
(334, '', '2022-05-19 12:14:11', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 333),
(335, '', '2022-05-19 12:14:13', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 334),
(336, '', '2022-05-19 12:14:13', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 335),
(337, '', '2022-05-19 12:14:13', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 336),
(338, '', '2022-05-19 12:14:13', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 337),
(339, '', '2022-05-19 12:14:13', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 338),
(340, '', '2022-05-19 12:14:15', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 339),
(341, '', '2022-05-19 12:14:15', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 340),
(342, '', '2022-05-19 12:14:15', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 341),
(343, '', '2022-05-19 12:14:16', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 342),
(344, '', '2022-05-19 12:14:16', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 343),
(345, '', '2022-05-19 12:14:16', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 344),
(346, '', '2022-05-19 12:14:17', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 345),
(347, '', '2022-05-19 12:14:17', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 346),
(348, '', '2022-05-19 12:14:17', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 347),
(349, '', '2022-05-19 12:14:18', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 348),
(350, '', '2022-05-19 12:14:18', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 19, 349),
(351, '', '2022-05-19 12:14:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 444),
(352, '', '2022-05-19 12:14:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 445),
(353, '', '2022-05-19 12:14:38', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 446),
(354, '', '2022-05-19 12:14:39', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 447),
(355, '', '2022-05-19 12:14:39', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 448),
(356, '', '2022-05-19 12:14:39', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 449),
(357, '', '2022-05-19 12:14:40', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 450),
(358, '', '2022-05-19 12:14:40', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 20, 451),
(359, '', '2022-05-19 12:18:27', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 555),
(360, '', '2022-05-19 12:18:28', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 556),
(361, '', '2022-05-19 12:18:29', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 557),
(362, '', '2022-05-19 12:18:29', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 558),
(363, '', '2022-05-19 12:18:29', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 559),
(364, '', '2022-05-19 12:18:29', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 560),
(365, '', '2022-05-10 12:18:30', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 561),
(366, '', '2022-05-10 12:18:30', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 562),
(367, '', '2022-05-09 12:18:30', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 563),
(368, '', '2022-05-11 12:18:30', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 564),
(369, '', '2022-05-19 12:18:30', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 565),
(370, '', '2022-05-19 12:18:30', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 566),
(371, '', '2022-05-19 12:18:31', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 567),
(372, '', '2022-05-19 12:18:31', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 568),
(373, '', '2022-05-19 12:18:31', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 569),
(374, '', '2022-05-19 12:18:31', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 570),
(375, '', '2022-05-19 12:18:31', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 571),
(376, '', '2022-05-19 12:18:32', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 572),
(377, '', '2022-05-19 12:18:32', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 573),
(378, '', '2022-05-19 12:18:32', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 223, 574),
(388, '', '2022-05-19 17:43:37', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 16, 222),
(389, '', '2022-05-19 17:58:43', '2022-05-19 17:30:00', 'Đang chờ', 'Hệ thống', 0, '', 16, 223);

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
(11, 'Quản lý', 1, 'Hello quản lý', 'X,Y,Z'),
(12, 'User', 2, 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'A,B,C'),
(13, 'Kế Toán', 1, 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'X,Y,Z'),
(14, 'Bác sĩ', 1, 'Khám mắt', 'X,Y,Z'),
(15, 'Quản lý A', 1, 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'X,Y,Z'),
(16, 'Bác sĩ A', 1, '', 'X,Y,Z');

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
  `prefix_id` varchar(30) NOT NULL,
  `surfix_id` varchar(30) NOT NULL,
  `stt_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceID`, `serviceName`, `descriptive`, `serviceStatus`, `serviceDate`, `prefix_id`, `surfix_id`, `stt_service`) VALUES
(16, 'Khám tim mạch', 'kham tim', 'Hoạt động', '2022-05-19 17:43:29', 'KT_', '_end', 222),
(17, 'Khám tai muỗi họng', 'Khám những bệnh liên quan về tai, muỗi, họng', 'Ngưng hoạt động', '2022-05-17 12:05:18', '0', '0', 222),
(18, 'Khám răng', 'kham rang', 'Hoạt động', '2022-05-17 14:57:58', 'KR_', '_REND', 200),
(19, 'Khám mắt', 'Khám mắt', 'Hoạt động', '2022-05-17 12:05:22', '0', '0', 333),
(20, 'Khám phụ khoa', 'thực hiện nhiệm vụ thống kê số liệu và tổng hợp dữ liệu', 'Hoạt động', '2022-05-17 12:05:26', '22', '0', 444),
(223, 'Khám tai', 'Khám những bệnh liên quan về tai, muỗi, họng', 'Hoạt động', '2022-05-17 12:05:30', '123', '0', 555);

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
(54, 'Tinh', 'admin', 834646929, '123123', 'tinhphu2244@gmail.com', 'Hoạt động', '13445244_387048514798774_4483890631897585445_n.jpg', 10),
(55, 'Phù Hiếu Tinh', 'user', 834646929, '123123', 'con22441999@gmail.com', 'Hoạt động', '', 12),
(56, 'ProductID', 'admin123', 834646929, '123123', 'tinhphgcs17226@fpt.edu.vn', 'Hoạt động', '', 13),
(57, 'ProductID', 'admin2222', 834646929, '123123', 'user11@gmail.com', 'Hoạt động', '', 14),
(58, 'ProductID', 'admin11112222', 834646929, '123123', 'tinhphgcs17226@fpt.edu.vnaaa', 'Hoạt động', '', 15),
(59, 'Phù Hiếu Tinh', 'admin222', 834646929, '123123', 'toan22442244@gmail.com222', 'Hoạt động', '', 16),
(60, '113 Tinh', 'user113', 834646929, '123123', 'tinhphu2244@gmail.com222', 'Hoạt động', '', 12),
(61, 'Phù Hiếu Tinh', 'admin123123123', 0, '123123', 'toan22442244@gmail.cossssm', 'Hoạt động', '', 11);

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
(261, 54, '2022-05-18 14:19:38', 0, 'add progress success'),
(262, 55, '2022-05-18 14:23:19', 0, 'add progress success progressID'),
(263, 55, '2022-05-18 14:28:03', 0, 'add progress success progressID'),
(264, 55, '2022-05-18 14:29:15', 0, 'add progress success progressID'),
(265, 55, '2022-05-18 14:31:21', 0, 'add progress success progressID'),
(266, 55, '2022-05-18 14:31:23', 0, 'add progress success progressID'),
(267, 54, '2022-05-18 20:51:51', 0, 'Update monitor Name success monitor Name is Kiosk'),
(268, 54, '2022-05-19 09:24:37', 0, 'Upload file success File Name is 13445244_387048514798774_4483890631897585445_n.jpg'),
(269, 54, '2022-05-19 10:50:34', 0, 'add progress success'),
(270, 54, '2022-05-19 10:50:35', 0, 'add progress success'),
(271, 54, '2022-05-19 10:50:35', 0, 'add progress success'),
(272, 54, '2022-05-19 10:50:35', 0, 'add progress success'),
(273, 54, '2022-05-19 10:50:36', 0, 'add progress success'),
(274, 54, '2022-05-19 10:50:36', 0, 'add progress success'),
(275, 54, '2022-05-19 10:50:36', 0, 'add progress success'),
(276, 54, '2022-05-19 10:50:36', 0, 'add progress success'),
(277, 54, '2022-05-19 10:50:36', 0, 'add progress success'),
(278, 54, '2022-05-19 10:50:36', 0, 'add progress success'),
(279, 54, '2022-05-19 10:50:37', 0, 'add progress success'),
(280, 54, '2022-05-19 10:50:37', 0, 'add progress success'),
(281, 54, '2022-05-19 10:50:37', 0, 'add progress success'),
(282, 54, '2022-05-19 10:50:37', 0, 'add progress success'),
(283, 54, '2022-05-19 10:50:37', 0, 'add progress success'),
(284, 54, '2022-05-19 10:50:38', 0, 'add progress success'),
(285, 54, '2022-05-19 10:50:38', 0, 'add progress success'),
(286, 54, '2022-05-19 10:50:38', 0, 'add progress success'),
(287, 54, '2022-05-19 10:50:38', 0, 'add progress success'),
(288, 54, '2022-05-19 10:50:38', 0, 'add progress success'),
(289, 54, '2022-05-19 12:14:12', 0, 'add progress success'),
(290, 54, '2022-05-19 12:14:13', 0, 'add progress success'),
(291, 54, '2022-05-19 12:14:13', 0, 'add progress success'),
(292, 54, '2022-05-19 12:14:13', 0, 'add progress success'),
(293, 54, '2022-05-19 12:14:13', 0, 'add progress success'),
(294, 54, '2022-05-19 12:14:13', 0, 'add progress success'),
(295, 54, '2022-05-19 12:14:15', 0, 'add progress success'),
(296, 54, '2022-05-19 12:14:15', 0, 'add progress success'),
(297, 54, '2022-05-19 12:14:15', 0, 'add progress success'),
(298, 54, '2022-05-19 12:14:16', 0, 'add progress success'),
(299, 54, '2022-05-19 12:14:16', 0, 'add progress success'),
(300, 54, '2022-05-19 12:14:17', 0, 'add progress success'),
(301, 54, '2022-05-19 12:14:17', 0, 'add progress success'),
(302, 54, '2022-05-19 12:14:17', 0, 'add progress success'),
(303, 54, '2022-05-19 12:14:17', 0, 'add progress success'),
(304, 54, '2022-05-19 12:14:18', 0, 'add progress success'),
(305, 54, '2022-05-19 12:14:18', 0, 'add progress success'),
(306, 54, '2022-05-19 12:14:37', 0, 'add progress success'),
(307, 54, '2022-05-19 12:14:38', 0, 'add progress success'),
(308, 54, '2022-05-19 12:14:38', 0, 'add progress success'),
(309, 54, '2022-05-19 12:14:39', 0, 'add progress success'),
(310, 54, '2022-05-19 12:14:39', 0, 'add progress success'),
(311, 54, '2022-05-19 12:14:39', 0, 'add progress success'),
(312, 54, '2022-05-19 12:14:40', 0, 'add progress success'),
(313, 54, '2022-05-19 12:14:40', 0, 'add progress success'),
(314, 54, '2022-05-19 12:18:27', 0, 'add progress success'),
(315, 54, '2022-05-19 12:18:29', 0, 'add progress success'),
(316, 54, '2022-05-19 12:18:29', 0, 'add progress success'),
(317, 54, '2022-05-19 12:18:29', 0, 'add progress success'),
(318, 54, '2022-05-19 12:18:29', 0, 'add progress success'),
(319, 54, '2022-05-19 12:18:29', 0, 'add progress success'),
(320, 54, '2022-05-19 12:18:30', 0, 'add progress success'),
(321, 54, '2022-05-19 12:18:30', 0, 'add progress success'),
(322, 54, '2022-05-19 12:18:30', 0, 'add progress success'),
(323, 54, '2022-05-19 12:18:30', 0, 'add progress success'),
(324, 54, '2022-05-19 12:18:30', 0, 'add progress success'),
(325, 54, '2022-05-19 12:18:31', 0, 'add progress success'),
(326, 54, '2022-05-19 12:18:31', 0, 'add progress success'),
(327, 54, '2022-05-19 12:18:31', 0, 'add progress success'),
(328, 54, '2022-05-19 12:18:31', 0, 'add progress success'),
(329, 54, '2022-05-19 12:18:31', 0, 'add progress success'),
(330, 54, '2022-05-19 12:18:31', 0, 'add progress success'),
(331, 54, '2022-05-19 12:18:32', 0, 'add progress success'),
(332, 54, '2022-05-19 12:18:32', 0, 'add progress success'),
(333, 54, '2022-05-19 12:18:32', 0, 'add progress success'),
(334, 54, '2022-05-19 12:18:37', 0, 'add progress success'),
(335, 54, '2022-05-19 12:18:37', 0, 'add progress success'),
(336, 54, '2022-05-19 12:18:37', 0, 'add progress success'),
(337, 54, '2022-05-19 12:18:38', 0, 'add progress success'),
(338, 54, '2022-05-19 12:18:38', 0, 'add progress success'),
(339, 54, '2022-05-19 12:18:38', 0, 'add progress success'),
(340, 54, '2022-05-19 12:18:38', 0, 'add progress success'),
(341, 54, '2022-05-19 12:18:38', 0, 'add progress success'),
(342, 54, '2022-05-19 12:18:39', 0, 'add progress success'),
(343, 54, '2022-05-19 17:43:29', 0, 'Update service success Service Name is Khám tim mạch'),
(344, 54, '2022-05-19 17:43:37', 0, 'add progress success'),
(345, 54, '2022-05-19 17:58:27', 0, 'Update monitor Name success monitor Name is Kiosk'),
(346, 54, '2022-05-19 17:58:43', 0, 'add progress success'),
(347, 54, '2022-05-19 17:59:25', 0, 'Add service success Service Name is Kham Đa Khoa'),
(348, 54, '2022-05-19 18:01:09', 0, 'Add service success Service Name is Kham Đa Khoa'),
(349, 54, '2022-05-19 18:03:39', 0, 'Add service success Service Name is Khám răng'),
(350, 54, '2022-05-19 18:04:46', 0, 'Add service success Service Name is Khám răng'),
(351, 54, '2022-05-19 18:05:26', 0, 'Add service success Service Name is Khám phụ khoaaaa'),
(352, 54, '2022-05-19 18:07:06', 0, 'Add account success userName is admin123123123'),
(353, 54, '2022-05-19 18:09:26', 0, 'Add service success Service Name is Khám tim mạch123123'),
(354, 54, '2022-05-19 18:09:42', 0, 'Add service success Service Name is Khám tim mạch123123'),
(355, 54, '2022-05-19 18:09:53', 0, 'Add service success Service Name is Khám tim mạch123123');

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
  MODIFY `monitorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `progression`
--
ALTER TABLE `progression`
  MODIFY `progressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `userlogID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;

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
