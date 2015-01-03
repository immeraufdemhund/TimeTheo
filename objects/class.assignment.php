<?php
class assignment {

    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $meetingID;   // (normal Attribute)
    var $personId;   // (normal Attribute)
	var $assignmentTypeId;   // (normal Attribute)
    var $database; // Instance of class database
	

    function assignment() {
        $this->database = new Database();
    }

    function getID() {
        return $this->ID;
    }
    function getmeetingID() {
        return $this->meetingID;
    }
    function getpersonId() {
        return $this->personId;
    }
	function getassignmentTypeId(){
		return $this->assignmentTypeId;
	}
    function setID($val) {
        $this->ID = $val;
    }
    function setmeetingID($val) {
        $this->meetingID = $val;
    }
    function setpersonId($val) {
        $this->personId = $val;
    }
	function setassignmentTypeId($var){
		$this->assignmentTypeId = $var;
	}

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {
        $sql = "SELECT * FROM assignment WHERE ID = $id;";
        $this->database->query($sql);        $row = $this->database->getResultObject();
        $this->ID = $row->ID;
        $this->meetingID = $row->meetingID;
        $this->personId = $row->personId;
		$this->assignmentTypeId = $row->assignmentTypeId;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM assignment WHERE ID = $id;";
        $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement

        $sql = "INSERT INTO assignment ( meetingID,personId,assignmentTypeId ) VALUES ( '$this->meetingID','$this->personId','$this->assignmentTypeId' )";
        $this->database->query($sql);
        $this->ID = $this->database->getInsertedId();
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE assignment SET  meetingID = '$this->meetingID',personId = '$this->personId', assignmentTypeId = '$this->assignmentTypeId' WHERE ID = $id ";
        $this->database->query($sql);
    }
}
?>
