<?php

    class User extends Db_object {
        protected static $db_table = "users";
        protected static $db_field_table = array("username", "password", "first_name", "last_name", "user_image");
        public $id;
        public $username;
        public $password;
        public $first_name;
        public $last_name;
        public $user_image;
        public $upload_directory = "images/users";
        public $image_placeholder = "http://placehold.it/62x62&text=image";

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
    
        public function upload_image() {
          
                if(!empty($this->errors)){
                    return false;
                }
                if(empty($this->user_image) || empty($this->tmp_path)){
                    $this->errors[] = "The file was not available";
                    return false;
                }
    
                $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;
    
                if(file_exists($target_path)){
                    $this->errors[] = "The file {$this->user_image} already exist";
                    return false;
                }
                if(move_uploaded_file($this->tmp_path, $target_path)){
                        unset($this->tmp_path);
                        return true;
                } else {
                    $this->errors[] = "The file directory propably does not exist";
                    return false;
                }
            
        }//save

        public function image_directory_user(){
            return empty($this->user_image) ? $this->image_placeholder  : $this->upload_directory.DS.$this->user_image;
        }
        public function picture_path(){
            return $this->upload_directory.DS.$this->user_image;
        }

        public static function verify_user($username, $password){
            global $database;

            $username = $database->escape_string($username);
            $password = $database->escape_string($password);

            $sql = "SELECT * FROM  " .self::$db_table. " WHERE ";
            $sql .= "username = '$username' ";
            $sql .= "AND password = '$password' ";
            $sql .= "LIMIT 1";
            $the_result_array = self::find_query($sql);
            //if user_found is not empty it will grab the first element in the the array
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
            
        }
        public function delete_user(){
            if($this->delete()){
                $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
                //this qill remove the photo
                return unlink($target_path) ? true : false;
            }else {
                return false;
            }
        }

    }   
    $user = new User();
?>