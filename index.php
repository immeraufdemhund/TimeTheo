<?php
include_once("autoload.php");

$administrator = new user();
$administrator->setUserName("pwrinkle");
$administrator->setPassword("changeme");
$valid = $administrator->tryLogin();

if($valid === false){
	//login failed
	print("Login failed for username ".$administrator->getUserName());
	die();
}
print("Logged in!");

$administrator->select($valid);

$loggedInUser = new person();

$loggedInUser->select($administrator->getPersonID());

print("Welcome ".$loggedInUser->getName()."!");


?>