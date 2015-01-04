<?php

class testSuiteLoader {

    var $classesDirectory = "../testClasses/";
    var $classesToCheck = array();

    public function testSuiteLoader() {
        
    }

    /*
     * Gets a list of Test Suites
     * @return testSuite[]
     */

    public function getTestSuites() {
        $this->getClassesFromDirectory($this->classesDirectory);
        $testSuites = array();
        foreach ($this->classesToCheck as $className) {
            $tempObject = new $className;
            if(is_subclass_of($tempObject, "testSuite")){
                
                array_push($testSuites, $tempObject);
            }
            else{
                throw new Exception("You silly person");
            }
        }
        return $testSuites;
    }

    private function getClassesFromDirectory($directory) {
        foreach (scandir($directory) as $file) {
            if ($this->startsWith($file, "class.")) {
                array_push($this->classesToCheck, str_replace(".php", "", str_replace("class.", "", $file)));
            }
        }
    }

    private function startsWith($haystack, $needle) {
        if (strlen($haystack) >= strlen($needle)) {
            return(substr($haystack, 0, strlen($needle)) === $needle);
        }
    }

    function selectTestSuiteMethods($theClass) {
        $methods = array();
        foreach (get_class_methods($theClass) as $method) {
            if ($this->startsWith($method, "test") || $this->startsWith($method, "skip")) {
                array_push($methods, $method);
            }
        }
        return $methods;
    }

}

?>