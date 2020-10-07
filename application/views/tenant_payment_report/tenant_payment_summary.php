<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <b style="color:blue;">Tenant Payment Summary Report </b>
                        <button type="button" class="btn btn-sm btn-default pull-right" onclick="gettableprint('hidden-table-info')">Print</button>
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


                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        
									   <th>SL</th>
                                       <th>House</th>
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
                                    </tr>
                                </thead> 
                                <tbody>

                                <?php
                                    
                                    $advance=0; $rent = 0;	$electrict = 0;  $gas = 0;	$water = 0; $service = 0; $garage = 0; $late = 0; $pay_amount = 0; $current_due = 0;
									$utility_due = 0;  $counter = 0;  $pay_amount_tot = 0;  $current_due_tot = 0;
									$advance_t = 0; $rent_t = 0; $electrict_t=0; $gas_t=0; $water_t=0; $service_t=0; $garage_t=0; $late_t=0; $utility_due_tot=0;
									
									$rent_total=0;
									$pay_renttotal=0;
									$utility_total=0;
									$pay_utitotal=0;
									
									$pre_rent_deu =0;
									$pre_uti_deu =0;
									$tot_pre_due =0;
									$totalamount =0;
									
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
									
									$pre_rent_deu_tot =0;
									$rent_total_tot =0;
									$pay_renttotal_tot =0;
									
									$pre_uti_deu_tot =0;
									$utility_total_tot =0;
									$pay_utitotal_tot =0;
									
									$tot_pre_due_tot=0;
									$totalamount_tot=0;
									
                                    foreach ($desco_bill_payment as $row) :
                                        
										$counter++;
                                        $id = $row->id;
                                        $hid = $row->hid;
                                        $clinet_id = $row->clinet_id;
                                       
                                        $result2=$this->db->query("select *  from add_house where id='$hid'");

                                        foreach($result2->result() as $row2):
										
                                            $name =$row2->house_name;
                                        endforeach;
										
										
										

                                       $result2=$this->db->query("select * from house_client where id='$clinet_id'");
									   foreach($result2->result() as $row2):
											
											$pre_rent_deu += $row2->pre_due;
											$pre_uti_deu += $row2->pre_uti_due;
											$tot_pre_due += $row2->pre_uti_due + $row2->pre_due;
											
											
										endforeach;
										
                                        if($dtfrm!='' && $dtto!=''){
											
											$this->db->where('pay_date >=', $dtfrm);
											$this->db->where('pay_date <=', $dtto);											
										}                                        
										$allqry = $this->db->where('hid', $hid)->get('bill_payment')->result();
										//echo $this->db->last_query();
										foreach($allqry as $allq){
											
										    
										    
										    $totalamount += $allq->total;
											
											if($allq->note != 'Advance'){
												
												$rent += $allq->rent;
												$rent_total += $allq->garage+$allq->service+$allq->rent;
											}else{
												
												$advance += $allq->rent;
												
											}
											
    										$electrict += $allq->electrict;
                                            $gas += $allq->gas;
    										$water += $allq->water;
                                            $service += $allq->service;
    										$garage += $allq->garage;
                                            $late += $allq->late;
                                            $pay_amount += $allq->pay_amount;
                                            $current_due += $allq->current_due;
    										$utility_due += $allq->utility_due;
    										
    										$pay_renttotal  += $allq->rent_pay;
			                                $pay_utitotal += $allq->utility_pay;
			                                
			                                
										    $utility_total += $allq->gas+$allq->water+$allq->electrict;
										}
										$rent_total += $pre_rent_deu;
										$utility_total += $pre_uti_deu;
										
										
										$electrict_t += $electrict;
                                        $gas_t += $gas;
										$water_t += $water;
                                        $service_t += $service;
										$garage_t += $garage;
                                        $late_t += $late;
                                        $advance_t += $advance;
                                        $rent_t += $rent;

                                        $pay_amount_tot += $pay_amount;
                                        $current_due_tot += $current_due;
                                        $utility_due_tot += $utility_due;
										
										$pre_rent_deu_tot += $pre_rent_deu;
										$rent_total_tot += $rent_total;
										$pay_renttotal_tot += $pay_renttotal;
										
										$pre_uti_deu_tot += $pre_uti_deu;
										$utility_total_tot += $utility_total;
										$pay_utitotal_tot += $pay_utitotal;
										
										$tot_pre_due_tot += $tot_pre_due;
										$totalamount_tot += $totalamount;
										
                                    ?>
                                        
                                    <tr class="gradeX">
                                        
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $name ?></td>
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
                                        <td><?php echo $gas; ?></td>
                                        <td><?php echo $water?></td>
                                        
										<td><?php echo $pre_uti_deu ?></td>
                                        <td><?php echo $utility_total ?></td>
                                        <td><?php echo $pay_utitotal ?></td>
                                        <td><?php echo $utility_due ?></td>
										
                                        <td><?php echo $late ?></td>
										
										<td></td>
										
										<td><?php echo $tot_pre_due ?></td>
                                        <td><?php echo $totalamount ?></td>
                                        <td><?php echo $pay_amount ?></td>                                        
									
										<td><?php echo $current_due+ $utility_due?></td>
                                    </tr>
                                    <?php 
									  $advance=0;
									  $rent = 0;
										$electrict = 0;
										$gas = 0;
										$water = 0;
										$service = 0;
										$garage = 0;
										$late = 0;
										$pay_amount = 0;
										$current_due = 0;
										$utility_due = 0;
										
										//$pay_amount_tot = 0;
										//$current_due_tot = 0;
										
										//$advance_t=0;$rent_t=0;$electrict_t=0;$gas_t=0;$water_t=0;$service_t=0;$garage_t=0;$late_t=0;$utility_due_tot=0;
										$rent_total=0;
										$pay_renttotal=0;
										$utility_total=0;
										$pay_utitotal=0;
										
										$pre_rent_deu =0;
										$pre_uti_deu =0;
										$tot_pre_due =0;
										$totalamount =0;
									
									
									endforeach;  
									
									
									
                                        
                                    ?>

                                    
                                </tbody>
                                <tfoot>
                                    <tr class="gradeX">
                                        <td colspan="2"></td>
										<td><strong><?= $advance_t;?></strong></td>
										<td><strong><?= $rent_t;?></strong></td>
										
										 
                                        <td><strong><?= $service_t;?></strong></td>
										  <td><strong><?= $garage_t;?></strong></td>
										  
										  <td><strong><?= $pre_rent_deu_tot;?></strong></td>
										  <td><strong><?= $rent_total_tot;?></strong></td>
										  <td><strong><?= $pay_renttotal_tot;?></strong></td>
										  <td><strong><?= $current_due_tot;?></strong></td>
										  <td> </td>
										  
										  <td><strong><?= $electrict_t;?></strong></td>
                                          <td><strong><?= $gas_t;?></strong></td>
										  <td><strong><?= $water_t;?></strong></td>
										  
										  
										  <td><strong><?= $pre_uti_deu_tot;?></strong></td>
										  <td><strong><?= $utility_total_tot;?></strong></td>
										  <td><strong><?= $pay_utitotal_tot;?></strong></td>
										  <td><strong><?= $utility_due_tot;?></strong></td>
										  
										  
                                        <td><strong><?= $late_t;?></strong></td>
										<td> </td>
                                        
										
										<td><strong><?php echo $tot_pre_due_tot ?></strong></td>
                                        
                                                                              
										<td><strong><?= $totalamount_tot;?></strong></td>
										<td><strong><?php echo $pay_amount_tot ?></strong></td>
                                        <td><strong><?= $current_due_tot+$utility_due_tot;?></strong></td>
										 
                                         
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

	var tablehead = '<table class="table table-bordered">';

	function gettableprint(id){
		
		 
		
		var tabledata = $('#'+id).html();
	 
		tabledata = tablehead+tabledata+'</table>';
		$('body').html(tabledata);	
		window.print();
	    location.href ="<?= base_url()?>tenant_payment_report" ;
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

