<?php

class configFile {

    var $doc;
    var $host;
    var $db;
    var $user;
    var $pass;
    var $theme;

    function configFile() {
        $this->doc = false;
        $this->host = false;
        $this->db = false;
        $this->user = false;
        $this->pass = false;
        $this->theme = false;
    }

    function getHost() {
        return $this->host;
    }

    function getDatabaseName() {
        return $this->db;
    }

    function getUser() {
        return $this->user;
    }

    function getPassword() {
        return $this->pass;
    }

    function getTheme() {
        return $this->theme;
    }

    function setHost($host) {
        $this->host = $host;
    }

    function setDatabase($db) {
        $this->db = $db;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPassword($pass) {
        $this->pass = $pass;
    }

    function setTheme($theme) {
        $this->theme = $theme;
    }

    function Load($uri) {
        if (!file_exists($uri)) {
            throw new exception("Config file not found at provided address: $uri");
        }
        $this->doc = new DOMDocument();
        $this->doc->load($uri);
        $this->host = $this->doc->getElementsByTagName("dbHost")->item(0)->nodeValue;
        $this->user = $this->doc->getElementsByTagName("dbUser")->item(0)->nodeValue;
        $this->pass = $this->doc->getElementsByTagName("dbPass")->item(0)->nodeValue;
        $this->db = $this->doc->getElementsByTagName("dbName")->item(0)->nodeValue;
        $this->theme = $this->doc->getElementsByTagName("theme")->item(0)->nodeValue;
    }

    function Save($uri) {
        $this->doc->getElementsByTagName("dbUser")->item(0)->nodeValue = $this->user;
        $this->doc->getElementsByTagName("dbHost")->item(0)->nodeValue = $this->host;
        $this->doc->getElementsByTagName("dbPass")->item(0)->nodeValue = $this->pass;
        $this->doc->getElementsByTagName("dbName")->item(0)->nodeValue = $this->db;
        $this->doc->getElementsByTagName("dbName")->item(0)->nodeValue = $this->db;
        $this->doc->getElementsByTagName("theme")->item(0)->nodeValue = $this->theme;
        $this->doc->save($uri);
    }

}

?>