<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">View Room</b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
					<th> House</th>
					<th> Floor Name</th>
                                        <th> Floor Code</th>
					<th> Flat Name</th>
                                        <th> Flat Code</th>
					<th> Room Name</th>
                                        <th> Room Code </th>
                                        <th> Notes </th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $hid = $row->hid;
					$floid = $row->floid;
					$fltid = $row->fltid;
                                        $room_name = $row->room_name;
                                        $room_code = $row->room_code;
                                        $notes = $row->notes;
									   
                                        $id = $row->id;
										
                                        $query_1 = $this->db->query("select * from add_house where id='$hid' ");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $housename = $row_add->house_name;	
											
                                        endforeach;
										
										
										
										
					$query_1 = $this->db->query("select * from add_floor where id='$floid' ");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $floor_name = $row_add->floor_name;
                                            $floor_code = $row_add->floor_code;		
                                        endforeach;
										
										
					$query_1 = $this->db->query("select * from add_flat where id='$fltid' ");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $flat_name = $row_add->flat_name;
                                            $flat_code = $row_add->flat_code;		
											
                                        endforeach;
										
										
										
                                        ?>
                                        <tr class="gradeX">
                                            <td><?php echo $housename; ?></td>
					    <td><?php echo $floor_name; ?></td>
                                            <td><?php echo $floor_code; ?></td>
					    <td><?php echo $flat_name; ?></td>
                                            <td><?php echo $flat_code; ?></td>
                                            <td><?php echo $room_name; ?></td>
                                            <td><?php echo $room_code; ?></td>
					    <td><?php echo  $notes; ?></td>
                                          
                                            <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."-".$housename?>'); " 					
                                                
											style="display:<?= $id ?>"
											>Update Room </button>
<button class="btn btn-primary btn-xs" onclick="deleteroom(<?= $id ?>)">x</button>
 
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update Room</h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('all_room/addPayment'); ?>">
             
             
             
                    <input type="hidden" class="form-control"  id="id" name="id"  >

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select House*:</label>
                        <div class="col-sm-9">
                             <select class="form-control"  onchange="getFloor(this.value)" id="house_name" name="house_name" required>
                                  <option value="">Chose House</option>
                                   <?php

                                    $headlist = $this->db->get('add_house')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->house_name .'</option>';
                                    } 
                                    echo $house_name; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Floor:</label>
                        <div class="col-sm-9">
                             <select class="form-control" name="floor" id="floor" onchange="getRoom(this.value)" required>


                                 <!-- <select class="form-control"  onchange="" id="house_name" name="house_name"> -->
                                   <option value="">Chose Floor</option>
                                    <?php

                                    $headlist = $this->db->get('add_floor')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->floor_name ."-".$hl->floor_code .'</option>';
                                    } 
                                    echo $house_name; ?>
                           <!--  </select> -->
                                    
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Flat*</label>
                        <div class="col-sm-9">
                             <select class="form-control" id="flat" name="flat" onchange="getRoomNo(this.value)"  required>
                                    <option value="">Chose Flat</option>

                                    <!--  <select class="form-control"  onchange="" id="house_name" name="house_name"> -->
                                    <?php

                                    $headlist = $this->db->get('add_flat')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->flat_name .'</option>';
                                    } 
                                    echo $house_name; ?>
                          <!--   </select> -->
                                    
                            </select>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Room Name: </label>
                        <div class="col-lg-9">      
                                   
                        <input type="text" class="form-control"  id="room_name" name="room_name"  required >
                        </div>

                    </div>
                    
                     <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Room Code: </label>
                        <div class="col-lg-9">      
                                   
                                    <input type="text" class="form-control"  id="room_code" name="room_code"  required>
                        </div>

                    </div>


               
                    
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Notes </label>
                        <div class="col-lg-9">
                            <textarea class="form-control"  id="notes" name="notes" ></textarea>
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


<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--script for this page-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_employee.js"></script>
<script type="text/javascript">


    $(function () {
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_employee/getEmpCode'); ?>",
            //   data: {'role_id':role_id,'action':'getPermission'} ,
            success: function (data) {
                //  alert(data);
                var cd = "0001";
                if (data != "") {
                    cd = (parseInt(data) + 1).toString();
                }
                var len = cd.length;
                if (len == 1) {
                    cd = "000" + cd;
                } else if (len == 2) {
                    cd = "00" + cd;
                } else if (len == 3) {
                    cd = "0" + cd;
                }
                $('#emp_code').val(cd);
            }
        });
    });


  
    
    
     
</script>

