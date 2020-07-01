<?php include("includes/header.php"); ?>
<?php
//this will check if user is not signed in 
 if(!$session->is_signed_in()){ redirect_link("login.php"); } ?>

<?php
$message = "";
if(isset($_POST['submit'])){
    $photos = new Photo();
    $photos->title = $_POST['title'];
    $photos->set_file($_FILES['file_upload']);

    if($photos->save()){
    $message = "Photo Uploaded Successfully";
    } else {
        $message = join("<br>", $photos->errors);
    }

}



?>



        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
                <?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <!--Admin Content-->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload 
                            <small>Subheading</small>
                        </h1>
                        
                        <div class="col-md-6">
                            <?php echo $message;?>
                            <form action="upload.php" method="post" enctype="multipart/form-data" >
                                <div class="form-group">
                                    <input type="text" name="title" class="form-control">           
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file_upload">
                                </div>
                                <input type="submit" value="submit" name="submit">

                            </form>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>