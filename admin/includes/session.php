<?php
 
 class Session {
     private $signed_in = false;
     public $user_id;
     public $count;
     public $message;

     function __construct() {
         session_start();
         $this->view_count();
         $this->check_the_login();
         $this->check_message();
     }
     public function message($mgs = ""){
         if(!empty($mgs)) {
            $_SESSION["message"] = $mgs;
         } else {
             return $this->message;
         }
     }
     private function check_message(){
         if(isset($_SESSION["message"])){
             //we check if message session is set 
             $this->message = $_SESSION["message"];
             unset($_SESSION["message"]);
         } else {
             //if message session is set then we assign to empty assign
             $this->message = "";
         }
     }
     public function is_signed_in(){
         return $this->signed_in;
     }
     public function view_count(){
         if(isset($_SESSION['count'])){
             return $this->count = $_SESSION['count']++;
         }else {
             return $_SESSION['count'] = 1;
         }
     }
     public function login($user){
         if($user){
             $this->user_id = $_SESSION['user_id'] = $user->id;
             $this->signed_in = true;
             $this->check_message();
         }
     }
     public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
     }
     public function check_the_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else{
            unset($this->user_id); 
            $this->signed_in = false; 
        }
     }
    //  public function message($mgs = ""){
    //     if(empty($mgs)){
    //         $_SESSION['message'] = $mgs;
    //     } else {
    //         return $this->message;
    //     }
    // }

    // public function check_message(){
    //     if(isset($_SESSION['message'])){
    //         $this->message = $_SESION['message'];
    //         //the code below will remove or clear mesaage after reload
    //         unset($_SESSION['messsage']);
    //     } else{
    //         $this->message = "";
    //     }
    // }
 }
$session = new Session();
$message = $session->message();

?>