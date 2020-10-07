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
							<form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('payment_gas_bill/searchData') ?>">

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
                      <b style="color:blue;">  Payment GAS Bill </b>
                      <button class="btn btn-sm btn-default pull-right" onclick="gettableprint('hidden-table-info')">Print</button>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
									
									   <th>House Name</th>
									    <th>Month</th>
									    <th>Single Burner Number</th>
                                        <th>Single Amount </th>
										<th>Double Burner Number</th>
                                        <th>Double Amount </th>
                                        <th>Amount </th>
										<th>Last Update</th>
										<th>Note</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $single_tot =0;
									   $sin_amount_tot =0;
									   $doubles_tot =0;
									   $dob_amount_tot =0;
									   $amount_tot =0;
									   
                                    foreach ($project_data as $row) :
                                        $hid = $row->hid;
										 $house_name = $row->name;
                                        $single = $row->single;
                                        $doubles = $row->doubles;
										$mont = $row->mont;
                                        $sin_amount = $row->sin_amount;
										$dob_amount = $row->dob_amount;
										$amount =  $sin_amount+$dob_amount;
                                        $note = $row->note;
                                       
                                        $last_update = $row->last_update;
									    $id = $row->id;


 $query_1 = $this->db->query("select * from add_house where id='$hid'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $house_name = $row_add->house_name;	
											
                                        endforeach;

                                       $single_tot += $single;
									   $sin_amount_tot += $sin_amount;
									   $doubles_tot += $doubles;
									   $dob_amount_tot += $dob_amount;
									   $amount_tot += $amount;
                                       
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $house_name; ?></td>
											 <td><?php echo $mont; ?></td>
											<td><?php echo $single;?></td>
                                            <td><?php echo $sin_amount; ?></td>
											<td><?php echo $doubles; ?></td>
                                            <td><?php echo $dob_amount; ?></td>
                                            
										    <td><?php echo $amount; ?></td>
                                         
                                            <td><?php echo $last_update; ?></td>
                                            <td><?php echo $note; ?></td>
                                            
                                            
                                             <?php $ro = 	$this->session->userdata('role_id');
                                            
                                            if($ro== 1)
                                            {
                                            
                                            ?>
                                            
                                            <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$hid?>'); " 
										
										
											>Payment GAS Bill </button>
											<button class="btn btn-primary btn-xs" onclick="deletepayment(<?= $id ?>); ">Delete</button>
                                            </td>
                                             <?php } else { ?>
                                             <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$hid?>'); " 
										
										
											>Payment GAS Bill </button>
											
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
										<td colspan="2">Total</td>  
										<td><?php echo $single_tot; ?></td>
										<td><?php echo $sin_amount_tot; ?></td>
										<td><?php echo $doubles_tot; ?></td>
										<td><?php echo $dob_amount_tot; ?></td>
										<td><?php echo $amount_tot; ?></td>
										<td colspan="2"></td>
										 
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
                <h4 class="modal-title">Payment GAS Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('payment_gas_bill/addPayment'); ?>" enctype="multipart/form-data">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
					  <input type="hidden" class="form-control"  id="hidfinal" name="hidfinal"  >
					  
					 <input type="hidden" class="form-control"  id="unit_rate" name="unit_rate"  >
					 <input type="hidden" class="form-control"  id="pre_unit" name="pre_unit"  >
					 <input type="hidden" class="form-control"  id="cur_unit" name="cur_unit"  >
					 <input type="hidden" class="form-control"  id="total_unit" name="total_unit"  >
					 <input type="hidden" class="form-control"  id="issue_date" name="issue_date"  >
					 <input type="hidden" class="form-control"  id="due_date" name="due_date"  >
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">House: </label>
                        <div class="col-lg-9">		
                              
						<input type="text" class="form-control"  id="hid" name="hid"  readonly>
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
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Single Burner Number: </label>
                        <div class="col-lg-9">		
                                   
						<input type="text" class="form-control"  id="single" name="single"  readonly>
                        </div>

                    </div>
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due Amount: </label>
                        <div class="col-lg-9">		
                                   
									<input type="text" class="form-control"  id="sin_amount" name="sin_amount"  readonly>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Pay Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="sin_pay" name="sin_pay"  >
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Double Burner Number:</label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="doubles" name="doubles"  readonly>
                        </div>
                    </div>

                 
					
					 <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="dob_amount" name="dob_amount"  readonly>
                        </div>
                    </div>
					
					  <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Pay Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="dob_pay" name="dob_pay"  >
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
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Cheque/Trx Num:  </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="trx" name="trx"  >
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
                                    <input type="file" name="userfile" id="userfile" size="20" />
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



  <script src="<?php echo $base_url ?>public/js/jquery.js"></script>
  <script src="<?php echo $base_url ?>public/js/bootstrap.min.js"></script>


<script>


    function deletepayment(id){
        
       if(confirm('Confirn Delete Payment')){	
			$.ajax({
				type: "Post",
				url: "<?php echo site_url('payment_gas_bill/cancelpayment'); ?>",
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

