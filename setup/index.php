<?php
//setup index file
$configFileUri = "../config/config.xml";
$testconfigFileUri = "../tests/config/config.xml";
include_once("../autoload.php");

if (isset($_REQUEST['setupSubmit']) && $_REQUEST['setupSubmit']) {
    $host = $_POST['host'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    $database = $_POST['database'];
    $testhost = $_POST['testhost'];
    $testpassword = $_POST['testpassword'];
    $testuser = $_POST['testuser'];
    $testdatabase = $_POST['testdatabase'];
    ?>
    <h2>You Submitted:</h2>
    <p>Host: <?php echo($host); ?></p>
    <p>User: <?php echo($user); ?></p>
    <p>Password: <?php echo($password); ?></p>
    <p>Database: <?php echo($database); ?></p>
    <p>Test Host: <?php echo($testhost); ?></p>
    <p>Test User: <?php echo($testuser); ?></p>
    <p>Test Password: <?php echo($testpassword); ?></p>
    <p>Test Database: <?php echo($testdatabase); ?></p>

    <?php
} else {
    $mconfigFile = new configFile();
    $mconfigFile->Load($configFileUri);
    $testconfigFile = new configFile();
    $testconfigFile->Load($testconfigFileUri);
    
    Template::load($mconfigFile);
    Template::load($testconfigFile);
?>
    <script>
        function copyFormFeilds() {
            getInputElement("testhost").value = getInputElement("host").value;
            getInputElement("testdatabase").value = getInputElement("database").value;
            getInputElement("testuser").value = getInputElement("user").value;
            getInputElement("testpassword").value = getInputElement("password").value;
            preventDefault();
        }
        function getInputElement(inputName) {
            return document.getElementById(inputName);
        }
    </script>
    <?php
}
?>