<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('asad');
        var id=arr[0];
		var hid=arr[1];
		var acct_number=arr[2];
		var meter_number=arr[3];


	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('update_wasa_bill/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var bill_numebr=ob[0].bill_numebr;
				var issue_date=ob[0].issue_date;
				var due_date=ob[0].due_date;
				var pre_unit=ob[0].pre_unit;			
				var cur_unit =ob[0].cur_unit;
				var mont =ob[0].mont;
				var total_unit =ob[0].total_unit;
				var unit_rate=ob[0].unit_rate;			
				var amount =ob[0].amount;
				var due_amount =ob[0].due_amount;
				
			
				console.log(data);
				  $("#id").val(id);
                  $("#bill_numebr").val(bill_numebr);
                  $("#hid").val(hid);
                  $("#acct_number").val(acct_number);	
                  $("#meter_number").val(meter_number);					  
				  $("#issue_date").val(issue_date);
                  $("#due_date").val(due_date);
				  $("#mont").val(mont);
				  $("#pre_unit").val(pre_unit);
				  $("#cur_unit").val(cur_unit);
				  $("#total_unit").val(parseInt(cur_unit) - parseInt(pre_unit));
$("#total_unithide").val(parseInt(cur_unit) - parseInt(pre_unit));
				  $("#unit_rate").val(unit_rate);
				  $("#amount").val(amount);

				  $("#due_amount").val(due_amount);
                                 $("#note").text(ob[0].note);
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }
    
    
    $(document).ready(function (){
    		$('#submitbtn').removeAttr('disabled');
    		$('#mont').datepicker().on('changeDate', function(ev) {
			  
			  
    		  var id = $('#id').val();
    		  var mont = $('#mont').val();
    		  alert(mont);
    		  $.ajax({
					
				type	:'POST',
				url		: "<?php echo base_url(); ?>update_wasa_bill/checkpayment",
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
