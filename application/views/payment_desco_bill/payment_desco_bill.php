<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">Select House</b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
						
						<div class="form-group">
						<form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('payment_desco_bill/searchData') ?>">

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">From Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" value="<?php if(isset($dtfrm)){ echo $dtfrm; } ?>" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from" >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">To Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" value="<?php if(isset($dtrto)){ echo $dtrto; } ?>" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"  >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">House  *</label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="desco_meter" id="desco_meter" >
                                                <option value="">Select House</option>
                                                <?php
                                                foreach ($houses as $row) :
                                                    ?>
                                                <option value="<?=$row->id;?>" <?php if(isset($house) && $house==$row->id){ echo ' selected'; } ?>><?=$row->house_name; ?></option>
                                                <?php endforeach;  ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- <button type="submit" name="submitDate" class="btn btn-info pull-right" onclick="getDateSearch()">Submit</button> -->
                                    
                                    <input type="submit" name="details" class="btn btn-info pull-right" value="Details">
                                    <!-- <input type="submit" name="summary" class="btn btn-info pull-right" value="Summary"> -->
                                </form>
						</div>
						
					</div>
				</section>
			</div>
		</div>

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Payment DESCO Bill </b>
                      <button class="btn btn-sm btn-default pull-right" onclick="gettableprint('hidden-table-info')">Print</button>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Space Code</th>
									    <th>House Name</th>
									    <th>Bill Name</th>
									    <th>Bill Number</th>
                                        <th>Account Number </th>
										<th>Meter Number</th>
										<th>Month</th>
                                        <th>Issue Date </th>
                                        <th>Due Date</th>
										<th>Payable Amount</th>
										<th>Late Amount</th>
										<th>Last Update</th>
										<th>Note</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php  $totalamount_tot = 0; $due_amount_tot = 0;
                                    
                                    foreach ($project_data as $row) :
                                        
                                        $hid = $row->hid;
                                        $relid = $row->relid;
                                        $acct_number = $row->acct_number;
                                        $totalamount= $row->totalamount;
                                        $meter_number = $row->meter_number;
                                        $bill_numebr = $row->bill_numebr;
										$issue_date = $row->issue_date;
                                        $due_date = $row->due_date;
                                        $pre_unit = $row->pre_unit;
										$cur_unit = $row->cur_unit;
                                        $total_unit = $row->total_unit;
                                        $unit_rate = $row->unit_rate;
										$amount = $row->amount;
                                        $due_amount = $row->due_amount;
                                        $last_update = $row->last_update;
									    $mont = $row->mont;
                                       
                                        $id = $row->id;
                                        $query_1 = $this->db->query("select * from add_house where id='$hid'");
                                        
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $house_name = $row_add->house_name;	
											
                                        endforeach;


                                        $query_1 = $this->db->query("select * from desco_meter where id='$relid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $name = $row_add->name;	
					                        $address = $row_add->address;	
                                            $code= $row_add->code;	
                                        endforeach;

                                        $note = $row->note;

										    $d = date('Y-m-d');

                                        if($d>=$due_date) {
                                            
    									   $color= 'red';
    								    }else{
    								        
    									 $color= 'blue';
    									}

										   
									  $due_amount_tot +=$due_amount;
									  $totalamount_tot +=$totalamount;

                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $code; ?></td>
                                            <td><?php echo $house_name; ?></td>
                                            <td><?php echo $name; ?></td>
											<td><?php echo $bill_numebr;?></td>
                                            <td><?php echo $acct_number; ?></td>
                                            <td><?php echo $meter_number; ?></td>
                                            <td><?php echo $mont; ?></td>
											<td><?php echo  $issue_date; ?></td>
                                            <td style = "color:<?=$color?>;"><?php echo  $due_date; ?></td>
											<td><?php echo  $due_amount; ?></td>
											<td><?php echo  $totalamount; ?></td>
                                            <td><?php echo $last_update; ?></td>
                                            <td><?php echo $note; ?></td>
                                            
                                            <?php $ro = 	$this->session->userdata('role_id');
                                            
                                            if($ro== 1)
                                            {
                                            
                                            ?>
<td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$acct_number."asad".$meter_number."asad".$hid."asad".$code?>'); ">Payment DESCO Bill </button>
											<button class="btn btn-primary btn-xs" onclick="deletepayment(<?= $id ?>); ">Delete</button>
                                            </td>
                                            <?php } else { ?>
                                            <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$acct_number."asad".$meter_number."asad".$hid."asad".$code?>'); ">Payment DESCO Bill </button>
									
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
									
																	
                                </tbody>
                                <tfoot>
                                     <tr style="font-weight:bold">	
									
										 <td></td> 
										<td colspan="9">Total</td>                                           
										<td><?php echo $due_amount_tot; ?></td>
										<td><?php echo $totalamount_tot; ?></td>
										<td colspan="3"></td>
										 
									</tr>
                                </tfoot>
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
                <h4 class="modal-title">Payment DESCO Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('payment_desco_bill/addPayment'); ?>" enctype="multipart/form-data">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
					  <input type="hidden" class="form-control"  id="hidfinal" name="hidfinal"  >
					  
				
					
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
                             <input type="text" class="form-control"  id="bill_numebr" name="bill_numebr"  readonly>
                        </div>
                    </div>
                               <div class="form-group">
                                  <label class="control-label col-md-3">Months Only</label>
                                  <div class="col-md-3 col-xs-11">
                                      <div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2018"  class="input-append date dpMonths">
                                          <input type="text" readonly="" size="16" class="form-control" id="mont" name="mont" readonly>
                                              <span class="input-group-btn add-on">
                                                <button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
                                              </span>
                                      </div>


                                      
                                  </div>
                              </div>
                  <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Issue Date: </label>
                        <div class="col-lg-9">
                             <input type="text" class="default-date-picker form-control"   id="issue_date" name="issue_date"  readonly>
                        </div>
                    </div>
					
					   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due Date: </label>
                        <div class="col-lg-9">
                             <input type="text" class="default-date-picker form-control"  id="due_date" name="due_date" readonly>
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Previous Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="pre_unit" name="pre_unit"  readonly>
                        </div>
                    </div>
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Current Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="cur_unit" name="cur_unit"  readonly>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="total_unit" name="total_unit"  readonly>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Demand Charge: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="loads" name="loads"  readonly>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Vat: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="vat" name="vat"  readonly>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Unit Rete: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="unit_rate" name="unit_rate"  readonly>
                        </div>
                    </div>
					
					
					
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="amount" name="amount"  readonly>
                        </div>
                    </div>
					
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="due_amount" name="due_amount"  readonly>
                        </div>
                    </div>
					
					
					

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payment Mode *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="payment_type" id="payment_type" required="required">
                                <option value="">Select Payment Option</option>
                                <option value="Cash">Cash</option>
                                <option value="bKash">bKash</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Cheque/Trx Num: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="trx" name="trx"  >
                        </div>
                    </div>

					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payment Amount :* </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="payment_amount" name="payment_amount"  required>
                        </div>
                    </div>
					
						 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payment  Date:* </label>
                        <div class="col-lg-9">
                          <input type="text" class="default-date-picker form-control" placeholder="Enter Payment Date " id="payment_date"  name="payment_date" required>
                        </div>
                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3"> Voucher</label>
                        <div class="col-lg-9">
                            <input type="file" name="userfile" id="userfile" />
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


<script>


    function deletepayment(id){
        
       if(confirm('Confirn Delete Payment')){	
			$.ajax({
				type: "Post",
				url: "<?php echo site_url('payment_desco_bill/cancelpayment'); ?>",
				data: {'id':id } ,
				success: function (data) {
					
					alert(data);
					location.reload();
				}
				
			});
		}
        
    }

    var tablehead = '<table class="table table-bordered">';

	function gettableprint(id){
		
		$('#'+id+' th:first-child').remove();
		$('#'+id+' th:last-child').remove();
		
		$('#'+id+' td:first-child').remove();
		$('#'+id+' td:last-child').remove();
		
		var tabledata = $('#'+id).html();
	 
		tabledata = tablehead+tabledata+'</table>';
		$('body').html(tabledata);	
		window.print();
	    location.reload();
	}
</script>

