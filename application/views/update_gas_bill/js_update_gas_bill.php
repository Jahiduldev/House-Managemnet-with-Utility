<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('asad');
        var id=arr[0];
		var house_name=arr[1];
		var acct_number=arr[2];
		var meter_number=arr[3];


	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('update_gas_bill/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var single=isNaN(parseInt(ob[0].single))?0:parseInt(ob[0].single);
				var doubles=isNaN(parseInt(ob[0].doubles))?0:parseInt(ob[0].doubles);
				var sin_amount=isNaN(parseInt(ob[0].sin_amount))?0:parseInt(ob[0].sin_amount);
				var dob_amount= isNaN(parseInt(ob[0].dob_amount))?0:parseInt(ob[0].dob_amount);		
				var note =ob[0].note;
				var mont =ob[0].mont;
			    var amount = isNaN(parseInt(ob[0].amount))?0:parseInt(ob[0].amount);	
				
			
				console.log(data);
				  $("#id").val(id);
                  $("#single").val(single);
                  $("#house_name").val(house_name);
                  $("#doubles").val(doubles);	
				  $("#mont").val(mont);	
                  $("#sin_amount").val(sin_amount);					  
				  $("#dob_amount").val(dob_amount); 
				  $("#totalburner").val(parseFloat(doubles)+parseFloat(single));
				  $("#totalamount").val(parseFloat(sin_amount)+parseFloat(dob_amount));
 
				  $("#totalburnerhide").val(parseFloat(doubles)+parseFloat(single));
				  $("#amount").val(amount); //alert(amount);
				  $("#note").val(note);
				
				  if(single!=0 && $('#sin_amount').val()!=0){ $('#sintotal').val(single*sin_amount) ;  }
                  if(doubles!=0 && $('#dob_amount').val()!=0){ $('#dobtotal').val(doubles*dob_amount) ;  }	  			 
                       }
                  });
	   
	   
                 $("#addModal").modal();
             }

        function calculate(){
	

           if($('#single').val() !=''){ 

           var single= parseFloat($('#single').val());}else{  var single= parseFloat(0); }
	       if($('#sin_amount').val() !=''){ var sin_amount= parseFloat($('#sin_amount').val());}else{  var sin_amount= parseFloat(0); }
			if($('#doubles').val() !=''){ var doubles= parseFloat($('#doubles').val());}else{  var doubles= parseFloat(0); }
			if($('#dob_amount').val() !=''){ var dob_amount= parseFloat($('#dob_amount').val());}else{  var dob_amount= parseFloat(0); }
			$('#sintotal').val(single*sin_amount) ;  
			$('#dobtotal').val(doubles*dob_amount) ; 
			if($('#sintotal').val() !=''){ var sintotal= parseFloat($('#sintotal').val());}else{  var sintotal= parseFloat(0); }
			if($('#dobtotal').val() !=''){ var dobtotal= parseFloat($('#dobtotal').val());}else{  var dobtotal= parseFloat(0); }
			
			$('#totalburner').val(single+doubles);
			$('#amount').val(sintotal+dobtotal);

        }
        
        
        
        $(document).ready(function (){
    		$('#submitbtn').removeAttr('disabled');
    		$('#mont').datepicker().on('changeDate', function(ev) {
			  
			  
    		  var id = $('#id').val();
    		  var mont = $('#mont').val();
    		  alert(mont);
    		  $.ajax({
					
				type	:'POST',
				url		: "<?php echo base_url(); ?>update_gas_bill/checkpayment",
				data	: {'id':id,'date':mont},
				success	:function(resp){
					
					if(resp==1){ $('#mont').val('This Month Bill Payment Has Completed'); 
					$('#submitbtn').attr("disabled", "disabled"); }
					else{ $('#submitbtn').removeAttr('disabled'); }
				}
				
			});
			   
		});
         
    });

</script>



</body>
</html>
