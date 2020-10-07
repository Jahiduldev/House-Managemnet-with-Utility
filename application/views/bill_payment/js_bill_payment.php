<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
			var arr=sid.split('-');
			var id=arr[0];
			var rent= isNaN(parseInt(arr[1]))?0:parseInt(arr[1]);
			var elec=isNaN(parseInt(arr[2]))?0:parseInt(arr[2]);
			var gas=isNaN(parseInt(arr[3]))?0:parseInt(arr[3]);
			var water=isNaN(parseInt(arr[4]))?0:parseInt(arr[4]);
			var service=isNaN(parseInt(arr[5]))?0:parseInt(arr[5]);
			var total=isNaN(parseInt(arr[6]))?0:parseInt(arr[6]);
			var garage=isNaN(parseInt(arr[7]))?0:parseInt(arr[7]);
			var pu=isNaN(parseInt(arr[8]))?0:parseInt(arr[8]);
			var cu=isNaN(parseInt(arr[9]))?0:parseInt(arr[9]);
			
			var mont=arr[11];
			var hid=arr[12];
			var late=isNaN(parseInt(arr[13]))?0:parseInt(arr[13]);
					 
			var monthly=arr[14];  
			 
			
			var rentAmount = rent+service+garage;
			$('#rent_amount').val(rentAmount);
			var rent_due=isNaN(parseInt(arr[10]))?0:parseInt(arr[10]);
			$('#rent_due').val(rent_due);
			var rentTotal = rentAmount+rent_due;
			$('#rent_total').val(rentTotal);
			$('#rent_total1').val(rentTotal);
			
			var utilityAmount = gas+elec+water;
			$('#utility_amount').val(utilityAmount);
			var utlty_due=isNaN(parseInt(arr[16]))?0:parseInt(arr[16]);
			$('#utility_due').val(utlty_due);
			var utilityTotal = utilityAmount+utlty_due;
			$('#utility_total').val(utilityTotal);
			$('#utility_total1').val(utilityTotal);
			
			$('#total_payment_amount').val(utilityTotal+rentTotal+late);
		$('#total_payment_amount2').val(utilityTotal+rentTotal+late);

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('bill_payment/getData');  ?>",
                data: {'id':id},
                success: function(data){  
					
					var ob=JSON.parse(data);
					var id=ob[0].id;
					var client_id=ob[0].client_id;
					var code=ob[0].code;
					var client_name=ob[0].client_name;			
				
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
					$("#da").val(rent_due);
					$("#late").val(late);
					$("#late2").val(late);
					$("#mtotal").val(monthly);
					$("#due").val(rent_due); 

				    
                }
            });
	   
	   
     $("#addModal").modal();
    }

</script>



</body>
</html>
