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
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('operation_request_panel/addProject'); ?>" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="employee" name="employee"  required> 

                                        <?php
                                        foreach ($get_employee_data as $row) :
                                            ?>
                                            <option value="<?= $row->id; ?>"><?= $row->emp_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                  <input type="hidden" id="market_visit_id" name="market_visit_id" value="<?=$market_visit_id?>" />
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="company" name="company" onchange="getClient(this.value)" required> 
                                        <option value="">Select Company</option>
                                        <?php
                                        foreach ($get_company_data as $row) :
                                            $c_id = $row->id;
                                            if ($select_company == $c_id):
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
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Client*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="client" name="client"  required> 
                                        <option value="">Select Client</option>
                                        <?php
                                        foreach ($get_client_data as $row) :
                                            ?>
                                            <option value="<?= $row->id; ?>"><?= $row->client_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <br>
                                    <button class="btn btn-success btn-sm" type="button" onclick="editClient()">Add Client</button>
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

<!-- Modal -->
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Client Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('operation_request_panel/addClient/'.$market_visit_id); ?>">
                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label" for="name">Client Name</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Enter Client Name" id="client_name" name="client_name" class="form-control">
                            <input type="hidden" id="client_company_id" name="client_company_id" value="<?=$select_company?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-9">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- modal -->
