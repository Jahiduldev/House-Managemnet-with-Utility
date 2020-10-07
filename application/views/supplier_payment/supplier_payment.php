<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Supplier Payment
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Supplier Name</th>
										 
                                        <th>Due Amount</th>
                                        <th>Payment Amount</th>
                                        <th>Current Due Amount</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($broker_data as $row) :
                                        $ref_id = $row->id;
                                        $broker_name = $row->broker_name;
                                        $payment = $row->payment;
                                        $due = $row->due;
                                        $cur_due = $due - $payment;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $broker_name; ?></td>
                                             
                                            <td>

                                                <?php
                                                echo
                                                '<a onclick="getAddSallaryInfo(' . $ref_id . ')" href="javascript:void(0)" 
												data-toggle="modal" data-target="#myModal">' . $due . '</a>';
                                                ?>
                                            </td>
                                            <td><?php echo '<a onclick="getAddSallaryInfo(' . $ref_id . ')" href="javascript:void(0)" 
												data-toggle="modal" data-target="#myModal">' . $payment . '</a>'; ?>



                                            </td>

                                            <td>

                                                <?php echo '<a onclick="getAddSallaryInfo(' . $ref_id . ')" href="javascript:void(0)" 
												data-toggle="modal" data-target="#myModal">' . $cur_due . '</a>'; ?>

                                            </td>
                                            <td> <button class="btn btn-primary btn-xs" onclick="addModal(<?= $ref_id ?>);">Transaction</button>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>																	
                    </div>

                </section>
            </div>
        </div>




    </section>
</section>
<!--main content end-->

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Supplier Payment</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('supplier_payment/addPayment'); ?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Supplier Name *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="broker_name" id="broker_name" required="required" readonly>
                                <option value="">Select Supplier</option>
                                <?php foreach ($broker_data as $row): ?>
                                   
								   <option value="<?= $row->id; ?>"><?= $row->broker_name; ?></option>
								<?php endforeach; ?>
                            </select>
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Select Project*</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="project" name="project"  required> 
                                <option value="">Select Project</option>
                                <?php foreach ($sup_data as $row12): ?>
                                    
									<option value="<?= $row12->id; ?>"><?= $row12->project_name; ?></option>
								<?php endforeach; ?>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payment Type *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="payment_type" id="payment_type" required="required">
                                <option value="">Select Payment Option</option>
                                <option value="Due">Due</option>
                                <option value="Payment">Payment</option>

                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Amount *</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control"  id="payment_amount" name="payment_amount" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Upload Cheque </label>
                        <div class="col-lg-9">
                            <input type="file" name="photo" id="photo" size="20" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Payment Voucher</label>
                        <div class="col-lg-9">
                            <input type="file" name="photo2" id="photo" size="20" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes *</label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="note" name="note" required="required"></textarea>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-lg-offset-10 col-lg-2">
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
        <form method="post" action="<?= site_url('view_customer/deleteModel') ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Model Confirmation</h4>
                </div>
                <div class="modal-body">

                    Do You Want To Delete This Model?
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



<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Type Confirmation</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('salary_add_report/editMenu'); ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-lg-3 col-sm-3 control-label">Employee ID *</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="edit_empy_id" name="edit_empy_id" required> <!-- input-sm m-bot15  -->
                                <option value="">Income Type</option>
                                <?php
                                foreach ($get_salary_deduct_type_data as $row) :
                                    ?>
                                    <option value="<?= $row->id; ?>"><?= $row->emp_id; ?></option>
<?php endforeach; ?>
                            </select>
                            <input type="hidden" id="edit_salary_deduct_id" name="edit_salary_deduct_id" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-lg-3 col-sm-3 control-label">Add Type*</label>
                        <div class="col-lg-9">
                            <select class="form-control" id="edit_deduct_type" name="edit_deduct_type" required> <!-- input-sm m-bot15  -->
                                <option value="">Deduct Type</option>
                                <?php
                                foreach ($get_salary_deduct_type_data2 as $row) :
                                    ?>
                                    <option value="<?= $row->id; ?>"><?= $row->type; ?></option>
<?php endforeach; ?>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label" for="name">Amount</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Enter Type Name" id="edit_deduct_amount" name="edit_deduct_amount" class="form-control">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 col-sm-3 control-label" for="name">Note</label>
                        <div class="col-lg-9">
                            <input type="text" placeholder="Enter Type Name" id="edit_deduct_note" name="edit_deduct_note" class="form-control">

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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="details_header"></h4>
            </div>
            <div class="modal-body">
                <p>
                <table class="display table table-bordered">
                    <tr>
                        <th>Project Name</th>
                        <th>Due Amount</th>
                        <th>Payment Amount</th>
                        <th>Current Due Amount</th>
                    </tr>
                    <tbody id="add_details">

                    </tbody>

                </table>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!-- modal -->

</section>
</section>
<!--main content end-->
<!-- modal -->

