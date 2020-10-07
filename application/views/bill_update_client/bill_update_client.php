<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
   

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;"> Bill Update </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                    
                                        <th>House</th>            
                                        <th>Tenant Code</th>
                                        <th>Space Code</th>
                                        <th>Tenant </th>
                                        <th>Mobile</th>
                                        <th>Month</th>
                                        <th>Rent  </th>
                                        
                                        <th>Total Unit  </th>
                                        <th>Electric </th>
                                        <th>Gas </th>
                                        <th>Water </th>
                                        <th>Service </th>
                                        <th>Garage </th>
<th>Monthly Amount </th>
                                        <th>Service Due</th>
                                        <th>Utility Due</th>
<th>Total Amount </th>
                                        <th>Last Update</th>
<th>Note</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if(isset($project_data)){
                                    foreach ($project_data as $row) :
                                        $client_id = $row->client_id;
                                        $code = $row->code;
                                        $client_name = $row->client_name;
                                        $mobile_number = $row->mobile_number;
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
                                                 $dueamount = $row_add->amount;
                                            }
                                               else if($bill_id==8)
                                            {
                                                 $preunit = $row_add->amount;
                                            }
                                                else if($bill_id==9)
                                            {
                                                 $curunit = $row_add->amount;
                                            }     
                                            else if($bill_id==10)
                                            {
                                                 $utilitydue = $row_add->amount;
                                            }     
                                            //$datetime = $row_add->last_payment_date;
                                              
                                             
                                        endforeach; 
$datetime = $row->last_payment_date;
                                        if($curunit > $preunit){$total_unit =   $curunit-$preunit;}else
										{ $total_unit = 0; }
					$totalamount = $rent+$elec+$gas+$water+$service+$garage; $status = $row->bill_status; $mo = explode('/', $mont); $note = $row->note;
                                        ?>
                                        <tr class="gradeX">

                                            <td><?php echo $this->db->where('id', $row->house)->get('add_house')->row()->house_name; ?></td>
                                            <td><?php echo $client_id; ?></td>
                                            <td><?php echo $code; ?></td>
                                           
                                            <td><?php echo $client_name; ?></td>
                                            <td><?php echo $mobile_number;?></td>
                                           <td><?php if($mont!=''){ echo  date("M", mktime(0, 0, 0, $mo[0], 10)).'/'.$mo[1]; } ?></td>
                                            <td><?php echo  $rent; ?></td> 
											
                                            <td><?php echo $total_unit; ?></td>
                                            <td><?php echo $elec; ?></td>
                                            <td><?php echo $gas; ?></td>
                                            <td><?php echo $water; ?></td>
                                            <td><?php echo $service; ?></td>
                                            <td><?php echo $garage; ?></td>
					                        <td><?php echo $totalamount; ?></td>
                                            <td><?php echo $dueamount; ?></td>
                                            <td><?php echo $utilitydue; ?></td>
					                        <td><?php echo $totalamount+$dueamount+$utilitydue; ?></td>
                                            <td><?php echo $datetime; ?></td>
 <td><?php echo $note; ?></td>
<td>
<button class="btn btn-primary btn-xs" 
onclick="addModal('<?=$id."-".$rent."-".$elec."-".$gas."-".$water."-".$service."-".$garage."-".$preunit."-".$curunit."-".$total_unit."-".$dueamount."-".$mont."-".$totalamount."-".$utilitydue?>'); " 
style="" <?php if($status==0){ echo ' disabled '; } ?>
											> <?php if($status==0){ echo ' Updated '; }else{ echo 'Bill Update'; } ?></button>



                                            
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                   }  ?>
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
                <h4 class="modal-title">Update Tenants Bill</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('bill_update/addPayment'); ?>">
             
             
             
                      <input type="hidden" class="form-control"  id="id" name="id"  >
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
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Advance: </label>
                        <div class="col-lg-9">
						
							<input type="text" class="form-control"  id="advance" readonly>
                        </div>

                    </div>
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Status: </label>
                        <div class="col-lg-9">
						
							<input type="text" class="form-control"  id="status" readonly>
                        </div>

                    </div>

					<div class="form-group">
						  <label class="control-label col-md-3">Months Only</label>
						  <div class="col-md-9 col-xs-11">
							   
<input type="text"  class="form-control col-md-6 monthpickerdate" id="mont" name="mont" required onchangeDate="checkbillpayment(this.value)" value="<?php echo date('m/Y'); ?>" autofocus="off" readonly>
								  <span id="monthtextdisplay" style="float:right;color:red; display:none">This Month Bill Payment Has Completed</span>
							                                     
						  </div>
					</div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Rent Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="rent" name="rent" onchange="gettotal()" >
                        </div>
                    </div>
                         <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">DESCO Previous Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="pu" name="pu"   onchange="gettotal()">
                        </div>
                    </div>
                    
                          <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">DESCO Current Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="cu" name="cu"  onchange="gettotal()" >
                        </div>
                    </div>
                          <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">DESCO Total Unit: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="tu" name="tu"  disabled>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Unit Rate: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="unitrate" name="unitrate" onfocus="getecectric(this.value)" onchange="getecectric(this.value)">
                        </div>
                    </div>
                  <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Electric Bill: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="elec" name=""   onchange="gettotal()" disabled>
                             <input type="hidden" class="form-control"  id="elec1" name="elec">
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payable Electric Bill: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="elect" name="elect"   onchange="gettotal()">
                        </div>
                    </div>
                    
                       <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Gas Bill: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="gas" name="gas"  onchange="gettotal()" >
                        </div>
                    </div>
                    
                   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Water Bill: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="water" name="water"   onchange="gettotal()">
                        </div>
                    </div>
                    
                    
                     <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Charge: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="service" name="service"   onchange="gettotal()">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Garage: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="garage" name="garage"   onchange="gettotal()">
                        </div>
                    </div><div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Monthly Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="totalamount" name="totalamount" readonly>
                            <input type="hidden" class="form-control"  id="totalamount1" name="totalamount">
                        </div>
                    </div>

					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Service Due: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="da" name="da"   onchange="gettotal()">
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Utility Due: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="uda" name="uda"   onchange="gettotal()">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Total Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="totaltotal" name="totaltotal"  >
                        </div>
                    </div>
					
					 <div class="form-group">
                                <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Send Sms</label>
                                <div class="col-lg-9">
                                    <input type="checkbox" name="sendsms" value="3" >
                                </div>
                            </div>
					

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes </label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="note" name="note" ></textarea>
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

