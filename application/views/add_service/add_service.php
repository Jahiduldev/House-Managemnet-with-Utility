<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                   
					<header class="panel-heading">
                      <b style="color:blue;">   Add Serive/Complain </b>
                    </header>
                     <div class="panel-body" style="background:#008B8B;color:white; ">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('add_service/addCompanyData'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Serive/Complain*</label>
                                <div class="col-lg-10">
                                  <select name="com_type" class="form-control" required>
									<option value=""> Select Serive/Complain</option>
									 
									  <?php $complain=''; foreach($complain_type_data as $hl){ 
									  
											$complain .= '<option value="'. $hl->id .'">'. $hl->complain .'</option>';
										} echo $complain; ?>
									  </select> 
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Notes*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Notes" id="client_note" name="client_note" required></textarea>
                                </div>
                            </div>
                        
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Complain  Image</label>
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


