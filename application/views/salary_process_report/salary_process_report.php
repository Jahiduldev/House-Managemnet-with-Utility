<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- <div class="row">
             <div class="col-lg-12">
                 <section class="panel">
                     <header class="panel-heading">
                         Add Indirect Expense Type
                     </header>
                     <div class="panel-body">
                         <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="<?php echo site_url('indirect_expense_type/addMenu'); ?>">
                             <div class="form-group">
                                 <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Type *</label>
                                 <div class="col-lg-10">
                                     <input type="text" class="form-control" placeholder="Enter Type Name" id="type" name="type" minlength="2" required>
                                 </div>
                             </div>
 
                             <button type="submit" class="btn btn-info pull-right">Submit</button>
                         </form>
 
                     </div>
                 </section>
             </div>
         </div>-->
        
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add Salary Process
                    </header>
                    <div class="panel-body">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="<?php echo site_url('salary_process_report/get_date_data'); ?>">
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">From *</label>
                                <div class="col-lg-2">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter From" id="date_from"  name="date_from" value="<?php
                                    if (isset($date_from)) {
                                        echo $date_from;
                                    } else {
                                       // echo date('Y-m-d');
                                    }
                                    ?>" required>
                                </div>
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To *</label>
                                <div class="col-lg-2">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter To" id="date_to"  name="date_to" value="<?php
                                    if (isset($date_to)) {
                                        echo $date_to;
                                    } else {
                                     //   echo date('Y-m-d');
                                    }
                                    ?>" required>
                                </div>

                                

                            </div>


                            <button type="submit"   class="btn btn-info pull-right ">Submit</button>

                        </form>

                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Salary Add Report
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

                                        <th>Employee ID </th>

                                        <th>Gross Salary</th>
                                        <th>Salary Add</th>
                                        <th>Salary Deduct</th>
                                        <th>Salary Month</th>
                                        <th>Net Payable Salary</th>
                                        <!--<th>Action</th>-->
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $Total_payable = 0;
                                    foreach ($get_salary_deduct_data as $row) :
                                        $id = $row->emp_id;
                                        $emp_id = $row->emp_id;

                                        $gross_salary = $row->gross_salary;
                                        $salary_add = $row->salary_add;

                                        $add_arr = explode("-", $salary_add);
                                        $salary_add_name = "";
                                        foreach ($add_arr as $value2):

                                            $query_2 = $this->db->query("select * from salary_add_type where id='$value2'");
                                            $result_2 = $query_2->result();
                                            foreach ($result_2 as $row_add):
                                                $salary_add_name = $salary_add_name . "," . $row_add->type;
                                            endforeach;
                                        endforeach;
                                        $salary_deduct = $row->salary_deduct;

                                        $deduct_arr = explode("-", $salary_deduct);
                                        $salary_deduct_name = "";
                                        foreach ($deduct_arr as $value):

                                            $query_1 = $this->db->query("select * from salary_deduct_type where id='$value'");
                                            $result_1 = $query_1->result();
                                            foreach ($result_1 as $row_add):
                                                $salary_deduct_name = $salary_deduct_name . "," . $row_add->type;
                                            endforeach;

                                        endforeach;

                                        $salary_month = $row->salary_month;
                                        $process_date = $row->process_date;
                                     

                                        $query_1 = $this->db->query("select * from employee where id='$emp_id'");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $emp_id = $row_add->emp_id;
                                            $emp_name = $row_add->emp_name;

                                        endforeach;

     
                                        $salary_add = 0;
                                        $query_salary_add = $this->db->query("select amount from employee_salary_add where emp_id='$id'");
                                        $result_salary_add = $query_salary_add->result();
                                        foreach ($result_salary_add as $row_add):
                                            $salary_add += $row_add->amount;
                                        endforeach;


                                        $salary_deduct = 0;
                                        $query_salary_deduct = $this->db->query("select amount from employee_salary_deduct where emp_id='$id'");
                                        $result_salary_deduct = $query_salary_deduct->result();
                                        foreach ($result_salary_deduct as $row_deduct):
                                            $salary_deduct += $row_deduct->amount;
                                        endforeach;

                                        $payable = ($gross_salary + $salary_add) - $salary_deduct;

                                        $Total_payable += $payable;
                                        ?>
                                        <tr class="gradeX">

                                            <td><?php echo $emp_id ?></td>
                                            <td><?php echo $gross_salary; ?></td>
                                            <td><?php echo '<a onclick="getAddSallaryInfo('. $id .')" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">'. $salary_add.'</a>'; ?></td>
                                            <td><?php echo $salary_deduct; ?></td>
                                            <td><?php echo $salary_month; ?></td>
                                            <td><?php echo $payable; ?></td>
                                            <!--<td>
                                                <button class="btn btn-primary btn-xs" onclick="editMenu(<?= $id ?>);"><i class="fa fa-pencil"></i></button>                                            
                                             <!-- <button class="btn btn-danger btn-xs" onclick="deleteMenu(<?//=$id?>);"><i class="fa fa-trash-o "></i></button>-->            
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td><strong><?php echo $Total_payable; ?></strong></td>
                                        
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="<?= site_url('add_menu/deleteMenu') ?>">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Delete Menu Confirmation</h4>
                        </div>
                        <div class="modal-body">

                            Do You Want To Delete This Menu?
                            <input type="hidden" id="delete_menu_id" name="delete_menu_id" />
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

        <!-- Modal -->
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
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
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
