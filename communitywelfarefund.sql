-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2019 at 02:49 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `communitywelfarefund`
--

-- --------------------------------------------------------

--
-- Table structure for table `authorities`
--

CREATE TABLE `authorities` (
  `aut_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสเจ้าหน้าที่',
  `aut_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `aut_lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สกุล',
  `aut_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่',
  `aut_tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `aut_img` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'รูป',
  `aut_position` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ตำแหน่ง',
  `aut_username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อผู้ใช้งาน',
  `aut_password` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสผ่าน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลเจ้าหน้าที่ - ออธอ-ริทิ';

--
-- Dumping data for table `authorities`
--

INSERT INTO `authorities` (`aut_id`, `aut_name`, `aut_lastname`, `aut_address`, `aut_tel`, `aut_img`, `aut_position`, `aut_username`, `aut_password`) VALUES
('AUT-000001', 'น้ำเชี่ยว', 'แสนวงษ์', '150 เทศบาลยโสธร ต.ในเมือง\r\nอ.เมือง จ.ยโสธร 35000', '043-283700', '../CommunityWelfareFund/img/authorities/20190611202849.png', 'เจ้าหน้าที่', 'admin1', '1234'),
('AUT-000002', 'กิตติเดช', 'กุมจันทึก ', '160 เทศบาลยโสธร ต.ในเมือง\r\nอ.เมือง จ.ยโสธร 35000', '0854161567', '../CommunityWelfareFund/img/authorities/20190902192512.png', 'ผู้บริหาร', 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `benefits`
--

CREATE TABLE `benefits` (
  `ben_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสวัสดิการ ',
  `ben_category` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อประเภทสวัสดิการ',
  `ben_condition` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'เงื่อนไข',
  `ben_evidence` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'หลักฐานการรับสวัสดิการ ',
  `ben_condition1` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ได้รับเงิน',
  `ben_condition2` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ยอดที่กู้ได้',
  `ben_condition3` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ระยะหักจ่าย/เดือน',
  `ben_condition4` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ปีละไม่เกิน/คืน',
  `ben_condition5` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ได้รับเงินกรณีนอนโรงบาลเพื่อคลอดบุตร',
  `ben_condition6` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ได้รับเงินกรณีนอนโรงบาลเพื่อคลอดบุตรไม่เกิน5คืน/ครั้ง',
  `ben_document1` int(1) NOT NULL COMMENT 'สำเนาบัตรประจำตัวประชาชน',
  `ben_document2` int(1) NOT NULL COMMENT 'สำเนาทะเบียนบ้าน',
  `ben_document3` int(1) NOT NULL COMMENT 'สมุดการเป็นสมาชิกกองทุน',
  `ben_document4` int(1) NOT NULL COMMENT 'สำเนาใบแจ้งเกิดลูก',
  `ben_document5` int(1) NOT NULL COMMENT 'สำเนาสูติบัตรลูก',
  `ben_document6` int(1) NOT NULL COMMENT 'ใบรับรองการนอนรักษาตัวในโรงพยาบาล',
  `ben_document7` int(1) NOT NULL COMMENT 'สำเนาใบมรณะบัตร',
  `ben_document8` int(1) NOT NULL COMMENT 'กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน',
  `ben_document9` int(1) NOT NULL COMMENT 'กรณีมอบฉันทะ สำเนาทะเบียนบ้าน',
  `interest` double(10,2) NOT NULL COMMENT 'ดอกเบี้ย',
  `interest_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ต่อครั้ง/ร้อยละ',
  `span_of_age_to` int(11) DEFAULT NULL COMMENT 'ช่วงอายุตั้งแต่',
  `span_of_age_from` int(11) DEFAULT NULL COMMENT 'ช่วงอายุจนถึง',
  `ben_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ผู้สูงอายุ/ผู้พิการ/กู้สามัญ',
  `ben_sex` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เพศของผู้ขอใช้สิทธิ์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลสวัสดิการ - เบน-อิฟิท';

--
-- Dumping data for table `benefits`
--

INSERT INTO `benefits` (`ben_id`, `ben_category`, `ben_condition`, `ben_evidence`, `ben_condition1`, `ben_condition2`, `ben_condition3`, `ben_condition4`, `ben_condition5`, `ben_condition6`, `ben_document1`, `ben_document2`, `ben_document3`, `ben_document4`, `ben_document5`, `ben_document6`, `ben_document7`, `ben_document8`, `ben_document9`, `interest`, `interest_type`, `span_of_age_to`, `span_of_age_from`, `ben_type`, `ben_sex`) VALUES
('BEN-000001', 'บำนาญ สำหรับผู้ที่มีอายุครบ 60 – 69 ปี', 'ได้รับเงินค่าเบี้ยยังชีพ 600 บาท / เดือน กู้ได้ 6000 บาท โดยหักจ่ายจากเงินเบี้ยยังชีพผู้สูงอายุ เป็นเวลา 11 เดือน คือ 6600', 'การ---', '600', '6000', '11', '0', '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 600.00, 'ต่อครั้ง', 60, 69, 'ผู้สูงอายุ', 'ทั้งชายและหญิง'),
('BEN-000002', 'บำนาญ สำหรับผู้ที่มีอายุครบ 70 – 79 ปี', 'ได้รับเงินค่าเบี้ยยังชีพ 700 บาท / เดือน กู้ได้ 7000 บาท โดยหักจ่ายจากเงินเบี้ยยังชีพผู้สูงอายุ เป็นเวลา 11 เดือน คือ 7700 บาท', '-', '700', '7000', '11', '0', '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 700.00, 'ต่อครั้ง', 70, 79, 'ผู้สูงอายุ', 'ทั้งชายและหญิง'),
('BEN-000003', 'บำนาญ สำหรับผู้ที่มีอายุครบ 80 – 89 ปี', 'ได้รับเงินค่าเบี้ยยังชีพ 800 บาท / เดือน กู้ได้ 8000 บาท โดยหักจ่ายจากเงินเบี้ยยังชีพผู้สูงอายุ เป็นเวลา 11 เดือน คือ 8800 บาท', '-', '800', '8000', '11', '0', '0', '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 800.00, 'ต่อครั้ง', 80, 89, 'ผู้สูงอายุ', 'ทั้งชายและหญิง'),
('BEN-000004', 'บำนาญ สำหรับผู้ที่มีอายุ 90 ปี ขึ้นไป', 'ได้รับเงินค่าเบี้ยยังชีพ 1000 บาท / เดือน กู้ได้ 10000 บาท โดยหักจ่ายจากเงินเบี้ยยังชีพผู้สูงอายุ เป็นเวลา 11 เดือน คือ 11000 บาท', '-', '1000', '10000', '11', '0', '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 1000.00, 'ต่อครั้ง', 90, 200, 'ผู้สูงอายุ', 'ทั้งชายและหญิง'),
('BEN-000005', 'บำนาญ สำหรับผู้พิการ', 'ได้รับเงินเบี้ยผู้พิการเดือนละ 800 บาท สามารถกู้ได้ 8000 บาท โดยหักจ่ายจากเงินเบี้ยยังชีพผู้พิการ เป็นเวลา 11 เดือน คือ 8800 บาท\r\n*** โดยการกู้ยืมนั้น จะเอาเงินเบี้ยยังชีพผู้สูงอายุ ผู้พิการ เป็นหลักประกันการกู้ยืม และจะต้องสมัครเป็นสมาชิกเป็นรายปีเท่านั้น ***', '-', '800', '8000', '11', '0', '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0.00, 'ต่อครั้ง', 10, 200, 'ผู้พิการ', 'ทั้งชายและหญิง'),
('BEN-000006', 'เสียชีวิต สำหรับผู้ที่ส่งเงินสัจจะครบ 6 เดือน ถึง 2 ปี', 'ได้ค่าจัดการศพ 3000 บาท', '1.สำเนาใบมรณะบัตร \r\n2.สำเนาทะเบียนบ้านผู้เสียชีวิต \r\n3.สำเนาบัตรประชาชน \r\n4.หลักฐานการเป็นสมาชิก \r\n**ผู้รับสวัสดิการนี้จะต้องเป็นผู้ที่ได้ระบุไว้ในชื่อผู้รับผลประโยชน์ พร้อมสำเนาทะเบียนบ้าน และบัตรประชาชน', '3000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0.00, 'ต่อครั้ง', 0, 200, 'ผู้สูงอายุ', 'ทั้งชายและหญิง'),
('BEN-000007', 'เสียชีวิต สำหรับผู้ที่ส่งเงินสัจจะครบ 2 ปี 1 วัน ถึง 4 ปี', 'ได้ค่าจัดการศพ 6000 บาท', '1.สำเนาใบมรณะบัตร \r\n2.สำเนาทะเบียนบ้านผู้เสียชีวิต \r\n3.สำเนาบัตรประชาชน \r\n4.หลักฐานการเป็นสมาชิก \r\n**ผู้รับสวัสดิการนี้จะต้องเป็นผู้ที่ได้ระบุไว้ในชื่อผู้รับผลประโยชน์ พร้อมสำเนาทะเบียนบ้าน และบัตรประชาชน', '6000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0.00, 'NaN', 100, 200, 'NaN', 'ทั้งชายและหญิง'),
('BEN-000008', 'เสียชีวิต สำหรับผู้ที่ส่งเงินสัจจะครบ 4 ปี 1 วัน ถึง 6 ปี', 'ได้ค่าจัดการศพ 8000 บาท', '1.สำเนาใบมรณะบัตร \r\n2.สำเนาทะเบียนบ้านผู้เสียชีวิต \r\n3.สำเนาบัตรประชาชน \r\n4.หลักฐานการเป็นสมาชิก \r\n**ผู้รับสวัสดิการนี้จะต้องเป็นผู้ที่ได้ระบุไว้ในชื่อผู้รับผลประโยชน์ พร้อมสำเนาทะเบียนบ้าน และบัตรประชาชน', '8000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0.00, 'NaN', 100, 200, 'NaN', 'ทั้งชายและหญิง'),
('BEN-000009', 'เสียชีวิต สำหรับผู้ที่ส่งเงินสัจจะครบ 6 ปี 1 วัน ถึง 8 ปี', 'ได้ค่าจัดการศพ 10000 บาท', '1.สำเนาใบมรณะบัตร \r\n2.สำเนาทะเบียนบ้านผู้เสียชีวิต \r\n3.สำเนาบัตรประชาชน \r\n4.หลักฐานการเป็นสมาชิก \r\n**ผู้รับสวัสดิการนี้จะต้องเป็นผู้ที่ได้ระบุไว้ในชื่อผู้รับผลประโยชน์ พร้อมสำเนาทะเบียนบ้าน และบัตรประชาชน', '10000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0.00, 'NaN', 100, 200, 'NaN', 'ทั้งชายและหญิง'),
('BEN-000010', 'เสียชีวิต สำหรับผู้ที่ส่งเงินสัจจะครบ 8 ปี 1 วัน ถึง 18 ปี', 'ได้ค่าจัดการศพ 15000 บาท', '1.สำเนาใบมรณะบัตร \r\n2.สำเนาทะเบียนบ้านผู้เสียชีวิต \r\n3.สำเนาบัตรประชาชน \r\n4.หลักฐานการเป็นสมาชิก \r\n**ผู้รับสวัสดิการนี้จะต้องเป็นผู้ที่ได้ระบุไว้ในชื่อผู้รับผลประโยชน์ พร้อมสำเนาทะเบียนบ้าน และบัตรประชาชน', '15000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0.00, 'NaN', 100, 200, 'NaN', 'ทั้งชายและหญิง'),
('BEN-000011', 'เสียชีวิต สำหรับผู้ที่ส่งเงินสัจจะครบ 15 ปี 1 วัน', 'ได้ค่าจัดการศพ 20000 บาท', '1.สำเนาใบมรณะบัตร \r\n2.สำเนาทะเบียนบ้านผู้เสียชีวิต \r\n3.สำเนาบัตรประชาชน \r\n4.หลักฐานการเป็นสมาชิก \r\n**ผู้รับสวัสดิการนี้จะต้องเป็นผู้ที่ได้ระบุไว้ในชื่อผู้รับผลประโยชน์ พร้อมสำเนาทะเบียนบ้าน และบัตรประชาชน', '20000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 1, 1, 1, 0.00, 'NaN', 100, 200, 'NaN', 'ทั้งชายและหญิง'),
('BEN-000012', 'นอนโรงพยาบาล', 'กรณี เจ็บหรือป่วย ที่ต้องนอนรักษาตัวในโรงพยาบาลได้คืนละ 100 บาท ปีละไม่เกิน 20 คืน หรือปีละไม่เกิน 2000 บาท', '1.ใบรับรองการนอนรักษาตัวในโรงพยาบาล \r\n2.สำเนาบัตรประจำตัวประชาชนผู้เข้ารักษา \r\n3.สำเนาทะเบียนบ้านผู้เข้ารักษา \r\n***กรณี ให้ผู้อื่นไปเบิก จะต้องมีใบมอบฉันทะ พร้อมแนบสำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านผู้รับมอบฉันทะ พร้อมหลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน', '100', '0', '0', '20', '0', '0', 1, 1, 0, 0, 0, 1, 0, 1, 1, 0.00, '', 0, 200, '', 'ทั้งชายและหญิง'),
('BEN-000013', 'แก่ชรา ผู้ที่ส่งเงินสัจจะครบ 10 ปี', 'ต้องเป็นผู้ที่มีอายุครบ 60 ปี บริบูรณ์ขึ้นไป ผู้ที่ส่งเงินสัจจะครบ 10 ปี ได้รับบำนาญปีละ 1500 บาท ****การรับสวัสดิการ กรรมการกองทุนจะเป็นผู้นตรวจเช็ค ว่าสมาชิกถึงเกณฑ์ที่จะได้รับเงินบำนาญของการเป็นสมาชิกตามเกณฑ์ กรรมการจึงจะแจ้งให้ทราบว่าถึงกำหนดที่จะได้รับบำนาญรายปี', '1.สำเนาบัตรประจำตัวประชาชน \r\n2.สำเนาทะเบียนบ้าน \r\n3.หลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน \r\n***กรณี ให้ผู้อื่นไปเบิก จะต้องมีใบมอบฉันทะ พร้อมแนบสำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านผู้รับมอบฉันทะ พร้อมหลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน', '1500', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 0, 1, 1, 0.00, '', 60, 200, '', 'ทั้งชายและหญิง'),
('BEN-000014', 'แก่ชรา ผู้ที่ส่งเงินสัจจะครบ 20 ปี', 'ต้องเป็นผู้ที่มีอายุครบ 60 ปี บริบูรณ์ขึ้นไป ผู้ที่ส่งเงินสัจจะครบ 20 ปี ได้รับบำนาญปีละ 2000 บาท ****การรับสวัสดิการ กรรมการกองทุนจะเป็นผู้นตรวจเช็ค ว่าสมาชิกถึงเกณฑ์ที่จะได้รับเงินบำนาญของการเป็นสมาชิกตามเกณฑ์ กรรมการจึงจะแจ้งให้ทราบว่าถึงกำหนดที่จะได้รับบำนาญรายปี', '1.สำเนาบัตรประจำตัวประชาชน \r\n2.สำเนาทะเบียนบ้าน \r\n3.หลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน \r\n***กรณี ให้ผู้อื่นไปเบิก จะต้องมีใบมอบฉันทะ พร้อมแนบสำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านผู้รับมอบฉันทะ พร้อมหลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน', '2000', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 0, 1, 1, 0.00, '', 60, 200, '', 'ทั้งชายและหญิง'),
('BEN-000015', 'แก่ชรา ผู้ที่ส่งเงินสัจจะครบ 30 ปี', 'ต้องเป็นผู้ที่มีอายุครบ 60 ปี บริบูรณ์ขึ้นไป ผู้ที่ส่งเงินสัจจะครบ 30 ปี ได้รับบำนาญปีละ 2500 บาท ****การรับสวัสดิการ กรรมการกองทุนจะเป็นผู้นตรวจเช็ค ว่าสมาชิกถึงเกณฑ์ที่จะได้รับเงินบำนาญของการเป็นสมาชิกตามเกณฑ์ กรรมการจึงจะแจ้งให้ทราบว่าถึงกำหนดที่จะได้รับบำนาญรายปี', '1.สำเนาบัตรประจำตัวประชาชน \r\n2.สำเนาทะเบียนบ้าน \r\n3.หลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน \r\n***กรณี ให้ผู้อื่นไปเบิก จะต้องมีใบมอบฉันทะ พร้อมแนบสำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านผู้รับมอบฉันทะ พร้อมหลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน', '2500', '0', '0', '0', '0', '0', 1, 1, 1, 0, 0, 0, 0, 1, 1, 0.00, '', 60, 200, '', 'ทั้งชายและหญิง'),
('BEN-000016', 'คลอดบุตร', 'จ่ายให้ 500 บาท แม่นอนพักรักษาตัวในโรงพยาบาลในคราวเดียวกันให้วันละ 100 บาท ไม่เกิน 5 คืนต่อครั้งรวมปีละไม่เกิน 2000 บาท', '1. สำเนาใบแจ้งเกิดลูก \r\n2.สำเนาสูติบัตรลูก \r\n3.สำเนาบัตรประจำตัวประชาชนแม่ \r\n4.สำเนาทะเบียนบ้านแม่ \r\n5.สมุดการเป็นสมาชิกกองทุน \r\n***กรณี ให้ผู้อื่นไปเบิก จะต้องมีใบมอบฉันทะ พร้อมแนบสำเนาบัตรประจำตัวประชาชนและสำเนาทะเบียนบ้านผู้รับมอบฉันทะ พร้อมหลักฐานการเป็นสมาชิกกองทุนสวัสดิการชุมชน', '500', '0', '0', '0', '0', '5', 1, 1, 1, 1, 1, 0, 0, 1, 1, 0.00, 'NaN', 0, 200, 'NaN', 'หญิง'),
('BEN-000017', 'กู้สามัญ', 'กู้สามัญ สำหรับบุคคลทั่วไป ต้องมีอายุมากกว่า 20 ปีขึ้นไป กูได้ 20000 บาท ดอกเบี้ยร้อยละ 3', '-', '0', '20000', '0', '0', '0', '0', 1, 1, 0, 0, 0, 0, 0, 0, 0, 3.00, 'ร้อยละ', 20, 200, 'กู้สามัญ', 'ทั้งชายและหญิง');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `dep_main_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dep_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสรับเงินฝาก',
  `dep_date` datetime NOT NULL COMMENT 'วันที่รับเงินฝาก',
  `dep_month` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dep_year` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dep_amount` int(10) NOT NULL COMMENT 'ยอดฝากต่อเดือน',
  `mem_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมาชิก',
  `aut_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสเจ้าหน้าที่'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลการรับฝากเงินเข้ากองทุน';

-- --------------------------------------------------------

--
-- Table structure for table `deposit_main`
--

CREATE TABLE `deposit_main` (
  `dep_main_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fund`
--

CREATE TABLE `fund` (
  `fund_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสองค์กร',
  `fund_name` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อองค์กร',
  `fund_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่',
  `fund_objective` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'วัตถุประสงค์สำคัญ',
  `fund_property` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'คุณสมบัติของสมาชิก',
  `fund_logo` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'โลโก้กองทุน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลกองทุน';

--
-- Dumping data for table `fund`
--

INSERT INTO `fund` (`fund_id`, `fund_name`, `fund_address`, `fund_objective`, `fund_property`, `fund_logo`) VALUES
('1', 'กองทุนสวัสดิการชุมชนเทศบาลเมืองยโสธร', 'สำนักประชาสัมพันธ์จังหวัด ยโสธร ศาลากลางจังหวัดยโสธร \r\nถ.แจ้งสนิท อ.เมือง จ.ยโสธร 35000 โทร.0-4571-1093 โทรสาร.0-4572-5131', '1.	เพื่อจัดสวัสดิการแก่สมาชิก\r\n2.	เพื่อเป็นศูนย์รวมน้ำใจของทุกเพศ ทุกวัย ในชุมชนและท้องถิ่นและจัดระบบสวัสดิการเพื่อสังคมและชุมชน\r\n3.	เพื่อสร้างความสัมพันธ์ระหว่างชุมชนและกลุ่มร่วมกัน\r\n4.	เพื่อขยายและเผยแพร่การจัดตั้งกองทุนสวัสดิการไปยังประชาชนในเขตเทศบาล\r\n5.	เพื่อช่วยเหลือและประสานความร่วมมือในการแก้ไขปัญหาชุมชนในด้านต่างๆ\r\n6.	เพื่อลดช่องว่างความเป็นอยู่สมาชิกในชุมชนให้เกิดความเสมอภาคและความสันติสุขร่วมกันเหมือนญาติพี่น้อง', '1.	เป็นผู้มีภูมิลำเนาอยู่ในเขตเทศบาลเมืองยโสธร\r\n2.	เป็นผู้ที่มีนิสัยอันดีงาม มีความรู้และความเข้าใจเห็นชอบในหลักการของกองทุนสวัสดิการและเข้าใจ / สนใจที่จะร่วมในกิจกรรมของกองทุน\r\n3.	เป็นผู้ที่มีความพร้อมที่จะปฎิบัติตามระเบียบข้อบังคับของกองทุนสวัสดิการ\r\n4.	เป็นผู้ที่คณะกรรมการกองทุนมีมติเห็นชอบให้เข้าเป็นสมาชิก', '../CommunityWelfareFund/img/fund/20190403003130.png');

-- --------------------------------------------------------

--
-- Table structure for table `get_benefits`
--

CREATE TABLE `get_benefits` (
  `get_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสขอรับสวัสดิการ',
  `mem_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมาชิก',
  `get_date` date NOT NULL COMMENT 'วันที่ขอรับ',
  `ben_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทสวัสดิการที่ขอรับ',
  `aut_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสเจ้าหน้าที่',
  `get_proxy` int(1) NOT NULL COMMENT 'กรณีมอบฉันทะ',
  `get_condition1` date NOT NULL COMMENT 'เงินสวัสดิการในการนอนรักษาพยาบาล ตั้งแต่/วันที่',
  `get_condition2` double(10,2) NOT NULL COMMENT 'จำนวน/วัน',
  `Copy1` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สำเนาบัตรประจำตัวประชาชน',
  `Copy2` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สำเนาทะเบียนบ้าน',
  `Copy3` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สมุดการเป็นสมาชิกกองทุน',
  `Copy4` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สำเนาใบแจ้งเกิดลูก',
  `Copy5` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สำเนาสูติบัตรลูก',
  `Copy6` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ใบรับรองการนอนรักษาตัวในโรงพยาบาล',
  `Copy7` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สำเนาใบมรณะบัตร',
  `Copy8` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'กรณีมอบฉันทะ สำเนาบัตรประจำตัวประชาชน',
  `Copy9` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'กรณีมอบฉันทะ สำเนาทะเบียนบ้าน',
  `get_date_ap` date NOT NULL COMMENT 'วันที่อนุมัติ',
  `get_state` int(1) NOT NULL COMMENT 'สถานะ',
  `get_reason` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สาเหตุที่ไม่อนุมัติ',
  `name_other` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อกรณีมอบฉันทะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ขอรับสิทธิสวัสดิการ';

-- --------------------------------------------------------

--
-- Table structure for table `give_money`
--

CREATE TABLE `give_money` (
  `give_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสการมอบเงิน',
  `aut_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสเจ้าหน้าที่',
  `get_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสขอรับสวัสดิการ',
  `give_money` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'จำนวนเงินที่มอบ',
  `give_date` date NOT NULL COMMENT 'วันที่มอบ',
  `give_chk` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'มารับด้วยตนเอง/มอบฉันทะ',
  `give_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อผู้รับเงิน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลการบันทึกการมอบเงินสวัสดิการ';

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `mem_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมาชิก',
  `mem_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'คำนำหน้า',
  `mem_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `mem_lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สกุล',
  `mem_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่',
  `mem_card` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขบัตรประจำตัวประชาชน',
  `mem_birthday` date NOT NULL COMMENT 'วันเดือนปีเกิด',
  `mem_work` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อาชีพ',
  `mem_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานภาพ',
  `mem_nationality` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สัญชาติ',
  `mem_tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `reg_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมัครสมาชิก',
  `mem_deposit` double(10,2) NOT NULL COMMENT 'ยอดเงินฝาก',
  `mem_deposit2` double(10,2) NOT NULL COMMENT 'ยอดเงินฝากทั้งหมด',
  `mem_date` date NOT NULL COMMENT 'วันที่เริ่มเป็นสมาชิกกองทุน',
  `mem_pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mem_img` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลสมาชิก';

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`mem_id`, `mem_title`, `mem_name`, `mem_lastname`, `mem_address`, `mem_card`, `mem_birthday`, `mem_work`, `mem_status`, `mem_nationality`, `mem_tel`, `reg_id`, `mem_deposit`, `mem_deposit2`, `mem_date`, `mem_pass`, `mem_img`) VALUES
('MEM-000001', 'นาย', 'มารวย', 'นากลาง', 'บ้านเลขที่ 443 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1409901376711', '1925-09-01', 'เกษตกร', 'สมรส', 'ไทย', '0663215680', 'REQ-000005', 0.00, 0.00, '2018-02-01', '', ''),
('MEM-000002', 'นาย', 'มีนา', 'จุลรักษา', 'บ้านเลขที่ 160 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1409901376712', '1931-01-01', 'เกษตกร', 'โสด', 'ไทย', '0632568931', 'REQ-000004', 0.00, 0.00, '2018-02-01', '', ''),
('MEM-000003', 'นาย', 'ศุลภิต', 'กุมจันทึก', 'บ้านเลขที่ 160 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1409901376713', '1931-01-01', 'ทำนา', 'โสด', 'ไทย', '0345623146', 'REQ-000003', 0.00, 0.00, '2019-03-01', '', ''),
('MEM-000004', 'นาย', 'บุญรักษ์', 'ชัยสีดา', 'บ้านเลขที่ 150 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น รหัสไปรษณีย์ 40000', '60342360023-5', '1994-01-01', 'เทส', 'โสด', 'ไทย', '0342360023', 'REQ-000002', 0.00, 0.00, '2019-01-01', '', ''),
('MEM-000005', 'นาย', 'กฤติเดช', 'กุมจันทึก', 'บ้านเลขที่ 150 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น รหัสไปรษณีย์ 40000', '60342360069-6', '1929-01-01', 'เทส', 'โสด', 'ไทย', '0603423600', 'REQ-000001', 0.00, 0.00, '2018-04-22', '', ''),
('MEM-000006', 'นาย', 'ภานุวัฒน์', 'วังวงค์', 'บ้านเลขที่ 448 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '60342360040-1', '1940-01-01', 'เทส', 'สมรส', 'ไทย', '0663215667', 'REQ-000008', 0.00, 0.00, '2018-04-22', '', ''),
('MEM-000007', 'นาย', 'อภิสิทธิ์', 'พิพัฒน์พงษ์', 'บ้านเลขที่ 447 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '60342360036-3', '1940-01-01', 'เทส', 'สมรส', 'ไทย', '0663215666', 'REQ-000007', 0.00, 0.00, '2019-04-22', '', ''),
('MEM-000008', 'นาง', 'เพ็ญ', 'รักษาศรี', 'บ้านเลขที่ 160 ถนน - ตำบล เมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1409901376721', '1923-09-01', '-', '', 'ไทย', '0854161567', 'REQ-000012', 0.00, 0.00, '2018-09-02', '', '../CommunityWelfareFund/img/authorities/20190902204724.png'),
('MEM-000009', 'นาย', 'จันทร์', 'พัสดุ', 'บ้านเลขที่ 44 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1409901376720', '1931-01-01', '-', 'สมรส', 'ไทย', '0854161567', 'REQ-000011', 0.00, 0.00, '2018-09-02', '', ''),
('MEM-000010', 'นาย', 'ประสิทธิ์', 'มาลัย', 'บ้านเลขที่ 160 ถนน - ตำบล เมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1401345648979', '1929-01-01', '-', '', 'ไทย', '854151567', 'REQ-000010', 0.00, 0.00, '2018-09-02', '', '../CommunityWelfareFund/img/authorities/20190902220232.png'),
('MEM-000011', 'นาย', 'จันทร์', 'สีเทา', 'บ้านเลขที่ 50 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '1409901376750', '1948-01-22', 'เกรียนอายุ', 'สมรส', 'ไทย', '0854161567', 'REQ-000013', 0.00, 0.00, '2019-09-03', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `pay_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสจ่ายเงิน',
  `pay_date` date NOT NULL COMMENT 'วันที่จ่ายเงิน',
  `pet_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสคำขอกู้ยืม',
  `pet_amount` int(10) NOT NULL COMMENT 'ยอดเงินที่จ่าย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `petition`
--

CREATE TABLE `petition` (
  `pet_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสคำขอกู้ยืม',
  `aut_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสเจ้าหน้าที่',
  `mem_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมาชิก',
  `pet_date` date NOT NULL COMMENT 'วันที่ขอกู้ยืม',
  `ben_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทการกู้ยืม',
  `amount` int(10) NOT NULL COMMENT 'ยอดเงินที่ต้องการกู้',
  `cause` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'โดยมีวัตถุประสงค์แห่งการกู้เพื่อ',
  `share` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'มีหุ้นในสถาบันการเงิน',
  `income` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'มีรายได้อื่นๆ/เดือน',
  `allowance` int(10) NOT NULL COMMENT 'เบี้ยยังชีพ/เดือน',
  `pet_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ผู้สูงอายุ/ผู้พิการ/กู้สามัญ',
  `pet_age` int(11) NOT NULL COMMENT 'อายุ',
  `pet_state` int(1) NOT NULL COMMENT 'สถานะ 0 = ยังไม่ชำระ  1= ชำระแล้ว ',
  `pet_state1` int(1) NOT NULL,
  `pet_balance` int(10) NOT NULL COMMENT 'ยอดหนี้คงค้าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลคำร้องขอกู้ยืม';

-- --------------------------------------------------------

--
-- Table structure for table `petition_detail`
--

CREATE TABLE `petition_detail` (
  `petd_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสรายละเอียดคำขอกู้ยืม',
  `pet_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสคำขอกู้ยืม',
  `mem_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมาชิก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `reg_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสมัครสมาชิก',
  `reg_date` date NOT NULL COMMENT 'วันที่สมัคร',
  `req_title` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'คำนำหน้า',
  `reg_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อ',
  `reg_lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุล',
  `reg_card` varchar(13) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เลขบัตรประจำตัวประชาชน',
  `reg_birthday` date NOT NULL COMMENT 'วันเดือนปีเกิด',
  `reg_age` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อายุ',
  `reg_work` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อาชีพ',
  `req_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานภาพ',
  `req_nationality` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สัญชาติ',
  `req_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่',
  `req_tel` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `req_condition` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เงื่อนไข',
  `req_condition_date1` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'วันที่ส่งเงิน',
  `req_condition_month1` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เดือนที่ส่งเงิน',
  `req_condition_date2` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'และวันที่ส่งเงิน',
  `req_condition_month2` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'และเดือนที่ส่งเงิน',
  `req_beneficiary` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อผู้รับประโยชน์',
  `req_beneficiary_age` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อายุผู้รับประโยชน์',
  `req_beneficiary_relation` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ความสัมพันธ์ระหว่างตนกับผู้รับประโยชน์',
  `req_beneficiary_address` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่ผู้รับประโยชน์',
  `req_state` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะ 0 = รออนุมัติ 1 = อนุมัติ 2 = ไม่อนุมัติ',
  `req_disapproval` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ไม่อนุมัติเนื่องจาก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลสมัครสมาชิก';

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`reg_id`, `reg_date`, `req_title`, `reg_name`, `reg_lastname`, `reg_card`, `reg_birthday`, `reg_age`, `reg_work`, `req_status`, `req_nationality`, `req_address`, `req_tel`, `req_condition`, `req_condition_date1`, `req_condition_month1`, `req_condition_date2`, `req_condition_month2`, `req_beneficiary`, `req_beneficiary_age`, `req_beneficiary_relation`, `req_beneficiary_address`, `req_state`, `req_disapproval`) VALUES
('REQ-000001', '2018-01-01', 'นาย', 'กฤติเดช', 'กุมจันทึก', '60342360069-6', '1929-01-01', '90', 'เทส', 'โสด', 'ไทย', 'บ้านเลขที่ 150 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น รหัสไปรษณีย์ 40000', '0603423600', '2', '01', 'มกราคม', '01', 'ธันวาคม', 'นางบุญชัย กุมจันทึก', '35', 'ลูกสาว', 'บ้านเลขที่ 150 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น', '1', ''),
('REQ-000002', '2018-01-01', 'นาย', 'บุญรักษ์', 'ชัยสีดา', '60342360023-5', '1994-01-01', '24', 'เทส', 'โสด', 'ไทย', 'บ้านเลขที่ 150 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น รหัสไปรษณีย์ 40000', '0342360023', '1', '01', '', '', '', 'นางมาพร ชัยสีดา', '53', 'มารดา', 'บ้านเลขที่ 150 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น', '1', ''),
('REQ-000003', '2019-04-22', 'นาย', 'ศุลภิต', 'กุมจันทึก', '1409901376713', '1931-01-01', '88', 'ทำนา', 'โสด', 'ไทย', 'บ้านเลขที่ 160 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0345623146', '2', '01', 'มกราคม', '01', 'กุมภาพันธ์', 'นางบุญชัย กุมจันทึก', '35', 'ลูกสาว', 'บ้านเลขที่ 160 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', ''),
('REQ-000004', '2019-04-22', 'นาย', 'มีนา', 'จุลรักษา', '1409901376712', '1931-01-01', '88', 'เกษตกร', 'โสด', 'ไทย', 'บ้านเลขที่ 160 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0632568931', '2', '01', 'มกราคม', '01', 'กุมภาพันธ์', 'นายกุมภา นากลาง', '40', 'ญาติ', 'บ้านเลขที่ 160 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', ''),
('REQ-000005', '2019-04-22', 'นาย', 'มารวย', 'นากลาง', '1409901376711', '1930-01-01', '89', 'เกษตกร', 'สมรส', 'ไทย', 'บ้านเลขที่ 443 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0663215680', '3', '01', 'มกราคม', '01', 'ธันวาคม', 'นายดอน  นากลาง', '35', 'บุตร', 'บ้านเลขที่ 443 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', ''),
('REQ-000006', '2018-01-01', 'นางสาว', 'วิภาภรณ์', 'สอนนาม', '60342360008-9', '1994-01-01', '24', 'เทส', 'โสด', 'ไทย', 'บ้านเลขที่ 151 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น รหัสไปรษณีย์ 40000', '0342360022', '1', '01', '', '', '', 'นางสาววิภาภรณ์ สอนนาม', '24', 'ตัวเอง', 'บ้านเลขที่ 151 ถนน ศรีจันทร์ ตำบล ในเมือง อำเภอ เมือง จังหวัด ขอนแก่น รหัสไปรษณีย์ 40000', '2', ''),
('REQ-000007', '2019-04-22', 'นาย', 'อภิสิทธิ์', 'พิพัฒน์พงษ์', '60342360036-3', '1940-01-01', '79', 'เทส', 'สมรส', 'ไทย', 'บ้านเลขที่ 447 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0663215666', '3', '01', 'มกราคม', '01', 'ธันวาคม', 'นายอภิสิทธิ์ พิพัฒน์พงษ์', '79', 'ตัวเอง', 'บ้านเลขที่ 447 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', ''),
('REQ-000008', '2019-04-22', 'นาย', 'ภานุวัฒน์', 'วังวงค์', '60342360040-1', '1940-01-01', '79', 'เทส', 'สมรส', 'ไทย', 'บ้านเลขที่ 448 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0663215667', '3', '01', 'มกราคม', '01', 'ธันวาคม', 'นายภานุวัฒน์ วังวงค์', '79', 'ตัวเอง', 'บ้านเลขที่ 448 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', ''),
('REQ-000009', '2019-04-22', 'นาย', 'ภพปภพ', 'อื้อจรรยา', '60342360045-1', '1940-01-01', '79', 'เทส', 'สมรส', 'ไทย', 'บ้านเลขที่ 449 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0663215777', '2', '01', 'มกราคม', '01', 'ธันวาคม', 'นายภพปภพ อื้อจรรยา', '79', 'ตัวเอง', 'บ้านเลขที่ 449 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '2', 'dddd'),
('REQ-000010', '2019-09-02', 'นาย', 'ประสิทธิ์', 'มาลัย', '1401345648979', '1972-01-01', '47', '-', 'โสด', 'ไทย', 'บ้านเลขที่ 160 ถนน - ตำบล เมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '854151567', '1', '-', '', '', '', 'นายฟ', '60', 'พี่น้อง', 'บ้านเลขที่ 160 ถนน - ตำบล เมือง อำเภอ เมือง จังหวัด ยโยสร', '1', ''),
('REQ-000011', '2019-09-02', 'นาย', 'จันทร์', 'พัสดุ', '1409901376720', '1931-01-01', '88', '-', 'สมรส', 'ไทย', 'บ้านเลขที่ 44 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0854161567', '3', '01', 'มกราคม', '01', 'ธันวาคม', 'นางศรี พัสดุ', '86', 'ภรรยา', 'บ้านเลขที่ 44 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', ''),
('REQ-000012', '2019-09-02', 'นาง', 'เพ็ญ', 'รักษาศรี', '1409901376721', '1923-09-01', '96', '-', 'หม้าย', 'ไทย', 'บ้านเลขที่ 160 ถนน - ตำบล เมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0854161567', '4', '03', 'กุมภาพันธ์', '03', 'พฤษภาคม', 'นายสมศรี โรสิวง', '50', 'ญาติ', 'บ้านเลขที่ 145 ถนน - ตำบล นาตาก อำเภอ นาตาก จังหวัด ตาก', '1', ''),
('REQ-000013', '0000-00-00', 'นาย', 'จันทร์', 'สีเทา', '1409901376750', '1948-01-22', '71', 'เกรียนอายุ', 'สมรส', 'ไทย', 'บ้านเลขที่ 50 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร รหัสไปรษณีย์ 35000', '0854161567', '3', '04', 'กุมภาพันธ์', '06', 'พฤษภาคม', 'นาย สำราญ สีเทา', '50', 'ลูกชาย', 'บ้านเลขที่ 50 ถนน - ตำบล ในเมือง อำเภอ เมือง จังหวัด ยโสธร', '1', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authorities`
--
ALTER TABLE `authorities`
  ADD PRIMARY KEY (`aut_id`);

--
-- Indexes for table `benefits`
--
ALTER TABLE `benefits`
  ADD PRIMARY KEY (`ben_id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`dep_id`);

--
-- Indexes for table `deposit_main`
--
ALTER TABLE `deposit_main`
  ADD PRIMARY KEY (`dep_main_id`);

--
-- Indexes for table `get_benefits`
--
ALTER TABLE `get_benefits`
  ADD PRIMARY KEY (`get_id`);

--
-- Indexes for table `give_money`
--
ALTER TABLE `give_money`
  ADD PRIMARY KEY (`give_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pay_id`);

--
-- Indexes for table `petition`
--
ALTER TABLE `petition`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `petition_detail`
--
ALTER TABLE `petition_detail`
  ADD PRIMARY KEY (`petd_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`reg_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
