<?php require_once("includes/init.php"); ?>
<?php
//this will check if user is not signed in 
 if(!$session->is_signed_in()){ redirect_link("login.php"); }

 ?>

      <?php
       if(empty($_GET["id"])){
         redirect_link("photos.php");
       }
       $photo = Photo::find_by_id($_GET["id"]);
       if($photo){
        $photo->delete_photo();
        redirect_link("../photos.php");
       } else {
         redirect_link("../photos.php");
       }
      
      ?>

  