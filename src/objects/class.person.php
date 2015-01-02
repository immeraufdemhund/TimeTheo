<?php
include_once("\conn\class.database.php");
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
        $success = $this->database->query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);

        $this->ID = $row->ID;
        $this->Name = $row->Name;
        $this->Active = $row->Active;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM person WHERE ID = $id;";
        return $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement
        $sql = "INSERT INTO person ( Name,Active ) VALUES ( '$this->Name','$this->Active' )";
        $result = $this->database->query($sql);
        $this->ID = mysql_insert_id($this->database->link);
        return $result;
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE person SET  Name = '$this->Name',Active = '$this->Active' WHERE ID = $id ";
        return $this->database->query($sql);
    }

}

?>