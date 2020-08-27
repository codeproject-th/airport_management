-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2015 at 10:49 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airport_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE IF NOT EXISTS `aircraft` (
  `Idair` int(10) NOT NULL,
  `Des_air` text COMMENT 'รายละเอียดเครื่องบิน',
  `Model` varchar(50) DEFAULT NULL COMMENT 'แบบของเครื่องบิน',
  `Owner` varchar(100) DEFAULT NULL COMMENT 'ชื่อเจ้าของ',
  `Iden_doc` varchar(50) DEFAULT NULL COMMENT 'เอกสารประจาเครื่อง',
  `Idmem` int(11) DEFAULT NULL COMMENT 'รหัสประจาตัวสมาชิก',
  `doc1` int(1) NOT NULL,
  `doc2` int(1) NOT NULL,
  `doc3` int(1) NOT NULL,
  `doc4` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='ข้อมูลเครื่องบิน';

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`Idair`, `Des_air`, `Model`, `Owner`, `Iden_doc`, `Idmem`, `doc1`, `doc2`, `doc3`, `doc4`) VALUES
(1, 'test', '888', 'ทดสอบ', '12399', 1, 0, 0, 0, 0),
(2, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(3, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(4, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(5, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0),
(6, '123456', '759', 'ฟฟ', '001', 1, 0, 0, 0, 0),
(7, 'test007', 'ultralight', '007', '', 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dep_air`
--

CREATE TABLE IF NOT EXISTS `dep_air` (
  `Idda` int(11) NOT NULL,
  `Dateda` date DEFAULT NULL COMMENT 'วันที่',
  `Dateda_end` date DEFAULT NULL COMMENT 'วันที่สิ้นสุด',
  `Ser_charge` int(10) DEFAULT NULL COMMENT 'ค่าบริการ',
  `Confirm` int(1) NOT NULL COMMENT '0=ยังไม่ยื่นยัน 1=ยืนยันแล้ว',
  `Idair` int(11) DEFAULT NULL COMMENT 'รหัสเครื่องบิน',
  `Idhang` int(11) DEFAULT NULL COMMENT 'รหัสโรงเก็บเครื่องบิน',
  `Idmem` int(11) DEFAULT NULL COMMENT 'รหัสประจาตัวสมาชิก'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='เก็บข้อมูลการบริการรับฝากเครื่องบิน';

--
-- Dumping data for table `dep_air`
--

INSERT INTO `dep_air` (`Idda`, `Dateda`, `Dateda_end`, `Ser_charge`, `Confirm`, `Idair`, `Idhang`, `Idmem`) VALUES
(1, '2015-12-05', '2016-01-04', 2500, 1, 6, NULL, 1),
(2, '2016-01-01', '2016-01-21', 2500, 1, 1, 1, 1),
(4, '2015-12-16', '2016-01-15', 2500, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hangar`
--

CREATE TABLE IF NOT EXISTS `hangar` (
  `Idhang` int(11) NOT NULL,
  `Name_hang` varchar(100) DEFAULT NULL COMMENT 'ชื่อโรงเก็บเครื่องบิน',
  `Model` varchar(100) DEFAULT NULL COMMENT 'แบบของโรงเก็บเครื่องบิน',
  `quantity` int(10) DEFAULT NULL COMMENT 'จำนวนที่จอด'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='โรงเก็บเครื่องบิน';

--
-- Dumping data for table `hangar`
--

INSERT INTO `hangar` (`Idhang`, `Name_hang`, `Model`, `quantity`) VALUES
(1, 'ทดสอบ1', '555', 31);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `Idmem` int(11) NOT NULL,
  `Member_type` int(2) NOT NULL COMMENT '1=ปกติ 2=รายปี เสีย2500 บาท',
  `Expires` date DEFAULT NULL COMMENT 'วันที่หมดอายุ',
  `Nameuser` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `Surname` varchar(100) DEFAULT NULL COMMENT 'นามสกุล',
  `ID_card` varchar(20) DEFAULT NULL COMMENT 'หมายเลขบัตรประชาชน',
  `Address` text COMMENT 'ที่อยู่',
  `Age` int(3) DEFAULT NULL COMMENT 'อายุ',
  `Gender` varchar(10) DEFAULT NULL COMMENT 'เพศ',
  `Telephone` varchar(100) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `Vocation` varchar(100) DEFAULT NULL COMMENT 'อาชีพ',
  `Mem_payment` float(10,1) DEFAULT NULL COMMENT 'ค่าสมาชิก',
  `Username` varchar(100) DEFAULT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `Password` varchar(100) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `Reg_date` date NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='สมาชิก';

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Idmem`, `Member_type`, `Expires`, `Nameuser`, `Surname`, `ID_card`, `Address`, `Age`, `Gender`, `Telephone`, `Vocation`, `Mem_payment`, `Username`, `Password`, `Reg_date`) VALUES
(1, 1, '2016-02-26', 'aaa', 'aaa', '111111188', '1122', 10, 'M', '1122', '88', 2500.0, 'test', 'test', '2015-12-01'),
(2, 2, '2015-12-31', '558', '888', '12544', '5555', 10, 'M', '125', '88', 0.0, 'amphol', 'amphol', '0000-00-00'),
(3, 2, '2016-12-11', 'กิจจักร', 'สมคิด', '1111111111', 'hhh', 10, 'M', '11111', '111111', 2500.0, 'amphol55', 'amphol55', '0000-00-00'),
(4, 2, '2016-12-15', 'อำพลทดสอบ', 'เทียมนุช', '3', '3', 50, 'M', '99', '', 2500.0, 'sssss', 'sssss', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `order_data`
--

CREATE TABLE IF NOT EXISTS `order_data` (
  `order_data_id` int(11) NOT NULL,
  `order_data_type` int(5) NOT NULL COMMENT '1=ค่าสมัครสมาชิก 2=ค่าเช่าสนามบิน 3=ค่าฝากเครื่อนบิน',
  `order_data_price` int(10) NOT NULL,
  `order_data_date` datetime DEFAULT NULL,
  `order_data_status` int(1) NOT NULL COMMENT '0=ยังไม่ยื่นยัน 1=ยืนยันแล้ว',
  `Idmem` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_data`
--

INSERT INTO `order_data` (`order_data_id`, `order_data_type`, `order_data_price`, `order_data_date`, `order_data_status`, `Idmem`, `order_id`) VALUES
(1, 2, 400, '2015-12-05 11:03:49', 1, 1, 4),
(2, 3, 2500, '2015-12-05 12:43:41', 1, 1, 1),
(3, 1, 2500, '2015-12-12 20:37:54', 1, 3, 3),
(4, 1, 2500, '2015-12-16 20:12:18', 1, 4, 4),
(5, 3, 2500, '2015-12-16 20:14:45', 1, 1, 4),
(6, 2, 100, '2015-12-16 20:25:18', 1, 1, 5),
(7, 2, 1400, '2015-12-16 22:35:01', 1, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `Idper` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL COMMENT 'ชื่อ',
  `Surname` varchar(100) DEFAULT NULL COMMENT 'นามสกุล',
  `Address` text COMMENT 'ที่อยู่',
  `Age` int(3) DEFAULT NULL COMMENT 'อายุ',
  `Gender` varchar(10) DEFAULT NULL COMMENT 'เพศ',
  `Telephone` varchar(50) DEFAULT NULL COMMENT 'เบอร์โทร',
  `Position` varchar(100) DEFAULT NULL COMMENT 'ตำแหน่ง'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='พนักงาน';

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`Idper`, `Name`, `Surname`, `Address`, `Age`, `Gender`, `Telephone`, `Position`) VALUES
(2, 'อำพล', 'เทียมนุช', '31/4', 29, 'M', '0897422423', 'โปรแกรมเมอร์'),
(4, '55555', '5555', 'v', 30, 'M', '1', '1'),
(5, 'vv', 'vv', 'vv', 1, 'M', 'rr', 'ff');

-- --------------------------------------------------------

--
-- Table structure for table `public`
--

CREATE TABLE IF NOT EXISTS `public` (
  `Intpub` int(11) NOT NULL,
  `Public_name` varchar(200) NOT NULL COMMENT 'รายละเอียคค่าสาธารณูปโภค',
  `Datepub` date NOT NULL COMMENT 'วันที่',
  `Money` int(10) NOT NULL COMMENT 'จำนวนเงิน'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='เก็บข้อมูลสาธารณูปโภค';

--
-- Dumping data for table `public`
--

INSERT INTO `public` (`Intpub`, `Public_name`, `Datepub`, `Money`) VALUES
(1, 'ทดสอบ55', '2015-12-03', 100);

-- --------------------------------------------------------

--
-- Table structure for table `ren_ser`
--

CREATE TABLE IF NOT EXISTS `ren_ser` (
  `Idrs` int(11) NOT NULL,
  `Daters` date DEFAULT NULL COMMENT 'วันที่',
  `Daters_end` date DEFAULT NULL COMMENT 'วันที่สิ้นสุด',
  `Timers` time DEFAULT NULL COMMENT 'เวลา',
  `Ser_charge` float(10,2) DEFAULT NULL COMMENT 'ค่าบริการ',
  `Confirm` int(1) NOT NULL COMMENT '0=ยังไม่ยื่นยัน 1=ยืนยันแล้ว',
  `Idair` int(10) DEFAULT NULL COMMENT 'รหัสเครื่องบิน',
  `Idmem` int(10) DEFAULT NULL COMMENT 'รหัสประจาตัวสมาชิก'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='บริการเช่าสนามบิน';

--
-- Dumping data for table `ren_ser`
--

INSERT INTO `ren_ser` (`Idrs`, `Daters`, `Daters_end`, `Timers`, `Ser_charge`, `Confirm`, `Idair`, `Idmem`) VALUES
(1, '2015-12-02', '2015-12-03', '10:17:12', 210.00, 0, 1, 1),
(2, '2015-12-01', '2015-12-04', '00:00:00', 400.00, 1, 1, 1),
(3, '2015-12-01', '2015-12-02', '00:00:00', 100.00, 0, 6, 1),
(4, '2015-12-01', '2015-12-05', '00:00:00', 400.00, 1, 6, 1),
(5, '2015-12-16', '2015-12-17', '00:00:00', 100.00, 1, 6, 1),
(6, '2015-12-16', '2015-12-29', '00:00:00', 1400.00, 1, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `Idsalary` int(11) NOT NULL,
  `Datesa` date NOT NULL COMMENT 'วันที่',
  `Money` int(10) NOT NULL COMMENT 'เวลา',
  `Idper` int(10) NOT NULL COMMENT 'Money'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='เก็บข้อมูลเงินเดือนพนักงาน';

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`Idsalary`, `Datesa`, `Money`, `Idper`) VALUES
(1, '2015-12-05', 30001, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `User_id` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Idper` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='ผู้ใช้งาน';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Username`, `Password`, `Idper`) VALUES
(1, 'admin', 'admin', 1),
(2, 'vvvvv', 'vvvvv', 5),
(3, 'test', 'testkk', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`Idair`);

--
-- Indexes for table `dep_air`
--
ALTER TABLE `dep_air`
  ADD PRIMARY KEY (`Idda`);

--
-- Indexes for table `hangar`
--
ALTER TABLE `hangar`
  ADD PRIMARY KEY (`Idhang`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Idmem`);

--
-- Indexes for table `order_data`
--
ALTER TABLE `order_data`
  ADD PRIMARY KEY (`order_data_id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`Idper`);

--
-- Indexes for table `public`
--
ALTER TABLE `public`
  ADD PRIMARY KEY (`Intpub`);

--
-- Indexes for table `ren_ser`
--
ALTER TABLE `ren_ser`
  ADD PRIMARY KEY (`Idrs`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`Idsalary`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `Idair` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dep_air`
--
ALTER TABLE `dep_air`
  MODIFY `Idda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hangar`
--
ALTER TABLE `hangar`
  MODIFY `Idhang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Idmem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_data`
--
ALTER TABLE `order_data`
  MODIFY `order_data_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `Idper` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `public`
--
ALTER TABLE `public`
  MODIFY `Intpub` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ren_ser`
--
ALTER TABLE `ren_ser`
  MODIFY `Idrs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `Idsalary` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
