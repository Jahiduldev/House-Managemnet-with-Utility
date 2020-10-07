<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Project
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('add_project/addProject'); ?>" enctype="multipart/form-data">

                            
                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="company" name="company" onchange="getClient(this.value)" required> 
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
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Client*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="client" name="client"  required> 
                                        <option value="">Select Client</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Project Name*</label>
                                <div class="col-lg-10">
                                     <input type="text" class="form-control" placeholder="Enter Project Name" id="project" name="project" required>
                                </div>
                            </div>
                            
                            
                             <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Project Description*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Project Description" id="project_description" name="project_description" required></textarea>
                                </div>
                            </div>
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Project Amount*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Project Amount" id="project_amount" name="project_amount" required>
                                </div>
                            </div>
                         
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Deadline*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter  Date " id="deadline"  name="deadline" required>
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


