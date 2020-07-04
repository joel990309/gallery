<?php include("includes/header.php"); ?>
<?php
    require_once("admin/includes/init.php");
    if(empty($_GET['id'])){
        redirect_link("index.php");
    }
    $photo = Photo::find_by_id($_GET['id']);

    if(isset($_POST['submit'])){

        $author = trim($_POST['author']);
        $body = trim($_POST['body']);

        $new_comment = Comment::create_comment($photo->id, $author, $body);

        if($new_comment && $new_comment->save()){
            //we rediect to same page with id to keep saved data
            redirect_link("photo.php?id={$photo->id}");
        } else {
            $message = "There is something wrong";
        }
    } else {
        $author = "";
        $body = "";
    }
    $comments = Comment::find_the_comments($photo->id);
?>




        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path();?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption;?></p>
                <p><?php echo $photo->description; ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>
                

                <!-- Posted Comments -->

                <!-- Comment -->
                <?php foreach ($comments as $comment):?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author;?>
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        <?php echo $comment->body;?>                    
                    </div>
                </div>
                <?php endforeach;?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">

            
                 <?php //include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->
                </div>
        <?php include("includes/footer.php"); ?>
