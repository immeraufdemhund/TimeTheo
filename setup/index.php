<?php
//setup index file
$configFileUri = "../config/config.xml";
$testconfigFileUri = "../tests/config/config.xml";
include_once("../autoload.php");

if (isset($_REQUEST['setupSubmit']) && $_REQUEST['setupSubmit']) {
    $mconfigFile = new configFile();
    $mconfigFile->Load($configFileUri);
    $testconfigFile = new configFile();
    $testconfigFile->Load($testconfigFileUri);
    $testconfigFile->setBeta("Beta");
    $mconfigFile->setHost(filter_input(INPUT_POST, 'host'));
    $mconfigFile->setPassword(filter_input(INPUT_POST, 'password'));
    $mconfigFile->setUser(filter_input(INPUT_POST, 'user'));
    $mconfigFile->setDatabase(filter_input(INPUT_POST, 'database'));
    $mconfigFile->setTheme(filter_input(INPUT_POST, 'theme'));
    $mconfigFile->Save($configFileUri);
    $mconfigFile->setDisabled(true);
    $testconfigFile->setHost(filter_input(INPUT_POST, 'Betahost'));
    $testconfigFile->setPassword(filter_input(INPUT_POST, 'Betapassword'));
    $testconfigFile->setUser(filter_input(INPUT_POST, 'Betauser'));
    $testconfigFile->setDatabase(filter_input(INPUT_POST, 'Betadatabase'));
    $testconfigFile->setTheme(filter_input(INPUT_POST, 'Betatheme'));
    $testconfigFile->Save($testconfigFileUri);
    $testconfigFile->setDisabled(true);
    ?>
    <h2>You Submitted:</h2>
    <?php
    Template::load($mconfigFile, $mconfigFile);
    ?>
    <h3>Beta:</h3>
    <?php
    Template::load($testconfigFile, $testconfigFile);
    ?>
    <a href="/setup/?setupDatabase=true"><div style="display: inline-block; width: 100px; height: 20px; border-radius: 5px; border: black thin solid; background-color:yellow; margin:5px; padding:5px;"><strong>Continue</strong></div></a>
    <?php
} elseif (isset($_REQUEST['setupDatabase']) && $_REQUEST['setupDatabase']) {
    ?>
    <h2>Starting Database Setup</h2>
    <h3>Loading Config Files... <?php
        $mconfigFile = new configFile();
        $mconfigFile->Load($configFileUri);
        $testconfigFile = new configFile();
        $testconfigFile->Load($testconfigFileUri);
        $testconfigFile->setBeta("Beta");
        ?><strong style="color:green">Done!</strong></h3>
    <h3>Starting database import on <?php echo($mconfigFile->getDatabaseName()); ?>... <?php
        $data = new Database();
        $data->setConfig($mconfigFile);
        $data->Query("DROP TABLE IF EXISTS `assignment`;");
        $data->Query("Create TABLE `assignment` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `meetingID` int(11) NOT NULL,  `personId` int(11) NOT NULL,  `assignmentTypeId` int(11) NOT NULL,  PRIMARY KEY (`ID`));");
        $data->Query("DROP TABLE IF EXISTS `assignmenttype`;");
        $data->Query("Create TABLE `assignmenttype` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) NOT NULL,  `hasbepoint` tinyint(1) DEFAULT '0',  `hasdetails` tinyint(1) DEFAULT '0',  `color` varchar(6) NULL,  PRIMARY KEY (`ID`));");
        $data->Query("DROP TABLE IF EXISTS `assignmentdetails`;");
        $data->Query("Create TABLE `assignmentdetails` (	`assignmentID` int(11) NOT NULL,	`details` text);");
        $data->Query("DROP TABLE IF EXISTS `bepoints`;");
        $data->Query("Create TABLE `bepoints` (  `PersonId` int(11) NOT NULL,  `assignmentTypeId` int(11) NOT NULL,  `pointNumber` int(3) NOT NULL,  `completeDate` int(11) NOT NULL,  `notes` text);");
        $data->Query("DROP TABLE IF EXISTS `meeting`;");
        $data->Query("Create TABLE `meeting` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `meetingTypeId` int(11) NOT NULL,  `weekNumber` int(11) NOT NULL,  `year` int(11) NOT NULL,  PRIMARY KEY (`ID`));");
        $data->Query("DROP TABLE IF EXISTS `meetingtype`;");
        $data->Query("Create TABLE `meetingtype` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) NOT NULL,  `offset` int(1) DEFAULT NULL,  PRIMARY KEY (`ID`));");
        $data->Query("DROP TABLE IF EXISTS `meetingtypeassignmenttype`;");
        $data->Query("Create TABLE `meetingtypeassignmenttype` (  `meetingtypeID` int(11) NOT NULL,  `assignmenttypeID` int(11) NOT NULL,  PRIMARY KEY (`meetingtypeID`,`assignmenttypeID`));");
        $data->Query("DROP TABLE IF EXISTS `person`;");
        $data->Query("Create TABLE `person` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `Name` varchar(100) NOT NULL,  `Active` tinyint(1) NOT NULL DEFAULT '1',  PRIMARY KEY (`ID`));");
        $data->Query("INSERT INTO `person`(`Name`, `Active`) VALUES ('Philip Wrinkle',1),('Robert Snyder',1);");
        $data->Query("DROP TABLE IF EXISTS `personassignmenttype`;");
        $data->Query("Create TABLE `personassignmenttype` (  `personID` int(11) NOT NULL,  `assignmenttypeID` int(11) NOT NULL,  PRIMARY KEY (`personID`,`assignmenttypeID`));");
        $data->Query("DROP TABLE IF EXISTS `user`;");
        $data->Query("Create TABLE `user` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `UserName` varchar(100) NOT NULL,  `Password` varchar(50) NOT NULL,  `PersonID` int(11) NOT NULL,  PRIMARY KEY (`ID`));");
        $data->Query("INSERT INTO `user`(`UserName`,`Password`,`PersonID`) VALUES ('pwrinkle','10c570237c83273ceef5e0b355f59777',1),('rsnyder','10c570237c83273ceef5e0b355f59777',2);");
        ?><strong style="color:green">Done!</strong></h3>
        <?php
        if ((string) $mconfigFile != (string) $testconfigFile) {
            ?><h3>Beta Database Configured, Importing data for running tests on <?php echo($testconfigFile->getDatabaseName()); ?>...<?php
                $data->setConfig($testconfigFile);
                $data->Query("DROP TABLE IF EXISTS `assignment`;");
                $data->Query("Create TABLE `assignment` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `meetingID` int(11) NOT NULL,  `personId` int(11) NOT NULL,  `assignmentTypeId` int(11) NOT NULL,  PRIMARY KEY (`ID`));");
                $data->Query("DROP TABLE IF EXISTS `assignmenttype`;");
                $data->Query("Create TABLE `assignmenttype` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) NOT NULL,  `hasbepoint` tinyint(1) DEFAULT '0',  `hasdetails` tinyint(1) DEFAULT '0',  `color` varchar(6) NULL,  PRIMARY KEY (`ID`));");
                $data->Query("DROP TABLE IF EXISTS `assignmentdetails`;");
                $data->Query("Create TABLE `assignmentdetails` (	`assignmentID` int(11) NOT NULL,	`details` text);");
                $data->Query("DROP TABLE IF EXISTS `bepoints`;");
                $data->Query("Create TABLE `bepoints` (  `PersonId` int(11) NOT NULL,  `assignmentTypeId` int(11) NOT NULL,  `pointNumber` int(3) NOT NULL,  `completeDate` int(11) NOT NULL,  `notes` text);");
                $data->Query("DROP TABLE IF EXISTS `meeting`;");
                $data->Query("Create TABLE `meeting` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `meetingTypeId` int(11) NOT NULL,  `weekNumber` int(11) NOT NULL,  `year` int(11) NOT NULL,  PRIMARY KEY (`ID`));");
                $data->Query("DROP TABLE IF EXISTS `meetingtype`;");
                $data->Query("Create TABLE `meetingtype` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `name` varchar(100) NOT NULL,  `offset` int(1) DEFAULT NULL,  PRIMARY KEY (`ID`));");
                $data->Query("DROP TABLE IF EXISTS `meetingtypeassignmenttype`;");
                $data->Query("Create TABLE `meetingtypeassignmenttype` (  `meetingtypeID` int(11) NOT NULL,  `assignmenttypeID` int(11) NOT NULL,  PRIMARY KEY (`meetingtypeID`,`assignmenttypeID`));");
                $data->Query("DROP TABLE IF EXISTS `person`;");
                $data->Query("Create TABLE `person` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `Name` varchar(100) NOT NULL,  `Active` tinyint(1) NOT NULL DEFAULT '1',  PRIMARY KEY (`ID`));");
                $data->Query("INSERT INTO `person`(`Name`, `Active`) VALUES ('Philip Wrinkle',1),('Robert Snyder',1);");
                $data->Query("DROP TABLE IF EXISTS `personassignmenttype`;");
                $data->Query("Create TABLE `personassignmenttype` (  `personID` int(11) NOT NULL,  `assignmenttypeID` int(11) NOT NULL,  PRIMARY KEY (`personID`,`assignmenttypeID`));");
                $data->Query("DROP TABLE IF EXISTS `user`;");
                $data->Query("Create TABLE `user` (  `ID` int(11) NOT NULL AUTO_INCREMENT,  `UserName` varchar(100) NOT NULL,  `Password` varchar(50) NOT NULL,  `PersonID` int(11) NOT NULL,  PRIMARY KEY (`ID`));");
                $data->Query("INSERT INTO `user`(`UserName`,`Password`,`PersonID`) VALUES ('pwrinkle','10c570237c83273ceef5e0b355f59777',1),('rsnyder','10c570237c83273ceef5e0b355f59777',2);");
                ?><strong style="color:green">Done!</strong></h3>
            <?php
        } else {
            ?><h3>No Beta Database selected, Skipping Beta Setup</h3><?php
        }
        ?>
    <a href="/tests"><div style="display: inline-block; width: 100px; height: 20px; border-radius: 5px; border: black thin solid; background-color:greenyellow; margin:5px; padding:5px;"><strong>Test Data</strong></div></a>
    <?php
} else {
    $mconfigFile = new configFile();
    $mconfigFile->Load($configFileUri);
    $testconfigFile = new configFile();
    $testconfigFile->Load($testconfigFileUri);
    $testconfigFile->setBeta("Beta");
    ?>
    <form action="?setupSubmit=true" method="post">
        <?php
        Template::load($mconfigFile, $mconfigFile);
        ?>
        <input type="button" onclick="copyFormFeilds()" value="Beta Same as Main" />    
        <?php
        Template::load($testconfigFile, $testconfigFile);
        ?>
        <input type="submit" />
    </form>
    <script>
        function copyFormFeilds() {
            getInputElement("Betahost").value = getInputElement("host").value;
            getInputElement("Betadatabase").value = getInputElement("database").value;
            getInputElement("Betauser").value = getInputElement("user").value;
            getInputElement("Betapassword").value = getInputElement("password").value;
            preventDefault();
        }
        function getInputElement(inputName) {
            return document.getElementById(inputName);
        }
    </script>
    <?php
}
?>
    