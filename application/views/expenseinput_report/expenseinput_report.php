<!DOCTYPE html>
<html lang="en">
  <head>


    <!-- Bootstrap core CSS -->
  
    <!--external css-->
    <link href="<?php echo $base_url ?>public/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link href="<?php echo $base_url ?>public/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo $base_url ?>public/css/gallery.css" />
      <!--right slidebar-->
     

    <!-- Custom styles for this template -->
  

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

 <section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        View Expense Details
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                        </span>
                    </header>
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-lg-12">

                                <form role="form" class="cmxform form-horizontal tasi-form" method="post"  id="RoleForm" action="<?php echo site_url('expenseinput_report/searchData') ?>">

                                    <div class="form-group">
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">From Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter From Date" id="date_from"  name="date_from" >
                                        </div>
                                        <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">To Date</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="default-date-picker form-control" placeholder="Enter To Date" id="date_to"  name="date_to"  >
                                        </div>


                                    </div>
                                    <button type="submit" name="submitDate" class="btn btn-info pull-right" onclick="getDateSearch()">Submit</button>
                                </form>


                            </div>
                        </div>
                        <br>


                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Employee Name</th>
                                        <th>Project Name</th>
                                        <th>Amount</th>

                                        <th>Notes</th>
                                        <th>Bill Photo</th>
                                        <th>Expense Date </th>
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $counter = 0;
                                    foreach ($reference_data as $row) :
                                        $counter++;
                                        $employee_id = $row->employee_id;
                                        $result2 = $this->db->query("select *  from employee where id= '$employee_id' ");

                                        foreach ($result2->result() as $row2):
                                            $emp_name = $row2->emp_name;
                                        endforeach;
                                        $project = $row->project;
                                        $result2 = $this->db->query("select *  from project where id= '$project' ");

                                        foreach ($result2->result() as $row2):
                                            $name = $row2->name;
                                        endforeach;
                                        $amount = $row->amount;
                                        $purpose = $row->purpose;
                                        $bill_photo = $row->bill_photo;
                                        $date_time = $row->date;
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $counter; ?></td>
                                            <td><?php echo $emp_name ?></td>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $amount ?></td>
                                            <td><?php echo $purpose ?></td>


                                            <td> 



                                                <div class="grid cs-style-3">

                                                    <figure>
                                                        <img src="<?= $base_url . 'public/uploads/employee/' . $bill_photo ?>" width="150" height="100">
                                                        <figcaption>

                                                            <a class="fancybox" rel="group" href="<?= $base_url . 'public/uploads/employee/' . $bill_photo ?>">Take a look</a>
                                                        </figcaption>
                                                    </figure>

                                                </div>  










                                            </td>
                                            <td><?php echo $date_time ?></td>
                                        </tr>

                                    <?php endforeach; ?>
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


      <!--main content end-->
      <!-- Right Slidebar start -->
     
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $base_url ?>public/js/jquery.js"></script>
    <script src="<?php echo $base_url ?>public/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo $base_url ?>public/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo $base_url ?>public/assets/fancybox/source/jquery.fancybox.js"></script>
    <script src="<?php echo $base_url ?>public/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo $base_url ?>public/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src<?php echo $base_url ?>public/js/respond.min.js" ></script>

    <script src="<?php echo $base_url ?>public/js/modernizr.custom.js"></script>
    <script src="<?php echo $base_url ?>public/js/toucheffects.js"></script>

  <!--right slidebar-->
  <script src="<?php echo $base_url ?>public/js/slidebars.min.js"></script>


    <!--common script for all pages-->
    <script src="<?php echo $base_url ?>public/js/common-scripts.js"></script>

  <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>


  </body>
</html>
