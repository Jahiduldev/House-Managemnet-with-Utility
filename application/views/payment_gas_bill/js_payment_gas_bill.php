<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('asad');
        var id=arr[0];
		var hid=arr[1];
	
		var hidfinal=arr[2];


	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('payment_gas_bill/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var single=ob[0].single;
				var doubles=ob[0].doubles;
				var sin_amount=ob[0].sin_amount;
				var dob_amount=ob[0].dob_amount;			
			    var mont=ob[0].mont;
			
				console.log(data);
				  $("#id").val(id);
				  $("#hid").val(hid);
				  $("#hidfinal").val(hidfinal);
                  $("#mont").val(mont);
                
                  $("#single").val(single);	
                  $("#doubles").val(doubles);					  
				  $("#sin_amount").val(sin_amount);
                  $("#dob_amount").val(dob_amount);
				
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }

</script>



</body>
</html>
