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
            "ajax": '<?php echo site_url('all_houses/getTableData'); ?>',
            "aoColumns": [
                
                 {"sClass": "center"},
                 {"sClass": "center"},                
                 {"sClass": "center"},
                 {"sClass": "center"},
                 {"sClass": "center"},
{"sClass": "center"},
                 {"sClass": "center"}
            ],
            "aaSorting": [[ 6, "asc" ]]

        });
    });


function gethouse(id){

       //alert(id);

       $.ajax({
			
			method: "post",
			url : "<?php echo base_url().'all_houses/gethouse'; ?>",
			data : { 'id' : id},
			success: function(result){

				  var json = JSON.parse(result); 
					$('#hid').val(id);
          $('#hname').val(json[0].house_name);
          $('#hcode').val(json[0].house_code);
          $('#address').text(json[0].address);
          $('#hnote').val(json[0].notes);
$('#emp').val(json[0].emp_id).change();
          //$('#imgg').val(json[0].imgg);
          var base_url = window.location.origin;

          var host = window.location.host;
          var path = 'http://localhost/greehasheba/public/uploads/employee/';
          $("#imgg").attr('src',path+json[0].imgg);
          $('#houseModal').modal();
			}		
		});
}

        function deletehouse(id){
if(confirm('Confirm Delete House ?')){
                 //alert(result);
              $.ajax({
			
			method: "post",
			url : "<?php echo base_url().'all_houses/delhouse'; ?>",
			data : { 'id' : id},
			success: function(result){

                                   alert(result);
                                   location.reload();
                                   
                           }		
		});
          }
}
</script>

 

</body>
</html>
