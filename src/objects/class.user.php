<?php
include_once("\conn\class.database.php");
class user {
    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $UserName;   // (normal Attribute)
    var $Password;   // (normal Attribute)
    var $PersonID;   // (normal Attribute)
    var $database; // Instance of class database

    function user() {
        $this->database = new Database();
    }

    function getID() {
        return $this->ID;
    }
    function getUserName() {
        return $this->UserName;
    }
    function getPassword() {
        return $this->Password;
    }
    function getPersonID() {
        return $this->PersonID;
    }
    function setID($val) {
        $this->ID = $val;
    }
    function setUserName($val) {
        $this->UserName = $val;
    }
    function setPassword($val) {
        $this->Password = saltAndMD5Text($val);
    }
    function setPersonID($val) {
        $this->PersonID = $val;
    }

// **********************
// SELECT METHOD / LOAD
// **********************
    function select($id) {

        $sql = "SELECT * FROM user WHERE ID = $id;";
        $success = $this->database->query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);
        
        $this->ID = $row->ID;
        $this->UserName = $row->UserName;
        $this->Password = $row->Password;
        $this->PersonID = $row->PersonID;
    }

// **********************
// DELETE
// **********************
    function delete($id) {
        $sql = "DELETE FROM user WHERE ID = $id;";
        return $this->database->query($sql);
    }

// **********************
// INSERT
// **********************
    function insert() {
        $this->ID = ""; // clear key for autoincrement
        $sql = "INSERT INTO user ( UserName,Password,PersonID ) VALUES ( '$this->UserName','$this->Password','$this->PersonID' )";
        $result = $this->database->query($sql);
        $this->ID = mysql_insert_id($this->database->link);
        return $result;
    }

// **********************
// UPDATE
// **********************
    function update($id) {
        $sql = " UPDATE user SET  UserName = '$this->UserName',Password = '$this->Password',PersonID = '$this->PersonID' WHERE ID = $id ";
        return $this->database->query($sql);
    }
    
    function saltAndMD5Text($input) {
        $salt1 = "ngfi4902f";
        $salt2 = "n498fvn65";
        return md5($salt1 . $input . $salt2);
    }
}
?>