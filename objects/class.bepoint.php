<?php

class bepoint {

    private $ID;
    private $PersonID;
    private $assignmentTypeId;
    private $pointNumber;
    private $completeDate;
    private $notes;
    private $database;
    private $person;
    private $assignmentType;

    public function bepoint() {
        $this->database = new Database();
        $this->person = new person();
        $this->assignmentType = new assignmentType();
    }
    
    function getID() {
        return $this->ID;
    }
    function getPersonID() {
        return $this->PersonID;
    }
    function getAssignmentTypeId() {
        return $this->assignmentTypeId;
    }
    function getPointNumber() {
        return $this->pointNumber;
    }
    function getNotes() {
        return $this->notes;
    }
    function getDatabase() {
        return $this->database;
    }
    function getPerson() {
        return $this->person;
    }
    function getAssignmentType() {
        return $this->assignmentType;
    }
    function setID($ID) {
        $this->ID = $ID;
    }
    function setPersonID($PersonID) {
        $this->PersonID = $PersonID;
    }
    function setAssignmentTypeId($assignmentTypeId) {
        $this->assignmentTypeId = $assignmentTypeId;
    }
    function setPointNumber($pointNumber) {
        $this->pointNumber = $pointNumber;
    }
    function setNotes($notes) {
        $this->notes = str_replace("'", "&#39;", $notes);
    }
    function setDatabase($database) {
        $this->database = $database;
    }
    function setPerson($person) {
        $this->person = $person;
    }
    function setAssignmentType($assignmentType) {
        $this->assignmentType = $assignmentType;
    }
    function getCompleteDate() {
        return $this->completeDate;
    }
    function setCompleteDate($completeDate) {
        $this->completeDate = $completeDate;
    }
    
    function select($ID){
        $sql = "SELECT * FROM bepoints WHERE ID = $ID;";
        $this->database->Query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);
        
        $this->ID = $row->ID;
        $this->personID = $row->personId;
        $this->assignmentTypeId = $row->assignmentTypeId;
        $this->pointNumber = $row->pointNumber;
        $this->completeDate = $row->completeDate;
        $this->notes = $row->notes;
        
        $this->person->select($this->PersonID);
        $this->assignmentType->select($this->assignmentTypeId);
        
        if ($this->database->rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function delete($id) {
        $sql = "DELETE FROM bepoints WHERE ID = $id;";
        $result = $this->database->query($sql);
    }
    
    function insert() {
        $this->ID = ""; // clear key for autoincrement
        $sql = "INSERT INTO bepoints ( personId,assignmentTypeId,pointNumber,completeDate,notes ) VALUES ( '$this->personId','$this->assignmentTypeId','$this->pointNumber','$this->completeDate','$this->notes' )";
        $result = $this->database->query($sql);
        $this->ID = mysql_insert_id($this->database->link);
    }

}

?>