<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
       

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        All House
                    </header>
                    <div class="panel-body">



                        <div class="adv-table">
                            <table class="display table table-bordered" id="editable-sample"> <!--hidden-table-info   -->
                                <thead>
                                    <tr>
                                     
                                        <th>House Name</th>
                                        <th>House Code</th>
<th>Employee</th>
                                        <th>Address</th>
                                        <th>Note</th>
                                        <th>Image</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </section>
            </div>
        </div>

		
		
		
		<div id="houseModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<form action="<?php echo base_url(); ?>all_houses/update" method="post" enctype="multipart/form-data">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">House Update</h4>
			  </div>
			  <div class="modal-body" style="overflow:hidden">
				

					<div class="form-group">
						<label for="" class="col-sm-3 control-label align-right">House Name</label>
						<div class="col-sm-9">
                                                        <input type="hidden" class="form-control" id="hid"  name="hid" />
							<input type="text" class="form-control" id="hname"  name="hname" />
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">House Code</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="hcode" name="hcode"/>
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Employee <span style="color:red">*</span></label>
						<div class="col-lg-9">
							<select class="form-control" id="emp" name="emp" required="required">									
								<option value="">Select Employee</option>
								<?php foreach($employee as $emp){
									
									echo '<option value="'.$emp->id.'">'.$emp->emp_name.'</option>';
								} ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Adress</label>
						<div class="col-sm-9">
							<textarea  class="form-control" id="address" name="address"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Note</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="hnote" name="hnote"/>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Image</label>
						<div class="col-sm-9">
							<!-- <img  src=" id="imgg" "  height="100" width="100"> -->
							<!-- <input type="text" class="form-control" id="imgg" name="hnote"/> -->
							<img src=""  width="20%" id="imgg">
							<input type="file" name="userfile" id="userfile" size="20" />
                                                            </span>
						</div>
					</div>
									
			  </div>
			  <div class="modal-footer">
				<input type="submit" class="btn btn-default" value="Update">
			  </div>
			</div>
			</form> 
		  </div>
		</div>


    </section>
</section>
<!--main content end-->

