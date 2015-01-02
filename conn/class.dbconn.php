<?php
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