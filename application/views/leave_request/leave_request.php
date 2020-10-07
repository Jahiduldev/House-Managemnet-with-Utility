<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Leave Request
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('leave_request/addLeaveRequest'); ?>" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">From Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter From Date " id="from_date"  name="from_date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter To Date " id="to_date"  name="to_date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Leave Type*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="leave_type" name="leave_type" required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Leave Type</option>
                                        <option value="Sick">Sick</option>
                                        <option value="Casual">Casual</option>
                                        <option value="Annual">Annual</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Reason*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Note" id="reason" name="reason" required></textarea>
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


