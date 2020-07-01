<?php
//we will put our commonly used methods here and extend them in other class
class Db_object {

    public $errors = array();
    public $upload_errors_array = array(

            UPLOAD_ERR_OK         => "There is no error",
            UPLOAD_ERR_INI_SIZE   => "The upload file exceeds the upload_maz_file",
            UPLOAD_ERR_FORM_SIZE  => "The upload file exceeds the MAX_FILE_SIZE",
            UPLOAD_ERR_PARTIAL    => "The upload file was only partially uploaded.",
            UPLOAD_ERR_NO_FILE    => "No file Upload",
            UPLOAD_ERR_NO_TMP_DIR =>"Missing temporal folder",
            UPLOAD_ERR_CANT_WRITE =>"Failed to write file to disk",
            UPLOAD_ERR_EXTENSION  =>"A PHP extension stopped the file"
        
        );

    public function set_file($file) {

            if(empty($file) || !$file || !is_array($file)){
                //This check and make sure that file is not empty
                $this->error[] = "There was no file uploaded here";
                return false;
            } elseif($file['error'] != 0){
                //This will check if there is an error and display the errors array
                $this->custom_errors[] = $this->upload_errors_array[$file['error']];
                return false;
            } else {
                $this->user_image = basename($file['name']);
                $this->tmp_path = $file['tmp_name'];
                $this->type = $file['type'];
                $this->size = $file['size'];
    
            }
    
    }    
    
    public static function find_all(){
        //global $database;
        // $result_set = $database->query("SELECT * FROM users");
        // return $result_set;
        return static::find_query("SELECT * FROM  " .static::$db_table. " ");

    }
    public static function find_by_id($id){
        //global $databases;
        $the_result_array = static::find_query("SELECT * FROM  " .static::$db_table. " where id = $id LIMIT 1");
        //$user_found = mysqli_fetch_array($the_result_id);
        //this step will grab the first item if $the_result_array is not empty
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public static function find_query($sql){
        global $database;
        $result_set = $database->query($sql);
        //this will create an array to save the object
        $the_object_array = array();
        //all table data will be store in $row
        while($row = mysqli_fetch_array($result_set)){
            //this means the result/data from fetch_array is passed to the instantiation method
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;
    }
    private static function instantiation($the_record){
        //replace self with the get_called_class() that is called Late Static Binding
        $calling_class = get_called_class();
        $the_object = new $calling_class;
        // $user->id = $user_found["id"];
        // $user->username = $user_found["username"];
        // $user->password = $user_found["password"];
        // $user->first_name = $user_found["first_name"];
        // $user->last_name = $user_found["last_name"];
        //In This Case $the_attribute = $user_found and $value = "id", username","password" 
        //this will loop through the key value
        foreach ($the_record as $the_attribute => $value) {
            //this will to find out if this data has any attribute
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    private function has_the_attribute($the_attribute){
        //this will get all attribute of the class
        $object_property = get_object_vars($this);
        //this will check if there is key that is $id, $username..etc
        return array_key_exists($the_attribute, $object_property);
    }
    protected function properties() {
        //this will get all the property above. Eg id, username, password, first_name, last_name, 
        //$object_property = get_object_vars($this);
        $properties = array();
        foreach (static::$db_field_table as $db_field) {
            if(property_exists($this, $db_field)){
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
    public function save() {
        return isset($this->id) ? $this->update() : $this->create(); 
    }
    public function create(){
        global $database;
        //this variable will store all the array value
        $properties = $this->clean_properties();
        //implode(",", array_keys($properties)) same as ('$username', '$password', '$first_name', '$last_name')";
        //the implode function will join the "," with array keys of the keys above Eg id, username, password, first_name, last_name, 
       
        //$sql .= "VALUES ('$username', '$password', '$first_name', '$last_name')";
        $sql = "INSERT INTO " .static::$db_table. " (" .implode(",", array_keys($properties)). ")";
        $sql .= "VALUES ('". implode("','", array_values($properties)). "')";
        //implode("','", array_values($properties)) = $database->escape_string($this->username) 

        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;
        } else {
            return false;
        }     

    }
    public function update(){
        global $database;
        $properties = $this->clean_properties();
        $properties_pairs = array();
        foreach ($properties as $key => $value) {
            //{$key}='{$vlaue}' is the same as "username = '".$database->escape_string($this->username)
            $properties_pairs[] = "{$key}='{$value}'";

        }
        
        //$sql .= "username = '".$database->escape_string($this->username)."', ";
        //$sql .= "password = '".$database->escape_string($this->password)."', ";
        //$sql .= "first_name = '".$database->escape_string($this->first_name)."', ";
        //$sql .= "last_name = '".$database->escape_string($this->last_name)."' ";
        $sql = "UPDATE ".static::$db_table." SET ";
        $sql .= implode(", ", $properties_pairs);
        $sql .= " WHERE id= ".$database->escape_string($this->id)."";

        $database->query($sql);
        //this will return the number of affected row
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    public function delete(){
        global $database;

        $sql = "DELETE FROM ".static::$db_table." WHERE id = ".$database->escape_string($this->id)."";
        $database->query($sql);
        //this will return the number of affected row
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    
    }
}


?>