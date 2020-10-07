<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('asad');
        var id=arr[0];
		var hid=arr[1];
		var acct_number=arr[2];
		var meter_number=arr[3];
		var total_unit=arr[4];
                var code12 =arr[5];

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('update_desco_bill/getData');  ?>",
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
				
				var pre_unit=ob[0].pre_unit;			
				var cur_unit =ob[0].cur_unit;
				
				var unit_rate=ob[0].unit_rate;			
				var amount =ob[0].amount;
				var due_amount =ob[0].due_amount;
                                var totalamount =ob[0].totalamount ;
				
			
				 
				  $("#id").val(id);
                                  $("#bill_numebr").val(bill_numebr);
                                  $("#hid").val(hid);
                                  $("#acct_number").val(acct_number);					 
				  $("#mont").val(mont);	
				  $("#loads").val(loads);	
				  $("#vat").val(vat);					 
                                  $("#meter_number").val(meter_number);					  
				  $("#issue_date").val(issue_date);
                                  $("#due_date").val(due_date);
				  $("#pre_unit").val(pre_unit);
				  $("#cur_unit").val(cur_unit);
				  $("#total_unit").val(parseFloat(cur_unit)  - parseFloat(pre_unit));
				  $("#total_unithide").val(parseFloat(cur_unit)  - parseFloat(pre_unit));
				  $("#unit_rate").val(unit_rate);
				  $("#amount").val(amount);
				  $("#due_amount").val(due_amount);
                                  $("#note").val(ob[0].note);
				   $("#code12").val(code12);
                                  $('#bill').val((cur_unit - pre_unit)*unit_rate);
                                  $('#totalamount').val(parseFloat(totalamount));
                }
            });
	   
	   
     $("#addModal").modal();
    }

function calculatebill(){
		
		if($('#pre_unit').val() !=''){ var pre_unit = parseFloat($('#pre_unit').val());}else{  var pre_unit = parseFloat(0); }
		if($('#cur_unit').val() !=''){ var cur_unit = parseFloat($('#cur_unit').val());}else{  var cur_unit = parseFloat(0); }
		if($('#unit_rate').val() !=''){ var unit_rate = parseFloat($('#unit_rate').val());}else{  var unit_rate = parseFloat(0); }
		$('#bill').val((cur_unit - pre_unit)*unit_rate); $('#total_unit').val(cur_unit - pre_unit);
 calculateamount();
	}
	
	function calculateamount(){
		
		if($('#pre_unit').val() !=''){ var pre_unit = parseFloat($('#pre_unit').val());}else{  var pre_unit = parseFloat(0); }
		if($('#cur_unit').val() !=''){ var cur_unit = parseFloat($('#cur_unit').val());}else{  var cur_unit = parseFloat(0); }
		if($('#loads').val() !=''){ var loads = parseFloat($('#loads').val());}else{  var loads = parseFloat(0); }
		if($('#vat').val() !=''){ var vat = parseFloat($('#vat').val());}else{  var vat = parseFloat(0); }
		if($('#unit_rate').val() !=''){ var unit_rate = parseFloat($('#unit_rate').val());}else{  var unit_rate = parseFloat(0); }
		if($('#due_amount').val() !=''){ var due_amount = parseFloat($('#due_amount').val());}else{  var due_amount = parseFloat(0); }
		if($('#bill').val() !=''){ var bill = parseFloat($('#bill').val());}else{  var bill = parseFloat(0); }
		
		
		
		//$('#bill').val((cur_unit - pre_unit)*unit_rate);
		$('#amount').val( loads + vat +bill );

		if($('#due_amount').val() !=''){
				$('#otalamount').val(bill + loads + vat + due_amount );
	         }
	         else{
	         	$('#otalamount').val(bill + loads + vat);

	         }
		
	}
	
	
	$(document).ready(function (){
		$('#submitbtn').removeAttr('disabled');
		$('#mont').datepicker().on('changeDate', function(ev) {
			  
			  
			  var id = $('#id').val();
			  var mont = $('#mont').val();
			  //alert(mont);
			  $.ajax({
						
					type	:'POST',
					url		: "<?php echo base_url(); ?>update_desco_bill/checkpayment",
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
