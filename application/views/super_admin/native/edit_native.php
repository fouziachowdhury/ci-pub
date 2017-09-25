<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form action="super_admin/updatePlaygroundImages" method="post" enctype="multipart/form-data">
                        
                        <input type="hidden" name="playground_id" value="">
                        
                        <table class="table table-condensed table-bordered table-striped">
                            <tr style="text-align: center">
                                <td>Images</td>
                                <td>Categories</td>
                                <td>Countries</td>
                                <td>Keywords</td>
                                <td>Action</td>
                            </tr>
                                <tr style="text-align: center">

                                    <td><img src="assets/admin/images/assets/background.png" style="width:100px; height: 50px;" alt="images"></td>
                                    <td>
                                        <p style="display: block;" id="cat_text">Category 1, Category 2</p>
                                        <select class="select2 m-b-10 select2-multiple" id="category" multiple="multiple" name="hobbies[]" style="display: none;">
                                            <option value="0">Choose Categories</option>
                                            <option value="1" selected="">Category 1</option>
                                            <option value="2" selected="">Category 2</option>
                                            <option value="3">Category 3</option>
                                        </select>
                                    </td>
                                    <td>
                                        <p style="display: block;" id="country_text">Country 1, Country 2</p>
                                        <select class="select2 m-b-10 select2-multiple" id="country" multiple="multiple" name="hobbies[]" style="display: none;">
                                            <option value="0">Choose Countries</option>
                                            <?php foreach ($all_country as $country) { ?>
                                                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>Keyword</td>
                                    <td>
                                        <a style="cursor: pointer;display: none;" id="update_button">Update</a>
                                        <a onclick="editInfo()" id="edit_button" style="cursor: pointer;display: block;">Edit</a>
                                        <a onclick="return chkDelete()" href="super_admin/deleteSubImages/">Delete</a>
                                    </td>

                                </tr>
<!--                                <tr style="text-align: center">

                                    <td><img src="assets/admin/images/assets/landscape1.jpg" style="width:100px; height: 50px;" alt="images"></td>
                                    <td>Category 1</td>
                                    <td>Country 1</td>
                                    <td>Keyword</td>
                                    <td>
                                        <a onclick="editInfo()" style="cursor: pointer;" data-toggle="modal" data-target="#quick_view_modal">Edit</a>
                                        <a onclick="return chkDelete()" href="super_admin/deleteSubImages/">Delete</a>
                                    </td>

                                </tr>-->
<!--                            <tr>
                                <td style="text-align: center">  <b>Add More Sub Images:</b>  </td>
                                <td colspan="2"><input type="file" multiple name="userfile[]" class="form-control" ></td>  
                            </tr>-->
                        </table>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Categories(For Bulk)</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="hobbies[]">
                                <option value="0">Choose Categories</option>
                                <option value="1">Category 1</option>
                                <option value="2">Category 2</option>
                                <option value="3">Category 3</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Countries(For Bulk)</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="hobbies[]">
                                <option value="0">Choose Countries</option>
                                <?php foreach ($all_country as $country) { ?>
                                    <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Keywords(For Bulk)</label>
                            <input type="text" name="membership_price" class="form-control" value="<?php echo set_value('membership_price'); ?>" placeholder="Keywords">
                        </div>

                        <div class="form-group">
                            <div class="dropzone" id="myId">
                                
                            </div>
                            <div class="previews" id="preview"></div>

                        </div>

                        <a href="super_admin/allPlayground">
                            <button type="button" class="btn btn-default waves-effect waves-light m-r-10">Cancel</button>
                        </a>
                        
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Edit</button>
                        <!--<button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>-->
                    </form>

                    <!--            Modal for edit Images            -->
                    
                    <div class="modal fade" id="quick_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title center" id="exampleModalLabel"><strong></strong></h4>
                                </div>

                                <form action="super_admin/update_image" method="post" enctype="multipart/form-data">
                                    <div class="modal-body">

                                        <?php // foreach ($image_details as $row){?>
                                        <input type="hidden" name="image_id" value="">
                                        <input type="hidden" name="is_main_image" value="">
                                        <input type="hidden" name="playground_id" value="">
                                        <!--            <div class="form-group">
                                                        <label for="name">Product Image:</label>
                                                        <img src="uploads/playground_images/<?php echo $image_details->images; ?>" style="width: 100px;height: 100px" alt="">
                                                    </div>-->

                                        <div class="form-group">
                                            <label for="email">New Image:</label>
                                            <input type="file" name="userfile" class="form-control dropify" value="">
                                        </div>

                                    </div>
                                    <?php // }?>
                                    <div class="modal-footer">
                                        <button type="submit" name="btn" class="btn btn-primary" class="pull-right">Submit</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left">Decline</button>

                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>

                      <!--            Modal for edit Images            -->
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function editInfo(){
        document.getElementById("category").style.display = "block";
        document.getElementById("country").style.display = "block";
        document.getElementById("update_button").style.display = "block";
        document.getElementById("edit_button").style.display = "none";
        
        document.getElementById("country_text").style.display = "none";
        document.getElementById("cat_text").style.display = "none";
        $("select").select2();
    }
    
    function chkDelete() {
        var chk = confirm("Are You Sure to Delete This ?");
        if (chk) {
            return true;
        } else {
            return false;
        }
    }
</script>

<script type="text/javascript">

    function image_details(img_id) {
        $.ajax({
            url: "<?php echo site_url('super_admin/image_details_modal'); ?>",
            type: "post",
            data: {img_id: img_id},
            success: function (msg) {
//                alert("" + msg);
                $('#quick_view_modal').html(msg);
                $('#quick_view_modal').modal('show');
            }
        });
    }
    
</script>

<script>
    $(function() {
    Dropzone.options.myId = {
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        previewsContainer: ".previews",
        url:"/file/post",
    init: function() {
      
        thisDropzone = this;
        this.on(
            "addedfile", function(file) {
              caption = file.caption == undefined ? "" : file.caption;
              file._captionLabel = Dropzone.createElement("<label for='exampleInputuname'>Categories</label>")
              file._captionBox = Dropzone.createElement(
                      "<select id='"+file.filename+"' class='select2 m-b-10 select2-multiple' multiple='multiple' name='catgory[]' value="+caption+">\n\
                                <option value='0'>Choose Category</option>\n\
                                <option value='1'>Category 1</option>\n\
                                <option value='2'>Category 2</option>\n\
                                <option value='3'>Category 3</option>\n\
                                                    </select>");
              file.previewElement.appendChild(file._captionLabel);
              file.previewElement.appendChild(file._captionBox);
              
              select = file.select == undefined ? "" : file.select;
              file._selectLabel = Dropzone.createElement("<label for='exampleInputuname'>Countries</label>")
              file._selectBox = Dropzone.createElement(
                      "<select id='"+file.filename+"' class='select2 m-b-10 select2-multiple' multiple='multiple' name='country[]' value="+caption+">\n\
                                <option value='0'>Choose Country</option>\n\
                                <?php foreach ($all_country as $country) { ?>\n\
                                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>\n\
                                <?php } ?>\n\
                        </select>");
              file.previewElement.appendChild(file._selectLabel);
              file.previewElement.appendChild(file._selectBox);
              
              keyword = file.select == undefined ? "" : file.select;
              file._keywordLabel = Dropzone.createElement("<label for='exampleInputuname'>Keyword</label>")
              file._keywordBox = Dropzone.createElement(
                      "<input id='"+file.filename+"' type='text' name='email' class='form-control'>");
              file.previewElement.appendChild(file._keywordLabel);
              file.previewElement.appendChild(file._keywordBox);
              $("select").select2();
              
//                 if (errorMessage.indexOf('Error 404') !== -1) {
//                    var errorDisplay = document.querySelectorAll('[data-dz-errormessage]');
//                    errorDisplay[errorDisplay.length - 1].innerHTML = 'Error 404: The upload page was not found on the server';
//                  }
        }),
        this.on(
            "sending", function(file, xhr, formData){
            formData.append('yourPostName',file._captionBox.value);
        })
    }
};
});
    
</script>