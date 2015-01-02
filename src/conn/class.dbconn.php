<?php

include_once("\conn\class.database.php");

//DB class - setup for the generic MYSQL interface (non abject constrained)

class dbconn {

    var $database; // Instance of class database   

    function dbconn() {
        $this->database = new Database();
    }

    function saltAndMD5Text($input) {
        $salt1 = "ngfi4902f";
        $salt2 = "n498fvn65";
        return md5($salt1 . $input . $salt2);
    }

}

?>