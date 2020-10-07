<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Add House </b>
                    </header>
                    <div class="panel-body" style="background:#008B8B;color:white; ">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('add_house/addCompanyData'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">House Name <span style="color:red">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter House Name" id="company_name" name="house_name" required="required">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">House Code <span style="color:red">*</span></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter House Code" id="company_name" name="house_code" required="required">
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee <span style="color:red">*</span></label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="emp" name="emp" required="required">
									
										<option value="">Select Employee</option>
										<?php foreach($employee as $emp){
										    
											echo '<option value="'.$emp->id.'">'.$emp->emp_name.'</option>';
										} ?>
									</select>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">House Address</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter House Address" id="company_address" name="house_address"></textarea>
                                </div>
                            </div>
							  <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Notes</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Notes" id="company_address" name="notes"></textarea>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">House  Image</label>
                                <div class="col-lg-10">
                                    <input type="file" name="userfile" id="userfile" size="20" />
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




