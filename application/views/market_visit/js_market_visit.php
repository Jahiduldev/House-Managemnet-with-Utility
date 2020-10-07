
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--common script for all pages-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_shop.js"></script>
<script>

    function getClient(com_id) {

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('add_project/getClient'); ?>",
            data: {'com_id': com_id},
            success: function (data) {
                $("#client").html(data);
            }
        });
    }
    
    
       function getProject(client_id) {
        var com_id = $("#company").val();
       
        $.ajax({
            type: "Post",
            url: "<?php echo site_url('assign_project/getProject'); ?>",
            data: {'com_id': com_id, 'client_id': client_id},
            success: function (data) {
                $("#project_div").html(data);
            }
        });
    }

</script>
</body>
</html>
