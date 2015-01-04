<?php
//tests index file
include_once("../autoload.php");

print("<h1>Test Scenario Starting:</h1>");

function runTestSuites() {
    $testsLoader = new testSuiteLoader();
    /* @var $t testSuite */
    foreach ($testsLoader->getTestSuites() as $t) {
        print("<div style='margin:5px;padding:10px;background-color:#f2f2f2;'>");
        if (count($methodArray) > 0) {
            print("<h2>Testing class: $class</h2>");
        } else {
            print("<h3>No Test found in: $class</h3>");
        }
        foreach ($methodArray as $theMethod) {
            $test = new testMethod($class, $theMethod);
            $test->runTest();
            print($test->getHtml());
        }
        print("</div>");
    }
}

runTestSuites();
?>
<a href="/"><div style="display: inline-block; width: 100px; height: 20px; border-radius: 5px; border: black thin solid; background-color:green; margin:5px; padding:5px;"><strong>Home</strong></div></a>
