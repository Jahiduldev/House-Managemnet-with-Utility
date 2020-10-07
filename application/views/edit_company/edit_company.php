<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Company
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('view_company/editCompanyData'); ?>" enctype="multipart/form-data">
                            <?php
                            foreach ($get_company_data as $row) :
                                $id = $row->id;
                                $company_name = $row->company_name;
                                $company_address = $row->company_address;
                                 
                                $image_name = $row->image_name;
                                $date = $row->date;
                                $status = $row->status;
                            endforeach;
                            ?>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company Name*</label>
                                <div class="col-lg-10">
                                    <input type="hidden"  id="id" name="id" value="<?= $id; ?>">
                                    <input type="text" class="form-control" placeholder="Enter Company Name" id="company_name" name="company_name" value="<?= $company_name; ?>" required="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company Address*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Company Address" id="company_address" name="company_address"><?= $company_address; ?></textarea>
                                </div>
                            </div>
                          <!--  <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Prefix*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Prefix" id="company_code" name="company_code" value="<?= $company_code; ?>" >
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Upload Image*</label>
                                <div class="col-lg-10">
                                     
									<img src="<?php echo $base_url . "public/uploads/company/" . $image_name; ?>" class="img-rounded" width="20%" height="auto"  />
									<input type="file" name="userfile" size="20" />
								</div>
								                                 
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Status*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="add_status" name="status"> <!-- input-sm m-bot15  -->
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


