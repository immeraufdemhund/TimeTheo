<?php
//setup index file
$configFileUri = "../config/config.xml";
$testconfigFileUri = "../tests/config/config.xml";
include_once("../autoload.php");

if(isset($_REQUEST['setupSubmit']) && $_REQUEST['setupSubmit']){
    $host = $_POST['host'];
    $password = $_POST['password'];
    $user = $_POST['user'];
    $database = $_POST['database'];
    $testhost =  $_POST['testhost'];
    $testpassword = $_POST['testpassword'];
    $testuser =  $_POST['testuser'];
    $testdatabase =  $_POST['testdatabase'];
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
}else{
    $mconfigFile = new configFile();
    $mconfigFile->Load($configFileUri);
    $host = $mconfigFile->gethost();
    $password = $mconfigFile->getpass();
    $user = $mconfigFile->getuser();
    $database = $mconfigFile->getdb();
    $testconfigFile = new configFile();
    $testconfigFile->Load($testconfigFileUri);
    $testhost = $testconfigFile->gethost();
    $testpassword = $testconfigFile->getpass();
    $testuser = $testconfigFile->getuser();
    $testdatabase = $testconfigFile->getdb();
	?>
	<form action="?setupSubmit=true" method="post">
		<h2>Enter Database connection information</h2>
        <div>Host: <input type="text" size="100" name="host" id="host" value="<?php echo($host); ?>" /></div>
        <div>Database Name: <input type="text" size="100" name="database" id="database" value="<?php echo($database); ?>" /></div>
        <div>Username: <input type="text" size="100" name="user" id="user" value="<?php echo($user); ?>" /></div>
        <div>Password: <input type="text" size="100" name="password" id="password" value="<?php echo($password); ?>" /></div>
        <h2>Testing Database Information, Enter a different database for running automated tests, enter same credentials if not using test features.</h2>
        <input type="button" onclick="copyFormFeilds()" value="Copy Main Database Info to Test" />
        <div>Test Host: <input type="text" size="100" name="testhost" id="testhost" value="<?php echo($testhost); ?>" /></div>
        <div>Test Database Name: <input type="text" size="100" name="testdatabase" id="testdatabase" value="<?php echo($testdatabase); ?>" /></div>
        <div>Test Username: <input type="text" size="100" name="testuser" id="testuser" value="<?php echo($testuser); ?>" /></div>
        <div>Test Password: <input type="text" size="100" name="testpassword" id="testpassword" value="<?php echo($testpassword); ?>" /></div>
        <input type="submit" />
	</form>
    <script>
        function copyFormFeilds(){
            getInputElement("testhost").value = getInputElement("host").value;
            getInputElement("testdatabase").value = getInputElement("database").value;
            getInputElement("testuser").value = getInputElement("user").value;
            getInputElement("testpassword").value = getInputElement("password").value;
            preventDefault();
        }
        function getInputElement(inputName){
            return document.getElementById(inputName);
        }
    </script>
	<?php
}
?>