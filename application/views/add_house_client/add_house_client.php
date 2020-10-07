<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                         <b style="color:blue;">Add Tenant </b>
                    </header>
                    <div class="panel-body" style="background:#008B8B;color:white; ">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="<?php echo site_url('add_house_client/addEmployeeData'); ?>" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Client Id*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Client Id" id="client_id" name="client_id" value="<?=rand(100000, 999999);?>" required>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select House*</label>
                                <div class="col-lg-10">
                                  <select name="house" class="form-control" onchange="getFloor(this.value)" required>
                                    <option value="">Select House</option>
                                     
                                      <?php $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                            $house_name .= '<option value="'. $hl->id .'">'. $hl->house_name .'</option>';
                                        } echo $house_name; ?>
                                    </select> 
                                </div>
                            </div>
                            
                              <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Floor*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="floor" id="floor" onchange="getRoom(this.value)"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Floor</option>
                                       
                                    </select>
                                </div>
                            </div>
                            
                            
                            
                              <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Flat*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="flat" name="flat" onchange="getRoomNo(this.value)"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Flat</option>

                                    </select>
                                </div>
                            </div>
                            
                            
                                  <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Rent Type*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="rent_type" name="rent_type" required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Rent Type</option>
                                        <option value="1">Flat / Office</option>
                                        <option value="2">Room / Shop</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            
               <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Room</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="room" name="room" > <!-- input-sm m-bot15  -->
                                        <option value="">Select Room</option>

                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Rent Date</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Rent Date" id="rent_date"  name="rent_date" >
                                </div>
                            </div>
                            
               <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Advance Amount</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Advance Amount" id="advance" name="advance"  >
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            <?php  foreach($bill_type as $bill){ ?>
                            
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><?php echo $bill->name ; ?></label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Amount" id="employee_name" name="<?php echo 'bill['.$bill->id.']' ; ?>"  >
                                </div>
                            </div>
                            
                        <?php   }  ?>
                            
                            
                            
                        

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Name" id="client_name" name="client_name"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Father Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Father Name" id="father_name" name="father_name" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mother Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Mother Name" id="mother_name" name="mother_name" >
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date Of Birth</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Date Of Birth" id="date_birth"  name="date_birth" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="gender" name="gender" > <!-- input-sm m-bot15  -->
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Marital Status</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="marital_status" name="marital_status" > <!-- input-sm m-bot15  -->
                                        <option value="">Select Marital Status</option>
                                        <option value="Single">Single</option>
                                        <option value="Single">Married</option>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Religion</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Religion" id="religion" name="religion" >
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Permanent Address*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Permanent Address" id="permanent_address" name="permanent_address" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Profession:*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Present Address" id="present_address" name="profession" required></textarea>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Designation:</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Designation" id="present_address" name="designation" required></textarea>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Working Address*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Working  Address" id="present_address" name="present_address" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Id Upload*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="idtype">
                                        <option value="">Select ID Type</option>
                                        <option value="Student ID">Student ID</option>
                                        <option value="National ID">National ID</option>
                                        <option value="Service ID">Service ID</option>
                                        <option value="Birth ID">Birth ID</option>
                                                                                <p>
                                    </select>
                                    <input  class="form-control" type="text" placeholder="Enter ID No" name="idno" required>     
                                    <input type="file" name="cv" id="cv" size="20" required>
                                    
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Email</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Email" id="emails" name="email" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mobile Number*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number" id="mobile_number" name="mobile_number"  maxlength="11" minlength="11" pattern="\d*" required>
                                </div>
                            </div>

                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Emergency Contact</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Emergency Contact" id="emergency_contact" name="emergency_contact" >
                                    <input type="text" class="form-control" placeholder="Enter Relation of  Emergency Contact" id="" name="emergencycontact_relation" >
                                </div>
                            </div>



                         

                          

                            

                        

                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">User Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter User Name" id="user_name"  name="user_name" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Password*</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" placeholder="Enter Password" id="password"  name="password" required>
                                </div>
                            </div> 

                            
                           




                           
                            



                           

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Client Photo Upload*</label>
                                <div class="col-lg-10">
                                    <input type="file" name="photo" id="photo" size="20" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Appplication Form Upload</label>
                                <div class="col-lg-10">
                                    <input type="file" name="signature" id="signature" size="20"  >
                                </div>
                            </div>

                            

                           

                            


                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>


    </section>
</section>
<!--main content end-->


