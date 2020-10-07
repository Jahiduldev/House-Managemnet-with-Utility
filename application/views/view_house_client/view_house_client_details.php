<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <b style="color:blue;">  Tenant Details </b>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                      <div class="panel-body" style="background:#E4F8EA;color:black; ">
                   
                    <?php
                   
						foreach ($get_client_data as $row1) :
										   
							$client_id=$row1->client_id;
							$code=$row1->code;
							$client_name=$row1->client_name;
							$mobile_number=$row1->mobile_number;
							$status=$row1->status;
                            if($status==1){$status='Active';  }
						   

							
						endforeach;                                      
                   
                    
                    
                    
                    
                    ?>
                    
                    <div class="row">
                    <div class="col-lg-6">
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tenant Id   :</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_id?></label>
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tenant Code :</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$code?></label>
                                      
                                       <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Name:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_name?></label>
                                      <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Mobile:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$mobile_number?></label>
                                      
                                       <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">status:</label>
                                      <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$status?></label>
                                  
                                      
                                      
                      </div>
                    </div>
                    <hr>
                    
                    
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hiddentable-info">
                                <thead>
                                    <tr>  
									
                                        <th class="hidden-phone">Month</th> 
<th class="hidden-phone">Rent</th> 										
                                        <th class="hidden-phone">Prv Unit</th>
                                        <th class="hidden-phone">Cur Unit</th>
                                        <th class="hidden-phone">Unit</th>
					<th class="hidden-phone">Electricity  </th>
                                        <th class="hidden-phone">Gas</th>
                                        <th class="hidden-phone">Water</th>
                                        <th class="hidden-phone">Service</th>
                                        <th class="hidden-phone">Garage</th>
					<th class="hidden-phone">Fine</th>
					<th class="hidden-phone">Total Amount</th>
					<th class="hidden-phone">Pay Amount</th>
					<th class="hidden-phone">Service Due</th>
					<th class="hidden-phone">Utility Due</th>
					 <th class="hidden-phone">Pay Type</th>
					<th class="hidden-phone">Pay Date</th>
										  
										   
					<th class="hidden-phone">Note</th>
                                        <th class="hide_coloum">Test</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($get_pay_data as $row) :


                                        $rent=$row->rent;
                                        $pu=$row->pu;
					$cu=$row->cu;
					$mont=$row->mont;
                                        $electrict=$row->electrict;
					$gas=$row->gas;
					$water=$row->water;
                                        $service=$row->service;
					$garage=$row->garage;
                                        $late=$row->late;
                                        $payment_type=$row->payment_type;
					$total=$row->total;
					$pay_amount=$row->pay_amount;
                                        $current_due=$row->current_due;
                                        $utility_due=$row->utility_due;
					$note=$row->note;
                                        $pay_date=$row->pay_date;

                                        $unit = $cu-$pu;
										
										

                                        ?>
                                    <tr class="gradeX">
                                       
                                        <td class="hidden-phone"><?php echo $mont; ?></td>
					<td class="hidden-phone"><?php echo $rent; ?></td>
                                        <td class="hidden-phone"><?php echo $pu; ?></td>
                                        <td class="hidden-phone"><?php echo $cu; ?></td>
					<td class="hidden-phone"><?php echo $unit; ?></td>
                                        <td class="hidden-phone"><?php echo $electrict; ?></td>
                                        <td class="hidden-phone"><?php echo $gas; ?></td>
					<td class="hidden-phone"><?php echo $water; ?></td>
                                        <td class="hidden-phone"><?php echo $service; ?></td>
                                        <td class="hidden-phone"><?php echo $garage; ?></td>
                                        <td class="hidden-phone"><?php echo $late; ?></td>
					<td class="hidden-phone"><?php echo $total; ?></td>
                                        <td class="hidden-phone"><?php echo $pay_amount; ?></td>
                                        <td class="hidden-phone"><?php echo $current_due; ?></td>
                                        <td class="hidden-phone"><?php echo $utility_due; ?></td>
                                        <td class="hidden-phone"><?php echo $payment_type; ?></td>
					<td class="hidden-phone"><?php echo $pay_date; ?></td>
                                        
					<td class="hidden-phone"><?php echo $note; ?></td>
                                  
                                       
                                    </tr>

                                    <?php endforeach;  ?>
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
<div class="modal fade" id="myModalADD" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Service Confirmation</h4>
            </div>

            <div class="modal-body">
                <form class="cmxform form-horizontal tasi-form" id="addServiceForm"  role="form" method="post"  action="<?php echo site_url('add_service/addReqService');  ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Customer Code *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly="readonly" placeholder="Enter Customer Code" id="add_customer_code" name="add_customer_code">
                            <input type="hidden" class="form-control"  id="client_id" name="client_id">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Mobile NUmber *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" readonly="readonly" placeholder="Enter Mobile Number" id="add_mobile_number" name="add_mobile_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Priority *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="add_service_priority" id="add_service_priority" required>
                                <option value="">Select Priority</option>
                                <option value="1">Normal</option>
                                <option value="2">Moderate</option>
                                <option value="3">High</option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Request Date *</label>
                        <div class="col-lg-9">
                            <input class="form-control form-control-inline input-medium default-date-picker" size="16" placeholder="Enter Request Date" value="" type="text" id="add_request_date" name="add_request_date">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Description *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" placeholder="Enter Service Description" id="add_service_description" name="add_service_description"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info pull-right">Submit</button>
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


</section>
</section>
<!--main content end-->














