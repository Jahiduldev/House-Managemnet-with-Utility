<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Client
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addDesignationForm"  role="form" method="post"  action="<?php echo site_url('view_client/editClientData'); ?>" enctype="multipart/form-data">
                            <?php
                            foreach ($get_client_data as $row) :
                                $id = $row->id;
                                $company_id = $row->company_id;                                
                                $client_name = $row->client_name;
                                $status = $row->status;
                            endforeach;
                            ?>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company Name*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="company" id="company"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select Company</option>
                                        <?php
                                        foreach ($get_company_data as $row) :
                                            if($company_id==$row->id):
                                               ?>
                                        <option value="<?= $row->id; ?>" selected><?= $row->company_name; ?></option>
                                        <?php
                                        else:
                                            ?>
                                         <option value="<?= $row->id; ?>" ><?= $row->company_name; ?></option>
                                        <?php
                                            endif;
                                            ?>                                         
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <input type="hidden"  id="id" name="id" value="<?= $id; ?>">
                            </div>
                            
                            
                            
                            
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Client*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Client Name" id="client" name="client" value="<?= $client_name ?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Status*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="status" name="status"> <!-- input-sm m-bot15  -->
                                        <option value="">Select Status</option>
                                        <?php
                                        foreach ($get_status_data as $row) :
                                            if ($row->status_id == $status):
                                                ?>
                                                <option value="<?= $row->status_id; ?>" selected><?= $row->status_detail; ?></option>
                                                <?php
                                            else:
                                                ?>
                                                <option value="<?= $row->status_id; ?>"><?= $row->status_detail; ?></option>
                                            <?php
                                            endif;
                                            ?>

                                        <?php endforeach; ?>
                                    </select>
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


