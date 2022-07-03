<?php

class Cars {

    Private $door_count = 4;
    
    //getter
    //gets the value of property
    function get_values(){
        echo $this->door_count . "<br>";
    }

    //setter
    //sets the value of property
    function set_values(){
        $this->door_count = 10;
    }

}

//access the class property
$bmw = new Cars();

//access the property value by using the getter
$bmw->get_values();
//set the property value by using the setter
$bmw->set_values();

$bmw->get_values();

?>
