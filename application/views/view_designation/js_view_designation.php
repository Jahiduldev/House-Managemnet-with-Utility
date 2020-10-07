
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_subs_menu.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_sub_menu.js"></script>


<script>

    $(document).ready(function() {
   
        var oTable = $('#editable-sample').dataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": '<?php echo site_url('view_designation/getTableData'); ?>',
            "aoColumns": [
                {"sClass": "center"},
                {"sClass": "center"}, 
                {"sClass": "center"}, 
                {"sClass": "center"}
            ],
            "aaSorting": [[ 3, "desc" ]]

        });
    });

</script>

 

</body>
</html>
