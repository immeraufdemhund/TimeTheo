<?php

/*
 * Test suite should hold the class name, and an array of testMethod
 * that are tested
 */

abstract class testSuite {

    public function RunTestSuite() {
        try {
            $this->TestSuiteSetup();
            $this->RunAllTestMethods();
        } catch (Exception $ex) {
            $this->tryTestTearDown();
        }
    }
    public function testSuite($className){
        
    }
    private function RunAllTestMethods() {
        
    }


    private function tryTestTearDown() {
        try {
            $this->TestSuiteTearDown();
        } catch (Exception $ex) {
            
        }
    }

    protected function TestSuiteSetup() {
        //Do nothing. If you want to do something special override me
    }

    protected function TestSuiteTearDown() {
        //Do nothing. If you want to do something special override me
    }

    protected function TestSetup() {
        //Do nothing. If you want to do something special override me
    }

    protected function TestTearDown() {
        //Do nothing. If you want to do something special override me
    }

}
