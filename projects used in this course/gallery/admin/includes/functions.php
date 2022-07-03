<!--Autoload method-->
<!--checks if there is a missing include class-->
<?php

//__autoload no longer supported (deprecated as of PHP 7.2.0 and removed as of PHP 8.0.0)
// function __autoload($class) {
//     $class = strtolower($class);
//     $the_path = "includes/{$class}.php";

//     if(file_exists($the_path)) {
//         require_once($the_path);
//     } else {
//         die("This file name {$class}.php was not found");
//     }
// }

//use spl_autoload_register() instead

function classAutoLoader($class) {
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";

    if(is_file($the_path) && !class_exists($class)) {
        require_once($the_path);
    } else {
        die("This file name {$class}.php was not found");
    }
}

spl_autoload_register('classAutoLoader');

function redirect($location){
    //can redirect somewhere else
    header("Location: {$location}");
}

?>