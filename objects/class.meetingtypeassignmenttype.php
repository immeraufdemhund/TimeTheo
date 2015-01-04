<?php
class meetingtypeassignmenttype{
    private $meetingTypeID;
    private $assignmentTypeID;
    private $database;
    private $meetingType;
    private $assignmentType;
    
    public function meetingtypeassignmenttype(){
        $this->database = new Database();
        $this->meetingType = new meetingType();
        $this->assignmentType = new assignmentType();
    }
    
    function getMeetingTypeID() {
        return $this->meetingTypeID;
    }
    function getAssignmentTypeID() {
        return $this->assignmentTypeID;
    }
    function setMeetingTypeID($meetingTypeID) {
        $this->meetingTypeID = $meetingTypeID;
    }
    function setAssignmentTypeID($assignmentTypeID) {
        $this->assignmentTypeID = $assignmentTypeID;
    }
    function getMeetingType() {
        return $this->meetingType;
    }
    function getAssignmentType() {
        return $this->assignmentType;
    }
    function setMeetingType($meetingType) {
        $this->meetingType = $meetingType;
    }
    function setAssignmentType($assignmentType) {
        $this->assignmentType = $assignmentType;
    }
        
    function select($mtID, $atID){
        $sql = "SELECT * FROM meetingtypeassignmenttype WHERE meetingtypeID = $mtID AND assignmenttypeID = $atID LIMIT 1;";
        $this->database->Query($sql);
        if($this->database->rows > 0){
            $this->meetingTypeID = $mtID;
            $this->assignmentTypeID = $atID;
            $this->meetingType->select($mtID);
            $this->assignmentType->select($atID);
            return true;
        }else{
            return false;
        }
    }
    
    function delete(){
        $sql = "DELETE FROM meetingtypeassignmenttype WHERE meetingtypeID = $this->meetingTypeID AND assignmenttypeID = $this->assignmentTypeID;";
        $this->database->Query($sql);
    }
    
    function insert(){
        if($this->meetingType->select($this->meetingTypeID) && $this->assignmentType->select($this->assignmentTypeID)){
            $sql = "INSERT INTO meetingtypeassignmenttype(meetingtypeID,assignmenttypeID) VALUES($this->meetingTypeID,$this->assignmentTypeID);";
            $this->database->Query($sql);
            return true;
        }
        return false;
    }
    
    
    
    

}