<?php

class Cars {

    function greeting(){

    }

    function greeting2(){

    }

}

//get all methods inside the class which is Cars
//in this case
$the_methods = get_class_methods('Cars');

//display all methods
foreach ($the_methods as $method) {
    echo $method . "<br>";
}

// //get all declared classes including the class
// //at top
// $my_classes = get_declared_classes();

// //display all declared classes
// foreach($my_classes as $class) {
//     echo $class . "<br>";
// }

?>
