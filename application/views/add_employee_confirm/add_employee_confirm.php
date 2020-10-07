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
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Department</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control"  id="department" name="department"  readonly>

                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Designation</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control"  id="designation" name="designation"  readonly>

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
                        Employee  Confirmation
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  action="<?php echo site_url('add_employee_confirm/addConfirm'); ?>" enctype="multipart/form-data">

     
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Confirmation Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter Date" id="confirm_date"  name="confirm_date" required>
                                    <input type="hidden" id="edit_id" name="edit_id" />
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


