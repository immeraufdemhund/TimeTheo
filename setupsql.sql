--
-- Table structure for table `assignment`
--
$data->Query("DROP TABLE IF EXISTS `assignment`;CREATE TABLE `assignment` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `meetingID` int(11) NOT NULL,  `personId` int(11) NOT NULL,  `assignmentTypeId` int(11) NOT NULL,  PRIMARY KEY (`ID`));");

--
-- Table structure for table `assignmenttype`
--
$data->Query("DROP TABLE IF EXISTS `assignmenttype`;CREATE TABLE `assignmenttype` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) NOT NULL,  `hasbepoint` tinyint(1) DEFAULT '0',  `hasdetails` tinyint(1) DEFAULT '0',  `color` varchar(6) NULL,  PRIMARY KEY (`ID`));");

--
-- Table structure for table `assignmentdetails`
--
$data->Query("DROP TABLE IF EXISTS `assignmentdetails`;CREATE TABLE `assignmentdetails` (	`assignmentID` int(11) NOT NULL,	`details` text);");

--
-- Table structure for table `bepoints`
--
$data->Query("DROP TABLE IF EXISTS `bepoints`;CREATE TABLE `bepoints` (  `PersonId` int(11) NOT NULL,  `assignmentTypeId` int(11) NOT NULL,  `pointNumber` int(3) NOT NULL,  `completeDate` int(11) NOT NULL,  `notes` text);");

--
-- Table structure for table `meeting`
--
$data->Query("DROP TABLE IF EXISTS `meeting`;CREATE TABLE `meeting` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `meetingTypeId` int(11) NOT NULL,  `weekNumber` int(11) NOT NULL,  `year` int(11) NOT NULL,  PRIMARY KEY (`ID`));");

--
-- Table structure for table `meetingtype`
--
$data->Query("DROP TABLE IF EXISTS `meetingtype`;CREATE TABLE `meetingtype` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) NOT NULL,  `offset` int(1) DEFAULT NULL,  PRIMARY KEY (`ID`));");

--
-- Table structure for table `meetingtypeassignmenttype`
--
$data->Query("DROP TABLE IF EXISTS `meetingtypeassignmenttype`;CREATE TABLE `meetingtypeassignmenttype` (  `meetingtypeID` int(11) NOT NULL,  `assignmenttypeID` int(11) NOT NULL,  PRIMARY KEY (`meetingtypeID`,`assignmenttypeID`));");

--
-- Table structure for table `person`
--
$data->Query("DROP TABLE IF EXISTS `person`;CREATE TABLE `person` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `Name` varchar(100) NOT NULL,  `Active` tinyint(1) NOT NULL DEFAULT '1',  PRIMARY KEY (`ID`));");

--
-- Dumping data for table `person`
--
$data->Query("INSERT INTO `person`(`Name`, `Active`) VALUES ('Philip Wrinkle',1),('Robert Snyder',1),('Kat Snyder',1),('Megan Wrinkle',1);");

--
-- Table structure for table `personassignmenttype`
--
$data->Query("DROP TABLE IF EXISTS `personassignmenttype`;CREATE TABLE `personassignmenttype` (  `personID` int(11) NOT NULL,  `assignmenttypeID` int(11) NOT NULL,  PRIMARY KEY (`personID`,`assignmenttypeID`));");

--
-- Table structure for table `user`
--
$data->Query("DROP TABLE IF EXISTS `user`;CREATE TABLE `user` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `UserName` varchar(100) NOT NULL,  `Password` varchar(50) NOT NULL,  `PersonID` int(11) NOT NULL,  PRIMARY KEY (`ID`));");

--
-- Dumping data for table `user`
--
$data->Query("INSERT INTO `user`(`UserName`,`Password`,`PersonID`) VALUES ('pwrinkle','10c570237c83273ceef5e0b355f59777',1),('rsnyder','10c570237c83273ceef5e0b355f59777',2);");