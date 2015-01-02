<?php
include_once("../autoload.php");
//set up classes to test
$classesToCheck = array(
	"DatabaseTest",
	"userTest",
	"personTest",
	//"meetingType",
	//"assignmentType",
	//"meeting",
);

function startWithTest($haystack)
{
	$searchVar = "test";
	if(strlen($haystack) >= strlen($searchVar)){
		return(substr($haystack, 0, strlen($searchVar)) === $searchVar);
	}
}

print("Test Scenario Starting: <br>");
foreach($classesToCheck as $class){
	print("<h2>Testing class: ".$class."</h2>");
	$strFormat = "<div style='padding:5px; margin:5px; background-color:%s;'>Test for Class: $class->%s: Result: %s</div>";
	$bgColor = "";
	$message = "";
	$tempObject = new $class;
	$methods = get_class_methods($tempObject);
	foreach($methods as $theMethod)
	{
		if(startWithTest($theMethod)){
			try{
				$tempObject->$theMethod();
				$bgColor = "lime";
				$message = "Test Passed!!!";
			}
			catch(Exception $e){
				$bgColor = "pink";
				$message = $e->getMessage()."<br>".str_replace("\n", "<br>", $e->getTraceAsString());
			}
			
			printf($strFormat, $bgColor,$theMethod, $message);
		}
	}
	
	
}

?>