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
			
				//console.log(data);
				  $("#id").val(id);
                  $("#client_id").val(client_id);
                  $("#code").val(code);         	
                  $("#client_name").val(client_name);	
                  $("#rent").val(rent);					  
				  $("#elec").val(elec);
                  $("#gas").val(gas);
				  $("#water").val(water);
				  $("#service").val(service);				  			 				  
				  $("#total").val(total);
if(ob[0].status==1){
					
					$("#checklive").hide();
					$("#checkbooked").hide();
				  
				  }if(ob[0].status==2){
					  
					$("#checkbooked").hide();
				  }if(ob[0].status==3){
					  
					$("#checkleave").hide();
				  }if(ob[0].status==4){
					  
					$("#checkleaverequ").hide();
				  }
                				  
                }
            });
	   
	   
     $("#addModal").modal();
    }

</script>



</body>
</html>
