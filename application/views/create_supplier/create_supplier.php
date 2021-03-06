<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Create Supplier
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="SubMenuForm"  role="form" method="post"  action="<?php echo site_url('create_supplier/addBroker'); ?>">
                         <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Company Name*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="company" id="company"  required> <!-- input-sm m-bot15  -->
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
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Supplier Name *</label>
                                <div class="col-lg-10">  
                                    <input type="text" class="form-control" placeholder="Enter Supplier Name" id="add_broker_name" name="add_broker_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Supplier ID *</label>
                                <div class="col-lg-10">  
                                    <input type="text" class="form-control" placeholder="Enter Supplier Name" id="add_broker_id" name="add_broker_id" value="<?= $last_row ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Supplier Mobile Number *</label>
                                <div class="col-lg-10">  <input type="text" class="form-control" maxlength="11" minlength="11" pattern="\d*" title="Please enter only mobile number" placeholder="Enter Broker Mobile Number" id="add_broker_mobile_number" name="add_broker_mobile_number" ></div>
                            </div>




                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Supplier
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Supplier Name</th>
                                        <th>Supplier ID</th>
                                        <th>Supplier Mobile Number</th>


                                        <th>Action</th>
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($get_broker_data as $row) :
                                        $id = $row->id;
                                        $add_broker_name = $row->broker_name;
                                        $add_broker_id = $row->broker_id;
                                        $add_broker_mobile_number = $row->broker_mobile;
                                        ?>
                                        <tr class="gradeX">
                                            <td ><?php echo $add_broker_name ?></td>
                                            <td><?php echo $add_broker_id ?></td>
                                            <td><?php echo $add_broker_mobile_number ?></td>

                                            <td>

                                                <button class="btn btn-primary btn-xs" onclick="editBroker(<?= $id ?>);"><i class="fa fa-pencil"></i></button>
                                                <!--<button class="btn btn-danger btn-xs" onclick="deleteReference(<?= $id ?>);"><i class="fa fa-trash-o "></i></button>-->
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Supplier</h4>
                    </div>

                    <div class="modal-body">
                        <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('create_supplier/editBroker'); ?>">
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label" for="name">Supplier Name</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="Enter Broker  Name" id="edit_broker_name" name="edit_broker_name" class="form-control" readonly>
                                    <input type="hidden" id="edit_id" name="edit_id" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Supplier ID *</label>
                                <div class="col-lg-9">  
                                    <input type="text" class="form-control" placeholder="Enter Broker ID" id="edit_broker_id" name="edit_broker_id"  readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label" for="name">Supplier Mobile Number</label>
                                <div class="col-lg-9">
                                    <input type="text" maxlength="11" minlength="11" pattern="\d*" placeholder="Enter Supplier Mobile Number" id="edit_broker_mobile_number" name="edit_broker_mobile_number" class="form-control">
                                    <input type="hidden" id="edit_menu_id" name="edit_menu_id" />
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
        <!-- Modal -->
        <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="<?= site_url('create_broker/deleteBroker') ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Delete Menu Confirmation</h4>
                        </div>
                        <div class="modal-body">

                            Do You Want To Delete Broker?
                            <input type="hidden" id="delete_id" name="delete_id" />
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success" type="submit">Yes</button>
                            <button data-dismiss="modal" class="btn btn-default" type="button">No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal -->

    </section>
</section>
<!--main content end-->
