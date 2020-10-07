<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Update WASA Bill </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
					<th>Month</th>
					<th>House Name</th>
					<th>Bill Name</th>
                                        <th>Address</th>
					<th>Bill Number</th>
                                        <th>Account Number </th>
					<th>Meter Number</th>
                                   
					<th>Amount</th>
					<th>Fine Amount</th>
					<th>Last Update</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $hid = $row->hid;
											$relid = $row->relid;
                                        $acct_number = $row->acct_number;
                                        $meter_number = $row->meter_number;
                                        $bill_numebr = $row->bill_numebr;
										$mont = $row->mont;
										$issue_date = $row->issue_date;
                                        $due_date = $row->due_date;
                                        $pre_unit = $row->pre_unit;
										$cur_unit = $row->cur_unit;
                                        $total_unit = $row->total_unit;
                                        $unit_rate = $row->unit_rate;
										$amount = $row->amount;
                                        $due_amount = $row->due_amount;
                                        $last_update = $row->last_update;
									
                                       
                                      
                                        $id = $row->id;
                                        $query_1 = $this->db->query("select * from add_house where id='$hid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $house_name = $row_add->house_name;
                                            $address = $row_add->address;	
											
                                        endforeach;
										
										
												
										 $query_1 = $this->db->query("select * from wasa_meter where id='$relid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $name = $row_add->name;	
											 $address = $row_add->address;	
                                        endforeach;
										
										
										
										
										
                                        ?>
                                        <tr class="gradeX">
					    <td><?php echo $mont; ?></td>
                                            <td><?php echo $house_name; ?></td>
					    <td><?php echo $name; ?></td>
                                            <td><?php echo $address;?></td
					    <td><?php echo $bill_numebr;?></td>
                                            <td><?php echo $acct_number; ?></td>
                                            <td><?php echo $meter_number; ?></td>
                                        
											
											 <td><?php echo  $amount; ?></td>
											 <td><?php echo  $due_amount; ?></td>
                                            <td><?php echo $last_update; ?></td>
                                            <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$acct_number."asad".$meter_number?>'); " 
											
								
											
											
											style="display:<?= $id ?>"
											>WASA Bill Update</button>
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
                <h4 class="modal-title">Update DESCO Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('update_wasa_bill/addPayment'); ?>">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">House: </label>
                        <div class="col-lg-9">		
                              
						<input type="text" class="form-control"  id="hid" name="hid"  readonly>
                        </div>

                    </div>
					
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Account Number: </label>
                        <div class="col-lg-9">		
                                   
						<input type="text" class="form-control"  id="acct_number" name="acct_number"  readonly>
                        </div>

                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Meter Number: </label>
                        <div class="col-lg-9">		
                                   
									<input type="text" class="form-control"  id="meter_number" name="meter_number"  readonly>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Bill Number: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="bill_numebr" name="bill_numebr"  >
                        </div>
                    </div>
  <div class="form-group">
                                  <label class="control-label col-md-3">Months Only</label>
                                  <div class="col-md-3 col-xs-11">
                                      <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2018"  class="input-append date dpMonths">
                                          <input type="text" readonly="" size="16" class="form-control" id="mont" name="mont" >
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
                                              </span>
                                      </div>


                                      
                                  </div>
                              </div>
                  <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Issue Date: </label>
                        <div class="col-lg-9">
                             <input type="text" class="default-date-picker form-control"   id="issue_date" name="issue_date"  >
                        </div>
                    </div>
					
					   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due Date: </label>
                        <div class="col-lg-9">
                             <input type="text" class="default-date-picker form-control"  id="due_date" name="due_date" >
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Previous Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="pre_unit" name="pre_unit"  >
                        </div>
                    </div>
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Current Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="cur_unit" name="cur_unit"  >
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="total_unit" name=""  disabled>
                             <input type="hidden" class=""  id="total_unithide" name="total_unit">
                        </div>
                    </div>
					
					
					
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Unit Rete: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="unit_rate" name="unit_rate"  >
                        </div>
                    </div>
					
					
					
		     <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="amount" name="amount" >

                        </div>
                    </div>				
					
		    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="due_amount" name="due_amount">
                        </div>
                    </div>		

            <!--       <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="totalamount" name="amount"  disabled>
                        </div>
                    </div>		-->		
							
					
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes </label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="note" name="note" ></textarea>
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

<script src="<?php echo $base_url ?>public/js/jquery.js"></script>
<script src="<?php echo $base_url ?>public/js/bootstrap.min.js"></script>


<!-- modal -->

