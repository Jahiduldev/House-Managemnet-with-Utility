<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Designation
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('add_designation/addDesignationData'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company Name*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="company" id="company" onchange="getDepartment(this.value)"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Company</option>
                                        <?php
                                        foreach ($get_company_data as $row) :
                                            ?>
                                            <option value="<?= $row->id; ?>"><?= $row->company_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Department*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="department" id="department"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select</option>
                                       
                                    </select>
                                </div>
                            </div>
                            
                            
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Designation*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Designation" id="designation" name="designation" required>
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


