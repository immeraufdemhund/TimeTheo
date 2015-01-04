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

    function gethasdetails() {
        return $this->hasdetails;
    }

    function getcolor() {
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

    function sethasdetails($var) {
        $this->hasdetails = $var;
    }

    function setcolor($var) {
        $this->color = $var;
    }

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {
        $sql = "SELECT * FROM assignmenttype WHERE ID = $id;";
        $success = $this->database->query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);

        $this->ID = $row->ID;
        $this->name = $row->name;
        $this->hasbepoint = $row->hasbepoint;
        $this->hasdetails = $row->hasdetails;
        $this->color = $row->color;
        if ($this->database->rows > 0) {
            return true;
        } else {
            return false;
        }
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM assignmenttype WHERE ID = $id;";
        $result = $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement

        $sql = "INSERT INTO assignmenttype ( name,hasbepoint,hasdetails,color ) VALUES ( '$this->name','$this->hasbepoint','$this->hasdetails','$this->color' )";
        $result = $this->database->query($sql);
        $this->ID = mysql_insert_id($this->database->link);
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE assignmenttype SET  name = '$this->name',hasbepoint = '$this->hasbepoint', hasdetails = '$this->hasdetails', color = '$this->color' WHERE ID = $id ";
        $result = $this->database->query($sql);
    }

}

?>
