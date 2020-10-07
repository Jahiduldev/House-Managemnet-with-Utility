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
                      <div class="panel-body" style="background#E4F8EA;color:black; ">
                   
                    <?php
                   
						 
										   
							$client_id=$row1->client_id;
							$code=$row1->code;
							$client_name=$row1->client_name;
							$mobile_number=$row1->mobile_number;
							$status=$row1->status;

						   
                    
                    ?>
                    
                    <div class="row">
                    <div class="col-lg-8">
					
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tenant Id   :</label>
						  <label for="inputSuccess" class="col-sm-8 col-lg-8"><?=$client_id?></label>
<div class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></div>
						<label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tenant Code :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$code?></label>	
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>			  
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Name:</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$client_name?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Mobile:</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$mobile_number?></label>	
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>					  
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">status:</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?php
						  
										if($status ==1) echo 'Active';
										if($status ==2) echo 'Booked';
										
										?></label>
						</div>
						<div class="col-lg-4">
						
							<span style="padding:3px; border:1px solid #eee;float: left;background: #ccc;">
								<img src="<?= base_url()?>public/uploads/employee/<?= $row1->photo_upload ?>"  width="150" height="180">
							</span>
						</div>
                    </div>
<hr />
                    <div class="row">
						<div class="col-lg-6">
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Father Name   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->father_name ?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Mother Name   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->mother_name?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Religion   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->religion?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Marital Status   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->marital_status?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>	

						<label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Profession:</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->profession?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>	
                          <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Designation:</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->designation?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Gender   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->gender?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Emegency Contact   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->emergency_contact.'( '.$row1->emergencycontactrelation.' )'?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Present Address   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->present_address?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>	
						  <label for="inputSuccess" class="col-sm-5 control-label col-lg-4">Parmanent Address:</label>	
						  <label for="inputSuccess" class="col-sm-7 control-label col-lg-8"><?=$row1->permanent_address?></label>
						</div>
						<div class="col-lg-6">
							
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tenant Code   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->code?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Tenant ID   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->client_id?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">House Name   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->house_name?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Floor Name   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->floor_name?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Flat Name   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->flat_name?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Room   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->room?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Rent Type   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->rent_type?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Rent Date   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->rent_date?></label>
<span class="col-sm-12 col-lg-12" style="border-bottom:1px solid #eee; height:1px"></span>		
						  <label for="inputSuccess" class="col-sm-4 control-label col-lg-4">Advance   :</label>
						  <label for="inputSuccess" class="col-sm-8 control-label col-lg-8"><?=$row1->advance?></label>
						</div>
                    </div>
                    <hr />
					<div class="row">
						<div class="col-lg-12">
							<label for="inputSuccess" class="col-sm-12">Tenants Id   :</label>
							<span style="padding:3px; border:1px solid #eee;float: left;background: #ccc;">
                                                                <td class=" ">
										<a href="<?= base_url()?>public/uploads/employee/<?= $row1->cv_upload ?>" target="_blank" style="color:blue;font-weight:bold;">View</a>
										
										</td>
								<img src="<?= base_url()?>public/uploads/employee/<?= $row1->cv_upload ?>"  width="150" height="">
							</span>
						</div>
					</div>





                                     <div class="row">
						<div class="col-lg-12">
							<label for="inputSuccess" class="col-sm-12">Appplication Form:</label>
							<span style="padding:3px; border:1px solid #eee;float: left;background: #ccc;">
                                                                <td class=" ">
										<a href="<?= base_url()?>public/uploads/employee/<?= $row1->signature_upload?>" target="_blank" style="color:blue;font-weight:bold;">View</a>
										
										</td>
								<img src="<?= base_url()?>public/uploads/employee/<?= $row1->signature_upload?>"  width="150" height="">
							</span>
						</div>
					</div>
                    


</section>
</section>
<!--main content end-->














