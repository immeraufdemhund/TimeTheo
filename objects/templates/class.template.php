<?php

class Template {

    public static function load(configFile $config, $classInstance) {
        $uri = sprintf("themes/%s/view.%s.html", self::getProperTheme($config), get_class($classInstance));
        if (!file_exists($uri)) {
            $uri = "../" . $uri;
            if (!file_exists($uri)) {
                $uri = "../" . $uri;
                if (!file_exists($uri)) {
                    $uri = "../" . $uri;
                }
            }
        }
        $template = self::replace($classInstance, file_get_contents($uri));
        echo($template);
    }

    private static function getProperTheme($config) {
        return strlen($config->getTheme()) > 0 ? $config->getTheme() : "classic";
    }

    private static function replace($classInstance, $template) {
        $matches = array();
        $pattern = "/#\{([^}]+)\}/";

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
