<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add About Site
                </button>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add About Site</h4>
                        </div>
                        <form action="super_admin/add_about_site" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group col-sm-12">
                                    <label for="exampleInputuname">About Site Name</label>
                                    <input type="text" name="about_site" class="form-control" id="exampleInputuname" placeholder="Name">
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

            <h3 class="" style="text-align: center;">All Hobbies</h3>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Sl No.</th>
                            <th style="text-align: center;">About Site Name</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($all_about_site as $row){?>
                        <tr>
                            <td style="text-align: center;"><?php echo $i;?></td>
                            <td style="text-align: center;"><?php echo $row->about_site;?></td>
                            <td style="text-align: center;">
                                <?php if($row->status == 1){?>
                                <label class="label label-success" style="line-height: 2">Active</label>
                                <?php }else{?>
                                
                                    <label class="label label-danger" style="line-height: 2">Block</label>
                                <?php }?>
                                
                            </td>
                            <td style="text-align: center;">
                                <a href="super_admin/change_about_site_status/<?php echo $row->about_site_id?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Status Change" class="glyphicon glyphicon-refresh"></span>
                                </a>&nbsp;
                                <a data-toggle="modal" data-target="#editLink_<?php echo $row->about_site_id;?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Stuff" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
                                <a href="super_admin/delete_about_site/<?php echo $row->about_site_id?>" onclick="return chkDelete()">
                                    <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                            
                            
                            
                            <div id="editLink_<?= $row->about_site_id;?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                        
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" style="text-align: center">Replace About Site Name</h4>
                                            </div>
                                        <form action="super_admin/updateAboutSite" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="about_site_id" class="form-control" value="<?= $row->about_site_id; ?>">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="form-first-name">About Site Name</label>
                                                            <input type="text" name="about_site" class="form-control" value="<?php echo $row->about_site;?>">
                            <!--                            <span class="help-inline">Mensagem de erro do campo</span> -->
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" id="sub_button" class="btn btn-success">Submit
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                            </div>
                            
                            
                            
                        </tr>
                        
                        <?php $i++;}?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
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

<script>
function validateForm() {
    var tmp_img2 = document.forms['myForm']['stuff_logo'].files[0];
    var name = document.forms["myForm"]["stuff_name"].value;
    var stuff_price = document.forms["myForm"]["stuff_price"].value;
    
    if (tmp_img2 == "" || tmp_img2 == null) {
        alert("Image must be filled out");
        return false;
    }
    
    if (name == "" || name == null) {
        alert("Name must be filled out");
        return false;
    }
    
    if (stuff_price == "" || stuff_price == null) {
        alert("Price must be filled out");
        return false;
    }
}
</script>