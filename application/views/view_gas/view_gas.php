<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">


        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      <b style="color:blue;">  View TITAS  </b>
                    </header>
                    <div class="panel-body" style="background:#E4F8EA;color:black; ">
                        <div class="adv-table">
                            <table class="display table table-bordered" id="hidden-table-info">
                                <thead>
                                    <tr>
                                       <th> Space Code</th>
					<th> House</th>
					<th> Bill Name</th>
					<th> Titas ID </th>
					<th> Address</th>
                                       
                                        <th>Notes </th>
									
                                        <th>Action</th>
<!--  <th class="hide_coloum">Test</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($project_data as $row) :
                                        $hid = $row->hid;
                                        $name = $row->name;
                                        $titas_id = $row->titas_id;

 $code= $row->code;
                                    
										$address = $row->address;
										$notes = $row->note;
									
									   
                                        $id = $row->id;
										
                                        $query_1 = $this->db->query("select * from add_house where id='$hid' ");
                                        $result_1 = $query_1->result();
                                        foreach ($result_1 as $row_add):
                                            $housename = $row_add->house_name;	
											
                                        endforeach;
                                        ?>
                                        <tr class="gradeX">
<td><?php echo $code; ?></td>
                                            <td><?php echo $housename; ?></td>
											<td><?php echo $name; ?></td>
											
                                            <td><?php echo $titas_id; ?></td>
                                          
                                      
											
											 <td><?php echo  $address; ?></td>
											  <td><?php echo  $notes; ?></td>
                                          
                                            <td><button class="btn btn-primary btn-xs" onclick="addModal('<?=$id."-"?>'); " 
											
								
											
											
											style="display:<?= $id ?>"
											>Update Titas </button>
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
                <h4 class="modal-title">Update TITAS </h4>
            </div>

            <div class="modal-body" style="color:black;">
                <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('view_gas/addPayment'); ?>">
             
			 
			 
			          <input type="hidden" class="form-control"  id="id" name="id"  >
                      <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select House*:</label>
                        <div class="col-sm-9">
                             <select class="form-control"  onchange="getFloor(this.value)" id="house_name" name="house_name"  required>
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
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->floor_name ."-".$hl->floor_code.'</option>';
                                    } 
                                    echo $house_name; ?>
                           <!--  </select> -->
                                    
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Select Flat*</label>
                        <div class="col-sm-9">
                             <select class="form-control" id="flat" name="flat" onchange="getRoomNo(this.value)" required>
                                    <option value="">Chose Flat</option>

                                    <!--  <select class="form-control"  onchange="" id="house_name" name="house_name"> -->
                                    <?php

                                    $headlist = $this->db->get('add_flat')->result();

                                    $house_name=''; foreach($headlist as $hl){ 
                                     // $data['headlist'] = $this->db->get('add_house')->result();
                                    $house_name .= '<option value="'. $hl->id .'">'. $hl->flat_name ."-".$hl->flat_code.'</option>';
                                    } 
                                    echo $house_name; ?>
                          <!--   </select> -->
                                    
                            </select>
                        </div>
                    </div>

                   <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Code: </label>
                        <div class="col-lg-9">		
                                   
			  <input type="text" class="form-control"  id="code" name="code"  >
                        </div>

                    </div>
				
					
					
		  <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Bill Name: </label>
                        <div class="col-lg-9">		
                                   
			  <input type="text" class="form-control"  id="name" name="name"  >
                        </div>

                    </div>
					
		  <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Titas Id: </label>
                        <div class="col-lg-9">		
                                   
									<input type="text" class="form-control"  id="titas_id" name="titas_id"  >
                        </div>

                    </div>


                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Billing Address: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="address" name="address"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Single burner Number: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="Ssburner" name="Sburner"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Single burner Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="Samount" name="Samount"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Double burner Number: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="Dnumber" name="Dnumber"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputSuccess" class="col-sm-3 control-label col-lg-3">Double burner Amount: </label>
                        <div class="col-lg-9">
                             <input type="text" class="form-control"  id="Damount" name="Damount"  >
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

