<?php include("includes/header.php"); ?>
<?php
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    $item_per_page = 4;

    $item_total_count = Photo::count_all();
    
    $paginate = new Paginate($page, $item_per_page, $item_total_count);
    $sql = "SELECT * FROM photos ";
    $sql .= "LIMIT {$item_per_page} ";
    $sql .= "OFFSET {$paginate->offset()}";
    $photos = Photo::find_query($sql);

    //$photos = Photo::find_all();
?>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">

                <div class="row">
                
                <?php foreach ($photos as $photo):?>
                    <div class="col-xs-6 col-md-3">
                        <a href="photo.php?id=<?php echo $photo->id; ?>" class="thumbnail">
                            <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                        </a>
                    </div>
                 <?php endforeach;?>
                </div>

                <div class="row">
                    <ul class="pager">
                        <?php 
                            if($paginate->total_page() > 1){
                                if($paginate->has_next()){
                                    echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                                }
                                for ($i=1; $i <= $paginate->total_page() ; $i++) { 
                                    if($i == $paginate->current_page){
                                        echo "<li class='active'><a href='index.php?page={$i}'>$i</a></li>";
                                    } else{
                                        echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                                    }
                                }
                           
                                if($paginate->has_previous()){
                                    echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                                }
                            }

                        ?>
                        
                        
                    </ul>
                
                </div>
 
         

            </div>




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">

            
                 <?php //include("includes/sidebar.php"); ?>



        </div> -->
        <!-- /.row -->
                </div>
        <?php include("includes/footer.php"); ?>
