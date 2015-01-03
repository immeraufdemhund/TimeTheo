<?php

class Template {
    public static function load($classInstance) {
        $uri = sprintf("../views/view.%s.html", get_class($classInstance));
        $template = self::replace($classInstance, file_get_contents($uri));
        echo($template);
    }

    private static function replace($classInstance, $template) {
        $matches = array();
        $pattern = "/#\{(.+)\}/";

        preg_match_all($pattern, $template, $matches);
        for ($i = 0; $i < count($matches[0]); $i++) {
            $getMethodName = "get" . $matches[1][$i];
            $placeHolder = $matches[0][$i];
            $newValue = $classInstance->$getMethodName();
            $template = str_replace($placeHolder, $newValue, $template);
        }
        
        return $template;
    }

}

?>
