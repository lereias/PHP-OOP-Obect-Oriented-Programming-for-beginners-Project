<?php

class Cars {

    var $wheels = 4;

    function greeting(){
        echo "hello";
    }

}

$bmw = new Cars();

//to inherit from class to a class use extends <name of
//class>
class Trucks extends Cars {

}

$tacoma = new Trucks();

echo $tacoma->wheels;

?>
