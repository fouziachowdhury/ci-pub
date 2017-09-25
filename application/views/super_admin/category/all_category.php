<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add Category
                </button>
            </a>
            
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Category</h4>
                        </div>
                        <form action="admin/saveCategory" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputuname">Category Name</label>
                                    <input type="text" name="cat_name" class="form-control" id="exampleInputuname" placeholder="Category Name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <!--Modal End-->
            <h3 class="" style="text-align: center;">All Category</h3>
            <div class="table-responsive">
                <ul class="list-unstyled list-inline" style="text-align: right;">
                    
                </ul>
                <table id="myTable" class="table table-striped">
                    <thead>
                
                        <!--<p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>-->
                        <tr>
                            <th style="text-align: center;">Sl No.</th>
                            <th style="text-align: center;">Category Name</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;foreach ($all_category as $row){?>
                        <tr style="text-align: center;">
                            <td><?php echo $i;?></td>
                            <td><?php echo $row['cat_name']?></td>
                            <td>
                                <?php if($row['status'] == 1){?>
                                <a onclick="changeCategoryStatus('<?php echo $row['cat_id']; ?>')">
                                    <label class="label label-success" id="active<?php echo $row['cat_id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                                </a>
                                <?php }?>
                                <?php if($row['status'] == 0){?>
                                <a onclick="changeCategoryStatus('<?php echo $row['cat_id']; ?>')" style="">
                                    <label class="label label-danger" id="inactive<?php echo $row['cat_id'];?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                                </a>
                                <?php }?>
                            </td>
                            <td>
<!--                                <a href="admin/changeStatus/<?php echo $row['cat_id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>
                                </a>&nbsp;-->
                                <a data-toggle="modal" data-target="#editLink<?php echo $row['cat_id'];?>" style="cursor: pointer;">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Category" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
<!--                                <a href="super_admin/editBannerImage/">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Banner Image" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;-->
                                <a href="admin/deleteCategory/<?php echo $row['cat_id'];?>" onclick="return chkDelete()">
                                    <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                            
                            <div id="editLink<?php echo $row['cat_id']; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="text-align: center">Edit Category</h4>
                                            </div>
                                            <form action="admin/updateCategory" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['cat_id'] ?>">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="form-first-name">Category Name</label>
                                                            <input type="text" name="cat_name" class="form-control" value="<?php echo $row['cat_name'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" id="sub_button" class="btn btn-success">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            
                        </tr>

                        <?php $i++;}?>
                    </tbody>
                </table>
                
                
                <div class="modal fade" id="quick_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                </div>
                
                
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        $("#active").prop("checked", true);
        $("#inactive").prop("checked", true);
        $("#trial").prop("checked", true);
        
    });
     
</script>

<script>
    function chkDelete(){
        var chk = confirm("Are You Sure to Delete This ?");
        if(chk){
            return true;
        }
        else{
            return false;
        }
    }
</script>

<script type="text/javascript">

    function view_user(reg_id) {
//        alert(reg_id);
        $.ajax({
            url: "<?php echo site_url('super_admin/viewUserModal'); ?>",
            type: "post",
            data: {reg_id: reg_id},
            success: function (msg) {
//                alert("" + msg);
                $('#quick_view_modal').html(msg);
                $('#quick_view_modal').modal('show');
            }
        });
    }
</script>

<script>
    
    function changeCategoryStatus(cat_id){
//       alert(cat_id);
       $.ajax({
            url: "<?php echo site_url('admin/changeCategoryStatus'); ?>",
            type: "post",
            data: {cat_id: cat_id},
            success: function (msg) {
//                alert("" + msg);
                if(msg == '1'){
                    if($( "#active"+cat_id ).hasClass( "label-danger" )){
                       $('#active'+cat_id).text('Active').removeClass("label-danger").addClass("label-success");
                   } 
                    if($( "#inactive"+cat_id ).hasClass( "label-danger" )){
                        $('#inactive'+cat_id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                }
                if(msg == '0'){
                    if($( "#inactive"+cat_id ).hasClass( "label-success" )){
                        $('#inactive'+cat_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
                    if($( "#active"+cat_id ).hasClass( "label-success" )){
                        $('#active'+cat_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                   }
//                   
                }
            }
        });
    }
    
</script>