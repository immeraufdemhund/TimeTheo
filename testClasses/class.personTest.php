<?php
class personTest extends person {

	function testBuildPerson(){
		$expectedPersonId = 2;
		$expectedPerson = new person();
		$expectedPerson->setName("Robert Snyder");
		$this->select($expectedPersonId);
		if($expectedPerson->Name != $this->Name){
			throw new exception("Expected $expectedPerson but found $this");
		}
	}

}
?>