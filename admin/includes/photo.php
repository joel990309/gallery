<?php

class Photo extends Db_object {
    protected static $db_table = "photos";
    protected static $db_field_table = array("id", "title", "caption", "description", "filename", "alternate_text", "type", "size");
    public $id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;
    //public $filename_in_set_file = "filename";
    public $tmp_path;
    public $upload_directory = "images/photos";
    
    
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];

        }

    } 
    

    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }

    public function save_and_upload_photo() {
        if($this->id){
            $this->update();
        } else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "The file was not Available";
                return false;
            }

            $target_path = SITE_ROOT . DS .'admin' . DS . $this->upload_directory . DS . $this->filename;

            if(file_exists($target_path)){
                $this->errors[] = "The file {$this->filename} already exist";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            } else {
                $this->errors[] = "The file directory probably does not exist";
                return false;
            }
        }
        
    }//save

    public function delete_photo(){
        if($this->delete()){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            //this qill remove the photo
            return unlink($target_path) ? true : false;
        }else {
            return false;
        }
    }

}


?>