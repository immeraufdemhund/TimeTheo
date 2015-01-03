<?php

class Database {

    private $result;
    private $link;
    private $query;
    private $rows;
    private $config;

    function Database() {
        $this->config = new configFile();
        $this->config->Load("config/config.xml");
        $this->rows = 0;
    }

    public function Query($query) {
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
    
    public function getResultObject(){
        return mysql_fetch_object($this->result);
    }
    
    public function getInsertedId(){
        return mysql_insert_id($this->link);
    }
    
//    public function getRawResult(){
//        return $this->result;
//    }
    
    private function OpenLink() {
        if (!$this->link = @mysql_connect($this->config->getHost(), $this->config->getUser(), $this->config->getPassword())) {
            throw new exception("Class Database: Error while connecting to DB (link)");
        }
    }

    private function SelectDB() {
        if (!@mysql_select_db($this->config->getDatabaseName(), $this->link)) {
            throw new exception("Class Database: Error while selecting DB");
        }
    }

    private function CloseDB() {
        mysql_close();
    }

}

?>