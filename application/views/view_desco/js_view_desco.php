<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>



<script>


       function addModal(sid){
		   
        var arr=sid.split('-');
        var id=arr[0];
	   
	    

	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('view_desco/getData');  ?>",
                data: {'id':id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				//var id=ob[0].id;
				var name=ob[0].name;
				var address=ob[0].address;
				var acct_number=ob[0].acct_number;

      			var rid=ob[0].id;
      		
      			 
      			var hid=ob[0].hid;

      			var fltid=ob[0].fltid;
                        var foid=ob[0].floid;
      			var room_name=ob[0].room_name;
      			var room_code=ob[0].room_code;
		        var notes=ob[0].notes;
				
			var meter_number=ob[0].meter_number;
		        var meter_nm=ob[0].meter_nm;
                        var load =ob[0].sec_load;
		        var notes=ob[0].notes;
                        var code=ob[0].code;
			$("#code").val(code);
				
                       
			
		      $("#id").val(id);
		     $("#house_name").val(hid);
				  $("#floor").val(foid);
				  $("#flat").val(fltid);
	              $("#name").val(name);
	              $("#room_code").val(room_code);	
	              $("#room_name").val(room_name);

	              $("#address").val(address);
	              $("#acct_number").val(acct_number);	
	              $("#meter_number").val(meter_number);
                      $("#load").val(load);

                      
	              $("#meter_nm").val(meter_nm);					  
		     $("#notes").val(notes);

		          
                 
				
			
				  			 
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
			
				          //alert(rid+' '+hid+' '+flid+' '+foid);
			
				          //console.log(data);
				          //$("#roomid").val(rid).change();

                  $("#id").val(id);
                  $("#house_name").val(hid);
                  //setTimeout(getFloor(hid, foid), 1000); 
                  $("#floor").val(foid);
                  $("#flat").val(flid);
                  //setTimeout(getRoom(foid, flid), 1000);
                  
                  $("#room_code").val(room_code);	
               	  $("#room_name").val(room_name);
				          $("#notes").val(notes);	
			
				  			 
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


    function deleteroom(id){
               if(confirm('Confirm Delete Room?')){
              //alert(result);
              $.ajax({
			
			 method: "post",
       cache: false,
			 url : "<?php echo base_url().'all_room/delroom'; ?>",
			 data : { 'id' : id},
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
