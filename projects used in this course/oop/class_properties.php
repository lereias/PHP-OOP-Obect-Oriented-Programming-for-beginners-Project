<?php

class Cars {

    //class properties (variables)
    //var is needed to declare a property in a class
    var $wheel_count = 4;
    var $door_count = 4;

    //$this->wheel_count is accessing var $wheel_count
    function car_detail(){
        return "This car has " . $this->wheel_count . " Wheels <br>";
    }

    // function greeting(){
    //     echo "Hello Student";
    // }

    // function greeting2(){

    // }

}

//access the class property
$bmw = new Cars();
$mercedes = new Cars();

echo $bmw->wheel_count . "<br>";
echo $mercedes->wheel_count . "<br>";
echo $mercedes->car_detail();

//you can change the value of the class property
echo $bmw->wheel_count = 10 . "<br>";
echo $bmw->wheel_count;

// //class instances to variables
// $bmw = new Cars();

// $mercedes = new Cars();

// $bmw->greeting();


// //get all methods inside the class which is Cars
// //in this case
// $the_methods = get_class_methods('Cars');

// //display all methods
// foreach ($the_methods as $method) {
//     echo $method . "<br>";
// }

// //get all declared classes including the class
// //at top
// $my_classes = get_declared_classes();

// //display all declared classes
// foreach($my_classes as $class) {
//     echo $class . "<br>";
// }

?>
