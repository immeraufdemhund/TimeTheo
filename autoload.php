<?php
    function __autoload($class_name) 
    {
        //class directories
        $directorys = array(
            'objects/',
			'conn/',
			'testClasses/'
        );
			
		$direction = "";
		
		if(basename(dirname($_SERVER['PHP_SELF'])) == "tests"){
			$direction = "../";
		}
		
        //for each directory
        foreach($directorys as $directory)
        {
            //see if the file exsists
            if(file_exists($direction.$directory.'class.'.$class_name . '.php'))
            {
                require_once($direction.$directory.'class.'.$class_name . '.php');
                //only require the class once, so quit after to save effort (if you got more, then name them something else 
                return;
            }
        }
    }
?>