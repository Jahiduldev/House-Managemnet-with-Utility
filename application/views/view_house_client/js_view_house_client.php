<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_subs_menu.js"></script>
<!--common script for all pages-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_sub_menu.js"></script>
<script src="<?php echo $base_url ?>public/js/base64.js"></script>


<script>

    $(document).ready(function () {
        //alert("data");
        var oTable = $('#editable-sample').dataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": '<?php echo site_url('view_house_client/getTableData'); ?>',
            "aoColumns": [

                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
                {"sClass": "center"},
		{"sClass": "center"},
		{"sClass": "center"},
			{"sClass": "center"},
                {"sClass": "center"}

            ],
            "aaSorting": [[9, "desc"]],
       
        });
    });

 function gethouseclient(id){

       //alert(id);

       $.ajax({
			
			method: "post",
			url : "<?php echo base_url().'view_house_client/getclient'; ?>",
			data : { 'id' : id},
			success: function(result){


		        var json = JSON.parse(result);
 
                        var getUrl = window.location.protocol+'//'+window.location.hostname+'/';
                        var id=json[0].id;
                        $("#id").val(id);
                        var rid=json[0].id;
                        var hid=json[0].hid;
                        var fltid=json[0].flat;
                        var foid=json[0].floid;
                        var room_name=json[0].room_name;
                        var room_code=json[0].room_code;
                       

                        $("#id").val(id);
                        $("#house_name").val(hid);

                      //setTimeout(getFloor(hid, foid), 1000); 
                        $("#floor").val(foid);
                        $("#flat").val(fltid);
                      //setTimeout(getRoom(foid, flid), 1000);
                      
                        $("#room_code").val(room_code);   
                        $("#roomn").val(room_name);
                    // end


                        $('#clientid').val(json[0].client_id);  
                        $('#rentdate').val(json[0].rent_date); 
                        $('#advance').val(json[0].advance); 
                        //alert(json[0].status);
                        if(json[0].rent_type = '1'){

                        $('#roomtype').show();
                        $('#roomn').val(json[0].room);
                        }else{

                        $('#roomtype').hide();
                       }

                       
                        $('#roomno').val(json[0].rent_type);

                        $('#name').val(json[0].client_name);
                        $('#code').val(json[0].code);
                        $('#datebirth').text(json[0].date_birth);
                        $('#ccode').val(json[0].code);

                        $('#rentdate').val(json[0].rent_date);
                        $('#advance').val(json[0].advance);
                        $('#username').val(json[0].user_name);
                        $('#password').val($.base64.decode(json[0].password));

                        $('#gender').val(json[0].gender);
                        $('#maritalstatus').val(json[0].marital_status);
                        $('#religion').val(json[0].religion);
                        $('#mobileno').val(json[0].mobile_number);

                        $('#emailaddr').val(json[0].email);
                        $('#fathername').val(json[0].father_name);
                        $('#mothername').val(json[0].mother_name);
                        $('#emergencycontact').val(json[0].emergency_contact);

                        $('#rentmonth').val(json[0].mont);
                        $('#lastpaymentdate').val(json[0].last_payment_date);

                        $('#photoupload').val(json[0].photo_upload);
                        $('#signature').val(json[0].signature_upload);
                        $('#presentaddr').val(json[0].present_address);
                        $('#parmaneaddr').val(json[0].permanent_address);

                        $('#note').val(json[0].note);
                        $('#emergencycontactrelation').val(json[0].emergencycontactrelation);
                        $('#idno').val(json[0].idno);

                        $('#profession').val(json[0].profession);
                        $('#designation').val(json[0].designation);
                        $('#0').val(json[0].amount);
                        $('#1').val(json[1].amount);
                        $('#2').val(json[2].amount);
                        $('#3').val(json[3].amount);
                        $('#4').val(json[4].amount);
                        $('#5').val(json[5].amount);
                        $('#6').val(json[6].amount);
                        $('#7').val(json[7].amount);
                        $('#8').val(json[8].amount);
                        $('#8').val(json[8].datetime);
                        $('#advance').val(json[0].advance);

                        
                         
                        var path = getUrl+'/greehasheba/public/uploads/employee/';
                        $("#Id_image").attr('src',path+json[0].photo_upload);
                         var path = getUrl+'/greehasheba/public/uploads/employee/';
                        $("#tenant_photo").attr('src',path+json[0].signature_upload);  
                         var path = getUrl+'/greehasheba/public/uploads/employee/';
                        $("#form_image").attr('src',path+json[0].cv_upload);


                        
                        $('#date_birth').val(json[0].date_birth);
                        $('#idtype').val(json[0].idtype).change();
                        $('#status').val(json[0].status).change();
                        $('#clientModal').modal();
			}		
		});
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
               
                $("#roomn").html(data);
            }
        });
    }

</script>



</body>
</html>
