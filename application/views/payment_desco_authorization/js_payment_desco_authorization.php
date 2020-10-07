<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('asad');
        var id=arr[0];
		var hid=arr[1];
		var acct_number=arr[2];
		var meter_number=arr[3];
		var hidfinal=arr[4];
var code12=arr[5];

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('payment_desco_authorization/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var bill_numebr=ob[0].bill_numebr;
		    	var issue_date=ob[0].issue_date;
				var due_date=ob[0].due_date;
				
				var mont=ob[0].mont;
				var loads=ob[0].loads;
				var vat=ob[0].vat;
				var total_unit=ob[0].total_unit;
				var pre_unit=ob[0].pre_unit;			
				var cur_unit =ob[0].cur_unit;
				
				var unit_rate=ob[0].unit_rate;			
				var amount =ob[0].amount;
				var due_amount =ob[0].due_amount;
			
				console.log(data);
				  $("#id").val(id);
				  $("#hid").val(hid);
				  $("#hidfinal").val(hidfinal);
                  $("#bill_numebr").val(bill_numebr);
                 
                  $("#acct_number").val(acct_number);	
                  $("#mont").val(mont);	
				  $("#loads").val(loads);	
				  $("#vat").val(vat);					 
                  $("#meter_number").val(meter_number);					  
				  $("#issue_date").val(issue_date);
                  $("#due_date").val(due_date);
$("#code12").val(code12);
				  $("#pre_unit").val(pre_unit);
				  $("#cur_unit").val(cur_unit);
				  $("#total_unit").val(total_unit);
				  $("#unit_rate").val(unit_rate);
				  $("#amount").val(amount);
				  $("#due_amount").val(due_amount);
                }
            });
	   
	   
     $("#addModal").modal();
    }

</script>



</body>
</html>
