<?php
class assignmentTypeList {
	private $typeList = array();
	private $database;

	public function assignmentTypeList(){
		$this->database = new Database();
	}

	public function getTypeList(){
		return $this->typeList;
	}

	public function setTypeList($var){
		$this->typeList = $var;
	}

	public function selectAll(){
		$sql = "SELECT ID FROM assignmenttype;";
		$this->database->Query($sql);
		if($thi->database->rows > 0){
			//table HAS records
			while($row = mysql_fetch_object($this->database->result)){
				$assignmenttype = new assignmenttype();
				if($assignmenttype->select($row->ID)){
					array_push($this->typeList, $assignmenttype);
				}
			}
			if(count($this->typeList) < 1){
				return false;
			}
			return true;
		}else{
			//table EMPTY
			return false;
		}
	}


}


?>