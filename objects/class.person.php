<?php
class person {

    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $Name;   // (normal Attribute)
    var $Active;   // (normal Attribute)
    var $database; // Instance of class database

    function person() {
        $this->database = new Database();
    }
	
    function getID() {
        return $this->ID;
    }

    function getName() {
        return $this->Name;
    }

    function getActive() {
        return $this->Active;
    }

    function setID($val) {
        $this->ID = $val;
    }

    function setName($val) {
        $this->Name = $val;
    }

    function setActive($val) {
        $this->Active = $val;
    }

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {
        $sql = "SELECT * FROM person WHERE ID = $id;";
        $this->database->query($sql);
        $row = $this->database->getResultObject();
        $this->ID = $row->ID;
        $this->Name = $row->Name;
        $this->Active = $row->Active;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM person WHERE ID = $id;";
        $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement
        $sql = "INSERT INTO person ( Name,Active ) VALUES ( '$this->Name','$this->Active' )";
        $this->database->query($sql);
        $this->ID = $this->database->getInsertedId();
        
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE person SET  Name = '$this->Name',Active = '$this->Active' WHERE ID = $id ";
        $this->database->query($sql);
    }
	
	public function __toString(){
		return sprintf("Person[%d]:'%s' (Active:%s)", $this->ID, $this->Name, $this->Active);
	}
}

?>