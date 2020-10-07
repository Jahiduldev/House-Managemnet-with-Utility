<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  Bill Payment </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
									
									   <th>Client Code</th>
									    <th>Rent Code</th>
                                        <th>Client </th>
										<th>Mobile</th>
										<th>Month</th>
                                        <th>Rent  </th>
                                        <th>Electric </th>
                                        <th>Gas </th>
										<th>Water </th>
                                        <th>Service </th>
										<th>Garage </th>
										<th>Monthly </th>
										<th><span style="color:red">Late Fee </span></th>
										<th>Due Amount </th>
										<th>Total </th>
										<th>Last Update</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $client_id = $row->client_id;
                                        $code = $row->code;
										$hid = $row->house;
                                        $client_name = $row->client_name;
                                        $mobile_number = $row->mobile_number;
                                        $bill_status = $row->bill_status;
										$mont = $row->mont;
                                        $id = $row->id;
                                        $query_1 = $this->db->query("select * from bill where clinet_id='$id'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $bill_id = $row_add->bill_id;	
											if($bill_id==1)
											{
					                        $rent = $row_add->amount;
											}
											else if($bill_id==2)
											{
												 $elec = $row_add->amount;
											}
                                            else if($bill_id==3)
											{
												 $gas = $row_add->amount;
											}	
                                             else if($bill_id==4)
											{
												 $water = $row_add->amount;
											}	
                                             else if($bill_id==5)
											{
												 $service = $row_add->amount;
											}	
                                             else if($bill_id==6)
											{
												 $garage = $row_add->amount;
											}	
                                             else if($bill_id==7)
											{
												 $da = $row_add->amount;
											}
                                             else if($bill_id==8)
											{
												 $pu = $row_add->amount;
											}
                                            else if($bill_id==9)
											{
												 $cu = $row_add->amount;
											}											
											$datetime = $row_add->datetime;
											  
											   
                                        endforeach;
										$d = date('Y-m-d');
										$d1 = date('Y-m-16');
										$d2 = date('Y-m-20');
										$d3 = date('Y-m-21');
								       if($d>=$d1 && $d<=$d2)
									   {
										   $latefee = '200';
										   
									   }
									   else if( $d>=$d3 )
									   {
										    $latefee = '500';
										   
									   }
									   else
									   {
										    $latefee = '0';
									   }
										$total = $rent +  $elec + $gas +  $water + $service+$garage+$da+$latefee ;
										$monthly = $rent +  $elec + $gas +  $water + $service+$garage;
									
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $client_id; ?></td>
                                            <td><?php echo $code; ?></td>
                                            <td><?php echo $client_name; ?></td>
                                            <td><?php echo $mobile_number;?></td>
											<td><?php echo $mont;?></td>
											<td><?php echo $rent; ?></td>
                                            <td><?php echo $elec; ?></td>
											<td><?php echo $gas; ?></td>
											<td><?php echo  $water; ?></td>
                                            <td><?php echo  $service; ?></td>
											<td><?php echo $garage; ?></td>
											<td><?php echo $monthly; ?></td>
											<td><span style="color:red"><?php echo $latefee; ?></span></td>
											<td><?php echo $da; ?></td>
											<td><?php echo  $total; ?></td>
                                            <td><?php echo $datetime; ?></td>
                                          <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."-".$rent."-".$elec."-".$gas."-".$water."-".$service."-".$total."-".$garage."-".$pu."-".$cu."-".$da."-".$mont."-".$hid."-".$latefee."-".$monthly ?>'); "                                           
											>Bill Payment</button>
											<a href="javascript:void(0)" onclick="cancelpayment(<?= $id ?>)">
												<button class="btn btn-primary btn-xs">Delete</button>
                                            </a>
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
                <h4 class="modal-title">Payment Client Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('bill_payment/addPayment'); ?>">
                     <input type="hidden" class="form-control"  id="rent" name="rent"  readonly>
					 <input type="hidden" class="form-control"  id="elec" name="elec"  readonly>
					 <input type="hidden" class="form-control"  id="gas" name="gas"  readonly>
					 <input type="hidden" class="form-control"  id="water" name="water"  readonly>
					 <input type="hidden" class="form-control"  id="service" name="service"  readonly>
					  <input type="hidden" class="form-control"  id="garage" name="garage"  readonly>
					  <input type="hidden" class="form-control"  id="hid" name="hid"  readonly>
					  <input type="hidden" class="form-control"  id="late" name="late"  readonly>
					   <input type="hidden" class="form-control"  id="pu" name="pu"  readonly>
					 <input type="hidden" class="form-control"  id="cu" name="cu"  readonly>
					  <input type="hidden" class="form-control"  id="da" name="da"  readonly>
					  
					  
					  
					  
					  
					  
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
                                  <label class="control-label col-md-3">Months </label>
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
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Monthly Total: </label>
                        <div class="col-lg-9">		
                        <input type="text" class="form-control"  id="mtotal" name="mtotal"  readonly>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Due: </label>
                        <div class="col-lg-9">		
                        <input type="text" class="form-control"  id="due" name="due"  readonly>
                        </div>
                    </div>
					
					
				    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total: </label>
                        <div class="col-lg-9">		
                        <input type="text" class="form-control"  id="total" name="total"  readonly>
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

<script>

	function cancelpayment(id){
		
		//alert(id);
		if(confirm('Confirn Delete Payment')){	
			$.ajax({
				type: "Post",
				url: "<?php echo site_url('bill_payment/cancelpayment'); ?>",
				data: {'id':id } ,
				success: function (data) {
					
					alert(data);
					location.reload();
				}
				
			});
		}
		
	}


</script>

