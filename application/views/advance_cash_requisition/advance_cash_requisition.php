<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Advance Cash Requisition
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('advance_cash_requisition/addRequisition'); ?>" enctype="multipart/form-data">



                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Project*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="project" name="project"  required> 
                                        <option value="">Select Project</option>
                                        <?php
                                        foreach ($get_project_data as $row) :
                                            ?>
                                            <option value="<?= $row->project; ?>"><?= $row->project_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Amount*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Amount" id="amount" name="amount" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Purpose*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Purpose" id="purpose" name="purpose" required></textarea>
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


