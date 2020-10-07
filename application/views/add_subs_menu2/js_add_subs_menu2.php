

<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo $base_url ?>public/js/jquery.js"></script>
<script src="<?php echo $base_url ?>public/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo $base_url ?>public/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo $base_url ?>public/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo $base_url ?>public/js/jquery.nicescroll.js" type="text/javascript"></script>

<script type="text/javascript" language="javascript" src="<?php echo $base_url ?>public/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $base_url ?>public/assets/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo $base_url ?>public/js/respond.min.js" ></script>


<!--datetime picker-->
<!--<script type="text/javascript" src="<?php //echo $base_url ?>public/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>-->
<!--this page  script only-->
<!--<script src="<?php //echo $base_url ?>public/js/advanced-form-components.js"></script>-->

<!--right slidebar-->
<script src="<?php echo $base_url ?>public/js/slidebars.min.js"></script>
<!--dynamic table initialization -->
<script src="<?php echo $base_url ?>public/js/dynamic_table_init_subs_menu.js"></script>
<!--common script for all pages-->
<script src="<?php echo $base_url ?>public/js/common-scripts.js"></script>

<!--script for this page-->
<script type="text/javascript" src="<?php echo $base_url ?>public/js/jquery.validate.min.js"></script>
<script src="<?php echo $base_url ?>public/js/form-validation-script_add_sub_menu.js"></script>
<script>

       function editSubMenu(subs_menu2_id){
	 
	        $.ajax({
                type: "Post",
                url: "<?php echo site_url('add_subs_menu2/getSubMenuData');  ?>",
                data: {'subs_menu2_id':subs_menu2_id} ,
                success: function(data) {  
				var ob=JSON.parse(data);
				var sub_menu2_id=ob[0].subs_menu2_id;
				var sub_menu2_name=ob[0].sub_menu2_name;
				console.log(data);
				  $("#edit_menu_id").val(sub_menu2_id);
                  $("#edit_menu_name").val(sub_menu2_name);
                    
                }
            });
	   
	   
     $("#myModalEdit").modal();
    }


</script>

</body>
</html>
