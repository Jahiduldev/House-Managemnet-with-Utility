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
						<form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('payment_desco_authorization/searchData') ?>">

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
                      <b style="color:blue;">  Payment DESCO Authorization </b>
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
<td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."asad".$house_name."asad".$acct_number."asad".$meter_number."asad".$hid."asad".$code?>'); ">Authorization </button>
											
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
                <h4 class="modal-title">Payment DESCO Bill Authorization</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('payment_desco_authorization/addPayment'); ?>" enctype="multipart/form-data">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
					  <input type="hidden" class="form-control"  id="hidfinal" name="hidfinal"  >
					  
				
					
					
                              
					
                    
					
					
			

                    <div class="form-group">
                        <div class="col-lg-offset-6 col-lg-6">
                            <button class="btn btn-success" type="submit">Authorization</button>
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
				url: "<?php echo site_url('payment_desco_authorization/cancelpayment'); ?>",
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

