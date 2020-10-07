<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Client Operation </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
									
									   <th>Client Code</th>
									    <th>Rent Code</th><th>Book Date</th><th>Live Date</th>
                                        <th>Client </th>
										<th>Mobile</th>
                                        <th>Advance Amount  </th>
                                        <th>Gender </th>
                                 
										<th>Status </th>
                                    
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $client_id = $row->client_id;
                                        $code = $row->code; $date= $row->date;$operation_date= $row->operation_date;
                                        $client_name = $row->client_name;
                                        $mobile_number = $row->mobile_number;
                                        $advance = $row->advance;
										$gender = $row->gender;
										$status = $row->status;
										if($status==1)
										{
											$sta = 'Live';
										}
										else if($status==2)
										{
											$sta = 'Booked Rent';
										}
										else if($status==3)
										{
											$sta = 'Leave';
										}
										else if($status==4)
										{
											$sta = 'Leave Request';
										}
                                        $id = $row->id;
                                        
								
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $client_id; ?></td>
                                            <td><?php echo $code; ?></td><td><?php echo $date; ?></td><td><?php echo $operation_date; ?></td>
                                            <td><?php echo $client_name; ?></td>
                                            <td><?php echo $mobile_number;?></td>
											 <td><?php echo  $advance; ?></td>
                                            <td><?php echo  $gender; ?></td>
											 <td><?php echo  $sta; ?></td>
											 
                                         
                                          <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id?>'); " 
                                          

										
											>Action</button>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
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

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Client Operation</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('client_operation/addPayment'); ?>">
                     
					 <input type="hidden" class="form-control"  id="id" name="id" >
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client id: </label>
                        <div class="col-lg-9">		
                              
						<input type="text" class="form-control"  id="client_id" name="client_id"  readonly>
                        </div>

                    </div>
					
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Rent Code: </label>
                        <div class="col-lg-9">		
                                   
						<input type="text" class="form-control"  id="code" name="code"  readonly>
                        </div>

                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Client Name: </label>
                        <div class="col-lg-9">		
                        <input type="text" class="form-control"  id="client_name" name="client_name"  readonly>
                        </div>
                    </div>
                   
				 


                      <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Select Client Status *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="status" id="status" required="required">
                                <option value="">Select Client Status </option>
                                <option id="checklive" value="1">Live</option>
                                <option id="checkbooked" value="2">Booked Rent</option>
				<option id="checkleaverequ" value="4">Leave Request</option>
                                <option id="checkleave" value="3">Leave</option>
                            </select>
                        </div>
                    </div>

             
					
		   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Opetation  Date:* </label>
                        <div class="col-lg-9">
                          <input type="text" class="default-date-picker form-control" placeholder="Enter Operation Date " id="operation_date"  name="operation_date" required>
                        </div>
                    </div>
					
					   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="notes" name="notes" >
                        </div>
                    </div>
                    
              
					
					
				
					
                 


                    <div class="form-group">
                        <div class="col-lg-offset-10 col-lg-2">
                            <button class="btn btn-success" type="submit">Submit</button>
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
<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="<?= site_url('view_customer/deleteModel') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Model Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Model?
                    <input type="hidden" id="delete_id" name="delete_id" />
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="submit">Yes</button>
                    <button data-dismiss="modal" class="btn btn-default" type="button">No</button>
                </div>
            </div>
        </form>
    </div>
</div>




<!-- modal -->

