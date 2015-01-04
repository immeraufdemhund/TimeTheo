<?php
class userTest extends phpTestSuite {
    
    public function userTest(){
        parent::phpTestSuite("userTest");
    }
    
    function testValidLogin() {
        $user = new user();
        $user->setUserName("pwrinkle");
        $user->setPassword("changeme");
        $valid = $user->tryLogin();
        if ($valid === false) {
            //login failed
            throw new exception("Login Failed, but has valid testing creds!");
        }
    }

    function testInvalidLogin() {
        $user = new user();
        $user->setUserName("pwrinkle");
        $user->setPassword("wrong");
        $valid = $user->tryLogin();
        if ($valid !== false) {
            //login failed
            throw new exception("Login succeeded with INCORRECT testing creds!");
        }
    }

    function testGetPersonFromUser() {
        $user = new user();
        $expectedName = "Philip Wrinkle";
        $user->setUserName("pwrinkle");
        $user->setPassword("changeme");
        $valid = $user->tryLogin();
        if ($valid === false) {
            //login failed
            throw new exception("Login Failed, but has valid testing creds!");
        }
        if ($expectedName != $user->getPerson()->getName()) {
            throw new exception("Logged In as $user, but got unexpected associated person, " . (string) $user->getPerson() . " Instead of Test expected person: $expectedName");
        }
    }

    function testGetPersonFromUserWrongUsername() {
        $user = new user();
        $expectedName = "Robert Snyder";
        $user->setUserName("pwrinkle");
        $user->setPassword("changeme");
        $valid = $user->tryLogin();
        if ($valid === false) {
            //login failed
            throw new exception("Login Failed, but has valid testing creds!");
        }
        if ($expectedName == $user->getPerson()->getName()) {
            throw new exception("Logged In as $user, but got EXPECTED associated person, " . (string) $user->getPerson() . " Instead of Test wrong person: $expectedName");
        }
    }

}

?>