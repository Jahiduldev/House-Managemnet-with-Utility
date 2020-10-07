<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Employee  Information
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm2"  role="form" method="post"  action="#" enctype="multipart/form-data">

                            <div class="form-group">
                                <div class="col-lg-6 col-lg-offset-2">
                                    <input type="text" class="form-control"  id="employee_code" placeholder="Enter employee id" name="employee_code" pattern="\d*" title="Please enter only employee code">                                 
                                </div>
                                <div class="col-lg-4">
                                    <button type="button" class="btn btn-info pull-left" onclick="getEmployeeInfo()">Search</button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control"  id="employee_name" name="employee_name"  readonly>
                                </div>
                            </div>

                          
                  
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Joining Date</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control"  id="joining_date"  name="joining_date" readonly>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mobile Number</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control"  id="mobile_number" name="mobile_number" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Email</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control"  id="email" name="email" readonly>
                                </div>
                            </div>

                        </form>

                    </div>
                </section>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Employee Leave Confirmation
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="<?php echo site_url('add_employee_leave/addConfirmLeave'); ?>" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Leave Type*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="leave_type" name="leave_type" required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Type</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Sick">Sick</option>
                                        <option value="Annual">Annual</option>
                                        <option value="Maternity">Maternity</option>
                                        <option value="Special">Special</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">From Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="from_date"  name="from_date" required>
                                    <input type="hidden" id="edit_id" name="edit_id" />
                                </div>
                            </div>

                          

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="to_date"  name="to_date" required >

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Remarks</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Remarks " id="remark" name="remark" ></textarea>
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


