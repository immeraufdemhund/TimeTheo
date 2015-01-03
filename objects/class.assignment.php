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
        $success = $this->database->query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);

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
        $result = $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement

        $sql = "INSERT INTO assignment ( meetingID,personId,assignmentTypeId ) VALUES ( '$this->meetingID','$this->personId','$this->assignmentTypeId' )";
        $result = $this->database->query($sql);
        $this->ID = mysql_insert_id($this->database->link);
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE assignment SET  meetingID = '$this->meetingID',personId = '$this->personId', assignmentTypeId = '$this->assignmentTypeId' WHERE ID = $id ";
        $result = $this->database->query($sql);
    }
}
?>
