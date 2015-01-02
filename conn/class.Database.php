<?php
class Database {
    var $host;    //Hostname, Server
    var $password;  //Passwort MySQL
    var $user;   //User MySQL
    var $database;  //Datenbankname MySQL
    var $link;
    var $query;
    var $result;
    var $rows;

    function Database() {
        $this->host = "localhost";                  //          <<---------
        $this->password = "timetheo";           //          <<---------
        $this->user = "timetheo";                   //          <<---------
        $this->database = "timetheo";           //          <<---------
        $this->rows = 0;
    }

    function OpenLink() {
        if(!$this->link = @mysql_connect($this->host, $this->user, $this->password)){
			throw new exception("Class Database: Error while connecting to DB (link)");
		}
    }

    function SelectDB() {
        if(!@mysql_select_db($this->database, $this->link)){
			throw new exception("Class Database: Error while selecting DB");
		}
    }

    function CloseDB() {
        mysql_close();
    }

    function Query($query) {
        $this->OpenLink();
        $this->SelectDB();
        $this->query = $query;
        if(!$this->result = mysql_query($query, $this->link)){
			throw new exception("Class Database: Error while executing Query");
		}
        if (ereg("SELECT", $query)) {
            $this->rows = mysql_num_rows($this->result);
        }
        $this->CloseDB();
    }

}

?>