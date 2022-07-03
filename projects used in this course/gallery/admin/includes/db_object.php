<?php

class Db_object {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');

    //find all
    public static function find_all() {
        return static::find_by_query("SELECT * FROM " . static::$db_table  . " ");
    }

    //find by id
    public static function find_by_id($id) {
        //$result_set = static::find_this_query("SELECT * FROM users WHERE id = $id LIMIT 1");
        //$found_user = mysqli_fetch_array($result_set);
        //return $found_user;

        $the_result_array = static::find_by_query("SELECT * FROM " . static::$db_table  . " WHERE id = $id LIMIT 1");
        
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

    //executes any query
    public static function find_by_query($sqli) {
        global $database;
        $result_set = $database->query($sqli);
        //array to put objects on
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)) {
            $the_object_array[] = static::instantiation($row);
        }

        return $the_object_array;
    }

    public static function instantiation($the_record) {
        
        $calling_class = get_called_class();
        
        $the_object = new $calling_class;
        
        //this way is not good if there are a lot of records
        // $the_object->id         = $found_user['id'];
        // $the_object->username   = $found_user['username'];
        // $the_object->password   = $found_user['password'];
        // $the_object->first_name = $found_user['first_name'];
        // $the_object->last_name  = $found_user['last_name'];

        foreach($the_record as $the_attribute => $value) {
            if($the_object->has_the_attribute($the_attribute)) {
                $the_object->$the_attribute = $value;
            }
        }

        return $the_object;
    }

    private function has_the_attribute($the_attribute) {
        //gets all the attributes/properties of this class
        $object_properties = get_object_vars($this);
        //what we want to find, where do we want to find it
        return array_key_exists($the_attribute, $object_properties);
    }

    protected function properties() {
        //this will not work because it will also get the table name property
        //return get_object_vars($this);

        $properties = array();

        foreach(static::$db_table_fields as $db_field) {
            //check if property exist in this class
            if(property_exists($this, $db_field)) {
                $properties[$db_field] = $this->$db_field;
            }

        }

        return $properties;   
    }

    protected function clean_properties() {
        global $database;

        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }

        return $clean_properties;
    }

    //create if user id does not exist, update if user id does exist
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    //create
    public function create() {
        global $database;

        //$properties = $this->properties();

        //$database->escape_string() to all values
        $properties = $this->clean_properties();

        //implode pulls out array_keys/array_values and separates it with the first parameter
        $sql = "INSERT INTO " . static::$db_table  . "(" . implode(",", array_keys($properties)) . ")";
        $sql .= "VALUES ('" . implode("', '",array_values($properties)) . "')";
        

        //check data query if successful
        if ($database->query($sql)) {
            //get the id of the last query
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }

    }

    //update
    public function update() {
        global $database;

        //$properties = $this->properties();

        //$database->escape_string() to all values
        $properties = $this->clean_properties();
        $properties_pairs = array();

        foreach($properties as $key => $value) {
            $properties_pairs[] = "{$key}='{$value}'";
        }

        $sql = "UPDATE " . static::$db_table  . " SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);   
    
        $database->query($sql);

        //check if affected row is 1
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    //delete
    public function delete() {
        global $database;

        $sql = "DELETE FROM " . static::$db_table  . " ";
        $sql .= "WHERE id= " . $database->escape_string($this->id); 
        $sql .= " LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    //counts all records
    public static function count_all() {
        global $database;

        $sql = "SELECT COUNT(*) FROM ". static::$db_table;
        $result_set = $database->query($sql);
        $row = mysqli_fetch_array($result_set);

        return array_shift($row);
    }

}

?>