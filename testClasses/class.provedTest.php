<?php
class provedTest{
    function testExists(){
        $v = true;
        if(!$v){
            throw new Exception("True is false!");
        }
    }
    
    
}