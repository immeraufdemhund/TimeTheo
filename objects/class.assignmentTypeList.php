<?php
class assignmentTypeList {
	private $typeList = array();
	private $database;
	private $editLink;

	public function assignmentTypeList(){
		$this->database = new Database();
	}

	public function getTypeList(){
		return $this->typeList;
	}

	public function setTypeList($var){
		$this->typeList = $var;
	}

	public function getEditLink(){
		return $this->editLink;
	}

	public function setEditLink($var){
		$this->editLink = $var;
	}

	public function getFullListing(){
		if(count($this->typeList) < 1){
			return "<h2>There are no recrds found, how about make some?</h2>";
		}
		$returnData = "<ul>";
		foreach($this->typeList as $type){
			$returnData .= Template::load($this->database->getConfig(), $type, true);
		}
		return $returnData . "</ul>";
	}

	public function selectAll(){
		$sql = "SELECT ID FROM assignmenttype;";
		$this->database->Query($sql);
		if($this->database->rows > 0){
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