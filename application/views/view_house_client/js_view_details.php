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
                {"sClass": "center"}

            ],
            "aaSorting": [[8, "desc"]],
       
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
					$('#hid').val(id);
$('#hid').val(json[0].id);
                                        $('#hname').val(json[0].house_name);
                                        $('#fname').val(json[0].floor_name);
                                        $('#flname').val(json[0].flat_name);

                                        $('#clientid').val(json[0].client_id);  
$('#rentdate').val(json[0].rent_date); 
$('#advance').val(json[0].advance); 
//alert(json[0].status);
                                        if(json[0].rent_type != '1'){

                                                  $('#roomtype').show();
                                                  $('#roomno').val(json[0].room);
                                        }else{

                                                  $('#roomtype').hide();
                                       }



                                        $('#name').val(json[0].client_name);
$('#code').val(json[0].code);
                                        $('#datebirth').text(json[0].date_birth);
                                        $('#ccode').val(json[0].code);

                                        $('#rentdate').val(json[0].rent_date);
                                        $('#advance').val(json[0].advance);
                                        $('#username').text(json[0].user_name);
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
                                        //$('#joiningstatus').val(json[0].joining_status);
                                        //$('#confirmstatus').text(json[0].confirm_status);
                                        $('#status').val(json[0].status).change();

                                        $('#clientModal').modal();
			}		
		});
}

</script>



</body>
</html>
