<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Update TITAS Bill </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
					                    <th>Month</th>
                                        <th>Space Code</th>
					                       <th>House Name</th>
					                        <th>Bill Name</th>
                                      
                                         <th>Bill Number</th>
					                <th>TITAS ID</th>
					<th>Single burner Number</th>
                                        <th> Amount</th>
					<th>Double burner Number</th>
                                        <th> Amount </th>
					<th> Total Burner </th>
					<th> Total Amount </th>
					
                                        <th>Last Update</th>
                                     <th>Note</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $hid = $row->hid;
										
					$mont = $row->mont;
                                         $code= $row->code;
					$name = $row->name;
					$titas_id = $row->titas_id;
					$address = $row->address;
                                        $single = $row->single;
                                        $sin_amount = $row->sin_amount;
                                        $double = $row->doubles;
					$dob_amount = $row->dob_amount;
                                        $last_update = $row->last_update;
                                        $note = $row->note;
                                        $amount = $row->amount; 
									
										
					$query_1 = $this->db->query("select * from add_house where id='$hid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $house_name = $row_add->house_name;	
											
                                        endforeach;
									
                                        $status = $row->status;
                                        $id = $row->id;
                                       
                                        ?>
                                        <tr class="gradeX">
					                        <td><?php echo $mont; ?></td>
                                            <td><?php echo $code; ?></td>
                                            <td><?php echo $house_name; ?></td>
					                        <td><?php echo $name; ?></td>

                                            <td><?php  ?></td>
                                             <td><?php echo $titas_id;?></td>
                                            <td><?php echo $single ; ?></td>
                                            
                                            <td><?php echo $single*$sin_amount; ?></td>
                                            <td><?php echo $double; ?></td>
					                        <td><?php echo $double*$dob_amount; ?></td>
					                        <td><?php echo $single+$double; ?></td>
					
                                            <td><?php echo $amount; ?></td>
                                            
					                        <td><?php echo  $last_update; ?></td>
					                        <td><?php echo $note; ?></td>
                                             
                                            <td>
											<?php if($status!=0){ ?>  
												<button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name?>'); " 
											
											style="display:<?= $id ?>"
											>GAS Bill Update</button>
											<?php }else{ ?>
											 <button class="btn btn-primary btn-xs" disabled>Updated</button>
											 <?php } ?>
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
                <h4 class="modal-title">Update Titas Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('update_gas_bill/addPayment'); ?>">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">House: </label>
                        <div class="col-lg-9">		
                              
						<input type="text" class="form-control"  id="house_name" name="house_name"  readonly>
                        </div>

                    </div>
					
					
				    <div class="form-group">
                        <label class="control-label col-md-3">Months Only</label>
                        <div class="col-md-9 col-xs-11">
                        
                            <input type="text"  class="form-control col-md-6 monthpickerdate" id="mont" name="mont" required onchangeDate="checkbillpayment(this.value)" value="<?php echo date('m/Y'); ?>" autofocus="off" readonly>
						</div>
                    </div>
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Single burner Number </label>
                        <div class="col-lg-9">		
                                   
						<input type="text" class="form-control" value="0" id="single" name="single" onchange="calculate()" >
                        </div>

                    </div>
					
					
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Rate : </label>
                        <div class="col-lg-9">		
                                   
							<input type="text" class="form-control"  id="sin_amount" name="sin_amount" value="0"  onchange="calculate()">
                        </div>

                    </div>


					
					
					
					
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Single Amount : </label>
                        <div class="col-lg-9">		
                                   
									<input type="text" class="form-control" value="0" id="sintotal" name="sintotal"   onchange="calculate()">
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Double burner Number : </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control" value="0"  id="doubles" name="doubles"   onchange="calculate()">
                        </div>
                    </div>
					
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Rate:  </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control" value="0"  id="dob_amount" name="dob_amount" onchange="calculate()">

                        </div>
                    </div>
					
					

					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Double Amount :  </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"   id="dobtotal" name="ob_amount" onchange="calculate()">

                        </div>
                    </div>
					
					
                      <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total burner: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="totalburner" name=""  disabled>
<input type="hidden" class=""  id="totalburnerhide" name="totalburner">
                        </div>
                    </div>

                 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total Amount : </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="amount" name="amount"  >

                        </div>
                    </div>
					
					   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Note : </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="note" name="note" >
                        </div>
                    </div>
                    


                    <div class="form-group">
                        <div class="col-lg-offset-10 col-lg-2">
                            <button id="submitbtn" class="btn btn-success" type="submit">Submit</button>
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

