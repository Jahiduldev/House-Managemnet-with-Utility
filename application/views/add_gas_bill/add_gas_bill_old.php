<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                       <b style="color:blue;">   Add GAS Bill </b> 
                    </header>
                    <div class="panel-body" style="background:#008B8B;color:white; ">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('add_gas_bill/addDepartmentData'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select House*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="hid" id="hid"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select House</option>
                                        <?php
                                        foreach ($get_company_data as $row) :
                                            ?>
                                            <option value="<?= $row->id; ?>"><?= $row->house_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
							
							
							   <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Billing Name *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Billing Name" id="billing_name" name="billing_name" required="required">
                                </div>
                            </div>
							
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Titas ID *</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Titas ID" id="titas_id" name="titas_id" required="required">
                                </div>
                            </div>
							
							  <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Billing Address</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Billing Address" id="billing_address" name="billing_address"></textarea>
                                </div>
                            </div>
							
							
							
							
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Single burner Number</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Single burner Number" id="sb" name="sbn" >
                                </div>
                            </div>
  <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Single burner Amount</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Single burner Amount" id="department" name="sba" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Double burner Number</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Double burner Number" id="department" name="dbn" >
                                </div>
                            </div>
							
							
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Double burner Amount</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Double burner Amount" id="department" name="dba" >
                                </div>
                            </div>
							 <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Notes</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Notes" id="company_address" name="note"></textarea>
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


