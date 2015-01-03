<?php
class assignmentDetails {

    var $assignmentID;   // (normal Attribute)
    var $details;   // (normal Attribute)
    var $database; // Instance of class database

    function assignmentDetails() {
        $this->database = new Database();
    }

    function getID() {
        return $this->ID;
    }
    function setID($val) {
        $this->ID = $val;
    }
    function getdetails() {
        return $this->details;
    }
    function setdetails($val) {
        $this->details = $val;
    }
    

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($assignmentID) {
        $sql = "SELECT * FROM assignmentdetails WHERE assignmentID = $assignmentID;";
        $success = $this->database->query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);

        $this->assignmentID = $row->assignmentID;
        $this->details = $row->details;
    }

// **********************
// DELETE
// **********************
    function delete($assignmentID) {
        $sql = "DELETE FROM assignmentdetails WHERE assignmentID = $assignmentID;";
        $result = $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $sql = "INSERT INTO assignmentdetails ( assignmentID,details ) VALUES ( '$this->assignmentID','$this->details' )";
        $result = $this->database->query($sql);
        $this->ID = mysql_insert_id($this->database->link);
    }

// **********************
// UPDATE
// **********************
    function update($assignmentID) {
        $sql = " UPDATE assignmentdetails SET  assignmentID = '$this->assignmentID',details = '$this->details' WHERE assignmentID = $assignmentID ";
        $result = $this->database->query($sql);
    }
}
?>
