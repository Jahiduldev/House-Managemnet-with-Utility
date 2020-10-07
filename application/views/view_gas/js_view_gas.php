<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('-');
        var id=arr[0];
	

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('view_gas/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var id=ob[0].id;
				var name=ob[0].name;
				var address=ob[0].address;
				var titas_id=ob[0].titas_id;
				
			 
				var notes=ob[0].note;
				
			    var rid=ob[0].id;
  				var hid=ob[0].hid;
  				var flid=ob[0].fltid;
                var foid=ob[0].floid;
  				var room_name=ob[0].room_name;
  				var room_code=ob[0].room_code;
	            var notes=ob[0].notes;

			    var meter_number=ob[0].meter_number;
				var meter_nm=ob[0].meter_nm;
				var notes=ob[0].note;
  $("#notes").val(notes);

				var titas_id = ob[0].titas_id;
				$("#titas_id").val(titas_id);

				var single = ob[0].single;
				$("#Ssburner").val(ob[0].single);
				var sin_amount = ob[0].sin_amount;
				$("#Samount").val(sin_amount);	
				var doubles = ob[0].doubles;
				$("#Dnumber").val(doubles);				  
				var dob_amount = ob[0].dob_amount;
				$("#Damount").val(dob_amount);
                                 var code = ob[0].code;
                        
                                 $("#code").val(code);
				
			  
				  $("#id").val(id);
				  $("#house_name").val(hid);
				  $("#floor").val(foid);
				  $("#flat").val(flid);
	              $("#name").val(name);
	              $("#room_code").val(room_code);	
	           	  $("#room_name").val(room_name);

	              $("#address").val(address);
	              $("#acct_number").val(acct_number);	
	              $("#meter_number").val(meter_number);	
	              $("#meter_nm").val(meter_nm);					  
				
              
				 
	            
	             

                  $("#address").val(address);
                  $("#titas_id").val(titas_id);	
         			  
				
			
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }





       function ddModal(sid){
		   
        var arr=sid.split('-');
        var id=arr[0];
	      var name_house=arr[1];


    


	        $.ajax({
                type: "Post",
                cache: false,
                url: "<?php echo site_url('all_room/getData');  ?>",
                data: {'id':id} ,
                success: function(data)
                {  //alert(data);
          				
                  var ob=JSON.parse(data);
          				var rid=ob[0].id;
          				var hid=ob[0].hid;
          				var flid=ob[0].fltid;
                        var foid=ob[0].floid;
          				var room_name=ob[0].room_name;
          				var room_code=ob[0].room_code;
			            var notes=ob[0].notes;


			            	
      		
      			 alert(hid);
      			
		          var notes=ob[0].notes;
				
			      var meter_number=ob[0].meter_number;
				  var meter_nm=ob[0].meter_nm;
				  var notes=ob[0].notes;
				
			
				  $("#id").val(id);
				  $("#house_name").val(hid);
				  $("#floor").val(foid);
				  $("#flat").val(flid);
	              $("#name").val(name);
	              $("#room_code").val(room_code);	
	           	  $("#room_name").val(room_name);

	              $("#address").val(address);
	              $("#acct_number").val(acct_number);	
	              $("#meter_number").val(meter_number);	
	              $("#meter_nm").val(meter_nm);					  
				  $("#notes").val(notes);
			
				          //alert(rid+' '+hid+' '+flid+' '+foid);
			
				          //console.log(data);
				          //$("#roomid").val(rid).change();

      //             $("#id").val(id);
      //             $("#house_name").val(hid);
      //             //setTimeout(getFloor(hid, foid), 1000); 
      //             $("#floor").val(foid);
      //             $("#flat").val(flid);
      //             //setTimeout(getRoom(foid, flid), 1000);
                  
      //             $("#room_code").val(room_code);	
      //          	  $("#room_name").val(room_name);
				  // $("#notes").val(notes);	
			
				  			 
                }
            });
	   
	   
     $("#addModal").modal();
    }


    function getFloor(house_id){

        $.ajax({
            type: "Post",
            cache: false,
            url: "<?php echo site_url('add_room/getFloor'); ?>",
            data: {'house_id': house_id},
            success: function (data) {

                $("#floor").html(data);


            }
        });

    }
    
    
    function getRoom(floor_id) {

        $.ajax({
            type: "Post",
             cache: false,
            url: "<?php echo site_url('add_room/getRoom'); ?>",
            data: {'floor_id': floor_id},
            success: function (data) {
               
                $("#flat").html(data);
            }
        });
    }
    
    function getRoomNo(room_id) {

        $.ajax({
            type: "Post",
             cache: false,
            url: "<?php echo site_url('add_house_client/getRoomNo'); ?>",
            data: {'room_id': room_id},
            success: function (data) {
               
                $("#room").html(data);
            }
        });
    }

</script>



</body>
</html>
