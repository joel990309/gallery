<?php require_once("includes/init.php"); ?>
<?php
//this will check if user is not signed in 
 if(!$session->is_signed_in()){ redirect_link("login.php"); }

 ?>

      <?php
       if(empty($_GET["id"])){
         redirect_link("users.php");
       }
       $user = User::find_by_id($_GET["id"]);
       if($user){
        $user->delete_user();
        redirect_link("../admin/users.php");
       } else {
         redirect_link("../admin/users.php");
       }
      
      ?>

  