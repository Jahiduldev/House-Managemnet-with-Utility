<!--main content start-->


<style>

                      
.col-sm-3.control-label {
	margin-top: 8px;
}

</style>
<section id="main-content">
    <section class="wrapper site-min-height">
       

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Clients
                    </header>
                    <div class="panel-body">
					
                        <div class="adv-table">
                            <table class="display table table-bordered" id="editable-sample"> <!--hidden-table-info   -->
                                <thead>
                                    <tr> 
                                        <th>Client Id</th>
										<th>Rent Code</th>
                                        <th>Client Name</th>   
                                        <th>Mobile</th>						
                                        <th>House</th>
                                        <th>Floor</th>
                                        <th>Flat </th>   
                                       <th>Authorization</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>

   

        <div id="clientModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<form action="<?php echo base_url(); ?>view_house_client/update" method="post" enctype="multipart/form-data">
			<!-- Modal content-->
			  <input type="hidden" class="form-control"  id="id" name="id">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tenents Information Update</h4>
			  </div>
			  <div class="modal-body" style="overflow:hidden">
				
                     <div class="form-group">
						<label for="" class="col-sm-3 control-label">Tenant ID</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="clientid" name="clientid" disabled>
						</div>
					</div>
					<div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select House*:</label>
                        <div class="col-sm-9">
                             <select class="form-control"  onchange="getFloor(this.value)" id="house_name" name="house_name" required>
                                  <option value="">Chose House</option>
                                   <?php

                                    $headlist = $this->db->get('add_house')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->house_name .'</option>';
                                    } 
                                    echo $house_name; ?>
                            </select>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Floor:</label>
                        <div class="col-sm-9">
                             <select class="form-control" name="floor" id="floor" onchange="getRoom(this.value)" required>


                                 <!-- <select class="form-control"  onchange="" id="house_name" name="house_name"> -->
                                   <option value="">Chose Floor</option>
                                    <?php

                                    $headlist = $this->db->get('add_floor')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->floor_name ."-".$hl->floor_code.'</option>';
                                    } 
                                    echo $house_name; ?>
                           <!--  </select> -->
                                    
                            </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Flat*</label>
                        <div class="col-sm-9">
                             <select class="form-control" id="flat" name="flat" onchange="getRoomNo(this.value)" required>
                                    <option value="">Chose Flat</option>

                                    <!--  <select class="form-control"  onchange="" id="house_name" name="house_name"> -->
                                    <?php

                                    $headlist = $this->db->get('add_flat')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->flat_name ."-".$hl->flat_code.'</option>';
                                    } 
                                    echo $house_name; ?>
                          <!--   </select> -->
                                    
                            </select>
                        </div>
                    </div>
					
					<!-- <div class="form-group" id="oomtype">
						<label for="" class="col-sm-3 control-label">Rent Type</label>
						<div class="col-sm-9">
							 
                         <input type="text" class="form-control" id="roomno" name="roomno" disabled/ >
						</div>
					</div>   -->
                    <div class="form-group" id="room">
						<label for="" class="col-sm-3 control-label">Room</label>
						<div class="col-sm-9">
							 <select class="form-control" id="roomn" name="roomn" onchange="">
                                    <option value="">Chose Room</option>
									<?php

										$headlist = $this->db->get('add_room')->result();
										$house_name=''; foreach($headlist as $hl){ 									
										 
											$house_name .= '<option value="'. $hl->id .'">'. $hl->room_name ."-".$hl->room_code.'</option>';
										} 
										echo $house_name; 
									?>
							 </select>                         
						</div>
					</div>
					
                    <div class="form-group">
						<label for="" class="col-sm-3 control-label">Code</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="code" name="code" disabled/>
						</div>
					</div>

                   
                    <div class="form-group">
						<label for="" class="col-sm-3 control-label">Rent Date</label>
						<div class="col-sm-9">
							 <input type="text" class="default-date-picker form-control" id="rentdate" name="rentdate" />
						</div>
					</div>

                    <div class="form-group">
						<label for="" class="col-sm-3 control-label">Advance Amount</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="advance" name="advance"/>
						</div>
					</div>
                   
					
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Name</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="name" name="name"/>
						</div>
					</div>
					 <div class="form-group">
						<label for="" class="col-sm-3 control-label">Father Name</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="fathername" name="fathername"/>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Mother Name</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="mothername" name="mothername"/>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Date Of Birth</label>
						<div class="col-sm-9">
							 <input type="text" class="default-date-picker form-control" id="date_birth" name="date_birth"/>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Gender</label>
						<div class="col-sm-9">
							 <select class="form-control" id="gender" name="gender">
                                    <option value="">Chose Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                            </select>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Marital Status</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="maritalstatus" name="maritalstatus"/>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Religion</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="religion" name="religion"/>
						</div>
					</div>

					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Parmanet Address</label>
						<div class="col-sm-9">
							  <input type="text" class="form-control" id="parmaneaddr" name="parmaneaddr"/>
						</div>
					</div> 
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Profession</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="profession" name="profession"/>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Designation</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="designation" name="designation"/>
						</div>
					</div>
					 <div class="form-group">
						<label for="" class="col-sm-3 control-label">Working Address</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="presentaddr" name="presentaddr"/>
						</div>
					</div>

					
					
					 <div class="form-group">
						<label for="" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="emailaddr" name="emailaddr"/>
						</div>
					</div> 

                    <div class="form-group">
						<label for="" class="col-sm-3 control-label">Mobile No</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="mobileno" name="mobileno"/>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Emergency</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="emergencycontact" name="emergencycontact"/>
						</div>
					</div>

                  <!--   <div class="form-group">
						<label for="" class="col-sm-3 control-label">Last Payment</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="lastpaymentdate" name="lastpaymentdate" disabled/>
						</div>
					</div> -->

					
                    
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Relation</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="emergencycontactrelation" name="emergencycontactrelation"/>
						</div>
					</div>
	                 <div class="form-group">
						<label for="" class="col-sm-3 control-label">ID Type</label>
						<div class="col-sm-9">
							 <select class="form-control" name="idtype" id="idtype">
										<option value="">Select ID Type</option>
										<option>Student ID</option>
										<option>National ID</option>
										<option>Service ID</option>
										<option>Birth ID</option>
                                                                                <option>Passport</option>
									</select>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">ID No</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="idno" name="idno"/>
						</div>
					</div>
 					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Status</label>
						<div class="col-sm-9">
						  <select class="form-control" id="status" name="status">
                                  <option value="">Chose Status</option>
                                  <option value="1">Active</option>
                                  <option value="2">Booked</option>
                          </select>
						</div>
					</div>
 					
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Tenant Photo</label>
						<div class="col-sm-9">
							<!-- <img  src=" id="imgg" "  height="100" width="100"> -->
							<!-- <input type="text" class="form-control" id="imgg" name="hnote"/> -->
							<img src=""  width="20%" id="Id_image">
							<input type="file" name="Id_image" id="Id_image" size="20" />
                           </span>
						</div>
					</div>
                                         <br>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Ids Image*</label>
						<div class="col-sm-9">
							
							<img src=""  width="20%" id="tenant_photo">
							<input type="file" name="tenant_photo*" id="tenant_photo" size="20" />
                                                      </span>
						</div>
					</div>
				    <br>
                                    
				  <div class="form-group">
						<label for="" class="col-sm-3 control-label">Appplication Form Upload</label>
						<div class="col-sm-9">
							
							<img src=""  width="20%" id="form_image">
							<input type="file" name="form_image" id="form_image" size="20" />
                           </span>
						</div>
					</div>
					
					<!-- <div class="form-group">
						<label for="" class="col-sm-3 control-label">User Name</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="username" name="username"/>
						</div>
					</div>
					<div class="form-group">
						<label for="" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							 <input type="text" class="form-control" id="password" name="password"/>
						</div>
					</div> -->

  					

									
			  </div>
			  <div class="modal-footer">
				<input type="submit" class="btn btn-default" value="Update">
			  </div>
			</div>
			</form> 
		  </div>
		</div>

       
    </section>
</section>
<!--main content end-->

