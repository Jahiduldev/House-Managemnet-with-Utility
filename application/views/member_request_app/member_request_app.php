<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
       

        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Members Request Approved
                    </header>
                    <div class="panel-body">



                        <div class="adv-table">
                            <table class="display table table-bordered" id="editable-sample"> <!--hidden-table-info   -->
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Army Name</th>
                                        <th>Army Id</th>                                     
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </section>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Sub Menu 2 Confirmation</h4>
                    </div>

                    <div class="modal-body">
                        <form role="form" class="form-horizontal" method="post" action="<?php echo site_url('add_subs_menu2/editSubMenu');  ?>">
                            <div class="form-group">
                                <label class="col-lg-3 col-sm-3 control-label" for="name">Sub Menu 2 Name</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="Enter Menu Name" id="edit_menu_name" name="edit_menu_name" class="form-control">
                                    <input type="hidden" id="edit_menu_id" name="edit_menu_id" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-3 col-lg-9">
                                    <button class="btn btn-success" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- modal -->


    </section>
</section>
<!--main content end-->

