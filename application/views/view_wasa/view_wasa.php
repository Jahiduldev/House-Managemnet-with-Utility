<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Update WASA Meter </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
									   <th> House</th>
									   <th> Name</th>
									   
                                        <th>Account Number </th>
										<th>Meter Number</th>
										 <th>Address</th>
                                        
                                        <th>Notes </th>
									
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $hid = $row->hid;
                                        $acct_number = $row->acct_number;
                                        $meter_number = $row->meter_number;
                                        $name = $row->name;
										$address = $row->address;
										$notes = $row->notes;
									
									   
                                        $id = $row->id;
										
                                        $query_1 = $this->db->query("select * from add_house where id='$hid' ");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $housename = $row_add->house_name;	
											
                                        endforeach;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $housename; ?></td>
											<td><?php echo $name; ?></td>
											
                                            <td><?php echo $acct_number; ?></td>
                                            <td><?php echo $meter_number; ?></td>
                                      
											
											 <td><?php echo  $address; ?></td>
											  <td><?php echo  $notes; ?></td>
                                          
                                            <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."-"?>'); " 
											
								
											
											
											style="display:<?= $id ?>"
											>Update WASA Meter</button>
                                            </td>
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
                <h4 class="modal-title">Update WASA Meter</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('view_wasa/addPayment'); ?>">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">House: </label>
                        <div class="col-lg-9">		
                              
						<input type="text" class="form-control"  id="name" name="name"  >
                        </div>

                    </div>
					
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Account Number: </label>
                        <div class="col-lg-9">		
                                   
						<input type="text" class="form-control"  id="acct_number" name="acct_number"  >
                        </div>

                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Meter Number: </label>
                        <div class="col-lg-9">		
                                   
									<input type="text" class="form-control"  id="meter_number" name="meter_number"  >
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Address: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="address" name="address"  >
                        </div>
                    </div>
                     
					
					
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes </label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="notes" name="notes" ></textarea>
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

