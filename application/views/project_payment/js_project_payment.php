<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<script>


    function addModal(id) {


        $("#project_name").val(id);
        $("#addModal").modal();
    }
    function deleteModal(id) {
        $("#delete_id").val(id);
        $("#myModalDelete").modal();
    }






</script>


</body>
</html>
