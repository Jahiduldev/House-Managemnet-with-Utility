
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_officer.js"></script>
<!--script for this page-->
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_employee.js"></script>



<script>

    function checkcreditvno(vno) {

        $.ajax({
            type: "Post",
            url: "<?php echo site_url('journal/checkcreditvno'); ?>",
            data: {'vno': vno},
            success: function (data) {

                if(data!='ok'){
					$('#credtvnofield').val('');
					$('#credtvnofield').focus();
					$('#checkcreditvnomsg').html('<p style="color:red; font-size:10px;">Try Another Voucher No, this no in use.</p>');
				}else{
					$('#checkcreditvnomsg').html('');
					
				}
			}
        });
    }


</script>




   

</body>
</html>
