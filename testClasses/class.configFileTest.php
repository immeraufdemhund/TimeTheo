<?php
class configFileTest extends configFile{
	function testCanLoadXMLFile(){
		$this->Load("config/config.xml");
	}
	function testCanRejectBadPath(){
		$wasExThrown = false;
		try{
			$this->Load("badlocation/config.xml");
		}catch(exception $e){
			$wasExThrown = true;
		}
		if(!$wasExThrown){
			throw new exception("The provided path is invalid but was accepted anyway.");
		}
	}
	function testDidLoadValues(){
		$this->Load("config/config.xml");
        $this->assertPropertyIsInitialized($this->doc, "Document");
        $this->assertPropertyIsInitialized($this->host, "Host Name");
		$this->assertPropertyIsInitialized($this->db, "Database Property");
        $this->assertPropertyIsInitialized($this->user, "Username");
        $this->assertPropertyIsInitialized($this->pass, "Password");
        $this->assertPropertyIsInitialized($this->theme, "Theme");
            
	}
    
    function assertPropertyIsInitialized($property, $propertyName){
        if($property === false){
            throw new exception("$propertyName property was not initialized on Load");
        }
    }
}
?>