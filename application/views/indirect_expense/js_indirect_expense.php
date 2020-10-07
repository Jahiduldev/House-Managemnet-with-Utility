
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--script for this page-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_employee.js"></script>



<script>

    function getExpense(com_id) {

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('indirect_expense/getExpense'); ?>",
            data: {'com_id': com_id},
            success: function (data) {

                $("#expense_type").html(data);


            }
        });



    }


</script>




   

</body>
</html>
