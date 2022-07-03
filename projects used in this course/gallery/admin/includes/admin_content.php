            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Dashboard</small>
                        </h1>

                        <?php
                            //test if query is working
                            //$sql = "SELECT * FROM users WHERE id=1";
                            //$result = $database->query($sql);

                            //get the user found
                            //save the result here
                            //$user_found = mysqli_fetch_array($result);

                            //echo $user_found['username'];

                            /** display all users */

                            //display all users
                            // this is not good, use static methods and properties
                            // $user = new User();
                            //this is now turned to find_all - section 13 
                            // $result_set = $user->find_all_users();

                            // $result_set = $user->find_all();
                            // while($row = mysqli_fetch_array($result_set)) {
                            //     echo $row['username'] . "<br>";
                            // }
                            
                            //this is now turned to find_all - section 13
                            // $result_set = User::find_all_users();

                            // $result_set = User::find_all();
                            // while($row = mysqli_fetch_array($result_set)) {
                            //     echo $row['username'] . "<br>";
                            // }
                            
                            //this is now turned to find_all - section 13
                            // $users = User::find_all_users();

                            // $users = User::find_all();

                            // foreach($users as $user) {
                            //     echo $user->username . "<br>";
                            //     echo $user->id . "<br>";
                            // }

                            /** display user by id */

                            //display user by id given
                            //this is now turned to find_by_id - section 13
                            // $found_user = User::find_user_by_id(3);

                            // $found_user = User::find_by_id(3);
                            // echo $found_user["username"];

                            //this is now turned to find_by_id - section 13
                            // $found_user = User::find_user_by_id(3);

                            // $found_user = User::find_by_id(3);
                            // $user = new User();

                            // $user->id = $found_user['id'];
                            // $user->username = $found_user['username'];
                            // $user->password = $found_user['password'];
                            // $user->first_name = $found_user['first_name'];
                            // $user->last_name = $found_user['last_name'];

                            //echo $user->id;
                            //echo "<br>";

                            //this is now turned to find_by_id - section 13
                            // $found_user = User::find_user_by_id(3);

                            // $found_user = User::find_by_id(3);
                            // $user = User::instantiation($found_user);
                            // echo $user->username;
                            // echo "<br>";

                            //this is now turned to find_by_id - section 13
                            // $found_user = User::find_user_by_id(3);

                            // $found_user = User::find_by_id(3);
                            // echo $found_user->username;

                            //testing if picture.php is included in init.php
                            //$pictures = new Picture();

                        ?>

                        <?php
                        //create user
                        // $user = new User();

                        // $user->username = "Sudent";
                        // $user->password = "werwerwe";
                        // $user->first_name = "SOL";
                        // $user->last_name = "DOn'tknow";

                        // $user->create();
                        // ?>

                        <?php
                        //update user by id
                        // $user = User::find_user_by_id(9);
                        // $user->username = "David45";
                        // $user->password = "david1989";
                        // $user->first_name = "David";
                        // $user->last_name = "Williams";

                        // $user->update();

                        ?>

                        <?php
                        //delete user by id
                        // $user = User::find_user_by_id(6);
                        // $user->delete();
                        ?>

                        <?php
                        //create if user id does not exist, update if user id does exist
                        // $user = User::find_user_by_id(6);
                        // $user->password = "justpassword";
                        // $user->save();

                        // $user = new User();
                        // $user->username = "SUAVE";
                        // $user->save();
                        ?>

                        <?php

                        // $photos = Photo::find_all();

                        // foreach ($photos as $photo) {
                        //     echo $photo->title;
                        // }

                        ?>
                           
                        <?php

                        // $photos = Photo::find_by_id(18);
                        // echo $photos->filename;

                        ?>   

                        <?php
                        
                        // $photo = new Photo();

                        // $photo->title = "Just some test title";
                        // $photo->size = 20;

                        // $photo->create();

                        ?>

                        <?php
                            // echo INCLUDES_PATH;
                        ?>

                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-users fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo $session->count; ?></div>
                                                <div>New Views</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#">
                                        <div class="panel-footer">
                                        <span class="pull-left">View Details</span> 
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> 
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-photo fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Photo::count_all(); ?></div>
                                                <div>Photos</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="photos.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">Total Photos in Gallery</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo User::count_all(); ?></div>
                                                <div>Users</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="users.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">Total Users</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="fa fa-support fa-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge"><?php echo Comment::count_all(); ?></div>
                                                <div>Comments</div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="comments.php">
                                        <div class="panel-footer">
                                            <span class="pull-left">Total Comments</span>
                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>


                        </div> <!--First Row-->
                        
                        <div class="row">
                        <div id="piechart" style="width: 900px; height: 500px;"></div>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->