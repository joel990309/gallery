<?php require_once("includes/init.php"); ?>
<?php
//this will check if user is not signed in 
 if(!$session->is_signed_in()){ redirect_link("login.php"); }

 ?>

      <?php
       if(empty($_GET["id"])){
         redirect_link("comments.php");
       }
       $comment = Comment::find_by_id($_GET["id"]);
       if($comment){
        $comment->delete();
        redirect_link("../admin/comment_photo.php?id={$comment->photo_id}");
       } else {
         redirect_link("../admin/comments.php");
       }
      
      ?>

  