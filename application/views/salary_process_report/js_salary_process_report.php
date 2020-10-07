
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_menu.js"></script>
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_menu.js"></script>
<script>
    function deleteMenu(menu_id) {
        $("#delete_menu_id").val(menu_id);
        $("#myModalDelete").modal();
    }

    function editMenu(id) {

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('salary_add_report/getMenuData'); ?>",
            data: {'id': id},
            success: function (data) {
                  //alert(data);
                var ob = JSON.parse(data);
                var id = ob[0].id;
                var emp_id = ob[0].emp_id;
                var add_type = ob[0].add_type;
                var amount = ob[0].amount;
                var note = ob[0].note;
              
                $("#edit_salary_deduct_id").val(id);
                $("#edit_empy_id").val(emp_id);
                $("#edit_deduct_type").val(add_type);
                $("#edit_deduct_amount").val(amount);
                $("#edit_deduct_note").val(note);

            }
        });

        $("#myModalEdit").modal();
    }
	
	function getAddSallaryInfo(id){ //alert(id);
	
		$.ajax({
            type: "Post",
            url: "<?php echo site_url('salary_add_report/getSalaryAddDetails'); ?>",
            data: 'id'= id,
            success: function (data) {
                  //alert(data);
                              
                $("#edit_salary_deduct_id").val(id);
                $("#edit_empy_id").val(emp_id);
                $("#edit_deduct_type").val(add_type);
                $("#edit_deduct_amount").val(amount);
                $("#edit_deduct_note").val(note);

            }
        });
		
	}

</script>

</body>
</html>
