<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Employee
                    </header>
                    <div class="panel-body">
                       <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="<?php echo site_url('view_employee/editEmployeeData'); ?>" enctype="multipart/form-data">
                            <?php
                            foreach ($get_employee_data as $row) :
                                $id = $row->id;
                                $emp_name = $row->emp_name;
                                $emp_user_name = $row->user_name;
                                $date_birth = $row->date_birth;
                                $date_joining = $row->joining_date;
                                $company= $row->company;
                                $department = $row->department;
                                $gross_salary = $row->gross_salary;
                                $reporting_to = $row->reporting_to;
                                $appointed_date = $row->appointed_date;
                                $joining_date   = $row->joining_date;
                                $prohibition_period = $row->prohibition_period;
                                $gender             = $row->gender;
                                $religion           = $row->religion;
                                $mobile_number = $row->mobile_number;
                                $father_name   = $row->father_name;
                                $mother_name   = $row->mother_name;
                                $emergency_contact = $row->emergency_contact;
                                $present_address   = $row->present_address;
                                $permanent_address  = $row->permanent_address;
                                $marital_status    = $row->marital_status;
                                $password          = $row->password;
                                $emp_code = $row->emp_id;
                                $email = $row->email; 
                                $user_name  = $row->user_name;                           
                                $photo_upload = $row->photo_upload;
                                $signature_upload = $row->signature_upload;
                                $cv_upload = $row->cv_upload;
                                $date = $row->date;

                            endforeach;
                            ?>
                            <?php
                            $role_id = $this->session->userdata('role_id');
                            if ($role_id == 3):
                                $readonly = "readonly";
                                $st = "style=display:none;";
                            else:
                                $readonly = "";
                                $st = "";
                            endif;
                            ?>


                            <div class="form-group" <?= $st ?>>
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee Code*</label>
                                <div class="col-lg-10">
                                    <label for="inputSuccess" class="col-sm-2 control-label col-lg-2"><?= $emp_code; ?></label>

                                </div>
                            </div>
                            <div class="form-group" <?= $st ?>>
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee  Name*</label>
                                <div class="col-lg-10">
                                    <input type="hidden"  id="id" name="id" value="<?= $id; ?>">
                                    <input type="text" class="form-control" placeholder="Employee  Name" id="emp_name" name="emp_name" value="<?= $emp_name ?>" required="required" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Date Of Birth*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Date Of Birth" id="date_birth"  name="date_birth" value="<?=$date_birth;?>" required>
                                </div>
                            </div>

                             <div class="form-group" <?= $st ?>>
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="company" name="company" onchange="getDepartment(this.value)"> <!-- input-sm m-bot15  -->
                                        <option value="">Select Company</option>

                                        <?php
                                        foreach ($get_company_data as $row) :
                                            if ($row->id == $company):
                                                ?>
                                                <option value="<?= $row->id; ?>" selected><?= $row->company_name; ?></option>
                                                <?php
                                            else:
                                                ?>
                                                <option value="<?= $row->id; ?>"><?= $row->company_name; ?></option>
                                            <?php
                                            endif;
                                            ?>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Department*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="department" name="department"  onchange="getDesignation(this.value)" required> 
                                        <option value="<?=$department?>">Select Department</option>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Designation*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="designation" name="designation" required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Designation</option>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gross Salary*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Gross Salary" id="gross_salary" name="gross_salary" value="<?= $gross_salary?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Reporting To*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Reporting To" id="reporting_to" name="reporting_to" value="<?=$reporting_to?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Appointed Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Appointed Date" id="appointed_date"  name="appointed_date" value="<?=$appointed_date?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Joining Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Joining Date " id="joining_date"  name="joining_date" value="<?=$joining_date?>" required>
                                </div>
                            </div>  

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Prohibition Period*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Prohibition Period" id="prohibition_period"  name="prohibition_period" value="<?=$prohibition_period?>" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">User Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter User Name" id="user_name"  name="user_name" value="<?=$user_name?>" required>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Password*</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" placeholder="Enter Password" id="password"  name="password" value="<?=$password?>" required>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Gender*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" value="<?=$gender?>" id="gender" name="gender" required> <!-- input-sm m-bot15  -->
                                        <option value=""><?=$gender?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Marital Status*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="marital_status" name="marital_status" required> <!-- input-sm m-bot15  -->
                                        <option value=""><?=$marital_status?></option>
                                        <option value="Single">Single</option>
                                        <option value="Single">Married</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Religion*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Religion" id="religion" name="religion" value="<?=$religion?>" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mobile Number*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number" id="mobile_number" name="mobile_number" value="<?=$mobile_number?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Email*</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" value="<?=$email?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Father Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Father Name" id="father_name" name="father_name" value="<?=$father_name?>" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mother Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Mother Name" id="mother_name" name="mother_name" value="<?=$mother_name?>" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Emergency Contact*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Emergency Contact" id="emergency_contact" name="emergency_contact" value="<?=$emergency_contact?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Photo Upload*</label>
                                <div class="col-lg-10">
                                    <img src="<?=base_url()?>public/uploads/employee/<?=$photo_upload?>" width="20%" id="Id_image">
                                    <input type="file" name="photo" id="photo" size="20" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Signature Upload*</label>
                                <div class="col-lg-10">
                                    <img src="<?=base_url()?>public/uploads/employee/<?=$signature_upload?>" width="20%" id="Id_image">
                                    <input type="file" name="signature" id="signature" size="20"  required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Present Address*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Present Address" id="present_address" name="present_address" value="<?=$present_address?>" required><?=$present_address?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Permanent Address*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Permanent Address" id="permanent_address" name="permanent_address" value="<?=$permanent_address?>" required><?=$permanent_address?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">CV Upload*</label>
                                <div class="col-lg-10">
                                    <img src="<?=base_url()?>public/uploads/employee/<?=$cv_upload?>" width="20%" id="Id_image">
                                    <input type="file" name="cv" id="cv" size="20" required/>
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


