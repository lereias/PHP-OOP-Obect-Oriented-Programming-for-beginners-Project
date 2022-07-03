<?php

class Cars {

    public $wheel_count = 4;
    static $door_count = 4;

    //constructor
    //whatever is inside will be called automatically
    function __construct(){
        echo $this->wheel_count . "<br>";
        //adds every class instantiation
        echo self::$door_count++ . "<br>";
    }

    //destructor
    //uninitialize something
    function __destruct(){
        //echo $this->wheel_count;
        //subtracts every class instantiation
        echo self::$door_count-- . "<br>";
    }

}

$bmw = new Cars();
$mercedes = new Cars();
$mercedes_2 = new Cars();

?>
