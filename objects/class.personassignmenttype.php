<?php
class personassignmenttype{
    private $personID;
    private $assignmentTypeID;
    private $database;
    private $person;
    private $assignmentType;
    
    public function meetingtypeassignmenttype(){
        $this->database = new Database();
        $this->person = new person();
        $this->assignmentType = new assignmentType();
    }
    
    function getPersonID() {
        return $this->personID;
    }
    function getAssignmentTypeID() {
        return $this->assignmentTypeID;
    }
    function setPersonID($personID) {
        $this->personID = $personID;
    }
    function setAssignmentTypeID($assignmentTypeID) {
        $this->assignmentTypeID = $assignmentTypeID;
    }
    function getPerson() {
        return $this->person;
    }
    function getAssignmentType() {
        return $this->assignmentType;
    }
    function setPerson($person) {
        $this->person = $person;
    }
    function setAssignmentType($assignmentType) {
        $this->assignmentType = $assignmentType;
    }
        
    function select($pID, $atID){
        $sql = "SELECT * FROM personassignmenttype WHERE personID = $pID AND assignmenttypeID = $atID LIMIT 1;";
        $this->database->Query($sql);
        if($this->database->rows > 0){
            $this->personID = $pID;
            $this->assignmentTypeID = $atID;
            $this->person->select($pID);
            $this->assignmentType->select($atID);
            return true;
        }else{
            return false;
        }
    }
    
    function delete(){
        $sql = "DELETE FROM personassignmenttype WHERE personID = $this->personID AND assignmenttypeID = $this->assignmentTypeID;";
        $this->database->Query($sql);
    }
    
    function insert(){
        if($this->person->select($this->personID) && $this->assignmentType->select($this->assignmentTypeID)){
            $sql = "INSERT INTO personassignmenttype(personID,assignmenttypeID) VALUES($this->personID,$this->assignmentTypeID);";
            $this->database->Query($sql);
            return true;
        }
        return false;
    }
    
    
    
    

    
    
}