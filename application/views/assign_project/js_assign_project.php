
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--common script for all pages-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_shop.js"></script>
<script>
$(function() {
     var employee = $("#employee").val();
      getProjectDiv(employee);
});
 
    function getProjectDiv(emp_id) {
     

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('assign_project/getProject'); ?>",
            data: {'emp_id': emp_id},
            success: function (data) {
            
                $("#projectDiv").html(data);
            }
        });
    }

  
</script>
</body>
</html>
