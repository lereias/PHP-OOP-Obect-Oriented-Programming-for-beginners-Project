<?php

class Cars {

    //static properties are called not by a class instance
    //but the class itself
    static $wheel_count = 4;
    static $door_count = 4;
    
    //if method is static, properties should be static
    static function car_detail(){
        echo Cars::$wheel_count . "<br>";
        echo Cars::$door_count . "<br>";
    }

}

/**accessing static properties and methods do not 
 * require a class instance
 */

//to access the static property
echo Cars::$door_count . "<br>";
//to access the static method
echo Cars::car_detail();

?>
