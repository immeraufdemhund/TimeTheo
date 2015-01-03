<?php

class configFileTest {

    function testCanLoadXMLFile() {
        $cf = new configFile();
        $cf->Load("config/config.xml");
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
        $cf->Load("config/config.xml");
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

}

?>