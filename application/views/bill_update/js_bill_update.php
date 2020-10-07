<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('-');
        var id=arr[0];
		var rent=arr[1];
		var elec=arr[2];
		var gas=arr[3];
		var water=arr[4];
		var service=arr[5];
                var garage=arr[6];
		var pu=arr[7];
		var cu=arr[8];
		var tu=arr[9];
		var da=arr[10];
		var mont=arr[11];
		var totalamount=arr[12];
		var uda=arr[13];
//alert(totalamount);
	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('bill_update/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  

				var ob=JSON.parse(data);
				var id=ob[0].id;
				var client_id=ob[0].client_id;
				var code=ob[0].code;
				var client_name=ob[0].client_name;
				var bill_id=ob[0].bill_id;
				
				$("#advance").val(ob[0].advance);
				
				var status=ob[0].status;
				if(status==1){status='Live';}else{ status='Leave Requested'; }
				$("#status").val(status);
				
				var amount =ob[0].amount;
				var amount1 =ob[0].amount;
			
				$("#unitrate").val(ob[0].elec_rate);
				//console.log(data);
				$("#id").val(id);
                                $("#client_id").val(client_id);
                                $("#code").val(code);
                                $("#rent").val(rent);	
                                $("#client_name").val(client_name);	
if(tu!=0){				  
				$("#elec").val(parseInt(tu)*parseInt(ob[0].elec_rate));
}else{
                               $("#elec").val(elec);
}
                                $("#gas").val(gas);
				  

                                  $("#water").val(water);
				  $("#garage").val(garage);
				  $("#service").val(service);
				  $("#mont").val(mont);
				  $("#pu").val(pu);
				  $("#cu").val(cu);
				  $("#tu").val(tu);
				  $("#da").val(da);
				  $("#uda").val(uda);
                                  $("#totalamount").val(totalamount);
$("#totalamount1").val(totalamount);              
                                 $('#totaltotal').val(parseInt(totalamount)+parseInt(da)+parseInt(uda));
				  $("#note").text(ob[0].comments);  

                                  
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }
	
	
	 function getecectric(rate){ //alert(rate);

                  if($("#tu").val() !=''){ var tu = $("#tu").val(); }else{ var tu =0 ;}
                  $("#elec").val(parseInt(rate)*parseInt(tu));  
                  $('#elec1').val(parseInt(rate)*parseInt(tu));  
                  $('#elect').val(parseInt(rate)*parseInt(tu));
                  gettotal();
          }
          function gettotal(){

			  if($("#rent").val()!=''){ var rent = parseInt($("#rent").val()); }else{ var rent =parseInt(0); }
              if($("#elec").val()!=''){ var elec = parseInt($("#elec").val()); }else{ var elec =parseInt(0); }
             if($("#elect").val()===0){ 
					elect =0;
			  }else{
				if($("#elect").val()!=''){ var elect = parseInt($("#elect").val()); }else{ var elect =parseInt(0); }
			  }
              if($("#water").val()!=''){ var water = parseInt($("#water").val()); }else{ var water =parseInt(0); }
              if($("#gas").val()!=''){ var gas = parseInt($("#gas").val()); }else{ var gas =parseInt(0); }
              if($("#garage").val()!=''){ var garage = parseInt($("#garage").val()); }else{ var garage =parseInt(0); }
              if($("#service").val()!=''){ var service = parseInt($("#service").val()); }else{ var service =parseInt(0); }
              if($("#da").val()!=''){ var da = parseInt($("#da").val()); }else{ var da =parseInt(0); }
			  if($("#uda").val()!=''){ var uda = parseInt($("#uda").val()); }else{ var uda =parseInt(0); }
              
if($("#pu").val()!=''){ var pu = parseInt($("#pu").val()); }else{ var pu =parseInt(0); }
              if($("#cu").val()!=''){ var cu = parseInt($("#cu").val()); }else{ var cu =parseInt(0); }
              
			  if(pu!=0 && cu!=0){
				if(pu > cu){ alert('Please Check Previous and Current DESCO Unit'); }
                                $("#tu").val(cu-pu);
                          }else{ $("#tu").val(cu-pu);  }

if($("#totalamount").val()!=''){ var totalamount = parseInt($("#totalamount").val()); }else{ var totalamount =parseInt(0); } 

			 
            if(elect!='' || elect===0){ elec = elect; $('#elec').val(elec); $('#elec1').val(elec); }
			  $('#totaltotal').val(water+garage+service+da+rent+elec+gas+uda);
              $('#totalamount').val(water+garage+service+rent+elec+gas);
			  $('#totalamount1').val(water+garage+service+rent+elec+gas);
          }
		  
		  
		  
	$(document).ready(function (){
		$('#submitbtn').removeAttr('disabled');
		$('#mont').datepicker().on('changeDate', function(ev) {
			  
			  
			  var id = $('#id').val();
			  var mont = $('#mont').val();
			  
			  $.ajax({
						
					type	:'POST',
					url		: "<?php echo base_url(); ?>bill_update/checkpayment",
					data	: {'id':id,'date':mont},
					success	:function(resp){
						
						if(resp==1){ $('#mont').val('This Month Bill Payment Has Completed'); $('#submitbtn').attr("disabled", "disabled"); }
						else{ $('#submitbtn').removeAttr('disabled'); }
					}
					
				});
			   
		});
         
    });


























       function addModalsms(sid){
		   
        var arr=sid.split('-');
        var id=arr[0];
		var rent=arr[1];
		var elec=arr[2];
		var gas=arr[3];
		var water=arr[4];
		var service=arr[5];
                var garage=arr[6];
		var pu=arr[7];
		var cu=arr[8];
		var tu=arr[9];
		var da=arr[10];
		var mont=arr[11];
		var totalamount=arr[12];
		var uda=arr[13];
//alert(totalamount);
	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('bill_update/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  

				var ob=JSON.parse(data);
				var id=ob[0].id;
				var client_id=ob[0].client_id;
				var code=ob[0].code;
				var client_name=ob[0].client_name;
				var bill_id=ob[0].bill_id;
				
				$("#advance").val(ob[0].advance);
				
				var status=ob[0].status;
				if(status==1){status='Live';}else{ status='Leave Requested'; }
				$("#status").val(status);
				
				var amount =ob[0].amount;
				var amount1 =ob[0].amount;
			
				$("#unitrate").val(ob[0].elec_rate);
				//console.log(data);
				$("#id").val(id);
                                $("#client_id").val(client_id);
                                $("#code").val(code);
                                $("#rent").val(rent);	
                                $("#client_name").val(client_name);	
if(tu!=0){				  
				$("#elec").val(parseInt(tu)*parseInt(ob[0].elec_rate));
}else{
                               $("#elec").val(elec);
}
                                $("#gas").val(gas);
				  

                                  $("#water").val(water);
				  $("#garage").val(garage);
				  $("#service").val(service);
				  $("#mont").val(mont);
				  $("#pu").val(pu);
				  $("#cu").val(cu);
				  $("#tu").val(tu);
				  $("#da").val(da);
				  $("#uda").val(uda);
                                  $("#totalamount").val(totalamount);
$("#totalamount1").val(totalamount);              
                                 $('#totaltotal').val(parseInt(totalamount)+parseInt(da)+parseInt(uda));
				  $("#note").text(ob[0].comments);  

                                  
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }
	
	
	 function getecectric(rate){ //alert(rate);

                  if($("#tu").val() !=''){ var tu = $("#tu").val(); }else{ var tu =0 ;}
                  $("#elec").val(parseInt(rate)*parseInt(tu));  
                  $('#elec1').val(parseInt(rate)*parseInt(tu));  
                  $('#elect').val(parseInt(rate)*parseInt(tu));
                  gettotal();
          }
          function gettotal(){

			  if($("#rent").val()!=''){ var rent = parseInt($("#rent").val()); }else{ var rent =parseInt(0); }
              if($("#elec").val()!=''){ var elec = parseInt($("#elec").val()); }else{ var elec =parseInt(0); }
             if($("#elect").val()===0){ 
					elect =0;
			  }else{
				if($("#elect").val()!=''){ var elect = parseInt($("#elect").val()); }else{ var elect =parseInt(0); }
			  }
              if($("#water").val()!=''){ var water = parseInt($("#water").val()); }else{ var water =parseInt(0); }
              if($("#gas").val()!=''){ var gas = parseInt($("#gas").val()); }else{ var gas =parseInt(0); }
              if($("#garage").val()!=''){ var garage = parseInt($("#garage").val()); }else{ var garage =parseInt(0); }
              if($("#service").val()!=''){ var service = parseInt($("#service").val()); }else{ var service =parseInt(0); }
              if($("#da").val()!=''){ var da = parseInt($("#da").val()); }else{ var da =parseInt(0); }
			  if($("#uda").val()!=''){ var uda = parseInt($("#uda").val()); }else{ var uda =parseInt(0); }
              
if($("#pu").val()!=''){ var pu = parseInt($("#pu").val()); }else{ var pu =parseInt(0); }
              if($("#cu").val()!=''){ var cu = parseInt($("#cu").val()); }else{ var cu =parseInt(0); }
              
			  if(pu!=0 && cu!=0){
				if(pu > cu){ alert('Please Check Previous and Current DESCO Unit'); }
                                $("#tu").val(cu-pu);
                          }else{ $("#tu").val(cu-pu);  }

if($("#totalamount").val()!=''){ var totalamount = parseInt($("#totalamount").val()); }else{ var totalamount =parseInt(0); } 

			 
            if(elect!='' || elect===0){ elec = elect; $('#elec').val(elec); $('#elec1').val(elec); }
			  $('#totaltotal').val(water+garage+service+da+rent+elec+gas+uda);
              $('#totalamount').val(water+garage+service+rent+elec+gas);
			  $('#totalamount1').val(water+garage+service+rent+elec+gas);
          }
		  
		  
		  
	$(document).ready(function (){
		$('#submitbtn').removeAttr('disabled');
		$('#mont').datepicker().on('changeDate', function(ev) {
			  
			  
			  var id = $('#id').val();
			  var mont = $('#mont').val();
			  
			  $.ajax({
						
					type	:'POST',
					url		: "<?php echo base_url(); ?>bill_update/checkpayment",
					data	: {'id':id,'date':mont},
					success	:function(resp){
						
						if(resp==1){ $('#mont').val('This Month Bill Payment Has Completed'); $('#submitbtn').attr("disabled", "disabled"); }
						else{ $('#submitbtn').removeAttr('disabled'); }
					}
					
				});
			   
		});
         
    });












</script>



</body>
</html>
