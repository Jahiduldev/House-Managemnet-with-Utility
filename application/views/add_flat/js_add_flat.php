
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--common script for all pages-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_shop.js"></script>


<script>

    function getFloor(house_id) {

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_flat/getFloor'); ?>",
            data: {'house_id': house_id},
            success: function (data) {

                $("#floor").html(data);


            }
        });



    }


</script>



</body>
</html>
