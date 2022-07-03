<?php

class User extends Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
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

    //placehold.it does not work, use https://via.placeholder.com/ instead
    public $image_placeholder = "https://via.placeholder.com/400x400?text=image";

    public function image_path_and_placeholder() {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }

    // use static method instead
    // public function find_all_users() {
    //     global $database;
    //     $result_set = $database->query("SELECT * FROM users");
    //     return $result_set;
    // }
    
    //find all users
    // public static function find_all() {
    //     return self::find_this_query("SELECT * FROM " . self::$db_table  . " ");
    // }

    //find user by id
    // public static function find_by_id($user_id) {
    //     //$result_set = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1");
    //     //$found_user = mysqli_fetch_array($result_set);
    //     //return $found_user;

    //     $the_result_array = self::find_this_query("SELECT * FROM " . self::$db_table  . " WHERE id = $user_id LIMIT 1");
        
    //     // if(!empty($the_result_array)) {
    //     //     $first_item = array_shift($the_result_array);
    //     //     return $first_item;
    //     // } else {
    //     //     return false;
    //     // }
        
    //     //ternary method
    //     //? is if
    //     //: is else
    //     return !empty($the_result_array) ? array_shift($the_result_array) : false;

    // }

    //executes any query
    // public static function find_this_query($sqli) {
    //     global $database;
    //     $result_set = $database->query($sqli);
    //     //array to put objects on
    //     $the_object_array = array();

    //     while($row = mysqli_fetch_array($result_set)) {
    //         $the_object_array[] = self::instantiation($row);
    //     }

    //     return $the_object_array;
    // }

    //verify if user exists on the database
    public static function verify_user($username, $password) {
        global $database;

        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        // .= means a continuation of =
        $sql = "SELECT * FROM " . self::$db_table  . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        //$sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1";

        $the_result_array = self::find_by_query($sql);
        
        // if(!empty($the_result_array)) {
        //     $first_item = array_shift($the_result_array);
        //     return $first_item;
        // } else {
        //     return false;
        // }
        
        //ternary method
        //? is if
        //: is else
        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

    // public static function instantiation($the_record) {
    //     $the_object = new self;
        
    //     //this way is not good if there are a lot of records
    //     // $the_object->id         = $found_user['id'];
    //     // $the_object->username   = $found_user['username'];
    //     // $the_object->password   = $found_user['password'];
    //     // $the_object->first_name = $found_user['first_name'];
    //     // $the_object->last_name  = $found_user['last_name'];

    //     foreach($the_record as $the_attribute => $value) {
    //         if($the_object->has_the_attribute($the_attribute)) {
    //             $the_object->$the_attribute = $value;
    //         }
    //     }

    //     return $the_object;
    // }

    // private function has_the_attribute($the_attribute) {
    //     //gets all the attributes/properties of this class
    //     $object_properties = get_object_vars($this);
    //     //what we want to find, where do we want to find it
    //     return array_key_exists($the_attribute, $object_properties);
    // }

    // protected function properties() {
    //     //this will not work because it will also get the table name property
    //     //return get_object_vars($this);

    //     $properties = array();

    //     foreach(self::$db_table_fields as $db_field) {
    //         //check if property exist in this class
    //         if(property_exists($this, $db_field)) {
    //             $properties[$db_field] = $this->$db_field;
    //         }

    //     }

    //     return $properties;   
    // }

    // protected function clean_properties() {
    //     global $database;

    //     $clean_properties = array();

    //     foreach ($this->properties() as $key => $value) {
    //         $clean_properties[$key] = $database->escape_string($value);
    //     }

    //     return $clean_properties;
    // }

    //create if user id does not exist, update if user id does exist
    // public function save() {
    //     return isset($this->id) ? $this->update() : $this->create();
    // }

    //create a user
    //apply to table name - section 12
    // public function create() {
    //     global $database;

    //     $sql = "INSERT INTO users (username, password, first_name, last_name)";
    //     $sql .= "VALUES ('";
    //     $sql .= $database->escape_string($this->username) . "', '";
    //     $sql .= $database->escape_string($this->password) . "', '";
    //     $sql .= $database->escape_string($this->first_name) . "', '";
    //     $sql .= $database->escape_string($this->last_name) . "')";

    //     //check data query if successful
    //     if ($database->query($sql)) {
    //         //get the id of the last query
    //         $this->id = $database->the_insert_id();
    //         return true;
    //     } else {
    //         return false;
    //     }

    // }

    // public function create() {
    //     global $database;

    //     //$properties = $this->properties();

    //     //$database->escape_string() to all values
    //     $properties = $this->clean_properties();

    //     //implode pulls out array_keys/array_values and separates it with the first parameter
    //     $sql = "INSERT INTO " . self::$db_table  . "(" . implode(",", array_keys($properties)) . ")";
    //     $sql .= "VALUES ('" . implode("', '",array_values($properties)) . "')";
        

    //     //check data query if successful
    //     if ($database->query($sql)) {
    //         //get the id of the last query
    //         $this->id = $database->the_insert_id();
    //         return true;
    //     } else {
    //         return false;
    //     }

    // }
    

    //update a user
    //apply to table name - section 12
    // public function update() {
    //     global $database;

    //     $sql = "UPDATE users SET ";
    //     $sql .= "username= '" . $database->escape_string($this->username)     . "', ";
    //     $sql .= "password= '" . $database->escape_string($this->password)     . "', ";
    //     $sql .= "first_name= '" . $database->escape_string($this->first_name) . "', ";
    //     $sql .= "last_name= '" . $database->escape_string($this->last_name)   . "' ";
    //     $sql .= " WHERE id= " . $database->escape_string($this->id);   
    
    //     $database->query($sql);

    //     //check if affected row is 1
    //     return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    // }

    // public function update() {
    //     global $database;

    //     //$properties = $this->properties();

    //     //$database->escape_string() to all values
    //     $properties = $this->clean_properties();
    //     $properties_pairs = array();

    //     foreach($properties as $key => $value) {
    //         $properties_pairs[] = "{$key}='{$value}'";
    //     }

    //     $sql = "UPDATE " . self::$db_table  . " SET ";
    //     $sql .= implode(", ", $properties_pairs);
    //     $sql .= " WHERE id= " . $database->escape_string($this->id);   
    
    //     $database->query($sql);

    //     //check if affected row is 1
    //     return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    // }

    //delete a user
    //apply to table name - section 12
    // public function delete() {
    //     global $database;

    //     $sql = "DELETE FROM users ";
    //     $sql .= "WHERE id= " . $database->escape_string($this->id); 
    //     $sql .= " LIMIT 1";

    //     $database->query($sql);

    //     return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    // }

    // public function delete() {
    //     global $database;

    //     $sql = "DELETE FROM " . self::$db_table  . " ";
    //     $sql .= "WHERE id= " . $database->escape_string($this->id); 
    //     $sql .= " LIMIT 1";

    //     $database->query($sql);

    //     return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    // }


    //dynamic image path
    public function picture_path() {
        return $this->upload_directory.DS.$this->user_image;
    }

    //delete the file from database and delete file from the directory
    public function delete_user() {
        if($this->delete()) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();

            //unlink is a predefined function which will delete the file
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }

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
            $this->user_image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
        
    }

    //sends the image from temporary file storage to permanent storage
    public function upload_photo() {
        
        //check if there are no errors
        if(!empty($this->errors)){
            return false;
        }

        //check if file or tmp_path is empty
        if(empty($this->user_image) || empty($this->tmp_path)) {
            $this->errors[] = "the file was not available";
            return false;
        }

        //target path or permanent path where file will be stored
        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
        
        //check if file already exists
        if(file_exists($target_path)) {
            $this->errors[] = "The file {$this->user_image} already exists.";
            return false;
        }

        //move the file
        if(move_uploaded_file($this->tmp_path, $target_path)) {
            unset($this->tmp_path);
            return true;
        } else {
            $this->errors[] = "the file directory probably does not have permission.";
            return false;
        }
        
    }

    //for ajax in edit_user.php to save new image selected for the user
    public function ajax_save_user_image($user_image, $user_id) {
        //save method is not used because only image and id is needed to be updated
        global $database;
        $user_image = $database->escape_string($user_image);
        $user_id = $database->escape_string($user_id);

        $this->user_image = $user_image;
        $this->id         = $user_id;

        $sql = "UPDATE " . self::$db_table . " SET user_image = '{$this->user_image}' ";
        $sql .= " WHERE id = {$this->id}";
        $update_image = $database->query($sql);

        echo $this->image_path_and_placeholder();

    }

} //End of User class

?>
