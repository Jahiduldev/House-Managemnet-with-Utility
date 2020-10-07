<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Assign Project
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('assign_project/addProject'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Employee*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" id="employee" name="employee" onchange="getProjectDiv(this.value)" required> 

                                        <?php
                                        foreach ($get_employee_data as $row) :
                                            if ($emp_id == ($row->id)):
                                                ?>
                                                <option value="<?= $row->id; ?>" selected><?= $row->emp_name; ?></option>
                                                <?php
                                                else:
                                                    ?>
                                                <option value="<?= $row->id; ?>" ><?= $row->emp_name; ?></option>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="projectDiv">


                            </div>

                            <hr>

                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>


    </section>
</section>
<!--main content end-->


