-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 10:45 AM
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
-- Database: `snhs_oes`
--

-- --------------------------------------------------------

--
-- Table structure for table `corevalues`
--

CREATE TABLE `corevalues` (
  `V_ID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `VALUE_ID` int(11) NOT NULL,
  `FIRST` int(11) NOT NULL,
  `SECOND` int(11) NOT NULL,
  `THIRD` int(11) NOT NULL,
  `FOURTH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_NAME` varchar(30) NOT NULL,
  `COURSE_LEVEL` varchar(50) NOT NULL DEFAULT '1',
  `COURSE_MAJOR` varchar(30) NOT NULL DEFAULT 'None',
  `COURSE_DESC` varchar(255) NOT NULL DEFAULT 'None',
  `DEPT_ID` int(11) NOT NULL,
  `SETSEMESTER` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `COURSE_LEVEL`, `COURSE_MAJOR`, `COURSE_DESC`, `DEPT_ID`, `SETSEMESTER`) VALUES
(1, 'JHS', '7', 'N/A', '', 1, ''),
(3, 'JHS', '8', 'N/A', '', 1, ''),
(4, 'JHS', '9', 'N/A', '', 1, ''),
(5, 'JHS', '10', 'N/A', '', 1, ''),
(6, 'SHS', '11', 'STEM', '', 2, ''),
(7, 'SHS', '11', 'ABM', '', 2, ''),
(8, 'SHS', '11', 'HUMSS', '', 2, ''),
(9, 'SHS', '11', 'GAS', '', 2, ''),
(10, 'SHS', '12', 'STEM', '', 2, ''),
(11, 'SHS', '12', 'ABM', '', 2, ''),
(12, 'SHS', '12', 'HUMSS', '', 2, ''),
(13, 'SHS', '12', 'GAS', '', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPT_ID` int(11) NOT NULL,
  `DEPARTMENT_NAME` varchar(30) NOT NULL,
  `DEPARTMENT_DESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_DESC`) VALUES
(1, 'Junior High School', 'Grade 7-10'),
(2, 'Senior High School', 'Grade 11 & 12');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `GRADE_ID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `FIRST` int(11) NOT NULL,
  `SECOND` int(11) NOT NULL,
  `THIRD` int(11) NOT NULL,
  `FOURTH` int(11) NOT NULL,
  `AVE` float NOT NULL,
  `REMARKS` text NOT NULL,
  `COMMENT` text NOT NULL,
  `SEMS` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schoolyr`
--

CREATE TABLE `schoolyr` (
  `SYID` int(11) NOT NULL,
  `AY` varchar(30) NOT NULL,
  `SEMESTER` varchar(20) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `IDNO` int(30) NOT NULL,
  `CATEGORY` varchar(30) NOT NULL DEFAULT 'ENROLLED',
  `DATE_RESERVED` datetime NOT NULL,
  `DATE_ENROLLED` datetime NOT NULL,
  `STATUS` varchar(30) NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentschedule`
--

CREATE TABLE `studentschedule` (
  `CLASS_ID` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `schedID` int(11) NOT NULL,
  `AY` varchar(11) NOT NULL,
  `DAY` varchar(20) NOT NULL,
  `C_TIME` varchar(30) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `ROOM` text NOT NULL,
  `CSECTION` varchar(30) NOT NULL DEFAULT 'NONE',
  `COURSE_ID` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentsubjects`
--

CREATE TABLE `studentsubjects` (
  `STUDSUBJ_ID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `LEVEL` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `SY` text NOT NULL,
  `ATTEMP` int(11) NOT NULL,
  `AVERAGE` double NOT NULL,
  `OUTCOME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentvalues`
--

CREATE TABLE `studentvalues` (
  `STUDVAL_ID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `VALUE_ID` int(11) NOT NULL,
  `LEVEL` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `SY` text NOT NULL,
  `ATTEMP` int(11) NOT NULL,
  `AVERAGE` double NOT NULL,
  `OUTCOME` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `SUBJ_ID` int(11) NOT NULL,
  `SUBJ_CODE` varchar(255) NOT NULL,
  `SUBJ_DESCRIPTION` varchar(255) NOT NULL,
  `UNIT` int(2) NOT NULL,
  `PRE_REQUISITE` varchar(30) NOT NULL DEFAULT 'None',
  `COURSE_ID` int(11) NOT NULL,
  `AY` varchar(30) NOT NULL,
  `SEMESTER` varchar(20) NOT NULL,
  `PreTaken` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`SUBJ_ID`, `SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`, `COURSE_ID`, `AY`, `SEMESTER`, `PreTaken`) VALUES
(1, 'ENG', 'English', 0, 'None', 1, '', '', 0),
(2, 'MATH', 'Mathematics', 0, 'None', 1, '', '', 0),
(3, 'FIL', 'Filipino', 0, 'None', 1, '', '', 0),
(4, 'SCI', 'Science', 0, 'None', 1, '', '', 0),
(5, 'TLE', 'Technology and Livelihood Education', 0, 'None', 1, '', '', 0),
(6, 'MAPEH', 'Music, Arts, Physical Education, and Health', 0, 'None', 1, '', '', 0),
(7, 'EsP', 'Edukasyon sa Pagpapakatao', 0, 'None', 1, '', '', 0),
(8, 'AP', 'Araling Panlipunan', 0, 'None', 1, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblauto`
--

CREATE TABLE `tblauto` (
  `ID` int(11) NOT NULL,
  `autocode` varchar(255) DEFAULT NULL,
  `autoname` varchar(255) DEFAULT NULL,
  `appendchar` varchar(255) DEFAULT NULL,
  `autostart` int(11) DEFAULT 0,
  `autoend` int(11) DEFAULT 0,
  `incrementvalue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblauto`
--

INSERT INTO `tblauto` (`ID`, `autocode`, `autoname`, `appendchar`, `autostart`, `autoend`, `incrementvalue`) VALUES
(1, 'Asset', 'Asset', 'ASitem', 0, 3, 1),
(2, 'Trans', 'Transaction', 'TrAnS', 1, 5, 1),
(3, 'SIDNO', 'IDNO', '2015', 1000000, 212, 1),
(4, 'EMPLOYEE', 'EMPID', '020010', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblinstructor`
--

CREATE TABLE `tblinstructor` (
  `INST_ID` int(11) NOT NULL,
  `INST_NAME` varchar(90) NOT NULL,
  `INST_MAJOR` varchar(90) NOT NULL,
  `INST_CONTACT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblinstructor`
--

INSERT INTO `tblinstructor` (`INST_ID`, `INST_NAME`, `INST_MAJOR`, `INST_CONTACT`) VALUES
(1, 'Mrs. Emily Garcia', '', ''),
(2, 'Mr. Benjamin Tan', '', ''),
(3, 'Miss Jessica Rodriguez', '', ''),
(4, 'Mr. Alexander Cruz', '', ''),
(5, 'Mrs. Samantha Martinez', '', ''),
(6, 'Mr. Daniel Reyes', '', ''),
(7, 'Miss Natalie Lopez', '', ''),
(8, 'Mr. Christopher Santos', '', ''),
(9, 'Mrs. Victoria Hernandez', '', ''),
(10, 'Mr. Joshua Rivera', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `LOGID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `LOGDATETIME` datetime NOT NULL,
  `LOGROLE` varchar(55) NOT NULL,
  `LOGMODE` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`LOGID`, `USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) VALUES
(1, 1000000202, '2024-03-24 08:18:27', 'Student', 'Logged out'),
(2, 1000000203, '2024-03-24 08:50:16', 'Student', 'Logged out'),
(3, 1000000204, '2024-03-24 12:20:30', 'Student', 'Logged out'),
(4, 1000000204, '2024-03-24 12:20:33', 'Student', 'Logged in'),
(5, 1000000204, '2024-03-24 12:32:28', 'Student', 'Logged out'),
(6, 1000000204, '2024-03-24 12:33:46', 'Student', 'Logged in'),
(7, 1000000204, '2024-03-24 12:45:51', 'Student', 'Logged out'),
(8, 1, '2024-03-24 12:48:15', 'Administrator', 'Logged out'),
(9, 1, '2024-03-24 12:48:20', 'Administrator', 'Logged in'),
(10, 1, '2024-03-25 01:43:33', 'Administrator', 'Logged in'),
(11, 1000000205, '2024-03-25 08:05:14', 'Student', 'Logged out'),
(12, 1000000206, '2024-03-25 08:31:35', 'Student', 'Logged out'),
(13, 1, '2024-03-26 01:36:27', 'Administrator', 'Logged in'),
(14, 1000000207, '2024-03-26 01:47:50', 'Student', 'Logged in'),
(15, 1000000207, '2024-03-26 03:27:51', 'Student', 'Logged out'),
(16, 1000000207, '2024-03-26 03:30:17', 'Student', 'Logged in'),
(17, 1000000207, '2024-03-26 07:40:04', 'Student', 'Logged in'),
(18, 1, '2024-03-26 07:48:26', 'Administrator', 'Logged in'),
(19, 1000000208, '2024-03-27 08:11:23', 'Student', 'Logged out'),
(20, 1, '2024-03-27 08:19:17', 'Administrator', 'Logged in'),
(21, 1000000209, '2024-03-27 09:00:32', 'Student', 'Logged out'),
(22, 1000000210, '2024-03-27 10:26:54', 'Student', 'Logged out');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayment`
--

CREATE TABLE `tblpayment` (
  `PAYMENTID` int(11) NOT NULL,
  `IDNO` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_LEVEL` int(11) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `ENTRANCEFEE` double NOT NULL,
  `TOTALUNITS` double NOT NULL,
  `TOTALSEMESTER` double NOT NULL,
  `PARTIALPAYMENT` double NOT NULL,
  `BALANCE` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE `tblschedule` (
  `schedID` int(11) NOT NULL,
  `TIME_FROM` varchar(90) NOT NULL,
  `TIME_TO` varchar(90) NOT NULL,
  `sched_time` varchar(30) NOT NULL,
  `sched_day` varchar(30) NOT NULL,
  `sched_semester` varchar(30) NOT NULL,
  `sched_sy` varchar(30) NOT NULL,
  `sched_room` varchar(30) NOT NULL,
  `SECTION` varchar(30) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `SUBJ_ID` int(11) NOT NULL,
  `INST_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`schedID`, `TIME_FROM`, `TIME_TO`, `sched_time`, `sched_day`, `sched_semester`, `sched_sy`, `sched_room`, `SECTION`, `COURSE_ID`, `SUBJ_ID`, `INST_ID`) VALUES
(1, '07:40 am', '08:40 am', '07:40 am-08:40 am', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 2, 1),
(2, '08:40 am', '09:40 am', '08:40 am-09:40 am', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 1, 8),
(3, '10:00 am', '11:00 am', '10:00 am-11:00 am', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 3, 3),
(4, '11:00 am', '12:00 pm', '11:00 am-12:00 pm', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 4, 4),
(5, '01:00 pm', '02:00 pm', '01:00 pm-02:00 pm', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 5, 6),
(6, '02:00 pm', '03:00 pm', '02:00 pm-03:00 pm', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 6, 5),
(7, '03:00 pm', '04:00 pm', '03:00 pm-04:00 pm', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 7, 5),
(8, '04:00 pm', '05:00 pm', '04:00 pm-05:00 pm', 'MTWThF', '', '2024-2025', 'Grade 7 Room', 'Alpha', 1, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `SEMID` int(11) NOT NULL,
  `SEMESTER` varchar(90) NOT NULL,
  `SETSEM` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`SEMID`, `SEMESTER`, `SETSEM`) VALUES
(1, 'First', 0),
(2, 'Second', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblstuddetails`
--

CREATE TABLE `tblstuddetails` (
  `DETAIL_ID` int(11) NOT NULL,
  `GUARDIAN1` varchar(255) DEFAULT NULL,
  `GCONTACT1` varchar(40) DEFAULT NULL,
  `GUARDIAN2` varchar(250) DEFAULT NULL,
  `GCONTACT2` varchar(40) DEFAULT NULL,
  `GUARDIAN3` varchar(250) DEFAULT NULL,
  `GCONTACT3` varchar(40) DEFAULT NULL,
  `IDNO` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `S_ID` int(11) NOT NULL,
  `IDNO` int(20) NOT NULL,
  `FNAME` varchar(40) NOT NULL,
  `LNAME` varchar(40) NOT NULL,
  `MNAME` varchar(40) NOT NULL,
  `EXT` varchar(10) DEFAULT NULL,
  `LRN_NO` int(11) DEFAULT NULL,
  `PSA_NO` varchar(50) DEFAULT NULL,
  `PSA_FILE` varchar(255) DEFAULT NULL,
  `REPORT_CARD` varchar(255) DEFAULT NULL,
  `LR_NO` varchar(50) DEFAULT NULL,
  `BALIK_ARAL` int(11) NOT NULL,
  `SEX` varchar(10) NOT NULL DEFAULT 'Male',
  `BDAY` date NOT NULL,
  `BPLACE` text NOT NULL,
  `AGE` int(30) NOT NULL,
  `MOTHER_TONGUE` varchar(50) DEFAULT NULL,
  `IP_NAME` varchar(50) DEFAULT NULL,
  `BENEFICIARY_ID` varchar(40) DEFAULT NULL,
  `DISABILITY_NAME` varchar(50) DEFAULT NULL,
  `CURRENT_ADD` text NOT NULL,
  `PERMANENT_ADD` text NOT NULL,
  `ACC_USERNAME` varchar(255) NOT NULL,
  `ACC_PASSWORD` text NOT NULL,
  `student_status` text NOT NULL,
  `YEARLEVEL` int(11) NOT NULL,
  `STUDSECTION` int(11) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `STUDPHOTO` varchar(255) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `SYEAR` varchar(30) NOT NULL,
  `NewEnrollees` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblvalues`
--

CREATE TABLE `tblvalues` (
  `VALUE_ID` int(11) NOT NULL,
  `CORE_VALUE` varchar(255) NOT NULL,
  `STATEMENT1` varchar(255) NOT NULL,
  `STATEMENT2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblvalues`
--

INSERT INTO `tblvalues` (`VALUE_ID`, `CORE_VALUE`, `STATEMENT1`, `STATEMENT2`) VALUES
(1, 'Maka-Diyos', 'Expresses one\'s spiritual beliefs while respecting the spiritual beliefs of others', 'Shows adherence to ethical principles by upholding the truth'),
(2, 'Makatao', 'Is sensitive to individual, social, and cultural differences', 'Demonstrates contributions towards solidarity'),
(3, 'Makakalikasan', 'Cares for the environment and utilizes resources wisely, judiciously, and economically', ''),
(4, 'Makabansa', 'Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen', 'Demonstrates appropriate behavior in carrying out activities in the school, community, and country');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `ACCOUNT_ID` int(11) NOT NULL,
  `ACCOUNT_NAME` varchar(255) NOT NULL,
  `ACCOUNT_USERNAME` varchar(255) NOT NULL,
  `ACCOUNT_PASSWORD` text NOT NULL,
  `ACCOUNT_TYPE` varchar(30) NOT NULL,
  `EMPID` int(11) NOT NULL,
  `USERIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `ACCOUNT_USERNAME`, `ACCOUNT_PASSWORD`, `ACCOUNT_TYPE`, `EMPID`, `USERIMAGE`) VALUES
(1, 'Josh Cadelina', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administrator', 1234, 'photos/LoginRed.jpg'),
(2, 'Norhan Alamada', 'norhan', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Registrar', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corevalues`
--
ALTER TABLE `corevalues`
  ADD PRIMARY KEY (`V_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_ID`),
  ADD KEY `DEPT_ID` (`DEPT_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPT_ID`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`GRADE_ID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `schoolyr`
--
ALTER TABLE `schoolyr`
  ADD PRIMARY KEY (`SYID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `studentschedule`
--
ALTER TABLE `studentschedule`
  ADD PRIMARY KEY (`CLASS_ID`),
  ADD KEY `IDNO` (`IDNO`),
  ADD KEY `schedID` (`schedID`);

--
-- Indexes for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  ADD PRIMARY KEY (`STUDSUBJ_ID`),
  ADD KEY `IDNO` (`IDNO`),
  ADD KEY `SUBJ_ID` (`SUBJ_ID`);

--
-- Indexes for table `studentvalues`
--
ALTER TABLE `studentvalues`
  ADD PRIMARY KEY (`STUDVAL_ID`),
  ADD KEY `IDNO` (`IDNO`),
  ADD KEY `SUBJ_ID` (`VALUE_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`SUBJ_ID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`);

--
-- Indexes for table `tblauto`
--
ALTER TABLE `tblauto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `autocode` (`autocode`);

--
-- Indexes for table `tblinstructor`
--
ALTER TABLE `tblinstructor`
  ADD PRIMARY KEY (`INST_ID`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`LOGID`);

--
-- Indexes for table `tblpayment`
--
ALTER TABLE `tblpayment`
  ADD PRIMARY KEY (`PAYMENTID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `tblschedule`
--
ALTER TABLE `tblschedule`
  ADD PRIMARY KEY (`schedID`),
  ADD KEY `COURSE_ID` (`COURSE_ID`),
  ADD KEY `SUBJ_ID` (`SUBJ_ID`);

--
-- Indexes for table `tblsemester`
--
ALTER TABLE `tblsemester`
  ADD PRIMARY KEY (`SEMID`);

--
-- Indexes for table `tblstuddetails`
--
ALTER TABLE `tblstuddetails`
  ADD PRIMARY KEY (`DETAIL_ID`);

--
-- Indexes for table `tblvalues`
--
ALTER TABLE `tblvalues`
  ADD PRIMARY KEY (`VALUE_ID`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`),
  ADD UNIQUE KEY `ACCOUNT_USERNAME` (`ACCOUNT_USERNAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corevalues`
--
ALTER TABLE `corevalues`
  MODIFY `V_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `COURSE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `GRADE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolyr`
--
ALTER TABLE `schoolyr`
  MODIFY `SYID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentschedule`
--
ALTER TABLE `studentschedule`
  MODIFY `CLASS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentsubjects`
--
ALTER TABLE `studentsubjects`
  MODIFY `STUDSUBJ_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentvalues`
--
ALTER TABLE `studentvalues`
  MODIFY `STUDVAL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `SUBJ_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblauto`
--
ALTER TABLE `tblauto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblinstructor`
--
ALTER TABLE `tblinstructor`
  MODIFY `INST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `LOGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblpayment`
--
ALTER TABLE `tblpayment`
  MODIFY `PAYMENTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblschedule`
--
ALTER TABLE `tblschedule`
  MODIFY `schedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblsemester`
--
ALTER TABLE `tblsemester`
  MODIFY `SEMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstuddetails`
--
ALTER TABLE `tblstuddetails`
  MODIFY `DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblvalues`
--
ALTER TABLE `tblvalues`
  MODIFY `VALUE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
