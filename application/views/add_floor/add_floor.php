<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
		<div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    
					
					<header class="panel-heading">
                      <b style="color:blue;">  Add Floor </b>
                    </header>
					
                     <div class="panel-body" style="background:#008B8B;color:white; ">
                        <form class="cmxform form-horizontal tasi-form" id="addUserForm"  role="form" method="post"  
						action="<?php echo site_url('add_floor/addPayment'); ?>" >
							
						
							
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">Select House*</label>
                                <div class="col-lg-10">
                                  <select name="house" class="form-control" required>
									<option value=""> Select House</option>
									 
									  <?php $house_name=''; foreach($headlist as $hl){ 
									  
											$house_name .= '<option value="'. $hl->id .'">'. $hl->house_name .'</option>';
										} echo $house_name; ?>
									  </select> 
                                </div>
                            </div>
							<div class="form-group">
                                <label for="inputSuccess" class="col-sm-2 control-label col-lg-2">
									Add Floor* 
									<a href="javascript:void(0)" id="deb" title="More Heads" onclick="addheads(this.id)"><i class="fa fa-plus" style="padding:0px 10px;color:white"></i></a>
									<a href="javascript:void(0)" id="lessdeb" title="Less Heads" onclick="lessheads(this.id)"><i class="fa fa-minus" style="padding:0px 10px;color:white"></i></a>
								</label>
                                <div class="col-lg-3">
								      <input type="text"  class="form-control" placeholder="Enter Floor Name"  name="floorname[0]" required>                            
                                </div>   
                                <div class="col-lg-3">
								<input type="text"  class="form-control" placeholder="Enter Floor Code"  name="floorcode[0]" required>
								
                                </div> 
                                <div class="col-lg-4">
                                 
								 <input type="text"  class="form-control" placeholder="Enter Notes"  name="notes[0]" >
                                </div>  
															
								<div id="moredeb"></div>

                            </div>	
							
						
							
							
							
						
							                            
                            <button  type="submit"  class="btn btn-info pull-right">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
        </div>

    </section>
</section>
<!--main content end-->

<script type="text/javascript">

function enterNumber(id){
	
	var e = document.getElementById(id);
		if(e.value != '')
		if (!/^[0-9.]+$/.test(e.value)){ 
			alert("Please enter onyl number.");
			e.value = e.value.substring(0,e.value.length-1);
		}	
	}   
	var debid = 0;
	var credid = 0;

	var cerAmnt = 0.00;
	var debAmnt = 0.00;

	function myFunction(id){
		if($('#'+id).val() !=''){					
			if(id.indexOf("deb") >= 0){			
				debAmnt = 0.00;
				for(var i=0; i<=debid; i++){				
					debAmnt = debAmnt + parseFloat($('#debtext'+i).val());	
				}
$('#sumdeb').html(debAmnt);	
				//alert(debAmnt);			
			}else{			
				cerAmnt = 0.00;
				for(var i=0; i<=credid; i++){				
					cerAmnt = cerAmnt + parseFloat($('#credtext'+i).val());		
				}
				//alert(cerAmnt);	
$('#sumcred').html(cerAmnt);				
			}
			//alert(debAmnt); alert(cerAmnt);		
			if(cerAmnt==debAmnt){ //alert('Finnaly');			
				$('#smbtbtn').removeAttr('disabled');
			}else{			
				$('#smbtbtn').attr("disabled", "disabled");
			}	
		}
	}



	var strings = 'String Initial ++[[][==;;--=--]';
	var strid=0;
	
	function addheads(id){ 
		if(id=='deb'){ strid = ++debid; }else{ strid = ++credid; }
			strings = '<div id="'+ id + strid +'">'+
				'<label for="inputSuccess" class="col-sm-2 control-label col-lg-2"></label>'+
				'<div class="col-lg-3">'+
					'<input type="text"  class="form-control" placeholder="Enter Floor Name"   name="floorname['+ strid +']" required>'+
				'</div>'+ 
				'<div class="col-lg-3">'+
				'<input type="text"  class="form-control" placeholder="Enter Floor Code"    name="floorcode['+ strid +']" required>'+
				'</div>'+
				'<div class="col-lg-4">'+
					'<input type="text"  class="form-control" placeholder="Enter Notes"    name="notes['+ strid +']" >'+
				'</div>'+  
				
			'</div>';
				
			$('#more'+id).append(strings);	//alert(debid);
		
	}
	
	function lessheads(id){ 
	
		if(id.indexOf("deb") >= 0){	var lessid = 'debtext'+debid; }
		else{ var lessid = 'credtext'+credid; }		
		if(id == 'lesscred'){ $('#cred'+credid).remove(); if(credid!=0)credid--; }
		else{ $('#deb'+debid).remove(); if(debid!=0)debid--; }
		myFunction(lessid);	
	}
</script>


