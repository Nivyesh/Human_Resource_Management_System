-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 07:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `message`, `created_at`) VALUES
(1, 'Emergency leave', 'Emergency leave is an urgent, unplanned time-off request for unexpected events like family illness, accidents, or crises. It is a formal, often policy-driven, way to take time off work, which can be paid or unpaid depending on the employer. Employees must notify employers as quickly as possible, usually in writing, to allow for work adjustments', '2026-04-26 06:37:21'),
(3, 'Memorial Day Function', 'This function to enjoy and celebrate with the all employee.', '2026-04-26 07:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `ID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `AttendanceDate` date DEFAULT NULL,
  `Status` enum('Present','Absent','Leave') DEFAULT 'Absent',
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`ID`, `EmployeeID`, `AttendanceDate`, `Status`, `check_in`, `check_out`) VALUES
(1, 1, '2026-02-01', 'Present', '09:35:00', '18:35:11'),
(2, 1, '2026-02-02', 'Absent', NULL, NULL),
(3, 2, '2026-02-01', 'Present', '09:53:59', '16:54:02'),
(4, 3, '2026-02-01', 'Leave', NULL, NULL),
(5, 2, '2026-02-25', 'Present', '10:11:12', '10:11:39'),
(6, 2, '2026-03-01', 'Present', '10:49:00', '16:49:14'),
(7, 2, '2026-03-03', 'Leave', NULL, NULL),
(8, 1, '2026-03-01', 'Present', '10:45:33', '15:45:42'),
(9, 3, '2026-03-01', 'Present', '09:25:00', '17:55:00'),
(10, 18, '2026-03-05', 'Present', '09:12:00', '18:08:00'),
(11, 2, '2026-03-11', 'Absent', NULL, NULL),
(12, 11, '2026-03-05', 'Present', '09:18:00', '18:02:00'),
(13, 11, '2026-03-04', 'Absent', NULL, NULL),
(14, 1, '2026-03-05', 'Present', '10:45:51', '16:45:57'),
(15, 6, '2026-03-05', 'Present', '09:05:00', '17:50:00'),
(16, 18, '2026-03-06', 'Present', '09:10:00', '18:12:00'),
(17, 19, '2026-03-05', 'Present', '09:15:00', '18:05:00'),
(18, 19, '2026-03-06', 'Present', '09:08:00', '17:58:00'),
(19, 1, '2026-04-03', 'Present', '10:46:05', '15:46:14'),
(20, 2, '2026-04-26', 'Present', '10:49:37', '18:28:39'),
(21, 2, '2026-04-26', 'Present', '10:50:01', '15:28:39'),
(22, 1, '2026-04-25', 'Present', '10:46:13', '15:46:18'),
(23, 19, '2026-04-26', 'Present', '09:09:30', '09:26:02'),
(24, 2, '2026-04-24', 'Present', '09:21:00', '14:22:00'),
(26, 2, '2026-05-17', 'Present', '09:09:30', '16:03:25');

--
-- Triggers `attendance`
--
DELIMITER $$
CREATE TRIGGER `prevent_status_update` BEFORE UPDATE ON `attendance` FOR EACH ROW BEGIN
    IF OLD.Status IN ('Absent', 'Leave') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Cannot update Absent or Leave records';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `ID` int(11) NOT NULL,
  `DepartmentName` varchar(100) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`ID`, `DepartmentName`, `CreatedAt`) VALUES
(1, 'Human Resources', '2026-02-28 09:41:07'),
(2, 'Information Technology', '2026-02-28 09:41:07'),
(3, 'Finance', '2026-02-28 09:41:07'),
(4, 'Marketing', '2026-02-28 09:41:07'),
(5, 'Electroinic Data processing', '2026-03-02 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `empeducation`
--

CREATE TABLE `empeducation` (
  `Id` int(11) NOT NULL,
  `EmpID` int(10) DEFAULT NULL,
  `CoursePG` varchar(45) DEFAULT NULL,
  `SchoolCollegePG` varchar(45) DEFAULT NULL,
  `YearPassingPG` varchar(45) DEFAULT NULL,
  `PercentagePG` varchar(4) DEFAULT NULL,
  `CourseGra` varchar(45) DEFAULT NULL,
  `SchoolCollegeGra` varchar(45) DEFAULT NULL,
  `YearPassingGra` varchar(45) DEFAULT NULL,
  `PercentageGra` varchar(4) DEFAULT NULL,
  `CourseSSC` varchar(45) DEFAULT NULL,
  `SchoolCollegeSSC` varchar(45) DEFAULT NULL,
  `YearPassingSSC` varchar(45) DEFAULT NULL,
  `PercentageSSC` varchar(4) DEFAULT NULL,
  `CourseHSC` varchar(45) DEFAULT NULL,
  `SchoolCollegeHSC` varchar(45) DEFAULT NULL,
  `YearPassingHSC` varchar(45) DEFAULT NULL,
  `PercentageHSC` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `empeducation`
--

INSERT INTO `empeducation` (`Id`, `EmpID`, `CoursePG`, `SchoolCollegePG`, `YearPassingPG`, `PercentagePG`, `CourseGra`, `SchoolCollegeGra`, `YearPassingGra`, `PercentageGra`, `CourseSSC`, `SchoolCollegeSSC`, `YearPassingSSC`, `PercentageSSC`, `CourseHSC`, `SchoolCollegeHSC`, `YearPassingHSC`, `PercentageHSC`) VALUES
(1, 4, 'M.Tech Information Technology', 'LPU University', '2016', '82%', 'B.Tech(IT)', 'LPU', '2014', '86%', 'Science', 'ABC Senoir secondary School', '2010', '64%', 'Science', 'abcd', '2008', '98%'),
(2, 2, 'abc', 'ghf', '2016', '89%', 'B.Tech(IT)', 'LPU', '2013', '86%', 'Science', 'DPS Senoir secondary School', '2009', '64%', 'Science', 'DPS Senoir secondary School', '2008', '90%'),
(3, 3, 'Master in charted accountant', 'Bhavi CA college', '2004', '89%', 'Bachelor in charted accountant', 'Bhavi CA college', '1996', '95%', 'Science', 'graimia convent school', '1993', '75%', 'Science', 'graimia convent school', '1991', '89%'),
(4, 7, 'MCA', 'KITE Ghaziabad', '1990', '64 %', 'BCA', 'TVN', '1997', '68 %', 'Science', 'TVN', '1992', '76 %', 'Science', 'TVN', '2010', '89 %'),
(5, 12, 'MBA Information Technology', 'Delhi University', '2015', '78%', 'B.Tech', 'VIT', '1996', '75%', 'Science', 'GHI convent school', '1993', '66%', 'Science', 'GHI convent school', '1990', '65%'),
(6, 13, 'MBA', 'SMU', '2018', '70', 'B.Tech', 'LPU', '2015', '80', 'PCM', 'Test', '2010', '74', 'PCM', 'ABC', '2008', '85'),
(7, 1, 'M.Tech Computer Science', 'ABC Engineering College', '2014', '80', 'B.Tech', 'ABC', '2012', '75', 'PCM', 'XYZ', '2008', '67', '10th', 'HGHH', '2006', '89'),
(8, 14, 'M.Tech', 'ABC College', '2014', '65', 'B.Tech', 'XYZ', '2012', '70', 'PCM', 'ABC', '2008', '56', 'High School', 'XYZ', '2006', '85'),
(9, 6, 'MBA', 'IIM Ahmedabad', '2018', '82', 'BBA', 'GLS University', '2016', '78', 'Commerce', 'St Xavier School', '2011', '80', 'Commerce', 'St Xavier School', '2009', '85'),
(10, 11, 'MCA', 'Nirma University', '2017', '84', 'BCA', 'Silver Oak College', '2015', '79', 'Science', 'Delhi Public School', '2010', '75', 'Science', 'Delhi Public School', '2008', '81'),
(11, 15, 'MBA', 'XYZ University', '2018', '75', 'B.E Computer Engineering', 'GEC Modasa', '2026', '78', 'Science', 'Shree Swaminarayan School', '2022', '72', 'Science', 'Shree Swaminarayan School', '2020', '84'),
(12, 18, 'M.Tech Electrical', 'NIT Surat', '2018', '80', 'B.Tech Electrical', 'GTU', '2016', '76', 'Science', 'Navrang School', '2011', '73', 'Science', 'Navrang School', '2009', '81'),
(13, 19, 'MBA Operations', 'Amity University', '2012', '74', 'B.Com', 'Gujarat University', '2010', '70', 'Commerce', 'Sharda School', '2005', '68', 'Commerce', 'Sharda School', '2003', '72'),
(14, 6, 'MBA', 'IIM Ahmedabad', '2018', '82', 'BBA', 'GLS University', '2016', '78', 'Commerce', 'St Xavier School', '2011', '80', 'Commerce', 'St Xavier School', '2009', '85'),
(15, 11, 'MCA', 'Nirma University', '2017', '84', 'BCA', 'Silver Oak College', '2015', '79', 'Science', 'Delhi Public School', '2010', '75', 'Science', 'Delhi Public School', '2008', '81'),
(16, 15, 'MBA', 'XYZ University', '2018', '75', 'B.E Computer Engineering', 'GEC Modasa', '2026', '78', 'Science', 'Shree Swaminarayan School', '2022', '72', 'Science', 'Shree Swaminarayan School', '2020', '84'),
(17, 18, 'M.Tech Electrical', 'NIT Surat', '2018', '80', 'B.Tech Electrical', 'GTU', '2016', '76', 'Science', 'Navrang School', '2011', '73', 'Science', 'Navrang School', '2009', '81'),
(18, 19, 'MBA Operations', 'Amity University', '2012', '74', 'B.Com', 'Gujarat University', '2010', '70', 'Commerce', 'Sharda School', '2005', '68', 'Commerce', 'Sharda School', '2003', '72');

-- --------------------------------------------------------

--
-- Table structure for table `empexpireince`
--

CREATE TABLE `empexpireince` (
  `ID` int(11) NOT NULL,
  `EmpID` varchar(5) DEFAULT NULL,
  `Employer1Name` varchar(75) DEFAULT NULL,
  `Employer1Designation` varchar(50) DEFAULT NULL,
  `Employer1CTC` varchar(50) DEFAULT NULL,
  `Employer1WorkDuration` varchar(11) DEFAULT NULL,
  `Employer2Name` varchar(75) DEFAULT NULL,
  `Employer2Designation` varchar(50) DEFAULT NULL,
  `Employer2CTC` varchar(50) DEFAULT NULL,
  `Employer2WorkDuration` varchar(11) DEFAULT NULL,
  `Employer3Name` varchar(75) DEFAULT NULL,
  `Employer3Designation` varchar(50) DEFAULT NULL,
  `Employer3CTC` varchar(50) DEFAULT NULL,
  `Employer3WorkDuration` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `empexpireince`
--

INSERT INTO `empexpireince` (`ID`, `EmpID`, `Employer1Name`, `Employer1Designation`, `Employer1CTC`, `Employer1WorkDuration`, `Employer2Name`, `Employer2Designation`, `Employer2CTC`, `Employer2WorkDuration`, `Employer3Name`, `Employer3Designation`, `Employer3CTC`, `Employer3WorkDuration`) VALUES
(2, '4', 'abc.pvt.td', 'software tester', '20,000 p/m', '4 yrs', 'tch.pvt.td', 'software tester', '32000 p/m', '4 yrs', 'dfg.pvt.td', 'SR.software tester', '45000 p/m', '7 yrs'),
(7, '2', 'SAR pvt.ltd', 'Software Developer', '25000 p/m', '3 yrs', 'abc enterprise', 'software developer', '30000 p/m', '3 yrs', 'dgfhgfg.pt.ltd', 'software developer', '35000 p/m', '2 yrs till '),
(8, '3', 'GHA pvt.ltd', 'accountant', '25000', '5 yrs', 'HRCH pvt.ltd', 'accountant', '75000', '5 yrs', 'TCGHB pvt ltd', 'Sr.Accountant', '95000 ', '8 yrs till'),
(9, '7', 'FAG pvt.ltd', 'HR Executive', '25000 p/m', '6 yrs', 'TYS', 'HR Executive', '35000 p/m', '7 yrs', 'hirp pvt.ltd', 'HR Executive', '45000 p/m', '4 yrs till'),
(10, '12', 'dfg.pvt.ltd', 'accountant', '25000 p/m', '1 yrs', 'fghpvt.ltd', 'accountant', '30000 p/m', '3 yrs', 'fghpvt.ltd', 'accountant', '45000 p/m', '5 yrs till'),
(11, '13', 'ABC', 'Developer', '12000 ', '2 years', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA'),
(12, '1', 'TechNova Solutions', 'Junior Software Developer', '25000 p/m', '2 Years', 'Skyline Technologies', 'Software Engineer', '40000 p/m', '3 Years', 'NextGen IT Solutions', 'Senior Software Engineer', '65000 p/m', '4 Years'),
(13, '14', 'ABC Tech', 'Jr Devloper', '1258000', '6 Month', 'XYZ Tech', 'Devloper', '2589300', '6 Month', 'It Tech', 'Sr Devloper', '853214447', '2 + Years'),
(14, '28', 'Infosys', 'Software Developer', '650000', '2 Years', 'TCS', 'Junior Developer', '450000', '1.5 Years', 'Wipro', 'Trainee Engineer', '320000', '1 Year'),
(15, '18', 'infoses', 'electrical engineer', '450000', '3 years', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `employeedetail`
--

CREATE TABLE `employeedetail` (
  `ID` int(11) NOT NULL,
  `EmpFname` varchar(50) DEFAULT NULL,
  `EmpLName` varchar(50) NOT NULL,
  `EmpCode` varchar(50) DEFAULT NULL,
  `EmpDept` varchar(120) DEFAULT NULL,
  `EmpDesignation` varchar(120) DEFAULT NULL,
  `EmpContactNo` bigint(10) DEFAULT NULL,
  `EmpGender` enum('Male','Female') DEFAULT NULL,
  `EmpEmail` varchar(200) DEFAULT NULL,
  `EmpPassword` varchar(100) DEFAULT NULL,
  `EmpJoingdate` date DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employeedetail`
--

INSERT INTO `employeedetail` (`ID`, `EmpFname`, `EmpLName`, `EmpCode`, `EmpDept`, `EmpDesignation`, `EmpContactNo`, `EmpGender`, `EmpEmail`, `EmpPassword`, `EmpJoingdate`, `PostingDate`) VALUES
(1, 'Nivyesh', 'Chaudhari', '123465', 'IT', 'Software Developer', 1234567890, 'Male', 'abc@gmail.com', '123', '2019-01-02', '2023-02-25 06:31:49'),
(2, 'Anuj', 'Kumar', '123465558', 'CS', 'Software Developer', 1234567890, 'Male', 'anuj@gmail.com', '123', '2017-03-23', '2023-04-20 06:41:42'),
(3, 'Ankush', 'Pandey', '123467', 'IT', 'Software Developer', 1234567890, 'Male', 'ankush@gmail.com', '89756', '2010-09-13', '2023-04-20 06:41:42'),
(4, 'Sarita', 'Pandey', '12346012', 'IT', 'Software Developer', 1234567890, 'Female', 'abhi@gmail.com', '156975', '2020-06-15', '2023-04-20 06:41:42'),
(6, 'Manu', 'Ramesh', '369874', 'Human Resources', 'HR Executive', 9876543210, 'Male', 'manu@gmail.com', '987563', '2021-02-10', '2023-04-20 06:41:42'),
(7, 'Ragunath', 'Shahye', '63', 'Finance', 'Accountant', 9123456780, 'Male', 'shahye@gmail.com', '99999', '2018-11-25', '2023-04-20 06:41:42'),
(8, 'Rohit', 'Patel', 'EMP108', 'Marketing', 'Marketing Executive', 9988776655, 'Male', 'rohitpatel@gmail.com', 'Rohit@123', '2022-08-12', '2023-04-20 06:41:42'),
(9, 'Garuv', 'Bhatia', '89745', 'Sales', 'Sales Manager', 9871234560, 'Male', 'jk@gmail.com', '12', '2019-09-18', '2023-04-20 06:41:42'),
(10, 'Khusi', 'Dev', '1234', 'Administration', 'Office Admin', 9012345678, 'Female', 'hjk@gmail.com', '1990', '2020-01-05', '2023-04-20 06:41:42'),
(11, 'SARITA', 'pANDEY', '789', 'IT', 'System Analyst', 8899776655, 'Female', 'PANDEY@GMAIL.COM', '1111', '2017-07-20', '2023-04-20 06:41:42'),
(12, 'Dinesh', 'Karthik', '56989', 'Support', 'Technical Support Engineer', 9090909090, 'Male', 'dinesh@gmail.com', '8989', '2021-04-14', '2023-04-20 06:41:42'),
(13, 'Test', 'User', '2131231', 'IT', 'Software Developer', 1234567890, 'Male', 'testuser@gmail.com', 'Test@123', '2018-10-09', '2023-04-20 06:41:42'),
(14, 'Anuj', 'Kumar', '1023647885', 'IT', 'Software Developer', 1234567890, 'Male', 'aktest@gmail.com', 'Test@123', '2019-01-01', '2023-04-20 06:41:42'),
(15, 'smarty', 'Chaudhari', '123', 'IT', 'Frontend Developer', 9876501234, 'Male', 'cse.2208940131013@gmail.com', '123', '2024-01-15', '2026-02-28 12:30:27'),
(18, 'Nivyesh', 'Chaudhary', '145', 'Electronic Data Processing', 'Software Developer', 78618814, 'Male', 'testuser@gmail.com', '145', '2019-01-02', '2026-03-05 14:29:04'),
(19, 'Jitendrabhai', 'Chaudhari', '999', 'Management', 'Operations Manager', 9822334455, 'Male', 'this@this.com', '999', '2016-12-01', '2026-03-06 03:28:26'),
(25, 'NIVYESHKUMAR', 'CHAUDHARI', '394163', NULL, NULL, NULL, NULL, 'chaudharinivyesh92@gmail.com', '123', NULL, '2026-05-17 05:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `leave_management`
--

CREATE TABLE `leave_management` (
  `ID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `LeaveType` varchar(50) DEFAULT NULL,
  `FromDate` date DEFAULT NULL,
  `ToDate` date DEFAULT NULL,
  `Status` enum('Pending','Approved','Rejected') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_management`
--

INSERT INTO `leave_management` (`ID`, `EmployeeID`, `LeaveType`, `FromDate`, `ToDate`, `Status`) VALUES
(1, 1, 'Sick Leave', '2026-02-10', '2026-02-12', 'Rejected'),
(2, 2, 'Casual Leave', '2026-02-15', '2026-02-16', 'Rejected'),
(3, 3, 'Annual Leave', '2026-02-20', '2026-02-25', 'Rejected'),
(4, 2, 'Causal', '2026-03-03', '2026-03-05', 'Approved'),
(5, 2, 'Family Problem', '2026-03-05', '2026-03-07', 'Pending'),
(6, 1, 'Sick Leave.', '2026-03-05', '2026-03-07', 'Approved'),
(7, 1, 'Approval', '2026-03-09', '2026-03-11', 'Approved'),
(8, 2, 'Big problem', '2026-03-15', '2026-03-21', 'Pending'),
(10, 1, 'Go for a interview in company in Infoses', '2026-03-08', '2026-03-10', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE `payroll` (
  `ID` int(11) NOT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `BasicSalary` decimal(10,2) DEFAULT NULL,
  `Allowance` decimal(10,2) DEFAULT NULL,
  `Deduction` decimal(10,2) DEFAULT NULL,
  `NetSalary` decimal(10,2) DEFAULT NULL,
  `PaymentDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`ID`, `EmployeeID`, `BasicSalary`, `Allowance`, `Deduction`, `NetSalary`, `PaymentDate`) VALUES
(1, 1, 45000.00, 5000.00, 2000.00, 48000.00, '2026-02-28'),
(2, 2, 70000.00, 10000.00, 3500.00, 76500.00, '2026-02-28'),
(3, 3, 50000.00, 5000.00, 2000.00, 53000.00, '2026-02-28'),
(4, 4, 35000.00, 2000.00, 1000.00, 33500.00, '2026-03-04'),
(5, 6, 50000.00, 2000.00, 1000.00, 49000.00, '2026-03-04'),
(6, 18, 75000.00, 12000.00, 4000.00, 83000.00, '2026-03-05'),
(7, 19, 80000.00, 15000.00, 5000.00, 90000.00, '2026-03-05'),
(8, 7, 42000.00, 4000.00, 1500.00, 44500.00, '2026-05-01'),
(9, 8, 38000.00, 3000.00, 1200.00, 39800.00, '2026-05-01'),
(10, 9, 65000.00, 7000.00, 2500.00, 69500.00, '2026-05-01'),
(11, 10, 32000.00, 2500.00, 1000.00, 33500.00, '2026-05-01'),
(12, 11, 58000.00, 6000.00, 2200.00, 61800.00, '2026-05-01'),
(13, 12, 45000.00, 4000.00, 1800.00, 47200.00, '2026-05-01'),
(14, 13, 62000.00, 7000.00, 3000.00, 66000.00, '2026-05-01'),
(15, 14, 68000.00, 8500.00, 3200.00, 73300.00, '2026-05-01'),
(16, 15, 55000.00, 5000.00, 2000.00, 58000.00, '2026-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `quick_links`
--

CREATE TABLE `quick_links` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quick_links`
--

INSERT INTO `quick_links` (`id`, `title`, `url`, `created_at`) VALUES
(2, 'Form for the Selection Process', 'https://www.google.com/search?gs_ssp=eJzj4tTP1TcwMU02T1JgNGB0YPBiS8_PT89JBQBASQXT&q=google&rlz=1C1UEAD_enIN1088IN1088&oq=google&gs_lcrp=EgZjaHJvbWUqGAgBEC4YQxiDARjHARixAxjRAxiABBiKBTIHCAAQABiPAjIYCAEQLhhDGIMBGMcBGLEDGNEDGIAEGIoFMgYIAhBFGDsyBggDEEUYPDIGCAQQRRg8MgYIBRBFGDwyBggGEEUYPDIGCAcQRRg80gEIMzM0OGowajeoAgCwAgA&sourceid=chrome&ie=UTF-8', '2026-04-26 07:01:39'),
(3, 'Link for the google form to add the employee', 'http://localhost/hrms_work/admin/quicklinks.php', '2026-04-26 07:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(11) NOT NULL,
  `AdminName` varchar(50) DEFAULT NULL,
  `AdminuserName` varchar(50) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `AdminuserName`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'Nivyesh', '123', '2023-02-25 16:52:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `empeducation`
--
ALTER TABLE `empeducation`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `empexpireince`
--
ALTER TABLE `empexpireince`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `employeedetail`
--
ALTER TABLE `employeedetail`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmpCode` (`EmpCode`);

--
-- Indexes for table `leave_management`
--
ALTER TABLE `leave_management`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `payroll`
--
ALTER TABLE `payroll`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EmployeeID` (`EmployeeID`);

--
-- Indexes for table `quick_links`
--
ALTER TABLE `quick_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `empeducation`
--
ALTER TABLE `empeducation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `empexpireince`
--
ALTER TABLE `empexpireince`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employeedetail`
--
ALTER TABLE `employeedetail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `leave_management`
--
ALTER TABLE `leave_management`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payroll`
--
ALTER TABLE `payroll`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `quick_links`
--
ALTER TABLE `quick_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employeedetail` (`ID`);

--
-- Constraints for table `leave_management`
--
ALTER TABLE `leave_management`
  ADD CONSTRAINT `leave_management_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employeedetail` (`ID`);

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_ibfk_1` FOREIGN KEY (`EmployeeID`) REFERENCES `employeedetail` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
