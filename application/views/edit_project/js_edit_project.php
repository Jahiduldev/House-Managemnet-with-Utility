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


</script>
</body>
</html>
