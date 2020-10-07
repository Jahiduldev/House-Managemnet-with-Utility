<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <?php
                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    $role_id = $this->session->userdata('role_id');
                    if ($role_id == 3):
                        $display = "style='display:none;'";
                    else:
                        $display = "";
                    endif;
                    ?>
                    <header class="panel-heading">
                        Attendance Report

                    </header>
                    <?php
                    $date = date('Y-m-d');
                    $date_str = $date;
                    $date_end = $date;
                    ?>
                    <div class="panel-body">
                        <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('shop_wise_report/getReport'); ?>">
                            <div class="form-group">
                                <div class="col-lg-12" >
                                    <a class="pull-right" href="<?php echo site_url('submit_attendance'); ?>"><button type="button"  class="btn btn-info ">Attendance</button></a>
                                </div>
                            </div>
                            <div class="form-group"
                            <?= $display; ?>
                                 >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Company</label>
                                <div class="col-lg-10" >
                                    <select class="form-control m-bot15" name="select_company" id="select_company"  onChange="getEmployee(this.value)">
                                        <option value="" >Choose one of the following Company...</option>
                                        <?php
                                        foreach ($get_company_data as $row) :
                                            if ($row->id == $select_company):
                                                ?>
                                                <option value="<?= $row->id; ?>" selected><?= $row->company_name . "(" . $row->company_code . ")"; ?></option>
                                                <?php
                                            else:
                                                ?>
                                                <option value="<?= $row->id; ?>"><?= $row->company_name . "(" . $row->company_code . ")"; ?></option>
                                            <?php
                                            endif;
                                            ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group"
                            <?= $display; ?>
                                 >
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select Employee</label>
                                <div class="col-lg-10">
                                    <select class="form-control m-bot15" name="select_employee" id="select_employee">
                                        <option value="" >Choose one of the following employee...</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" <?= $display; ?>>
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">From Date</label>
                                <div class="col-lg-4">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from" value="<?php
                                    echo $date_from;
                                    ?>">
                                </div>
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">To Date</label>
                                <div class="col-lg-4">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to" value="<?php
                                    echo $date_to;
                                    ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info pull-right" <?= $display; ?>>Submit</button>
                        </form>

                    </div>
                </section>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Attendance Report
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
                                        <th>Company Name</th>										
                                        <th >In Time</th>
                                        <th >out Time</th>
                                        <th class="hidden-phone">Date</th>
                                        <th class="hidden-phone">Employee Name</th>                                   
                                        <th class="hidden-phone">In Picture</th>
                                        <th class="hidden-phone">Out Picture</th>

                                        <?php
                                        if ($role_id == 3):
                                        else:
                                            ?>
                                            <th class="hidden-phone">Action</th>
                                        <?php
                                        endif;
                                        ?>


<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $date = date('Y-m-d');
                                    if ($select_employee == ''):
                                        $query_str = "select * from employee where company='$select_company'";
                                    elseif ($select_employee == 'all'):
                                        $query_str = "select * from employee";
                                    else:
                                        $query_str = "select * from employee where id='$select_employee'";
                                    endif;
                                    $query_emp = $this->db->query($query_str);
                                    $result_emp = $query_emp->result();
                                    if (count($result_emp) > 0):
                                        foreach ($result_emp as $rowemp):
                                            $emp_id = $rowemp->id;
                                            $image_name = $rowemp->photo_upload;
                                            $emp_full_name = $rowemp->emp_name;
                                            $company_id = $rowemp->company;
                                            $query_shop = $this->db->query("select * from company where id='$company_id'");
                                            $result_shop = $query_shop->result();
                                            if (count($result_shop) > 0):
                                                foreach ($result_shop as $rowshop):
                                                    // echo "select * from attendance where emp_id='$emp_id' and (`date_time` between '$date_from 00.00.00' and '$date_to 23.59.59')  order by id DESC";
                                                    $company_name = $rowshop->company_name;
                                                    $company_code = $rowshop->company_code;

                                                    $query_emp_att = $this->db->query("select * from attendance where emp_id='$emp_id' and (`date` between '$date_from' and '$date_to')");
                                                    $result_emp_att = $query_emp_att->result();
                                                    if (count($result_emp_att) > 0):
                                                        foreach ($result_emp_att as $rowempatt):
                                                            $id = $rowempatt->id;
                                                            $date_time = $rowempatt->date_time;
                                                            $date_time_out = $rowempatt->date_time_out;
                                                            $image = $rowempatt->image;
                                                            $image_out = $rowempatt->image_out;
                                                            $date = $rowempatt->date;
                                                            ?>

                                                            <tr class="gradeX">
                                                                <td><?php echo $company_name . "(" . $company_code . ")"; ?></td>

                                                                <td ><?php echo substr($date_time, 10); ?></td>
                                                                <td ><?php echo substr($date_time_out, 10); ?></td>
                                                                <td class="hidden-phone"><?php echo $date; ?></td>
                                                                <td class="hidden-phone"><?php echo $emp_full_name; ?></td>
                                                                <td class="hidden-phone"><img src="<?php echo $base_url . "/public/uploads/attendance/" . $image; ?>" class="task-thumb" onClick="showImg('<?= $image ?>');"/></td>
                                                                <td class="hidden-phone"><img src="<?php echo $base_url . "/public/uploads/attendance/" . $image_out; ?>" class="task-thumb" onClick="showImg('<?= $image_out ?>');"/></td>
                                                          
                                                                <?php
                                                                if ($role_id == 3):
                                                                else:
                                                                    ?>
                                                                    <td class="hidden-phone"><a href="<?php echo site_url('shop_wise_report/editAttendance/' . $id); ?>"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>
                                                                <?php
                                                                endif;
                                                                ?>

                                                            </tr>

                                                            <?php
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                            endif;
                                        endforeach;
                                    endif;
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

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Attendance Picture</h4>
            </div>
            <div class="modal-body">

                <img id="pro_img" width=100%;height=auto; />

            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                <!-- <button class="btn btn-success" type="button">Submit</button>-->
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<!--main content end-->
<script type="text/javascript">
    function getEmployee(company_id) {
        var company_id = company_id;
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('shop_wise_report/getEmployee'); ?>",
            data: {'company_id': company_id},
            success: function (data) {
                //alert(data);
                $('#select_employee').html(data);
            }
        });
    }

    function showImg(img_name) {
        var url = "<?php echo $base_url . "/public/uploads/attendance/"; ?>" + img_name;

        $("#pro_img").attr("src", url);
        $("#myModal").modal();
    }
</script>