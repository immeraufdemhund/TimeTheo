<?php
class testMethod {

    private $wasTestRun = true;
    private $strFormat = "<div style='padding:5px; margin:5px; background-color:%s;'>Test for Class: %s->%s: Result: %s</div>";
    private $bgColor = "";
    private $message = "";
    private $name = "";
    private $className = "";
    private $object = null;

    public function testMethod($class, $method) {
        $this->className = $class;
        $this->name = $method;
        $this->object = new $this->className();
    }

    public function runTest() {
        if ($this->startsWith($this->name, "test")) {
            try {
                $function = $this->name;
                $this->object->$function();
                $this->bgColor = "lime";
                $this->message = "Test Passed!!!";
            } catch (Exception $e) {
                $this->bgColor = "pink";
                $this->message = $e->getMessage() . "<br>" . str_replace("\n", "<br>", $e->getTraceAsString());
            }
        } else if ($this->startsWith($this->name, "skip")) {
            $this->bgColor = "lightblue";
            $this->message = "Test Skipped";
        } else {
            $this->wasTestRun = false;
        }
    }

    public function getHtml() {
        if ($this->wasTestRun) {
            return sprintf($this->strFormat, $this->bgColor, $this->className, $this->name, $this->message);
        } else {
            return "";
        }
    }
    
    function startsWith($haystack, $needle) {
        if (strlen($haystack) >= strlen($needle)) {
            return(substr($haystack, 0, strlen($needle)) === $needle);
        }
    }

}
?>