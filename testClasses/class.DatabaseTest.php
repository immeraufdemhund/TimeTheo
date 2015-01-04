<?php

class DatabaseTest {

    function testQuery() {
        $db = new Database();
        $db->Query("SELECT 1 as 'test';");
        $row = mysql_fetch_object($this->result);
        if ($row->test != 1) {
            throw new exception("The expected value was 1, but found" . $row->test);
        }
    }

    function testThisShouldFail() {
        $this->Query("SELECT 2 as 'test';");
        $row = mysql_fetch_object($this->result);
        if ($row->test != 1) {
            throw new exception("This test was supposed to fail");
        }
    }

}

?>