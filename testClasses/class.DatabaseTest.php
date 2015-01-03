<?php

class DatabaseTest {
    var $db;
    
    function testQuery() {
        $db = new Database();
        $db->Query("SELECT 1 as 'test';");
        $result = $db->getResultObject();
        if ($result->test != 1) {
            throw new exception("The expected value was 1, but found" . $result->test);
        }
    }

    function testThisShouldFail() {
        $db = new Database();
        $db->Query("SELECT 2 as 'test';");
        $result = $db->getResultObject();
        if ($result->test != 1) {
            throw new exception("This test was supposed to fail");
        }
    }

}

?>