<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_subs_menu.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_sub_menu.js"></script>


<script>

    $(document).ready(function() {
        //alert("data");
        var oTable = $('#editable-sample').dataTable({
            "processing": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": '<?php echo site_url('all_floor/getTableData'); ?>',
            "aoColumns": [
                
                   {"sClass": "center"},
                   {"sClass": "center"},                
                   {"sClass": "center"},
                   {"sClass": "center"},
                   {"sClass": "center"},
                   {"sClass": "center"}

            ],
            "aaSorting": [[ 5, "asc" ]]

        });
    });


function getfloor(id){

        

                $.ajax({
			
			method: "post",
			url : "<?php echo base_url().'all_floor/getfloor'; ?>",
			data : { 'id' : id},
			success: function(result){

				   var json = JSON.parse(result); 
					$('#hid').val(id);
                                        $('#hname').val(json[0].house_name);
                                        $('#hcode').val(json[0].house_code);
                                        $('#address').text(json[0].address);
                                        $('#floor').val(json[0].floor_name);
                                        $('#notes').val(json[0].notes);
                                        $('#houseModal').modal();
			}		
		});
            }

</script>

 

</body>
</html>
