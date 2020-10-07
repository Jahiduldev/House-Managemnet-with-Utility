<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('-');
        var id=arr[0];
	

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('view_wasa/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var name=ob[0].name;
				var address=ob[0].address;
				var acct_number=ob[0].acct_number;
				
			    var meter_number=ob[0].meter_number;
				var notes=ob[0].notes;
				
			
				console.log(data);
				  $("#id").val(id);
                  $("#name").val(name);
                  $("#address").val(address);
                  $("#acct_number").val(acct_number);	
                  $("#meter_number").val(meter_number);				  
				  $("#notes").val(notes);	
			
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }

</script>



</body>
</html>
