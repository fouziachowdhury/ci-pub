<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add Sponsor
                </button>
            </a>
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Sponsor</h4>
                        </div>
                        <form action="admin/addSponsor" method="post" enctype="multipart/form-data">
                            <div class="optionBox">
                                <div class="block">
                                    <span class="add btn btn-success" style="margin: 10px 0px;">Add Option</span>
                                </div>


                                <div class="block">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Icon</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="userfile[]" id="title" value="" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group col-xs-12">
                                        <h3 class="box-title">Text</h3>
                                        <textarea class="summernote" name="sponsor_txt[]" id="description1"></textarea>
                                    </div>

                                    
                                    <div class="appenddata0"></div>
                                    <span class="remove btn btn-danger" style="margin-bottom: 10px;">Remove Option</span>
                                </div>

                            </div>
<!--                            <div id="items">
                                <div>
                                    <div class="form-group col-xs-12">
                                        <label for="exampleInputuname">Icon</label>
                                        <input type="file" name="icon[]" id="title" value="" class="form-control">
                                    </div>
                                    <div class="form-group col-xs-12">
                                        <h3 class="box-title">News</h3>
                                        <textarea class="summernote" name="news" id="description1"></textarea>
                                    </div>
                                </div>
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
                    <h3 class="" style="text-align: center;">All Sponsor</h3>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>

        <!--<p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>-->
                                <tr>
                                    <th style="text-align: center;width: 10%;">Sl No.</th>
                                    <th style="text-align: center;width: 60%;">News</th>
                                    <th style="text-align: center;width: 20%;">Date</th>
                                    <th style="text-align: center;width: 10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($news_data as $row) { ?>
                                    <tr style="text-align: center;">
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <?php
                                                if (strlen($row['sponsor_txt']) > 50) {
                                                    echo substr($row['sponsor_txt'], 0, 150);
                                                } else {
                                                    echo $row['sponsor_txt'];
                                                }
                                                ?>
                                            <?php // echo $row['news'] ?>
                                        </td>
                                        <td>
                                            <img src="uploads/sponsor_icon/<?php echo $row['sponsor_image']; ?>" alt="SPonsor Icon" style="width: 80px;height: 50px;">
                                        </td>
                                        <td>
                                            <a data-toggle="modal" data-target="#editLink<?php echo $row['id']; ?>" style="cursor: pointer;">
                                                <span data-toggle="tooltip" data-placement="top" title="Edit Category" class="glyphicon glyphicon-edit"></span>
                                            </a>&nbsp;
                                            <a href="admin/deleteSponsor/<?php echo $row['id']; ?>" onclick="return chkDelete()">
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
                                                        <h4 class="modal-title" style="text-align: center">Edit Sponsor</h4>
                                                    </div>
                                                    <form action="admin/update_sponsor" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">Icon</label>
                                                                <div class="col-sm-10">
                                                                    <input type="file" name="sponsor_image" class="form-control">
                                                                    <input type="hidden" name="sponsor_image1" value="<?php echo $row['sponsor_image']; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-xs-12">
                                                                <h3 class="box-title">Sponsor Text</h3>
                                                                <textarea class="summernote" name="sponsor_txt" id="description1"><?php echo $row['sponsor_txt'];?></textarea>
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


<script>
	var id = 0;
    $('.add').click(function () {
        id++;
//        alert(id);
        var n = $(".optionBox .block").length;
//        console.log(n);
        if (n <=4) {
        $('.block:last').after('<div class="block">\n\
                                <div class="form-group">\n\
                                <label for="inputEmail3" class="col-sm-2 control-label">Code</label>\n\
                                <div class="col-sm-10">\n\
                                    <input type="file" class="form-control" name="userfile[]" id="inputEmail3">\n\
                                </div>\n\
                            </div>\n\
                            <div class="form-group col-xs-12">\n\
                                <h3 class="box-title">News</h3>\n\
                                <textarea class="summernote" name="sponsor_txt[]" id="description1"></textarea>\n\
                            </div>\n\
                            <div class="appenddata' + id + '"></div>\n\
                                <span class="remove btn btn-danger" style="margin-bottom: 10px;">Remove Option</span></div>');
        }
        else{
                alert("Only five additional fields are allowed!")
            }
            
            $('.summernote').summernote({
            height: 350,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
    });
   
    $('.optionBox').on('click', '.remove', function () {
        id--;
        $(this).parent().remove();
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