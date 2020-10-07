<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid , house){
		   
        var arr=sid.split('-');
        var id=arr[0];
	    var name_house=arr[1];
		

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('all_flat/getData');  ?>",
                data: {'id':id} ,
                success: function(data) { 

                  		var ob=JSON.parse(data);
          				var rid=ob[0].id;
          				var hid=ob[0].hid;
                        var foid=ob[0].floid;
          				var flat_name=ob[0].flat_name;
          				var flat_code=ob[0].flat_code;
			            var notes=ob[0].notes;
			            
			            
			
				//alert(rid+' '+hid+' '+flid+' '+foid);
			
				//console.log(data);
				  //$("#roomid").val(rid).change();
	                  $("#id").val(id);
	                  $("#name_house").val(hid);
	                  $("#flat_name").val(flat_name);
	                  $("#flat_code").val(flat_code);	  
					  $("#notes").val(notes);	
	                  

	                  //setTimeout(getFloor(hid, foid), 9998); 
	                  //$("#floor").val(foid).change();
	                  ////$("#flat").val(flid).change();
	                  //setTimeout(getRoom(foid, flid), 1000); 
	                   $("#flat_id").val(id);
                  $("#house_name").val(hid);
                  //setTimeout(getFloor(hid, foid), 1000); 
                  $("#floor").val(foid);
                  //$("#flat").val(flid);

	                  $("#flat_name").val(flat_name);
	                  $("#flat_code").val(flat_code);	
                }
            });
	   
	   
     $("#addModal").modal();
    }

     function deletehouse(id){
               if(confirm('Confirm Delete Flat?')){
              //alert(result);
              $.ajax({
			
			method: "post",
			url : "<?php echo base_url().'all_flat/delflat'; ?>",
			data : { 'id' : id },
			success: function(result){

                                   alert(result);
                                   location.reload();
                                   
                           }		
		});
          }
      }

</script>



</body>
</html>
