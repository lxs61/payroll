-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 11:19 AM
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
-- Database: `payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `EmployeeNumber` varchar(200) NOT NULL,
  `Date` date NOT NULL,
  `Time_in` time NOT NULL,
  `Time_out` time NOT NULL,
  `worktime` time NOT NULL,
  `Late` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`EmployeeNumber`, `Date`, `Time_in`, `Time_out`, `worktime`, `Late`) VALUES
('12345', '2024-05-08', '17:23:32', '17:24:03', '00:00:48', ''),
('12345', '2024-05-15', '15:22:43', '15:23:10', '00:00:48', ''),
('12345', '2024-05-18', '01:30:00', '02:30:00', '00:00:01', ''),
('12345', '2024-05-18', '07:30:00', '08:30:00', '00:00:01', ''),
('090909', '2024-05-18', '07:00:00', '08:00:00', '00:00:01', ''),
('12345', '2024-05-18', '02:00:00', '03:00:00', '00:00:01', ''),
('12345', '2024-05-18', '01:00:00', '02:00:00', '00:00:01', ''),
('12345', '2024-05-18', '01:00:00', '02:00:00', '00:00:01', ''),
('090909', '2024-05-10', '02:00:00', '07:00:00', '00:00:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `AccountName` varchar(200) NOT NULL,
  `Address` varchar(400) NOT NULL,
  `PhoneNumber` varchar(200) NOT NULL,
  `Superior` varchar(100) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `BirthDate` date NOT NULL,
  `Email` varchar(200) NOT NULL,
  `BankAccountNumber` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL,
  `Gender` varchar(200) NOT NULL,
  `DateHired` date NOT NULL,
  `Department` varchar(200) NOT NULL,
  `EmployeeNumber` varchar(200) NOT NULL,
  `Position` varchar(200) NOT NULL,
  `Rate` int(100) NOT NULL,
  `otp_code` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`AccountName`, `Address`, `PhoneNumber`, `Superior`, `Username`, `BirthDate`, `Email`, `BankAccountNumber`, `Password`, `Gender`, `DateHired`, `Department`, `EmployeeNumber`, `Position`, `Rate`, `otp_code`) VALUES
('RONNIE FLORES', 'B-35 L-22 Southvill 8A San Isidro', '09971776834', 'Mr Niko Alvarez', 'Mr Flores', '2002-03-01', 'ronnieflores321@gmail.com', '090909', '12345', 'Male', '2024-03-04', 'ICS', '090909', 'Instructor ', 0, 0),
('RONNIE FLORES', 'B-35 L-22 Southvill 8A San Isidro', '09971776834', 'Mr Niko Alvarez', 'Mr Flores', '2002-03-01', 'ronnieflores321@gmail.com', '090909', '12345', 'Male', '2024-03-04', 'ICS', '090909', 'Instructor ', 0, 0),
('RONNIE FLORES', 'B-35 L-22 Southvill 8A San Isidro', '09971776834', 'Mr Niko Alvarez', 'Mr Flores', '2002-03-01', 'ronnieflores321@gmail.com', '090909', '12345', 'Male', '2024-03-04', 'ICS', '090909', 'Instructor ', 0, 0),
('RONNIE FLORES', 'B-35 L-22 Southvill 8A San Isidro', '09971776834', 'Mr Niko Alvarez', 'Mr Flores', '2002-03-01', 'ronnieflores321@gmail.com', '090909', '12345', 'Male', '2024-03-04', 'ICS', '090909', 'Instructor ', 0, 0),
('Kathlyn M. Leal', 'Blk 4 Lot 75 Southville 8C Phase 1N San Isidro Rodriguez Rizal', '09774746136', 'Dev. Ronnie B. Flores', 'Kathlyn', '2003-11-17', 'leal.kathlynm@gmail.com', '101234', 'kathlyn_03', 'Female', '2015-08-20', 'IOE', '12345', 'Instructor ', 90, 0),
('NIKO ALVAREZ', 'B-25 L-24 SV8A SAN ISIDRO', '0912345678', 'MR FLORES', 'NIKO', '2024-03-04', 'NIKO@GMAIL.COM', '070707', '070707', 'Male', '2024-03-04', 'IOE', '070707', 'Admin', 90, 0),
('Janrow F. Gallogo', 'B-12 L-32', '09999999999', 'MR FLORES', 'BEDES', '2024-03-04', 'gallogojanrow@gmail.com', '080808', '080808', 'Male', '2024-03-04', 'ICS', '080808', 'Admin', 90, 0),
('EUGENIO,ANNE CHRISTINE', 'SITIO MAISLAP CATALINO COMPOUND', '09123456789', 'JONAS', 'HATDOG', '2024-03-04', 'annextine13@gmail.com', '1212', '1234', 'Female', '2024-03-04', 'ICS', '12', 'Instructor ', 550, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE `payslip` (
  `EmployeeNumber` varchar(200) NOT NULL,
  `Totaldeduc` varchar(100) NOT NULL,
  `Basicpay` int(200) NOT NULL,
  `Netpay` int(100) NOT NULL,
  `Date` varchar(200) NOT NULL,
  `Hrs` int(100) NOT NULL,
  `EmployeeName` varchar(200) NOT NULL,
  `Rate` varchar(100) NOT NULL,
  `Sss` varchar(100) NOT NULL,
  `Pagibig` varchar(100) NOT NULL,
  `Phil` varchar(100) NOT NULL,
  `Tax` varchar(100) NOT NULL,
  `Date_Covered` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payslip`
--

INSERT INTO `payslip` (`EmployeeNumber`, `Totaldeduc`, `Basicpay`, `Netpay`, `Date`, `Hrs`, `EmployeeName`, `Rate`, `Sss`, `Pagibig`, `Phil`, `Tax`, `Date_Covered`) VALUES
('Ronnie B. Flores', '090909', 0, 0, '090909', 0, '', '', '', '', '', '', ''),
('Kathlyn M. Leal', '12345', 0, 0, '101234', 0, '', '', '', '', '', '', ''),
('12345', '3149.28', 8640, 5491, 'May 13, 2024', 96, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('', '', 0, 0, 'May 22, 2024', 0, '', 'Rate not found', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '3313.305', 9090, 5777, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', 'MAY15 - MAY30'),
('12345', '', 0, 0, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '', 0, 0, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '', 0, 0, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '3313.305', 9090, 5777, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '3313.305', 9090, 5777, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '', 0, 0, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12345', '', 0, 0, 'May 22, 2024', 101, 'Kathlyn M. Leal', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('080808', '0', 0, 0, 'May 22, 2024', 0, 'Janrow F. Gallogo', '90', '8.28%', '7.02%', '9.15%', '12%', ''),
('12', '0', 0, 0, 'May 23, 2024', 0, 'EUGENIO,ANNE CHRISTINE', '550', '8.28%', '7.02%', '9.15%', '12%', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `AccountName` varchar(300) NOT NULL,
  `EmployeeNumber` varchar(100) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Position` varchar(100) NOT NULL,
  `Mon_1` varchar(300) NOT NULL,
  `Mon_2` varchar(300) NOT NULL,
  `Mon_3` varchar(300) NOT NULL,
  `Mon_4` varchar(300) NOT NULL,
  `Mon_5` varchar(300) NOT NULL,
  `Mon_6` varchar(300) NOT NULL,
  `Tue_1` varchar(300) NOT NULL,
  `Tue_2` varchar(300) NOT NULL,
  `Tue_3` varchar(300) NOT NULL,
  `Tue_4` varchar(300) NOT NULL,
  `Tue_5` varchar(300) NOT NULL,
  `Tue_6` varchar(300) NOT NULL,
  `Wed_1` varchar(300) NOT NULL,
  `Wed_2` varchar(300) NOT NULL,
  `Wed_3` varchar(300) NOT NULL,
  `Wed_4` varchar(300) NOT NULL,
  `Wed_5` varchar(300) NOT NULL,
  `Wed_6` varchar(300) NOT NULL,
  `Thu_1` varchar(300) NOT NULL,
  `Thu_2` varchar(300) NOT NULL,
  `Thu_3` varchar(300) NOT NULL,
  `Thu_4` varchar(300) NOT NULL,
  `Thu_5` varchar(300) NOT NULL,
  `Thu_6` varchar(300) NOT NULL,
  `Fri_1` varchar(300) NOT NULL,
  `Fri_2` varchar(300) NOT NULL,
  `Fri_3` varchar(300) NOT NULL,
  `Fri_4` varchar(300) NOT NULL,
  `Fri_5` varchar(300) NOT NULL,
  `Fri_6` varchar(300) NOT NULL,
  `Sat_1` varchar(300) NOT NULL,
  `Sat_2` varchar(300) NOT NULL,
  `Sat_3` varchar(300) NOT NULL,
  `Sat_4` varchar(300) NOT NULL,
  `Sat_5` varchar(300) NOT NULL,
  `Sat_6` varchar(300) NOT NULL,
  `Sun_1` varchar(300) NOT NULL,
  `Sun_2` varchar(300) NOT NULL,
  `Sun_3` varchar(300) NOT NULL,
  `Sun_4` varchar(300) NOT NULL,
  `Sun_5` varchar(300) NOT NULL,
  `Sun_6` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`AccountName`, `EmployeeNumber`, `Department`, `Position`, `Mon_1`, `Mon_2`, `Mon_3`, `Mon_4`, `Mon_5`, `Mon_6`, `Tue_1`, `Tue_2`, `Tue_3`, `Tue_4`, `Tue_5`, `Tue_6`, `Wed_1`, `Wed_2`, `Wed_3`, `Wed_4`, `Wed_5`, `Wed_6`, `Thu_1`, `Thu_2`, `Thu_3`, `Thu_4`, `Thu_5`, `Thu_6`, `Fri_1`, `Fri_2`, `Fri_3`, `Fri_4`, `Fri_5`, `Fri_6`, `Sat_1`, `Sat_2`, `Sat_3`, `Sat_4`, `Sat_5`, `Sat_6`, `Sun_1`, `Sun_2`, `Sun_3`, `Sun_4`, `Sun_5`, `Sun_6`) VALUES
('Ronnie B. Flores', '090909', 'ICS', 'Instructor ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Ronnie B. Flores', '090909', 'ICS', 'Instructor ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Ronnie B. Flores', '090909', 'ICS', 'Instructor ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Ronnie B. Flores', '090909', 'ICS', 'Instructor ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
('Kathlyn M. Leal', '12345', 'ICS', 'Admin', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
