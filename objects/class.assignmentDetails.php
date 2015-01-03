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
        $this->database->query($sql);        $row = $this->database->getResultObject();
        $this->assignmentID = $row->assignmentID;
        $this->details = $row->details;
    }

// **********************
// DELETE
// **********************
    function delete($assignmentID) {
        $sql = "DELETE FROM assignmentdetails WHERE assignmentID = $assignmentID;";
        $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $sql = "INSERT INTO assignmentdetails ( assignmentID,details ) VALUES ( '$this->assignmentID','$this->details' )";
        $this->database->query($sql);
        $this->ID = $this->database->getInsertedId();
    }

// **********************
// UPDATE
// **********************
    function update($assignmentID) {
        $sql = " UPDATE assignmentdetails SET  assignmentID = '$this->assignmentID',details = '$this->details' WHERE assignmentID = $assignmentID ";
        $this->database->query($sql);
    }
}
?>
