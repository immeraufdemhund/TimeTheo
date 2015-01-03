<?php
class userLogin extends user{  
    private $previous = "";
    
    function getPrevious(){
        return $this->previous;
    }
    function setPrevious($var){
        $this->previous = $var;
    }
}
?>