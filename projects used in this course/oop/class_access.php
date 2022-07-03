<?php

class Cars {

    //class properties (variables)
    //var is needed to declare a property in a class
    

    /**access properties is used to control the flow
     * of the program
     */
    //public can be used for the entire script
    //private can only be accessed inside the class
    //protected can only be accessed inside the class and 
    //subclasses
    public $wheel_count = 4;
    Private $door_count = 4;
    Protected $seat_count = 2;

    function car_detail(){
        echo $this->wheel_count . "<br>";
        echo $this->door_count . "<br>";
        echo $this->seat_count;
    }

}

class Trucks extends Cars {
    function car_detail2(){
        echo $this->wheel_count . "<br>";
        echo $this->door_count . "<br>";
        echo $this->seat_count;
    }
}

//access the class property
$bmw = new Cars();

//will display cause it is public
//echo $bmw->wheel_count;

//throws error cause it can only be accessed in the class
//echo $bmw->door_count;

//throws error cause it can only be accessed in the class
//echo $bmw->seat_count;

//all properties are shown
//echo $bmw->car_detail();

$mercedes = new Trucks();

//will display cause it is public
//echo $bmw->wheel_count;

//throws error cause it can only be accessed in the class
//echo $bmw->door_count;

//throws error cause it can only be accessed in the class
//echo $mercedes->seat_count;

//throws error cause door_count is private
//door_count is not inherited
echo $mercedes->car_detail2();

?>
