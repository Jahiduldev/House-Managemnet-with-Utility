<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
       

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        All Flat
                    </header>
                    <div class="panel-body">



                        <div class="adv-table">
                            <table class="display table table-bordered" id="editable-sample"> <!--hidden-table-info   -->
                                <thead>
                                    <tr>
                                     
                                        <th>House Name</th>
                                        <th>Floor</th>
                                  <th>Flat Name</th>
										 <th>Flat Code</th>
										  <th>Note</th> 
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
			<form action="<?php echo base_url(); ?>all_flat/update" method="post">
			<!-- Modal content-->
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Flat Update</h4>
			  </div>
			  <div class="modal-body" style="overflow:hidden">
				

					<div class="form-group">
						<label for="" class="col-sm-3 control-label align-right">House Name</label>
						<div class="col-sm-9">
                                                        <input type="hidden" class="form-control" id="hid"  name="hid" />
							<input type="text" class="form-control" id="hname"  name="hname" disabled />
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Floor Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="fname" name="fname" disabled />
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Flat Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="flname" name="flname" />
						</div>
					</div>
                                        <div class="form-group">
						<label for="" class="col-sm-3 control-label">Flat Code</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="flcode" name="flcode" />
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Note</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="flnote" name="flnote" />
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

