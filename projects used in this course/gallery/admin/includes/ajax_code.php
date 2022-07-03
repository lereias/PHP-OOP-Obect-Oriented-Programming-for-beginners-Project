<?php require_once("init.php");

$user = new User();

//check if there is $_POST['image_name'], if yes, update the image_name for the user image
if(isset($_POST['image_name'])) {
    $user->ajax_save_user_image($_POST['image_name'], $_POST['user_id']);
    //echo "This is data from the server YAYYYYY";
}

//check if there is $_POST['photo_id'], if yes, get all data of that photo
if(isset($_POST['photo_id'])) {
    Photo::display_sidebar_data($_POST['photo_id']);
}

?>