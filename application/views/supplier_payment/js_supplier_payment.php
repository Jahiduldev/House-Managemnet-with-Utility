
<script>


    function addModal(id) {


        $("#broker_name").val(id);
        
         $.ajax({
            type: "Post",
            url: "<?php echo site_url('supplier_payment12/getData'); ?>",
            data: {'id': id},
            success: function (data) {
                
                $("#project").html(data);
            }
        });
        
        
        $("#addModal").modal();
    }
    function deleteModal(id) {
        $("#delete_id").val(id);
        $("#myModalDelete").modal();
    }



function getAddSallaryInfo(id){ 
	
	//alert(id);
	
		$.ajax({
            type: "Post",
            url: "<?php echo site_url('supplier_payment/getSalaryAddDetails'); ?>",
            data: 'id='+id,
            success: function (data) {
                  //alert(data);
                $("#details_header").html('Supplier Due Details : '); 
				if(data !=''){  
					               
					$("#add_details").html(data);
                }else{
					
					$("#add_details").html('<tr><td colspan="4">No Details Found !</td></tr>');
				}

            }
        });
		
	}
	
	function getDeductSallaryInfo(id){ 
	
	//alert(id);
	
		$.ajax({
            type: "Post",
            url: "<?php echo site_url('supplier_payment/getSalaryDeductDetails'); ?>",
            data: 'id='+id,
            success: function (data) {
                  //alert(data);
				$("#details_header").html('Salary Deduct Details : ');
                if(data !=''){						
					$("#add_details").html(data);
				}else{
					
					$("#add_details").html('<tr><td colspan="4">No Details Found !</td></tr>');
				}

            }
        });
		
	}


</script>


</body>
</html>
