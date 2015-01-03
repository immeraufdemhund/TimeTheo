<?php

class user {

    var $ID;   // KEY ATTR. WITH AUTOINCREMENT
    var $UserName;   // (normal Attribute)
    var $Password;   // (normal Attribute)
    var $PersonID;   // (normal Attribute)
    var $Person;   // Associated Person
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

    function setUserName($val) {
        $this->UserName = $val;
    }

    function setPassword($val) {
        $this->Password = $this->saltAndMD5Text($val);
    }

    function setPersonID($val) {
        $this->PersonID = $val;
    }

    function getPerson() {
        return $this->Person;
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
        $this->Person = new person();
        $this->Person->select($this->PersonID);
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
        //Example: Password "changeme" would become "ngfi4902fchangemen498fvn65" and then MD5 hash encoded
        $salt1 = "ngfi4902f";
        $salt2 = "n498fvn65";
        return md5($salt1 . $input . $salt2);
    }

    function tryLogin() {
        $sql = "SELECT Password, ID FROM user WHERE UserName = '$this->UserName'";
        $success = $this->database->query($sql);
        $result = $this->database->result;
        $row = mysql_fetch_object($result);
        if ($this->database->rows > 0) {
            if ($this->Password == $row->Password) {
                $this->select($row->ID);
                return $this->ID;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function __toString() {
        return sprintf("User[%d]:'%s'", $this->ID, $this->UserName);
    }

}

?>