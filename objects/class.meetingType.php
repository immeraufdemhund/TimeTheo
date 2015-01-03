<?php
class meetingType {

    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $name;   // (normal Attribute)
    var $offset;   // (normal Attribute)
    var $database; // Instance of class database

    function meetingType() {
        $this->database = new Database();
    }
	
    function getID() {
        return $this->ID;
    }

    function getname() {
        return $this->name;
    }

    function getoffset() {
        return $this->offset;
    }

    function setID($val) {
        $this->ID = $val;
    }

    function setname($val) {
        $this->name = $val;
    }

    function setoffset($val) {
        $this->offset = $val;
    }

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {

        $sql = "SELECT * FROM meetingtype WHERE ID = $id;";
        $this->database->query($sql);        $row = $this->database->getResultObject();
        $this->ID = $row->ID;
        $this->name = $row->name;
        $this->offset = $row->offset;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM meetingtype WHERE ID = $id;";
        $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement
        $sql = "INSERT INTO meetingtype ( name,offset ) VALUES ( '$this->name','$this->offset' )";
        $this->database->query($sql);
        $this->ID = $this->database->getInsertedId();
        
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE meetingtype SET  name = '$this->name',offset = '$this->offset' WHERE ID = $id ";
        $this->database->query($sql);
    }

}

?>
