<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Project Payment
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Client Name</th>
                                        <th>Project Name</th>
                                        <th>Due Amount</th>
                                        <th>Receive Amount</th>
                                        <th>Current Due Amount</th>
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $project_id = $row->project_id;
                                        $client_id = $row->client_id;
                                        $project_name = $row->project_name;
                                        $payment = $row->payment;
                                        $due = $row->due;
                                        $cur_due = $due - $payment;
                                        $query_1 = $this->db->query("select * from client where id='$client_id'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $client_name = $row_add->client_name;
                                        endforeach;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $client_name; ?></td>
                                            <td><?php echo $project_name; ?></td>
                                            <td><?php echo $due ?></td>
                                            <td><?php echo $payment ?></td>
                                            <td><?php echo $cur_due ?></td>
                                            <td> <button class="btn btn-primary btn-xs" onclick="addModal(<?= $project_id ?>);">Transaction</button>
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
                <h4 class="modal-title">Add Project Payment</h4>
            </div>

            <div class="modal-body">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('project_payment/addPayment'); ?>">

                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Project Name *</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="project_name" id="project_name" required="required" readonly>
                                <option value="">Select Project</option>
                                <?php
                                foreach ($project_data as $row) :
                                    ?>
                                    <option value="<?= $row->project_id; ?>"><?= $row->project_name; ?></option>
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
                                <option value="Payment">Receive</option>

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




<!-- modal -->

