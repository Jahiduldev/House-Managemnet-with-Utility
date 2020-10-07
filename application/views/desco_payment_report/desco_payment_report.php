<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <b style="color:blue;">  DESCO Payment Report </b>
                        <button class="btn btn-sm btn-default pull-right" onclick="gettableprint('hidden-table-info')">Print</button>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">

                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('desco_payment_report/searchData') ?>">

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
                                                foreach ($desco_meter as $row) :
                                                    ?>
                                                <option value="<?=$row->id;?>" <?php if(isset($house) && $house==$row->id){ echo ' selected'; } ?>><?=$row->house_name; ?></option>
                                                <?php endforeach;  ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- <button type="submit" name="submitDate" class="btn btn-info pull-right" onclick="getDateSearch()">Submit</button> -->
                                    
                                    <input type="submit" name="details" class="btn btn-info pull-right" value="Details">
                                    <input type="submit" name="summary" class="btn btn-info pull-right" value="Summary"> 
                                </form>


                            </div>
                        </div>
                        <br>

<?php $ro = $this->session->userdata('role_id') ; ?>
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Authorization</th>
										<th>House</th>
										<th>Meter Name</th>
                                        <th>Bill No</th>
                                        <th>Account No</th>
                                        <th>Meter No</th>
										<th>Month</th>
                                        <th>Issue Date</th>
										<th>Due Date</th>
										<th>Total Unit</th>
										<th>Pay Amount</th>
										<th>Note</th>
										<th>Voucher</th>
                                        <th>Payment Date </th>
                                        <?php if( $ro ==1)
                                        {
                                        ?>
                                        <th>Action</th>
                                        <?php }?>
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $counter = 0; $total_payment_amount=0;
                                    $total_unit_tot=0;
                                    foreach ($desco_bill_payment as $row) :
                                        $counter++;
                                        $hid = $row->hid;
                                        $id = $row->id;
                                        $authorizatino = $row->authorization;
                                        
                                        if($authorizatino==1)
                                        {
                                            $auth = 'Authorized';
                                        }
                                        else
                                        {
                                            $auth = 'Pending';
                                        }
                                        
                                        $result22=$this->db->query("select *  from add_house where id='$hid'");

                                        foreach($result22->result() as $row22):
										
                                            $house_name =$row22->house_name;
                                        endforeach;
                                        
                                        $result2=$this->db->query("select *  from desco_meter where hid='$hid'");

                                        foreach($result2->result() as $row2):
                                            $name=$row2->name;
                                        endforeach;
                                        
                                        $acct_number = $row->acct_number;
                                        $bill_numebr = $row->bill_numebr;
                                        $meter_number = $row->meter_number;
										 $mont = $row->mont;
                                        $issue_date = $row->issue_date;
										$due_date = $row->due_date;
										$total_unit = $row->total_unit;
                                        $total_unit_tot += $total_unit;
										$payment_amount = $row->payment_amount;
										$image_name = $row->image_name;
										$note = $row->note;   
										$payment_date = $row->payment_date;   
									$total_payment_amount += $payment_amount;
                                        ?>
                                    <tr class="gradeX">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $auth; ?></td>
                                        <td><?php echo $house_name ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $bill_numebr ?></td>
                                        <td><?php echo $acct_number ?></td>
                                         <td><?php echo $meter_number ?></td>
									     <td><?php echo $mont ?></td>
									
                                        <td><?php echo $issue_date ?></td>
										<td><?php echo $due_date ?></td>
										
										 <td><?php echo $total_unit ?></td>
										<td><?php echo $payment_amount ?></td>
										<td><?php echo $note ?></td>
										 
                                        
										<td><?php if($image_name !=''){ ?>
										<a href="<?= base_url()?>public/uploads/company/<?php echo $image_name ?>" target="_blank" style="color:blue;font-weight:bold;">View</a>
										<?php }else{ ?>
										<span>No File</span>

										<?php } ?>
										</td>
										<td><?php echo $payment_date ?></td>
										 <?php if( $ro ==1)
                                        {
                                        ?>
										<td><a href="javascript:void(0)" onclick="deletedesco(<?php echo $id; ?>)" class="btn btn-sm btn-danger">Delete</a></td>
										<?php }?>
                                    </tr>

                                    <?php endforeach; ?>
                                   
                                </tbody>
                                <tfoot>
                                     <tr>
                                        <td colspan="9"></td>
                                        <td><strong><?php echo $total_unit_tot;?></strong></td>
                                        <td><strong><?php echo $total_payment_amount; ?></strong></td>
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

    var tablehead = '<table class="table table-bordered">';

	function gettableprint(id){
		
		$("#"+id+" th:nth-child(14)").remove();
		$('#'+id+' th:last-child').remove();
		
		$("#"+id+" td:nth-child(14)").remove();
		$('#'+id+' td:last-child').remove();
		
		var tabledata = $('#'+id).html();
	 
		tabledata = tablehead+tabledata+'</table>';
		$('body').html(tabledata);	
		window.print();
	    location.reload();
	}


	function deletedesco(id){
	    if(confirm('Confirm Delete DESCO Payment')){	
    		$.ajax({
    			
    			type : "Post",
    			url : "<?php echo site_url('desco_payment_report/deletepayment'); ?>",
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
