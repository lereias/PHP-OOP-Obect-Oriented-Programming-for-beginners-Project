<?php

//gives the whole path/directory of the file together with
//the file name
echo __FILE__ . "<br>";

//gives the line number of the echo in the code
echo __LINE__ . "<br>";

//gives the whole path/directory of the file
echo __DIR__ . "<br>";

//finds if file/directory exists
if(file_exists(__DIR__)) {
    echo "yes" . "<br>";
}

//check if it is a file
//this results to no
if(is_file(__DIR__)) {
    echo "yes" . "<br>";
} else {
    echo "no" . "<br>";
}

//this results to yes
if(is_file(__FILE__)) {
    echo "yes" . "<br>";
} else {
    echo "no" . "<br>";
}

//check if it is a directory
//this results to yes
if(is_dir(__DIR__)) {
    echo "yes" . "<br>";
} else {
    echo "no" . "<br>";
}

//this results to no
if(is_dir(__FILE__)) {
    echo "yes" . "<br>";
} else {
    echo "no" . "<br>";
}

//Ternary operator
//short-hand of if-else statement
echo file_exists(__FILE__) ? "yes" : "no";

?>