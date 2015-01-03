<?php
class meeting {
    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $meetingTypeId;   // (normal Attribute)
    var $weekNumber;   // (normal Attribute)
    var $year;   // (normal Attribute)
    var $database; // Instance of class database

    function meeting() {
        $this->database = new Database();
    }
	
    function getID() {
        return $this->ID;
    }

    function getmeetingTypeId() {
        return $this->meetingTypeId;
    }

    function getweekNumber() {
        return $this->weekNumber;
    }

    function getyear() {
        return $this->year;
    }

    function setID($val) {
        $this->ID = $val;
    }

    function setmeetingTypeId($val) {
        $this->meetingTypeId = $val;
    }

    function setweekNumber($val) {
        $this->weekNumber = $val;
    }

    function setyear($val) {
        $this->year = $val;
    }

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {
        $sql = "SELECT * FROM meeting WHERE ID = $id;";
        $this->database->query($sql);        $row = $this->database->getResultObject();
        $this->ID = $row->ID;
        $this->meetingTypeId = $row->meetingTypeId;
        $this->weekNumber = $row->weekNumber;
        $this->year = $row->year;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM meeting WHERE ID = $id;";
        $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement

        $sql = "INSERT INTO meeting ( meetingTypeId,weekNumber,year ) VALUES ( '$this->meetingTypeId','$this->weekNumber','$this->year' )";
        $this->database->query($sql);
        $this->ID = $this->database->getInsertedId();
        
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = "UPDATE meeting SET  meetingTypeId = '$this->meetingTypeId',weekNumber = '$this->weekNumber',year = '$this->year' WHERE ID = $id ";
        $this->database->query($sql);
    }

}
?>
