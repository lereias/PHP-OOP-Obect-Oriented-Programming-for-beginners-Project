<?php

class Cars {



}

//get all declared classes including the class
//at top
$my_classes = get_declared_classes();

//display all declared classes
foreach($my_classes as $class) {
    echo $class . "<br>";
}

?>
