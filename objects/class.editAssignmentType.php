<?php
class editAssignmentType extends assignmentType{

	private new;

	public function editAssinmentType(){

	}

	public function isNew(){
		return $this->new;
	}

	public function setNew($var){
		$this->new = $var;
	}

}

?>