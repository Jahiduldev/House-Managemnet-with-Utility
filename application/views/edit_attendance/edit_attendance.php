<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Attendance
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="<?php echo site_url('shop_wise_report/editAttendanceData');  ?>" enctype="multipart/form-data">
                            <?php
                            foreach ($get_attendance_data as $row) :
                                $id= $row->id;
                                $image= $row->image;
                                $comments= $row->comments;                            
                                $date_time= $row->date_time;
                                $att_type= $row->att_type;
								
								$image_out= $row->image_out;
                                $comments_out= $row->comments_out;                            
                                $date_time_out= $row->date_time_out;
                                $att_type_out= $row->att_type_out;
                            endforeach;
                            ?>
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Attendance Type</label>
                                <div class="col-lg-10">
								
                                    <input type="text" class="form-control" placeholder="Attendance Type" id="att_type"  name="att_type" value="<?=$att_type?>" readonly>
                                </div>
                            </div>
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date Time</label>
                                <div class="col-lg-10">
								<input type="hidden" name="id" value="<?=$id?>"   />
                                    <input type="text" class="form_datetime form-control" placeholder="Entery Time" id="entry_time"  name="entry_time" value="<?=$date_time?>">
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Upload Image</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-6">
								<img src="<?php echo  $base_url."/public/uploads/attendance/".$image;  ?>" class="img-rounded" width="100%" height="auto"  />
								</div>
								 <div class="col-lg-6">
                                    <input type="file" name="userfile" size="20" />
									</div>
                                </div>
                            </div>

                           <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Comments</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Comments" id="comments" name="comments"><?=$comments?></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Attendance Type</label>
                                <div class="col-lg-10">
								
                                    <input type="text" class="form-control" placeholder="Attendance Type" id="att_type_out"  name="att_type_out" value="<?=$att_type_out?>" readonly>
                                </div>
                            </div>
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date Time</label>
                                <div class="col-lg-10">
								<input type="hidden" name="id" value="<?=$id?>"   />
                                    <input type="text" class="form_datetime form-control" placeholder="Entery Time" id="exit_time"  name="exit_time" value="<?=$date_time_out?>">
                                </div>
                            </div>
                           <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Upload Image</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-6">
								<img src="<?php echo  $base_url."/public/uploads/attendance/".$image_out;  ?>" class="img-rounded" width="100%" height="auto"  />
								</div>
								 <div class="col-lg-6">
                                    <input type="file" name="userfile_out" size="20" />
									</div>
                                </div>
                            </div>

                           <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Comments</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Comments" id="comments_out" name="comments_out"><?=$comments_out?></textarea>
                                </div>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>


    </section>
</section>
<!--main content end-->


