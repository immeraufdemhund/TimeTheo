<?php
include_once("../autoload.php");
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
    return "";
}

function isPostVar($varName) {
    if (strlen(filter_input(INPUT_POST, $varName)) > 0) {
        return true;
    }
    return false;
}

function getPostVar($varName) {
    if (isPostVar($varName)) {
        return filter_input(INPUT_POST, $varName);
    }
    return "";
}

function isGetVar($varName) {
    if (strlen(filter_input(INPUT_GET, $varName)) > 0) {
        return true;
    }
    return false;
}

function getGetVar($varName) {
    if (isGetVar($varName)) {
        return filter_input(INPUT_GET, $varName);
    }
    return "";
}

//page flow logic

if(isGetVar('logout')){
    //logout logic
    session_destroy();
    header("Location: /");
    die();
}


if (isSessionVar('UserId')) {
    $user->select(getSessionVar('UserId'));
}else{
	header("Location: /");
}

$aList = new assignmentTypeList();
$aList->selectAll();
Template::load($config, $aList);