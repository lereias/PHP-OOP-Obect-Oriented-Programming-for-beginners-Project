$(document).ready(function() {
  //summernote
  $('#summernote').summernote({
    height: 300
  });

  //for user id
  var user_href;
  var user_href_splitted;
  var user_id;

  //for photo name
  var image_src;
  var image_src_splitted;
  var image_name;

  //for photo id clicked
  var photo_id;

  //get the modal_thumbnails class when clicked in photo_library_modal.php
  $(".modal_thumbnails").click(function(){
    //set the button with set_user_image id disabled to false
    $("#set_user_image").prop('disabled', false);
    
    //get the user id from the delete button in edit_user.php
    user_href = $("#user-id").prop('href');
    user_href_splitted = user_href.split("=");
    user_id = user_href_splitted[user_href_splitted.length - 1];

    //alert(user_id);

    //get the image name from the source of the image clicked
    image_src = $(this).prop('src');
    image_src_splitted = image_src.split("/");
    image_name = image_src_splitted[image_src_splitted.length - 1];

    //alert(image_name);

    //get the image id from data attribute of the image clicked
    photo_id = $(this).attr('data');

    //display the information about the image clicked
    $.ajax({
      url: "includes/ajax_code.php",
      data: {photo_id:photo_id},
      type: "POST",
      success:function(data) {
        if(!data.error) {
          $("#modal_sidebar").html(data);
        }
      }
    });

  });

  //inserts the image selected to the place where the previous image in edit_user.php is at using AJAX
  $("#set_user_image").click(function(){
    $.ajax({
      url: "includes/ajax_code.php",
      data: {image_name:image_name, user_id:user_id},
      type: "POST",
      success: function(data){
        if(!data.error) {
          $(".user_image_box a img").prop("src", `images/${image_name}`);
          //location.reload(true); //reloads the page
        }
      }
    });
  });

  /******************Edit Photo Sidebar*********************/
  $(".info-box-header").click(function(){
    //alert("hello");
    
    //toggle open and close the sidebar in edit_photo.php
    $(".inside").slideToggle("fast");
    $("#toggle").toggleClass("glyphicon-menu-down glyphicon-menu-up");

  });

  /***************Delete Function*****************/
  $(".delete_link").click(function(){
    return confirm("Are you sure you want to delete this item?");
  });

});