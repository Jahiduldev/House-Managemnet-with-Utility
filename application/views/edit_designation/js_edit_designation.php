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
