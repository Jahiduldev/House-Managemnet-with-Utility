<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Send Tenant SMS
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('tenent_sms/send_sms'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">House Names*</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="houseid" id="houseid"  required> <!-- input-sm m-bot15  -->
                                        <option value="">Select House</option>
                                        <?php
                                        foreach ($add_house as $row) :
                                            ?>
                                            <option value="<?= $row->id; ?>"><?= $row->house_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">SMS*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter SMS" id="housesms" name="housesms" required></textarea>
                                </div>
                            </div>

                          
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
					
					<br><br><br><br>
					<header class="panel-heading">
                        Send Bulk SMS
                    </header>
                    <div class="panel-body">
                        <form class="cmxform form-horizontal tasi-form" id="addCompanyForm"  role="form" method="post"  action="<?php echo site_url('tenent_sms/send_bulk_sms'); ?>" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Mobile Number*</label>
                                <div class="col-lg-10">
                                    <input type="text" name="bulknumber" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">SMS*</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" placeholder="Enter SMS" id="bulksms" name="bulksms" required></textarea>
                                </div>
                            </div>

                          
                            <button type="submit" class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
					
					<br><br><br><br>
					<div class="panel-body">
                        <table class="display table table-bordered dataTable" id="hidden-table-info" aria-describedby="hidden-table-info_info">
							<thead>
								<tr>
									<th>House</th>
									<th>Phone</th>
									<th>SMS</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($smsese as $sms){ ?>
								
									 <tr>
											<td><?php if($sms->house_id!=0){ echo $this->db->where('id', $sms->house_id)->get('add_house')->row()->house_name;}else{ echo 'Bulk SMS';} ?></td>
											<td><?php echo $sms->phonenumber ?></td>
											<td><?php echo $this->db->where('smsid', $sms->smsid)->get('sendsms')->row()->sms; ?></td>
											<td><?php echo $this->db->where('smsid', $sms->smsid)->get('sendsms')->row()->date; ?></td>
										</tr> 
								<?php } ?>
							<tbody>
						</table>
                    </div>
                </section>
            </div>
        </div>


    </section>
</section>
<!--main content end-->


