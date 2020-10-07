
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--script for this page-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_employee.js"></script>
<script type="text/javascript">


    function toDate(d) {
        var from_date = $("#from_date").val()
        var today = new Date(from_date);
        var dd = today.getDay() + d;
        var mm = today.getMonth(); //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        var today = yyyy + '-' + dd + '-' + mm;
        $("#to_date").val(today);
        alert(today);
    }



    function getEmployeeInfo() {
        var emp_id = $("#employee_code").val();

        if ($.isNumeric(emp_id) && emp_id != "") {
            $.ajax({
                type: "Post",
                url: "<?php echo site_url('salary_deduct/getEmployeeInfo'); ?>",
                data: {'emp_id': emp_id},
                success: function (data) {

                    if (data != 'not matched') {
                        var ob = JSON.parse(data);
                        var id = ob[0].id;
                        var emp_id = ob[0].emp_id;
                        var emp_name = ob[0].emp_name;
                        var department = ob[0].department;
                        var designation = ob[0].designation;
                        var joining_date = ob[0].joining_date;
                        var mobile_number = ob[0].mobile_number;
                        var email = ob[0].email;

                        $("#edit_id").val(id);
                        $("#employee_name").val(emp_name);

                        $("#department").val(department);
                        $("#designation").val(designation);
                        $("#joining_date").val(joining_date);
                        $("#mobile_number").val(mobile_number);
                        $("#email").val(email);
                    } else {
                        $("#edit_id").val("");
                        $("#employee_name").val("");

                        $("#department").val("");
                        $("#designation").val("");
                        $("#joining_date").val("");
                        $("#mobile_number").val("");
                        $("#email").val("");
                        alert("Not found");
                    }


                }
            });
        } else {
            $("#edit_id").val("");
            $("#employee_name").val("");

            $("#department").val("");
            $("#designation").val("");
            $("#joining_date").val("");
            $("#mobile_number").val("");
            $("#email").val("");
            alert("Please enter a valid employee code");
        }



    }

</script>

</body>
</html>
