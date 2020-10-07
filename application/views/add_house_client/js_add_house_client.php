
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--script for this page-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_employee.js"></script>
<script type="text/javascript">


    $(function () {
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_employee/getEmpCode'); ?>",
            //   data: {'role_id':role_id,'action':'getPermission'} ,
            success: function (data) {
                //  alert(data);
                var cd = "0001";
                if (data != "") {
                    cd = (parseInt(data) + 1).toString();
                }
                var len = cd.length;
                if (len == 1) {
                    cd = "000" + cd;
                } else if (len == 2) {
                    cd = "00" + cd;
                } else if (len == 3) {
                    cd = "0" + cd;
                }
                $('#emp_code').val(cd);
            }
        });
    });


  
    function getFloor(house_id) {

        $.ajax({
            type: "Post",
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
