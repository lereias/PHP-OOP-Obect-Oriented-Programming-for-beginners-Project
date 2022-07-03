<?php

class Cars {

    //static properties are called not by a class instance
    //but the class itself
    static $wheel_count = 4;
    
    //if method is static, properties should be static
    //self:: is the reference for static and $this-> for
    //not
    static function car_detail(){
        return self::$wheel_count . "<br>";
    }

}

class Trucks extends Cars {

    //parent:: is the reference to parent class with static
    //property or method
    static function display(){
        echo parent::car_detail();        
    }

}

?>
