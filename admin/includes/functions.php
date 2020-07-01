<?php

//This Funtion will automatically load any new class create without including it in init.php
function classAutoLoad($class){
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    if(is_file($the_path) && !class_exists($class)){
        require_once($the_path);
    } else{
        die("This file {$class}.php was not found");
    }

}

spl_autoload_register('classAutoLoad');

function redirect_link($location){
    header("Location: {$location}");
}

?>