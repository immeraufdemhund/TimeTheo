<?php

class configFileTest {
    var $goodConfigUri = "config/config.xml";
    
    function testCanLoadXMLFile() {
        $cf = new configFile();
        $cf->Load($this->goodConfigUri);
    }

    function testCanRejectBadPath() {
        $wasExThrown = false;
        try {
            $cf = new configFile();
            $cf->Load("asdf/config.xml");
        } catch (exception $e) {
            $wasExThrown = true;
        }
        if (!$wasExThrown) {
            throw new exception("The provided path is invalid but was accepted anyway.");
        }
    }

    function testDidLoadValues() {
        $cf = new configFile();
        $cf->Load($this->goodConfigUri);
        $this->assertPropertyIsInitialized($cf->doc, "Document");
        $this->assertPropertyIsInitialized($cf->host, "Host Name");
        $this->assertPropertyIsInitialized($cf->db, "Database Property");
        $this->assertPropertyIsInitialized($cf->user, "Username");
        $this->assertPropertyIsInitialized($cf->pass, "Password");
        $this->assertPropertyIsInitialized($cf->theme, "Theme");
    }

    function assertPropertyIsInitialized($property, $propertyName) {
        if ($property === false) {
            throw new exception("$propertyName property was not initialized on Load");
        }
    }
    
    function testCanSaveConfigFile(){
        $original = $this->getGoodConfigFile();
        
        $cf = $this->getGoodConfigFile();
        $cf->setDatabase("NewDatabaseName");
        $cf->setHost("NewHost");
        $cf->setPassword("NewPassword");
        $cf->setTheme("NewTheme");
        $cf->setUser("NewUser");
        $cf->Save($this->goodConfigUri);
        
        $cf2 = $this->getGoodConfigFile();
        
        $original->Save($this->goodConfigUri);
        
        $exception = "";
        
        if($cf2->getDatabaseName() !== "NewDatabaseName"){
            $exception = "-DatabaseName in config file did not update-";
        }
        if($cf2->getUser() !== "NewUser"){
            $exception = "-User in config file did not update-";
        }
        if($cf2->getPassword() !== "NewPassword"){
            $exception = "-Password in config file did not update-";
        }
        if($cf2->getHost() !== "NewHost"){
            $exception = "-Host in config file did not update-";
        }
        if($cf2->getTheme() !== "NewTheme"){
            $exception = "-Theme in config file did not update-";
        }
        
        if(strlen($exception) > 0){
            throw new exception($exception);
        }
    }
    
    function getGoodConfigFile(){
        $cf = new configFile();
        $cf->Load($this->goodConfigUri);
        
        return $cf;
    }
}

?>