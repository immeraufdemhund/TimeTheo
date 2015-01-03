<?php
class assignmentType {

    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $name;   // (normal Attribute)
    var $hasbepoint;   // (normal Attribute)
	var $hasdetails;   // (normal Attribute)
	var $color;   // (normal Attribute)
    var $database; // Instance of class database
	

    function assignmentType() {
        $this->database = new Database();
    }

    function getID() {
        return $this->ID;
    }
    function getname() {
        return $this->name;
    }
    function gethasbepoint() {
        return $this->hasbepoint;
    }
	function gethasdetails(){
		return $this->hasdetails;
	}
	function getcolor(){
		return $this->color;
	}
    function setID($val) {
        $this->ID = $val;
    }
    function setname($val) {
        $this->name = $val;
    }
    function sethasbepoint($val) {
        $this->hasbepoint = $val;
    }
	function sethasdetails($var){
		$this->hasdetails = $var;
	}
	function setcolor($var){
		$this->color = $var;
	}

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {
        $sql = "SELECT * FROM assignmenttype WHERE ID = $id;";
        $this->database->query($sql);        $row = $this->database->getResultObject();
        $this->ID = $row->ID;
        $this->name = $row->name;
        $this->hasbepoint = $row->hasbepoint;
		$this->hasdetails = $row->hasdetails;
		$this->color = $row->color;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM assignmenttype WHERE ID = $id;";
        $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement

        $sql = "INSERT INTO assignmenttype ( name,hasbepoint,hasdetails,color ) VALUES ( '$this->name','$this->hasbepoint','$this->hasdetails','$this->color' )";
        $this->database->query($sql);
        $this->ID = $this->database->getInsertedId();
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE assignmenttype SET  name = '$this->name',hasbepoint = '$this->hasbepoint', hasdetails = '$this->hasdetails', color = '$this->color' WHERE ID = $id ";
        $this->database->query($sql);
    }
}
?>
