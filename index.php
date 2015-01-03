<?php
//main index file
include_once("autoload.php");
$configFileUri = "config/config.xml";
session_start();
$config = new configFile();
$config->Load($configFileUri);
$user = new user();

function isSessionVar($varName) {
    if (isset($_SESSION[$varName]) && $_SESSION[$varName]) {
        return true;
    }
    return false;
}

function getSessionVar($varName) {
    if (isSessionVar($varName)) {
        return $_SESSION[$varName];
    }
    return false;
}

//page flow logic

if(isSessionVar('Logout')){
    //logout logic
    session_destroy();
    header("Location: /");
    die();
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>TimeTheo Scheduler</title>
    </head>
    <body>
        <h1>Welcome <?php
            if (isSessionVar('UserId')) {
                $user->select(getSessionVar('UserId'));
                echo($user->getPerson()->getName() . ', ');
            }
            ?>to TimeTheo, the Assignment schedule manager!</h1>
        <?php
        if(!isSessionVar('UserId')){
            //user not logged in, create login page
            ?>
        <h2>Login</h2>
        <form action="/?login=true" method="post">
            <?php
            $login = new userLogin();
            if(strlen(filter_input(INPUT_POST, 'username')) > 0){
                $login->setPrevious(filter_input(INPUT_POST, 'username'));
            }
            Template::load($config, $login);
            ?>
            <input type="submit" value="Login!" />
        </form>
            <?php
        }else{
            //user is logged in, create home page
            ?>
        <h2>Home</h2>
        <a href="/?logout=true"><div style="display: inline-block; width: 100px; height: 20px; border-radius: 5px; border: black thin solid; background-color:blue; margin:5px; padding:5px;"><strong style="color:white;">Logout</strong></div></a>
    
            <?php
        }
        ?>
    </body>
</html>