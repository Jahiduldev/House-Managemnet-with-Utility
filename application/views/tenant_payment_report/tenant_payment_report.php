<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <b style="color:blue;">Tenant Payment Report </b>
                        <button type="button" class="btn btn-sm btn-default pull-right" onclick="getprint()" id="printbtn">Print</button>
                    </header>
                    
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">

                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('tenant_payment_report/searchData') ?>">

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">From Date</label>
                                        <div class="col-lg-3">
                                            <input value="<?php if(isset($dtfrm)){ echo $dtfrm; } ?>" type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from" >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">To Date</label>
                                        <div class="col-lg-3">
                                            <input value="<?php if(isset($dtto)){ echo $dtto; } ?>" type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"  >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">House  *</label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="desco_meter" id="desco_meter" >
                                                <option value="">Select House</option>
                                                <?php
                                                foreach ($desco_meter as $row) :
                                                    ?>
                                                <option value="<?=$row->id;?>" <?php if(isset($house) && $house==$row->id){ echo ' selected'; } ?>><?=$row->house_name; ?></option>
                                                <?php endforeach;  ?>
                                            </select>
                                        </div>

                                    </div>
                                    
                                    <input type="submit" name="details" class="btn btn-info pull-right" value="Details">
                                    <input type="submit" name="summary" class="btn btn-info pull-right" value="Summary">
                                    
                                </form>


                            </div>
                        </div>
                        <hr>
<?php $ro = $this->session->userdata('role_id') ; ?>

                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                       <th>Print</th>
									   <th>SL</th>
									    <th>Authorization</th>
                                       <th>Tenant Code</th>
                                       <th>House</th>
                                       <th>Name</th>
					                   <th>Mobile</th>
                                       <th>Month</th>
                                       <th>Advance</th>
                                       <th>Rent</th>
                                       <th>Service</th>                  
                                       <th>Garage</th>
                                       
                                       <th>Previous Arreas</th>
                                       <th>Rent Total</th>
                                       <th>Rent Payment</th>
                                       <th>Current Arreas</th>
                                       
                                       <th></th>
									   <th>Desco Bill</th>
                                       <th>Titas Bill</th>                  
                                       <th>Wasa Bill </th>
                                       
                                       <th>Previous Arreas</th>
                                       <th>Utility Total</th>
                                       <th>Utility Payment</th>
                                       <th>Current Arreas</th>
                                       
									   <th>Late </th>
									   
									   <th></th>
									   
									   <th>Previous Arreas</th>
									   <th>Total Amount</th>
					                   <th>Payment Amount</th>
					                   <th>Arrears Amount</th>
					                   
                                       <th>Payment Date </th>
					                   <th>Note</th>
					                    <?php if( $ro ==1)
                                        {
                                        ?>
					                   <th>Action</th>
					                   <?php } ?>
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead> 
                                <tbody>

                                    <?php
                                        $counter = 0;  $pay_amount_tot = 0;
                                        $current_due_tot = 0;
										
										$rent_t=0;$electrict_t=0;$gas_t=0;$water_t=0;$service_t=0;$garage_t=0;$late_t=0;$utility_due_tot=0;$advance_t=0;
										
										$pre_rent_deu_t =0;
										$rent_total_t =0;
										$pay_renttotal_t =0;
										$current_due_t =0;
										
										$pre_uti_deu_t =0;
										$utility_total_t =0;
										$pay_utitotal_t =0;
										$utility_due_t =0;
										
										$tot_pre_due_t =0;
										$totalamount_t =0;
										$pay_amount_t =0;
										$tot_due_t =0;
										
                                    foreach ($desco_bill_payment as $row) :
                                        $rent='';$advance='';
										$counter++;
                                        $id = $row->id;
                                        $hid = $row->hid;
                                        
                                         $authorization = $row->authorization;
                                         if( $authorization==1)
                                         {
                                             $auth = 'Authorized';
                                         }
                                         else
                                         {
                                              $auth = 'Pending';
                                         }
                                        $clinet_id = $row->clinet_id;
                                        $note = $row->note; 
                                        if($note=='Advance'){
                                            
                                            $advance = $row->rent;
                                            $advance_t += $row->rent;
                                        }else{
                                            
                                            $rent = $row->rent;
                                            $rent_t += $row->rent;
                                        }
                                        $result2=$this->db->query("select *  from add_house where id='$hid'");

                                        foreach($result2->result() as $row2):
										
                                            $name =$row2->house_name;
                                        endforeach;
                                        
                                        //$cuurent_due_rent = $this->db->where('clinet_id', $clinet_id)->where('bill_id', 7)->get('bill')->row()->amount;
			                            //$cuurent_due_util = $this->db->where('clinet_id', $clinet_id)->where('bill_id', 10)->get('bill')->row()->amount;
										
										$result2=$this->db->query("select * from house_client where id='$clinet_id'");

                                        foreach($result2->result() as $row2):
                                            
                                            $client_id=$row2->client_id;
											$code=$row2->code;
											$client_name =$row2->client_name;
											$mobile_number =$row2->mobile_number;
											
											$pre_rent_deu = $row2->pre_due;
											$pre_uti_deu = $row2->pre_uti_due;
											
											$tot_pre_due = $row2->pre_uti_due + $row2->pre_due;
											
											$totalamount = $row2->totalamount;
											
                                        endforeach;
										
                                        
                                        $pay_amount = $row->pay_amount;
                                        $current_due = $row->current_due;
										
										$tot_due = $row->utility_due + $row->current_due;
										
										$pay_renttotal  = $row->rent_pay;
			                            $pay_utitotal = $row->utility_pay;
										
										
										$electrict = $row->electrict;
                                        $gas = $row->gas;
										$water = $row->water;
                                        $service = $row->service;
										$garage = $row->garage;
                                        $late = $row->late;
                                        
                                        $rent_total = $pre_rent_deu+$garage+$service+$rent;
										$utility_total = $gas+$water+$electrict+$pre_uti_deu;
										
										$electrict_t += $row->electrict;
                                        $gas_t += $row->gas;
										$water_t += $row->water;
                                        $service_t += $row->service;
										$garage_t += $row->garage;
                                        $late_t += $row->late;
                                        
                                        
										
										$pay_amount = $row->pay_amount;
                                        $current_due = $row->current_due;
										$utility_due = $row->utility_due;
										

                                        $pay_amount_tot += $row->pay_amount;
                                        $current_due_tot += $row->current_due;
                                        $utility_due_tot += $row->utility_due;
                                        $pay_date = $row->pay_date;
										$mont = $row->mont;
										
										$pre_rent_deu_t += $pre_rent_deu;
										$rent_total_t += $rent_total;
										$pay_renttotal_t += $pay_renttotal;
										$current_due_t += $current_due;
										
										$pre_uti_deu_t += $pre_uti_deu;
										$utility_total_t += $utility_total;
										$pay_utitotal_t += $pay_utitotal;
										$utility_due_t +=$utility_due;
										
										$tot_pre_due_t += $tot_pre_due;
										$totalamount_t += $totalamount;
										$pay_amount_t += $pay_amount;
										$tot_due_t += $tot_due;
										
                                        ?>
                                        <!-- kcode -->
                                        <?php
                                         
                                       


                                        //$total_unit =   $curunit-$preunit;
                                        ?>

                                        <!-- endkcode -->
                                    <tr class="gradeX">
                                       
                                         <td>
                                            <?php 

                                            echo '<a target="_blank"  href=" ' . site_url("tenant_payment_report/tenant_print/" . $id) . '">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-print"></i></button>
                                            </a>'

                                        ?>
                                       <br>
                                       
                                            <?php 

                                            echo '<a target="_blank"  href=" ' . site_url("tenant_payment_report/tenant_print_eng/" . $id) . '">
                                            <button class="btn btn-primary btn-xs"><i class="fa fa-print"></i></button>
                                            </a>'

                                        ?>
                                            
                                        </td>
                                        <td><?php echo $counter; ?></td>
                                         <td><?php echo  $auth; ?></td>
                                        <td><?php echo $client_id ?></td>
                                        <td><?php echo $code ?></td>
                                        <td><?php echo $client_name ?></td>
                                        <td><?php echo $mobile_number ?></td>
									    <td><?php echo $mont ?></td>
									    <td><?php echo $advance?></td>
                                        <td><?php echo $rent?></td>
                                       
                                        <td><?php echo $service?></td>
                                        <td><?php echo $garage?></td>
                                        
                                        <td><?php echo $pre_rent_deu ?></td>
                                        <td><?php echo $rent_total ?></td>
                                        <td><?php echo $pay_renttotal ?></td>
                                        <td><?php echo $current_due ?></td>
										
										<td> </td>
										<td><?php echo $electrict;  ?></td>   
                                        <td><?php echo  $gas; ?></td>
                                        <td><?php echo $water?></td>
                                        
                                        <td><?php echo $pre_uti_deu ?></td>
                                        <td><?php echo $utility_total ?></td>
                                        <td><?php echo $pay_utitotal ?></td>
                                        <td><?php echo $utility_due ?></td>
										
                                        <td><?php echo $late ?></td>
                                        
                                        <td> </td>
                                        
                                        <td><?php echo $tot_pre_due ?></td>
                                        <td><?php echo $totalamount ?></td>
                                        <td><?php echo $pay_amount ?></td>
                                        <td><?php echo $tot_due ?></td>
                                        
										
										<td><?php echo $pay_date ?></td>
									
										<td><?php echo $note ?></td>
										 <?php if( $ro ==1)
                                        {
                                        ?>
										 
                                        <td><?php 

                                            echo '<a target="_blank"  href=" ' . site_url("view_house_client/getCustomerServiceDetail/" . $clinet_id) . '">
												<button class="btn btn-primary btn-xs">Details</button>
                                            </a><a href="javascript:void(0)" onclick="cancelpayment('. $id .')">
												<button class="btn btn-primary btn-xs">Delete</button>
                                            </a>'

										?></td>
										<?php }?>
							
                                    </tr>
                                      <?php 
                                       endforeach;  
                                        
                                      ?>

                                    
                                </tbody>
                                <tfoot>
                                    <tr class="gradeX">
                                        <td colspan="7"></td>
                                        <td><strong><?= $advance_t;?></strong></td>
										<td><strong><?= $rent_t;?></strong></td>
										
										 
                                        <td><strong><?= $service_t;?></strong></td>
										<td><strong><?= $garage_t;?></strong></td>
										
										<td><strong><?= $pre_rent_deu_t;?></strong></td>
										
										<td><strong><?= $rent_total_t;?></strong></td>
										<td><strong><?= $pay_renttotal_t;?></strong></td>
										<td><strong><?= $current_due_t;?></strong></td>
										<td> </td>
										
										<td><strong><?= $electrict_t;?></strong></td>
                                        <td><strong><?= $gas_t;?></strong></td>
										<td><strong><?= $water_t;?></strong></td>
										
										<td><strong><?= $pre_uti_deu_t;?></strong></td>
										<td><strong><?= $utility_total_t;?></strong></td>
										<td><strong><?= $pay_utitotal_t;?></strong></td>
										<td><strong><?= $utility_due_t;?></strong></td>
										<td><strong><?= $late_t;?></strong></td>
										<td> </td>
										
                                        <td><strong><?= $tot_pre_due_t;?></strong></td>
										
										<td><strong><?= $totalamount_t;?></strong></td>
										<td><strong><?= $pay_amount_t;?></strong></td>
										<td><strong><?= $tot_due_t;?></strong></td>
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

<script>

	function getprint(){
		
		$.ajax({
				type: "Post",
				url: "<?php echo site_url('tenant_payment_report/getprint'); ?>",
				data: {'paymentarray':JSON.stringify(<?php echo  json_encode($desco_bill_payment) ?>) },
				beforeSend: function() {
                    // setting a timeout
                    $('#printbtn').html('<img src="<?php echo base_url(); ?>public/loading.gif" width="28" height="15">');
                },
				success: function (datas) {
					
					$('body').html(datas);	
                    window.print();
                    location.href = "<?php echo base_url(); ?>tenant_payment_report"			 
				}
				
			});
		
	}

	function cancelpayment(id){
		
		if(confirm('Confirn Delete Payment')){	
			$.ajax({
				type: "Post",
				url: "<?php echo site_url('tenant_payment_report/cancelpayment'); ?>",
				data: {'id':id } ,
				success: function (data) {
					
					alert(data);
					location.reload();
				}
				
			});
		}
		
	}


</script>

