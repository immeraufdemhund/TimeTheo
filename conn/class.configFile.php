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
    
    function getHost(){
        return $this->host;
    }
    function getDatabaseName(){
        return $this->db;
    }
    function getUser(){
        return $this->user;
    }
    function getPassword(){
        return $this->pass;
    }
    function getTheme(){
        return $this->theme;
    }

    function Load($uri) {
        if (!file_exists($uri)) {
            throw new exception("Config file not found at provided address: $uri");
        }
        $this->doc = new DOMDocument();
        $this->doc->load($uri);
        $rootElement = $this->getFirstElement($this->doc, "xml");
        $this->host = $this->getFirstElement($rootElement,"dbHost")->nodeValue;
        $this->user = $this->getFirstElement($rootElement,"dbUser")->nodeValue;
        $this->pass = $this->getFirstElement($rootElement,"dbPass")->nodeValue;
        $this->db = $this->getFirstElement($rootElement,"dbName")->nodeValue;
        $this->theme = $this->getFirstElement($rootElement,"theme")->nodeValue;
    }
    
    public static function getFirstElement($node, $elementName){
        $element = $node->getElementsByTagName($elementName);
        return $element->item(0);
    }
}

?>