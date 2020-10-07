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
		var total=arr[6];
        var garage=arr[7];
		var pu=arr[8];
		var cu=arr[9];
		var da=arr[10];
		var mont=arr[11];
		var hid=arr[12];
		var late=arr[13];
                 
		var monthly=arr[14];  

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('bill_payment/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var client_id=ob[0].client_id;
				var code=ob[0].code;
				var client_name=ob[0].client_name;
			
				console.log(data);
				  $("#id").val(id);
                  $("#client_id").val(client_id);
                  $("#code").val(code);         	
                  $("#client_name").val(client_name);	
                  $("#rent").val(rent);					  
				  $("#elec").val(elec);
                  $("#gas").val(gas);
				  $("#garage").val(garage);
				  $("#water").val(water);
				  $("#service").val(service);				  			 				  
				  $("#total").val(total);
				   $("#mont").val(mont);
				   $("#pu").val(pu);
				   $("#hid").val(hid);
				  $("#cu").val(cu);				  			 				  
				  $("#da").val(da);
				    $("#late").val(late);
					
					 $("#mtotal").val(monthly);
				    $("#due").val(da);
                				  
                }
            });
	   
	   
     $("#addModal").modal();
    }

</script>



</body>
</html>
