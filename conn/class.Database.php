<?php

class Database {

    var $link;
    var $query;
    var $result;
    var $rows;
    var $config;

    function Database() {
        $this->config = new configFile();
        $this->config->Load("config/config.xml");
        $this->rows = 0;
    }
    
    function setConfig(configFile $config){
        $this->config = $config;
    }

    function OpenLink() {
        if (!$this->link = @mysql_connect($this->config->getHost(), $this->config->getUser(), $this->config->getPassword())) {
            throw new exception("Class Database: Error while connecting to DB (link)");
        }
    }

    function SelectDB() {
        if (!@mysql_select_db($this->config->getDatabaseName(), $this->link)) {
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
        if (!$this->result = mysql_query($query, $this->link)) {
            throw new exception("Class Database: Error while executing Query");
        }
        if (ereg("SELECT", $query)) {
            $this->rows = mysql_num_rows($this->result);
        }
        $this->CloseDB();
    }

}

?>