<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add Call Center
                </button>
            </a>
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Call Center</h4>
                        </div>
                        <form action="admin/save_call_center" method="post" enctype="multipart/form-data">
                            <div class="form-group col-xs-12">
                                <label for="exampleInputuname">URL</label>
                                <input type="text" name="url" onkeyup="getTitle(this.value),getUrl(this.value)" class="form-control" placeholder="URL">
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="exampleInputuname">Title</label>
                                <input type="text" name="title" id="title" value="" class="form-control" placeholder="Title">
                            </div>
                            <div class="form-group col-xs-12">
                                <h3 class="box-title">Meta Description</h3>
                                <textarea class="form-control" name="meta" id="description1" style="resize: none;"></textarea>
                            </div>
<!--                            <div class="form-group col-xs-12">
                                <h3 class="box-title">Meta Description</h3>
                                <textarea class="summernote" name="meta" id="description1"></textarea>
                            </div>-->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <!--Modal End-->
            
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <!--                    <h5 style="color: red;"><?php
                    if (validation_errors()) {
                        echo validation_errors();
                    }
                    ?>
                                        </h5>-->
                       <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('success'); ?>
                        </div>
                       <?php } ?>

                       <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('error'); ?>
                        </div>

                       <?php } ?>
                    <h3 class="" style="text-align: center;">All Call Center</h3>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>

        <!--<p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>-->
                                <tr>
                                    <th style="text-align: center;">Sl No.</th>
                                    <th style="text-align: center;">Title</th>
                                    <th style="text-align: center;">Zip File</th>
                                    <th style="text-align: center;">URL</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resource_data as $row) { ?>
                                    <tr style="text-align: center;">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td>
                                            <a class="example-image-link" href="<?php echo $row['zip_file_name']; ?>" data-lightbox="example-1">
                                                <img src="<?php echo $row['zip_file_name']; ?>" alt="Landing Image" style="width: 100px;">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $row['url']; ?>" target="_blank">
                                                <?php
                                                if (strlen($row['url']) > 50) {
                                                    echo substr($row['url'], 0, 50);
                                                } else {
                                                    echo $row['url'];
                                                }
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-target="#editLink<?php echo $row['id']; ?>" style="cursor: pointer;">
                                                <span data-toggle="tooltip" data-placement="top" title="Edit Category" class="glyphicon glyphicon-edit"></span>
                                            </a>&nbsp;
                                            <a href="admin/deleteCallCenter/<?php echo $row['id']; ?>" onclick="return chkDelete()">
                                                <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </td>
                                        
                                        
                                        <div id="editLink<?php echo $row['id']; ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" style="text-align: center">Edit Call Center</h4>
                                                    </div>
                                                    <form action="admin/update_call_center" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group col-xs-12">
                                                                <label for="exampleInputuname">URL</label>
                                                                <input type="text" name="url" class="form-control" value="<?php echo $row['url']; ?>">
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <label for="exampleInputuname">Title</label>
                                                                <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>">
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <h3 class="box-title">Meta Description</h3>
                                                                <textarea class="summernote" name="meta" id="description1"><?php echo $row['meta_description']; ?></textarea>
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
                                    <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="assets/admin/bower_components/jquery/dist/lightbox-plus-jquery.min.js" type="text/javascript"></script>
<script>
    
    function getTitle(val){
//        alert(val);
        var result = val.replace(/(^\w+:|^)\/\//, '');
        $.ajax({
              url: "http://textance.herokuapp.com/title/"+result,
              complete: function(data) {
                document.getElementById('title').value = (data.responseText);
              }
        });
    }
    
    function getUrl(val){
        $.ajax({
            url: "<?php echo site_url('admin/get_url'); ?>",
            type: "post",
            data: {url: val},
            success: function (msg) {
//                alert("" + msg);
                if(msg){
                     $("#description1").text(msg);

//                    $("#description1").val(msg); 
                    //document.getElementById('description1').value = 'msg';
                }
            }
        });
    }
    
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