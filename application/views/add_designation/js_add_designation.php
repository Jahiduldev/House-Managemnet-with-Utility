
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--common script for all pages-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_shop.js"></script>


<script>

    function getDepartment(com_id) {

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_designation/getDepartment'); ?>",
            data: {'com_id': com_id},
            success: function (data) {

                $("#department").html(data);


            }
        });



    }


</script>



</body>
</html>
