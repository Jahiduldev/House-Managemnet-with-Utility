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
                        Supply Transaction Search
                    </header>
                    <div class="panel-body">
                        <form role="form" class="cmxform form-horizontal tasi-form" id="MenuForm"  method="post"  id="commentForm" action="<?php echo site_url('supply_report/get_date_data'); ?>">
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">From*</label>
                                <div class="col-lg-2">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter From" id="date_from"  name="date_from" value="<?php
                                    if (isset($date_from)) {
                                        echo $date_from;
                                    } else {
                                       // echo date('Y-m-d');
                                    }
                                    ?>" required>
                                </div>
                                <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">To*</label>
                                <div class="col-lg-2">
                                    <input type="text" class="default-date-picker form-control" placeholder="Enter To" id="date_to"  name="date_to" value="<?php
                                    if (isset($date_to)) {
                                        echo $date_to;
                                    } else {
                                     //   echo date('Y-m-d');
                                    }
                                    ?>" required>
                                </div>
								
								
								<label for="inputSuccess" class="col-sm-1 control-label col-lg-1">Supplier</label>
                                <div class="col-lg-2">
                                    <select class="form-control" name="supplier">
										<option value="">Supplier</option>
										<?php foreach($brokers as $supp){
												
											echo '<option value="'.$supp->id.'"';
											if($supp->id==$supplier){ echo  ' selected '; }
											echo'>'.$supp->broker_name.'</option>';
										}
										?>
									</select>
                                </div>
                                <label for="inputSuccess" class="col-sm-1 control-label col-lg-1">Project</label>
                                <div class="col-lg-2">
                                    <select class="form-control" name="project">
										<option value="">Project</option>
										 
										<?php foreach($projects as $proj){
												
											echo '<option value="'.$proj->id.'"';
											if($proj->id==$project){ echo  ' selected '; }
											echo'>'.$proj->project_name.'</option>';
										}
										?>
									</select>
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
                        Supply Payment Report
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
										
                                        <th>SL</th>
                                        <th>Supplier</th>

                                        <th>Project</th>
                                        <th>Payment</th>
                                        <th>Due</th>
                                        <th>Voucher</th>
                                        <th>Note</th>
                                        <th>Date</th>
                                        <!--<th>Action</th>-->
                                     <!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sl=1;
                                    
                                    foreach ($broker_payment as $row) :
                                       
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $sl++; ?></td>

                                            <td><?php echo $this->db->where('id', $row->broker_id)->get('broker_table')->row()->broker_name; ?></td>
                                            <td><?php echo $this->db->where('id', $row->project_id)->get('projects')->row()->project_name; ?></td>
                                            <td><?php echo $row->payment; ?></td>
                                            <td><?php echo $row->due; ?></td>
                                            <td><img src="<?php echo base_url().'public/uploads/employee/'.$row->photo; ?>" width="10%" 
											onmouseover="showimg(this.src)" onmouseout="hideimg()">
											<img src="<?php echo base_url().'public/uploads/employee/'.$row->photo2; ?>" width="10%"
											onmouseover="showimg(this.src)" onmouseout="hideimg()"></td>
                                            <td><?php echo $row->note; ?></td>
                                            <td><?php echo $row->date_time; ?></td>
											
                                            <!--<td>
                                                <button class="btn btn-primary btn-xs" onclick="editMenu(<?= $id ?>);"><i class="fa fa-pencil"></i></button>                                            
                                             <!-- <button class="btn btn-danger btn-xs" onclick="deleteMenu(<?//=$id?>);"><i class="fa fa-trash-o "></i></button>-->            
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                
                            </table>

                        </div>
                    </div>
                </section>
            </div>
        </div>
		
		
		<div id="imgbox" style="position:absolute; z-index:99; right:-2000px; top:0px">
		
				<img src="" width="400px;">
		
		</div>


        <!-- modal -->

    </section>
</section>
<!--main content end-->

<script>
	function showimg(img){
		
		$('#imgbox img').attr('src', img);
		$('#imgbox').css({'right': '0px', 'top':'0px', 'transition':'1s'});
		
		
	}
	function hideimg(){
		
		//$('#imgbox img').attr('src', '');
		$('#imgbox').css({'right': '-2000px', 'top':'0px', 'transition':'.5s'});
		
		
	}
</script>
