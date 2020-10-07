<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_subs_menu.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_sub_menu.js"></script>


<script>

    $(document).ready(function() {
        //alert("data");
        var oTable = $('#editable-sample').dataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": '<?php echo site_url('all_room/getTableData'); ?>',
            "aoColumns": [
                {"sClass": "center"},
                {"sClass": "center"},                
                {"sClass": "center"},
                 {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                 {"sClass": "center"}
            ],
            "aaSorting": [[ 6, "asc" ]]

        });
    });


function getroom(id){

        

       $.ajax({
			
			method: "post",
			url : "<?php echo base_url().'all_room/getroom'; ?>",
			data : { 'id' : id},
			success: function(result)
            {

		      var json = JSON.parse(result); 

			        $('#hid').val(id);
                    $('#hname').val(json[0].house_name);
                    $('#fname').val(json[0].floor_name);
                    $('#flname').val(json[0].flat_name);
                    $('#rname').val(json[0].room_name);
                    $('#rcode').val(json[0].room_code);
                    $('#rnote').val(json[0].notes);
                    $('#houseModal').modal();
			 }		
		  });
        }




//New Code 


    // $(function () {
    //     $.ajax({
    //         type: "Post",
    //         url: "<?php //echo site_url('add_employee/getEmpCode'); ?>",
    //         //   data: {'role_id':role_id,'action':'getPermission'} ,
    //         success: function (data) {
    //             //  alert(data);
    //             var cd = "0001";
    //             if (data != "") {
    //                 cd = (parseInt(data) + 1).toString();
    //             }
    //             var len = cd.length;
    //             if (len == 1) {
    //                 cd = "000" + cd;
    //             } else if (len == 2) {
    //                 cd = "00" + cd;
    //             } else if (len == 3) {
    //                 cd = "0" + cd;
    //             }
    //             $('#emp_code').val(cd);
    //         }
    //     });
    // });


  
    // function getFloor(house_id) {

    //     $.ajax({
    //         type: "Post",
    //         url: "<?php// echo site_url('add_room/getFloor'); ?>",
    //         data: {'house_id': house_id},
    //         success: function (data) {

    //             $("#floor").html(data);


    //         }
    //     });



    // }
    
    
    // function getRoom(floor_id) {

    //     $.ajax({
    //         type: "Post",
    //         url: "<?php //echo site_url('add_room/getRoom'); ?>",
    //         data: {'floor_id': floor_id},
    //         success: function (data) {
               
    //             $("#flat").html(data);
    //         }
    //     });
    // }
    
    // function getRoomNo(room_id) {

    //     $.ajax({
    //         type: "Post",
    //         url: "<?php //echo site_url('add_house_client/getRoomNo'); ?>",
    //         data: {'room_id': room_id},
    //         success: function (data) {
               
    //             $("#room").html(data);
    //         }
    //     });
    // }
    
    

</script>

 

</body>
</html>
