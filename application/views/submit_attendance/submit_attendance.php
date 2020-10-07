<?php date_default_timezone_set("Asia/Thimbu"); ?>
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
	
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Submit Attendance
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="<?php echo site_url('submit_attendance/addAttendanceData');  ?>" enctype="multipart/form-data">
						
                                <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Attendance Type*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="att_type" name="att_type" required> <!-- input-sm m-bot15  -->
                                       <option value="">Choose one of the following attendance type</option>
                                       <option value="In">In</option>
									   <option value="Out">Out</option>
                                    </select>
                                </div>
                            </div>                           
                              <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Upload Image*</label>
                                <div class="col-lg-10">
                                    <input type="file"   name="userfile" size="20" required/>
                                </div>
                            </div>

                           <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Comments</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Comments" id="comments" name="comments"></textarea>
                                </div>
                            </div>
<!--<progress style="width:100%;display: none;"  id="progressbar" value="0" max="100"></progress>-->
                            <button type="submit"  class="btn btn-info pull-right">Submit</button>
                        </form>
                        <!--   <div class="loader col-lg-10"></div>-->
                    </div>
                </section>
            </div>
        </div>


    </section>
</section>
<!--main content end-->


