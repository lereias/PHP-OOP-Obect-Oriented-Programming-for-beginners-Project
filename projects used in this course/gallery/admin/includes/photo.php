<?php

class Photo extends Db_object {
    
    protected static $db_table = "photos";
    protected static $db_table_fields = array('id', 'title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size');
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";
    public $errors = array();

    //upload file error messages
    public $upload_errors_array = array(
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

    //This is passing $_FILES['uploaded_file'] as an argument
    public function set_file($file) {
        
        if(empty($file) || !$file || !is_array($file)) { //check if there is no file chosen for upload, it is not a file, or it is not an array
            $this->errors[] = "There was no file uploaded here."; 
            return false;
        }elseif($file['error'] != 0) { //check after a file has been uploaded, check if there are upload errors that are not error = 0
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else {
            //basename gets the file name only not the whole file directory
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
        
    }

    //dynamic image path
    public function picture_path() {
        return $this->upload_directory.DS.$this->filename;
    }

    //sends the image from temporary file storage to permanent storage
    public function save() {
        if($this->id) {
            $this->update();
        } else {
            //check if there are no errors
            if(!empty($this->errors)){
                return false;
            }

            //check if file or tmp_path is empty
            if(empty($this->filename) || empty($this->tmp_path)) {
                $this->errors[] = "the file was not available";
                return false;
            }

            //target path or permanent path where file will be stored
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            
            //check if file already exists
            if(file_exists($target_path)) {
                $this->errors[] = "The file {$this->filename} already exists.";
                return false;
            }

            //move the file
            if(move_uploaded_file($this->tmp_path, $target_path)) {
                if($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "the file directory probably does not have permission.";
                return false;
            }

        }
    }

    //delete the file from database and delete file from the directory
    public function delete_photo() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();

            //unlink is a predefined function which will delete the file
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

    //this is for the sidebar for the selected image in the modal in edit_user.php
    public static function display_sidebar_data($photo_id) {
        $photo = Photo::find_by_id($photo_id);

        $output = "<a class='thumbnail' href='#'><img width='100' src='{$photo->picture_path()}'></a>";
        $output .= "<p>Name: {$photo->filename}</p>";
        $output .= "<p>Type: {$photo->type}</p>";
        $output .= "<p>Size: {$photo->size}</p>";

        echo $output;
    }

}

?>