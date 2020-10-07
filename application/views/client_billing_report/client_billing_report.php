<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                         <b style="color:blue;">  Tenant Payment Report </b>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">

                      <!--   <div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('tenant_payment_report/searchData') ?>">

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">From Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from" >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">To Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"  >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">House  *</label>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="desco_meter" id="desco_meter" >
                                                <option value="">Select House</option>
                                                <?php
                                                foreach ($desco_meter as $row) :
                                                    ?>
                                                <option value="<?=$row->id;?>"><?=$row->house_name; ?></option>
                                                <?php endforeach;  ?>
                                            </select>
                                        </div>

                                    </div>
                                    <button type="submit" name="submitDate" class="btn btn-info pull-right" onclick="getDateSearch()">Submit</button>
                                </form>


                            </div>
                        </div> -->
                        <br>


                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        
					<th>Tenant Id</th>
                                        <th>Tenant Code</th>
                                        <th>House</th>
                                        <th>Name</th>
					<th>Mobile</th>
                                        <th>Month</th>
					<th>Payment Amount</th>
					<th>Due Amount</th>										
                                        <th>Payment Date </th>
					<th>Note</th>
					<th>Action</th>
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead> 
                                <tbody>

                                    <?php
                                    $counter = 0;  $pay_amount_tot = 0;
                                        $current_due_tot = 0;
                                    foreach ($desco_bill_payment as $row) :
                                        $counter++;
                                        $hid = $row->hid;
                                        $clinet_id = $row->clinet_id;
                                        $result2=$this->db->query("select *  from add_house where id='$hid'");

                                        foreach($result2->result() as $row2):
                                            $name =$row2->house_name;
                                        endforeach;
										
										
										$result2=$this->db->query("select *  from house_client where id='$clinet_id'");

                                        foreach($result2->result() as $row2):
                                            $client_id=$row2->client_id;
											$code=$row2->code;
											$client_name =$row2->client_name;
											$mobile_number =$row2->mobile_number;
                                        endforeach;
										
                                        
                                        $pay_amount = $row->pay_amount;
                                        $current_due = $row->current_due;

 $pay_amount_tot += $row->pay_amount;
 $current_due_tot += $row->current_due;
                                        $pay_date = $row->pay_date;
										 $mont = $row->mont;
                                      
							
										$note = $row->note;   
										
										
                                        ?>
                                    <tr class="gradeX">
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $client_id ?></td>
                                        <td><?php echo $code ?></td>
                                        <td><?php echo $name ?></td>
                                         <td><?php echo $client_name ?></td>
									     <td><?php echo $mobile_number ?></td>
									
                                        <td><?php echo $mont ?></td>
										<td><?php echo $pay_amount?></td>
										<td><?php echo $current_due?></td>
										 <td><?php echo $pay_date ?></td>
									
										<td><?php echo $note ?></td>
										 
                                        <td><?php 

echo '<a target="_blank"  href=" ' . site_url("view_house_client/getCustomerServiceDetail/" . $clinet_id) . '">
      <button class="btn btn-primary btn-xs">Details</button></a>'

										?></td>
							
                                    </tr>

                                    <?php endforeach; ?>
<tr><td colspan="7"></td>

<td><?= $pay_amount_tot;?></td><td>
                                       <?= $current_due_tot;?></td><td colspan="3"></td></tr>
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
