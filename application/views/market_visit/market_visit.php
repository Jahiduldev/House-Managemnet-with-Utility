<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Market Visit
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('market_visit/addMarketVisit'); ?>" enctype="multipart/form-data">


                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company Name*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="company" id="company"   required> <!-- input-sm m-bot15  -->
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
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Market Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Market Name" id="market" name="market" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Contact Person Name*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Contact Person Name" id="contact_person" name="contact_person" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mobile No*</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="Enter Mobile No" id="mobile" name="mobile" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Email*</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Note*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter Note" id="note" name="note" required></textarea>
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


