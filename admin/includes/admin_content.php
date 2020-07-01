<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>
                        <?php

                            //$user = User::find_by_id(4);
                            //echo $user->username; 
                            
                            $photo = Photo::find_by_id(7);
                            echo $photo->filename;  


                            // $user = new User();
                            // $result = $user->find_user_id(2);
                            // while($row = mysqli_fetch_assoc($result)){
                            //     echo $row['username']."<br>";
                            // }

                            //$users = new User();

                            // $users = User::find_all();

                            // foreach($users as $user){
                            //     echo $user->username . "<br>";
                            // }

                            //  $user = User::find_user_by_id(3);
                            //  $user->last_name = "Abena";
                            //  $user->save(); 
                            //  $user->first_name = "Ruth";
                            //  $user->update();

                            // echo $user_found->username;
                            //testing create method
                        //     $user = new User();
                        //    // $user = User::find_user_by_id(17);
                        //     $user->username = "fool";
                        //     $user->password = "a123";
                        //     $user->first_name = "guy";
                        //     $user->last_name = "man";
                        //     $user->save();




                            // $user_found = User::find_user_by_id(2);
                            
                            // $user = new User();
                            // $user->id = $user_found["id"];
                            // $user->username = $user_found["username"];
                            // $user->password = $user_found["password"];
                            // $user->first_name = $user_found["first_name"];
                            // $user->last_name = $user_found["last_name"];

                            // echo $user->username;

                            // $photos = Photo::find_all();

                            // foreach($photos as $photo){
                            //     echo $photo->title . "<br>";
                            // }

                            //echo SITE_ROOT;
                        ?>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->