<?php
class userTest extends user {
    
	function testValidLogin(){
		$this->setUserName("pwrinkle");
		$this->setPassword("changeme");
		$valid = $this->tryLogin();
		if($valid === false){
			//login failed
			throw new exception("Login Failed, but has valid testing creds!");
		}
	}
	
	function testInvalidLogin(){
		$this->setUserName("pwrinkle");
		$this->setPassword("wrong");
		$valid = $this->tryLogin();
		if($valid !== false){
			//login failed
			throw new exception("Login succeeded with INCORRECT testing creds!");
		}
	}
	
	function testGetPersonFromUser(){
		$expectedName = "Philip Wrinkle";
		$this->setUserName("pwrinkle");
		$this->setPassword("changeme");
		$valid = $this->tryLogin();
		if($valid === false){
			//login failed
			throw new exception("Login Failed, but has valid testing creds!");
		}
		if($expectedName != $this->getPerson()->getName()){
			throw new exception("Logged In as $this, but got unexpected associated person, ".(string)$this->getPerson()." Instead of Test expected person: $expectedName");
		}
	}
	
	function testGetPersonFromUserWrongUsername(){
		$expectedName = "Robert Snyder";
		$this->setUserName("pwrinkle");
		$this->setPassword("changeme");
		$valid = $this->tryLogin();
		if($valid === false){
			//login failed
			throw new exception("Login Failed, but has valid testing creds!");
		}
		if($expectedName == $this->getPerson()->getName()){
			throw new exception("Logged In as $this, but got EXPECTED associated person, ".(string)$this->getPerson()." Instead of Test wrong person: $expectedName");
		}
	}
	
}
?>