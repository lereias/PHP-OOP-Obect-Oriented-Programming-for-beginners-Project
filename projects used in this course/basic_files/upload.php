<?php

$the_message = "";

if(isset($_POST['submit'])){
    // echo "<pre>";
    // //print the values and keys of an array
    // //prints the name, type, tmp_name, error, size of the file
    // //uploaded
    // print_r($_FILES['file_upload']);

    // echo "<pre>";

    $upload_errors = array(
        //error = 0
        UPLOAD_ERR_OK           => "There is no error.",

        //error = 1
        UPLOAD_ERR_INI_SIZE     => "The uploaded file exceeds the upload_max_filesize directive in php.ini.",

        //error = 2
        UPLOAD_ERR_FORM_SIZE    => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
        
        //error = 3
        UPLOAD_ERR_PARTIAL      => "The uplaoded file was only partially uploaded.",
        
        //error = 4
        UPLOAD_ERR_NO_FILE      => "No file was uploaded.",
        
        //error = 5 is deprecated

        //error = 6
        UPLOAD_ERR_NO_TMP_DIR   => "Missing a temporary folder.",
        
        //error = 7
        UPLOAD_ERR_CANT_WRITE   => "Failed to write file to disk.",
        
        //error = 8
        UPLOAD_ERR_EXTENSION    => "A PHP extension stopped the file upload."
    );

    //display the error
    $the_error = $_FILES['file_upload']['error'];
    $the_message = $upload_errors[$the_error];

    //moving the file from local to temp in server to permanent in server
    $temp_name = $_FILES['file_upload']['tmp_name'];
    $the_file = $_FILES['file_upload']['name'];
    $directory = "uploads";

    //does the moving even if it is in if statement
    if(move_uploaded_file($temp_name, $directory . "/" . $the_file)) {
        $the_message = "File uploaded successfully";
    } else {
        $the_error = $_FILES['file_upload']['error'];
        $the_message = $upload_errors[$the_error];
    }    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="upload.php" enctype="multipart/form-data" method="post">
        
        <h2>
            <?php
            
            if(!empty($upload_errors)) {}
                echo $the_message;
            ?>
        </h2>
    
        <input type="file" name="file_upload"><br>
        <input type="submit" name="submit">
    </form>
    
</body>
</html>