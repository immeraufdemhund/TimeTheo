<?php

//tests index file
include_once("../autoload.php");

function startsWith($haystack, $needle) {
    if (strlen($haystack) >= strlen($needle)) {
        return(substr($haystack, 0, strlen($needle)) === $needle);
    }
}

print("<h1>Test Scenario Starting:</h1>");
$classesDirectory = "../testClasses/";
$classesToCheck = array();

foreach(scandir($classesDirectory) as $file){
    if(startsWith($file, "class.")){
        array_push($classesToCheck, str_replace(".php", "", str_replace("class.", "", $file)));
    }
}

foreach ($classesToCheck as $class) {
    $tempObject = new $class;
    $methods = selectTestSuiteMethods($tempObject);
    print("<div style='margin:5px;padding:10px;background-color:#f2f2f2;'>");
    if (count($methods) > 0) {
        print("<h2>Testing class: $class</h2>");
    } else {
        print("<h3>No Test found in: $class</h3>");
    }
    foreach ($methods as $theMethod) {
        $test = new testMethod($class, $theMethod);
        $test->runTest();
        print($test->getHtml());
    }
    print("</div>");
}

function selectTestSuiteMethods($theClass){
    $methods = array();
    foreach(get_class_methods($theClass) as $method){
        if (startsWith($method, "test") || startsWith($method, "skip")) {
            array_push($methods, $method);
        }
    }
    return $methods;
}

class testMethod{
    private $wasTestRun = true;
    private $strFormat = "<div style='padding:5px; margin:5px; background-color:%s;'>Test for Class: %s->%s: Result: %s</div>";
    private $bgColor = "";
    private $message = "";
    private $name = "";
    private $className = "";
    private $object = null;
    
    public function testMethod($class, $method){
        $this->className = $class;
        $this->name = $method;
        $this->object = new $this->className();
    }
    
    public function runTest(){
        if (startsWith($this->name, "test")) {
            try {
                $function = $this->name;
                $this->object->$function();
                $this->bgColor = "lime";
                $this->message = "Test Passed!!!";
            } catch (Exception $e) {
                $this->bgColor = "pink";
                $this->message = $e->getMessage() . "<br>" . str_replace("\n", "<br>", $e->getTraceAsString());
            }
        } else if (startsWith($this->name, "skip")) {
            $this->bgColor = "lightblue";
            $this->message = "Test Skipped";
        }
        else{
            $this->wasTestRun = false;
        }
    }
    
    public function getHtml(){
        if ($this->wasTestRun) {
            return sprintf($this->strFormat, $this->bgColor, $this->className, $this->name, $this->message);
        } else {
            return "";
        }
    }
    
}
?>