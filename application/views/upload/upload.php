<!DOCTYPE HTML>
<html>
    <head>
        <link href="<?php echo $base_url ?>public/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $base_url ?>public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
        <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
        <!-- External Editor -->
        <link href="<?php echo $base_url ?>public/assets/external-editor/editor.css" rel="stylesheet" />
        <!--right slidebar-->
        <link href="<?php echo $base_url ?>public/css/slidebars.css" rel="stylesheet">
        <!--toastr-->
        <link href="<?php echo $base_url ?>public/assets/toastr-master/toastr.css" rel="stylesheet" type="text/css" />
        <!-- Custom styles for this template -->
        <link href="<?php echo $base_url ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo $base_url ?>public/css/style-responsive.css" rel="stylesheet" />
        <title>Jolshiri</title>
    </head>
    <body>
    <section id="container" >
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="<?php echo site_url('dashboard');  ?>" class="logo">Jol<span>shiri</span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">6</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 6 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Dashboard v1.3</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Database Update</div>
                                        <div class="percent">60%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Iphone Development</div>
                                        <div class="percent">87%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 87%">
                                            <span class="sr-only">87% Complete</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Mobile App</div>
                                        <div class="percent">33%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 33%">
                                            <span class="sr-only">33% Complete (danger)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info">
                                        <div class="desc">Dashboard v1.3</div>
                                        <div class="percent">45%</div>
                                    </div>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                            <span class="sr-only">45% Complete</span>
                                        </div>
                                    </div>

                                </a>
                            </li>
                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-important">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-red"></div>
                            <li>
                                <p class="red">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini.jpg"></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini2.jpg"></span>
                                    <span class="subject">
                                        <span class="from">Jhon Doe</span>
                                        <span class="time">10 mins</span>
                                    </span>
                                    <span class="message">
                                        Hi, Jhon Doe Bhai how are you ?
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini3.jpg"></span>
                                    <span class="subject">
                                        <span class="from">Jason Stathum</span>
                                        <span class="time">3 hrs</span>
                                    </span>
                                    <span class="message">
                                        This is awesome dashboard.
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar" src="./img/avatar-mini4.jpg"></span>
                                    <span class="subject">
                                        <span class="from">Jondi Rose</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is metrolab
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <i class="fa fa-bell-o"></i>
                            <span class="badge bg-warning">7</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <div class="notify-arrow notify-arrow-yellow"></div>
                            <li>
                                <p class="yellow">You have 7 new notifications</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    Server #3 overloaded.
                                    <span class="small italic">34 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-warning"><i class="fa fa-bell"></i></span>
                                    Server #10 not respoding.
                                    <span class="small italic">1 Hours</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                                    Database overloaded 24%.
                                    <span class="small italic">4 hrs</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-success"><i class="fa fa-plus"></i></span>
                                    New user registered.
                                    <span class="small italic">Just now</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-info"><i class="fa fa-bullhorn"></i></span>
                                    Application error.
                                    <span class="small italic">10 mins</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">See all notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username"><?=$this->session->userdata('user_name');?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                            <li><a href="<?php echo site_url('home/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <li class="sb-toggle-right">
                        <i class="fa  fa-align-right"></i>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar"  class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">

                    <?php
                    $role_id= $this->session->userdata('role_id');
                    $queryPermission = $this->db->query("SELECT * FROM permission WHERE role_id='$role_id' GROUP BY menu_id");

                    foreach ($queryPermission->result() as $rowPermission) {
                        $menu_id=$rowPermission->menu_id;
                        $queryMenu = $this->db->query("SELECT * FROM menu WHERE menu_id='$menu_id'");
                        foreach ($queryMenu->result() as $rowMenu) {
                            $menu_name=$rowMenu->menu_name;
                            $menu_icon=$rowMenu->menu_icon;
                        }
                        ?>

                    <li class="sub-menu">
                        <a href="javascript:;" <?php if($active_menu=="$menu_name") {
                                echo 'class="active"';
                               }  ?>>
                            <i class="<?php echo $menu_icon; ?>"></i>

                            <span><?php echo $menu_name; ?></span>
                        </a>

                        <ul class="sub">
                                <?php

                                $queryPermissionSubMenu = $this->db->query("SELECT * FROM permission WHERE role_id='$role_id' AND menu_id='$menu_id'");
                                foreach ($queryPermissionSubMenu->result() as $row) {
                                    $sub_menu_id=$row->sub_menu_id;
                                    $querySubMenu = $this->db->query("SELECT * FROM subs_menu WHERE sub_menu_id='$sub_menu_id'");
                                    foreach ($querySubMenu->result() as $row) {
                                        $url=$row->url;
                                        $sub_menu_name=$row->sub_menu_name;

                                        ?>
                            <li <?php if($active_sub_menu=="$sub_menu_name") {
                                            echo 'class="active"';
                                            }  ?>><a href="<?php echo site_url($url); ?>"><?php echo $sub_menu_name; ?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                        </ul>

                    </li>

                        <?php
                    }
                    ?>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper site-min-height">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm" onsubmit="return test()"  role="form" method="post"  action="<?php echo site_url('upload/uploadData');?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Category</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="select_cat" id="select_cat" onchange="getYouTube(this.value)"> <!-- input-sm m-bot15  -->
                                        <option value="">Choose Your Gallery</option>
                                        <option value="1">Slide Gallery</option>
                                        <option value="2">Picture Gallery</option>
                                        <option value="3">Video Gallery</option>
                                        <option value="4">You Tube Video Gallery</option>
                                        <option value="5">Animation  Gallery</option>
                                        <option value="6">Publication  Gallery</option>
										<option value="7">Home Page Image</option>
                                        <option value="8">Animation Video Gallery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="recent_album_div" style="display: none;">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Recent Album Title </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="recent_album_title" id="recent_album_title"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Folder</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="select_sub_folder" id="select_sub_folder" onchange="getTableData(this.value)"> <!-- input-sm m-bot15  -->
                                        <option value="">Choose Your Folder</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="youtube_div" style="display: none;">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">You Tube Embbed </label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="youtube" id="youtube"  />
                                </div>
                            </div>
                            <div class="form-group" id="upload_div">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Upload </label>
                                <div class="col-lg-10">
                                    <input type="file" name="userfile" id="userfile" size="20" />
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                 <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Editor </label>
                                 <div class="col-lg-10">
                                     <textarea id="txtEditor" name="txtEditor"></textarea>
                                 </div>
                             </div>-->
                            <div class="form-group">
                                <input type="submit"  class="col-lg-offset-2" value="upload" />
                            </div>

                        </form>
                    </div>               
                </div>
                <hr><hr>
                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Delete Upload
                                <span class="tools pull-right">
                                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                                    <a href="javascript:;" class="fa fa-times"></a>
                                </span>
                            </header>
                            <div class="panel-body">
                                <div class="adv-table">
                                    <table class="display table table-bordered" id="hidden-table-info">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Folder</th>
                                                <th>File Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tdata">

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </section>
        </section>
        <!--main content end-->
    </section>

    <!-- Modal -->
    <div class="modal fade" id="myModalDeleteFile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete File Confirmation</h4>
                </div>

                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('upload/deleteFile');  ?>">
                        <input type="hidden" id="file_id" name="file_id"/>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <h5>Do You Want To Delete This File?</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-success pull-right" type="submit">Yes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModalDeleteFolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Folder Confirmation</h4>
                </div>

                <div class="modal-body">
                    <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('upload/deleteFolder');  ?>">
                        <input type="hidden" id="folder_id" name="folder_id"/>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <h5>Do You Want To Delete This Folder?</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn btn-success pull-right" type="submit">Yes</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- modal -->




    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $base_url ?>public/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>public/js/bootstrap.min.js"></script>
      <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
   <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
    <!-- External Editor -->
    <script src="<?php echo $base_url ?>public/assets/external-editor/editor.js"></script>

    <script class="include" type="text/javascript" src="<?php echo $base_url ?>public/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo $base_url ?>public/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo $base_url ?>public/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!--right slidebar-->
    <script src="<?php echo $base_url ?>public/js/slidebars.min.js"></script>

    <!--toastr-->
    <script src="<?php echo $base_url ?>public/assets/toastr-master/toastr.js"></script>

    <!--common script for all pages-->
    <script src="<?php echo $base_url ?>public/js/common-scripts.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            $("#txtEditor").Editor();

        });
        function test(){
            var text= $("#txtEditor") .data("editor").html();
            $("#txtEditor").val(text);
            return true;
        }

        function getYouTube(id){
            getSubFolder(id);
            if(id == 4 || id==8){
                $("#youtube_div").css("display","block");
                $("#upload_div").css("display","none");
                $("#userfile").val("");
                 $("#recent_album_div").css("display","block"); 

            }else if(id == 2 || id == 3 || id == 4 || id == 6){
                 $("#recent_album_div").css("display","block"); 
            }else{
                 $("#recent_album_div").css("display","none");
                $("#upload_div").css("display","block");
                $("#youtube_div").css("display","none");
                $("#youtube").val("");
            }
        }

        function getSubFolder(cat_id){
            var cat_id=cat_id;
            $.ajax({
                type: "Post",
                url: "<?php echo site_url('upload/getSubFolder');  ?>",
                data: {'cat_id':cat_id} ,
                success: function(data) {

                    $('#select_sub_folder').html(data);
                }
            });
        }


        function getTableData(folder_id){
            var folder_id=folder_id;
            $.ajax({
                type: "Post",
                url: "<?php echo site_url('upload/getTableData');  ?>",
                data: {'folder_id':folder_id} ,
                success: function(data) {
                    $('#tdata').html(data);
                }
            });
        }

        function deleteFile(id){
            $("#file_id").val(id);
            $("#myModalDeleteFile").modal()
        }

        function deleteFolder(id){
            $("#folder_id").val(id);
            $("#myModalDeleteFolder").modal()
        }

    </script>


    <script type="text/javascript">
        $(function() {
            var title="<?php echo $this->session->userdata('msg_title'); ?>";
            // alert(title);
            if(title !=""){
                var msg_title="<?php echo $this->session->userdata('msg_title'); ?>";
                var msg_body="<?php echo $this->session->userdata('msg_body'); ?>";
                var msg_type='';
                if(msg_title=='Success'){
                    msg_type='success';
                }else if(msg_title=='Error'){
                    msg_type='error';
                }else if(msg_title=='Warning'){
                    msg_type='warning';
                }
                else{
                    msg_type='info';
                }
                toastr[msg_type](msg_body, msg_title);
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
            }

        });
    </script>
</body>
</html>
