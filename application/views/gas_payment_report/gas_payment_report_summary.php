<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <b style="color:blue;">  GAS Payment Report </b>
                        <button class="btn btn-sm btn-default pull-right" onclick="gettableprint('hidden-table-info')">Print</button>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">

                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('gas_payment_report/searchData') ?>">

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">From Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from" value="<?php if(isset($dtfrm)){ echo $dtfrm; } ?>">
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">To Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"    value="<?php if(isset($dtrto)){ echo $dtrto; } ?>" >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">House  *</label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="desco_meter" id="desco_meter" >
                                                <option value="">Select House</option>
                                                <?php
                                                foreach ($desco_meter as $row) :
                                                    ?>
                                                <option value="<?=$row->id;?>" <?php if(isset($house) && $house==$row->id){ echo ' selected'; }?>><?=$row->house_name; ?></option>
                                                <?php endforeach;  ?>
                                            </select>
                                        </div>

                                    </div>
                                    <input type="submit" name="details" class="btn btn-info pull-right" value="Details">
                                    <input type="submit" name="summary" class="btn btn-info pull-right" value="Summary">
                                </form>


                            </div>
                        </div>
                        <br>


                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
										<th>House</th>
										<th>Bill Name</th>
										<th>Month</th>
                                        <th>Single Burner</th>
                                        <th>Amount</th>
                                        <th>Double Burner</th>
										<th>Amount</th>
                                        <th>Total burner</th>
										<th>Total Amount</th>
										
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    
                                    $single_total =0;
									$double_total =0;
										
									$sin_amount_total = 0; 
									$dob_amount_total = 0; 
										
                                    $counter = 0; $total_amount_total = 0; 
                                    
                                    $single = 0;
                                    $sin_amount = 0;
                                    $doubles = 0;
                                    $dob_amount = 0;
                                    
                                    $total_unit_tot = 0;
                                    foreach ($desco_bill_payment as $row) :
                                        $counter++;
                                        $hid = $row->hid;
                                        $id = $row->id;
                                
                                        $result2=$this->db->query("select *  from gas_bill where hid='$hid'");

                                        foreach($result2->result() as $row2):
                                            $name=$row2->name;
                                        endforeach;
                                        
                                         $result22=$this->db->query("select *  from add_house where id='$hid'");

                                        foreach($result22->result() as $row22):
										
                                            $house_name =$row22->house_name;
                                        endforeach;
                                        
                                        $totalresult = $this->db->where('hid', $hid)->get('gas_bill_payment')->result();
                                        foreach($totalresult as $row222){
										
                                            $single += $row->single;
                                            $sin_amount += $row->sin_pay;
                                            $doubles += $row->doubles;
                                            $dob_amount += $row->dob_pay;
                                        }
                                        
                                        
                                        $mont = $row->mont;
                                        
									
										$total_unit = $single+$doubles;
                                        $total_unit_tot +=  $total_unit;
							            $total_amount = $sin_amount+$dob_amount;
                                        $total_amount_total+=$total_amount;
										$note = $row->note;   
										$image_name = $row->image_name;
										
										$payment_date = $row->payment_date;  
										
										
										$single_total += $single;
										$double_total += $doubles;
										
										$sin_amount_total += $sin_amount; 
										$dob_amount_total += $dob_amount; 
										
										
										
                                        ?>
                                    <tr class="gradeX">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $house_name ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $mont ?></td>
                                        <td><?php echo $single ?></td>
                                         <td><?php echo $sin_amount ?></td>
									     <td><?php echo $doubles ?></td>
									
                                        <td><?php echo $dob_amount ?></td>
										
										
										 <td><?php echo $total_unit ?></td>
										<td><?php echo $total_amount ?></td>
										
										
                                    </tr>

                                    <?php  $single = 0;
                                    $sin_amount = 0;
                                    $doubles = 0;
                                    $dob_amount = 0; endforeach; ?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td></td>
                                        <td colspan="4">Total</td>
                                        <td><strong><?php echo $single_total; ?></strong></td>
                                        <td><strong><?php echo $sin_amount_total; ?></strong></td>
                                        <td><strong><?php echo $double_total; ?></strong></td>
                                        <td><strong><?php echo $dob_amount_total; ?></strong></td>
                                        
                                        <td><strong><?php echo $total_unit_tot; ?></strong></td>
                                        <td><strong><?php echo $total_amount_total; ?></strong></td>
                                         
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
		
		$("#"+id+" th:nth-child(13)").remove();
		$('#'+id+' th:last-child').remove();
		$("#"+id+" td:nth-child(13)").remove();
		$('#'+id+' td:last-child').remove();
		var tabledata = $('#'+id).html();
		tabledata = tablehead+tabledata+'</table>';
		$('body').html(tabledata);	
		window.print();
	    location.reload();
	}


	function deletegas(id){
	if(confirm('Confirm Delete GAS Payment')){	
		$.ajax({
			
			type : "Post",
			url : "<?php echo site_url('gas_payment_report/deletepayment'); ?>",
			data : {'id':id },
			success : function (datas){
				
				if(datas=='ok'){
				    
				    location.reload();
				}		 
			}				
		});
	}
	}
</script>

