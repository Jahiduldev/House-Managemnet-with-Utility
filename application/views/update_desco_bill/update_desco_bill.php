<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Update DESCO Bill </b>
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
                                        <th>Account Number </th>
                    					<th>Meter Number</th>
                    					<th>Meter Name</th>
                    							
                    					<th>Payable Amount</th>
                    					<th>Late Amount</th>
                    					<th>Last Update</th>
                                        <th>Notes</th>
                                        <th>Action</th>
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
					                    $meter_nm = $row->meter_nm;
					                    $issue_date = $row->issue_date;
					                    $mont = $row->mont;
                                        $due_date = $row->due_date;
                                        $pre_unit = $row->pre_unit;
					                    $cur_unit = $row->cur_unit;
                                        $total_unit = $row->total_unit;
                                        $unit_rate = $row->unit_rate;
					                    $amount = $row->amount;
                                        $totalamount= $row->totalamount;
                                        $note= $row->note;
                                        $due_amount = $row->due_amount;
                                        $last_update = $row->last_update;
                                        $total_unit = $cur_unit-$pre_unit;
                                        
                                        $id = $row->id;
                                        $query_1 = $this->db->query("select * from add_house where id='$hid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $house_name = $row_add->house_name;	
											
                                        endforeach;
										
										
										 $status = $row->status;
										
					$query_1 = $this->db->query("select * from desco_meter where id='$relid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                        $name = $row_add->name;	
					$address = $row_add->address;	
$code= $row_add->code;	
                                        endforeach;
										
										
										
										
										
									
                                        ?>
                                        <tr class="gradeX">
					    <td><?php echo $mont; ?></td>
<td><?php echo  $code; ?></td>
                                            <td><?php echo $house_name; ?></td>
					     <td><?php echo $name; ?></td>
					   
					   <td><?php echo $bill_numebr;?></td>
                                            <td><?php echo $acct_number; ?></td>
                                            <td><?php echo $meter_number; ?></td>

                                            
											
											
<td><?php echo  $meter_nm; ?></td>

											 <td><?php echo  $due_amount; ?></td>
											 <td><?php echo  $totalamount; ?></td>
                                            <td><?php echo $last_update; ?></td>
<td><?php echo $note; ?></td>
                                            <td>
                                            <?php if($status!=0){ ?>    
                                                
                                                <button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$acct_number."asad".$meter_number."asad".$total_unit."asad".$code?>'); " 
											
								
											
											
											style="display:<?= $id ?>"
											>DESCO Bill Update</button>
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
                <h4 class="modal-title">Update DESCO Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('update_desco_bill/addPayment'); ?>">
             
			 
			 
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
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Space Code: </label>
                        <div class="col-lg-9">		
                                   
							<input type="text" class="form-control"  id="code12" name="code12"  readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Bill Number: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="bill_numebr" name="bill_numebr"  required>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="control-label col-md-3">Months Only</label>
                        <div class="col-md-9 col-xs-11">
							   
                            <input type="text"  class="form-control col-md-6 monthpickerdate" id="mont" name="mont" required onchangeDate="checkbillpayment(this.value)" value="<?php echo date('m/Y'); ?>" autofocus="off" readonly>
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
                             <input type="text" class="form-control"  id="pre_unit" name="pre_unit" onchange="calculatebill()">
                        </div>
                    </div>
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Current Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="cur_unit" name="cur_unit" onchange="calculatebill()"  >
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="total_unit" name=""  disabled >

                        </div>
                    </div>
					
					<div class="form-group">					
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Unit Rate: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="unit_rate" name="unit_rate"  onchange="calculatebill()" >
                        </div>
                    </div>	
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Unit Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="bill" name="bill" onchange="calculateamount()">

                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Demand Charge: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="loads" name="loads"  onchange="calculateamount()" >
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Vat: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="vat" name="vat"  onchange="calculateamount()" >
                        </div>
                    </div>					
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Monthly Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="amount" name="amount" onchange="calculateamount()">

                        </div>
                    </div>
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payable Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="due_amount" name="due_amount" onchange="calculateamount()">
                        </div>
                    </div>
					
		            <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Late Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="totalamount" name="totalamount">
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes </label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="note" name="note" ></textarea>
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

<script>

    
</script>

