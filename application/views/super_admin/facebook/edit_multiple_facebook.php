<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <!--<form action="super_admin/updatePlaygroundImages" method="post" enctype="multipart/form-data">-->
                        
                        <!--<input type="hidden" name="playground_id" value="">-->
                        
                        <table class="table table-bordered" id="tableName">
                            <tr style="text-align: center">
                                <td style="width: 10%;">Images</td>
                                <td style="width: 20%;">Categories</td>
                                <td style="width: 20%;">Countries</td>
                                <td style="width: 20%;">Keywords</td>
                                <td style="width: 20%;">Type</td>
                                <td style="width: 10%;">Action</td>
                            </tr>
                            <?php foreach ($all_facebook as $row){?>
                            <tr>
                                <td colspan="6" style="padding: 0px;">
                                    <form action="" id="form_data<?php echo $row[0]['fb_images_id']; ?>">
                                        <table class="table table-bordered" style="padding: 0px;">
                                            <tr style="text-align: center" id="row_data<?php echo $row[0]['fb_images_id']; ?>">

                                                <td style="width: 10%;padding: 10px 6px;">
                                                    <img src="uploads/facebook_ads/<?php echo $row[0]['image'] ?>" style="width:100%; height: 50px;" alt="images">
                                                </td>
                                                <td style="width: 20%;padding: 10px 6px;">
                                                    <p style="display: block;" id="cat_text<?php echo $row[0]['fb_images_id']; ?>">
                                                        <?php
                                                        $category = explode(',', $row[0]['cat_id']);
                                                        foreach ($category as $cat) {
                                                            foreach ($all_category as $all_cat) {
                                                                if ($all_cat['cat_id'] == $cat) {
                                                                    echo $all_cat['cat_name'] . '<br>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </p>
                                                    <select class="select2 m-b-10 select2-multiple" id="category<?php echo $row[0]['fb_images_id']; ?>" multiple="multiple" name="category[]" style="display: none;">
                                                        <option value="0">Choose Categories</option>
                                                        <?php foreach ($all_category as $all_cat) { ?>
                                                            <option value="<?php echo $all_cat['cat_id']; ?>" 
                                                            <?php
                                                            foreach ($category as $cat) {
                                                                if ($all_cat['cat_id'] == $cat) {
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>><?php echo $all_cat['cat_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td style="width: 20%;padding: 10px 6px;">
                                                    <p style="display: block;" id="country_text<?php echo $row[0]['fb_images_id']; ?>">
                                                        <?php
                                                        $country = explode(',', $row[0]['country_id']);
//                                    print_r($category);
                                                        foreach ($country as $cnt) {
                                                            foreach ($all_country as $country) {
                                                                if ($country['country_id'] == $cnt) {
                                                                    echo $country['country_name'] . '<br>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </p>
                                                    <select class="select2 m-b-10 select2-multiple" id="country<?php echo $row[0]['fb_images_id']; ?>" multiple="multiple" name="country[]" style="display: none;">
                                                        <option value="0">Choose Country</option>
                                                        <?php foreach ($all_country as $all_count) { ?>
                                                            <option value="<?php echo $all_count['country_id']; ?>" 
                                                            <?php
                                                                    $country = explode(',', $row[0]['country_id']);
                                                                    foreach ($country as $count) {
                                                                        if ($all_count['country_id'] == $count) {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo $all_count['country_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td style="width: 20%;padding: 10px 6px;">
                                                    <p style="display: block;" id="keyword_text<?php echo $row[0]['fb_images_id']; ?>">
                                                        <?php
                                                        $keyword = explode(',', $row[0]['keyword']);
                                                        foreach ($all_keyword as $all_key) {
                                                            foreach ($keyword as $key) {
                                                                if ($all_key['id'] == $key) {
                                                                    echo $all_key['keyword_tags'] . '<br>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </p>
                                                    <input type="text" name="keyword" id="key<?php echo $row[0]['fb_images_id']; ?>" multiple class="" style="display: none;"
                                                           value="<?php
                                                           $keyword = explode(',', $row[0]['keyword']);
                                                           foreach ($all_keyword as $all_key) {
                                                               foreach ($keyword as $key) {
                                                                   if ($all_key['id'] == $key) {
                                                                       echo $all_key['keyword_tags'] . ',';
                                                                   }
                                                               }
                                                           }
                                                           ?>">
                                                </td>
                                                <td style="width: 20%;padding: 10px 6px;">
                                                    <p style="display: block;" id="type_text<?php echo $row[0]['fb_images_id']; ?>">
                                                        <?php
                                                        if ($row[0]['facebook_type'] == 1) {
                                                            echo 'News Feed';
                                                        } else {
                                                            echo 'Right Side Ad';
                                                        }
                                                        ?>
                                                    </p>
                                                    <div id="fb_type<?php echo $row[0]['fb_images_id']; ?>" style="display: none;">
                                                        <div class="radio-list">

                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="fb_type" id="news_feed_bulk" <?php if ($row[0]['facebook_type'] == 1) {
                                                                        echo 'checked';
                                                                    } ?> value="1">
                                                                    <label for="news_feed_bulk">News Feed</label>
                                                                </div>
                                                            </label>

                                                            <label class="radio-inline">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="fb_type" id="right_side_bulk" <?php if ($row[0]['facebook_type'] == 2) {
                                                                        echo 'checked';
                                                                    } ?> value="2">
                                                                    <label for="right_side_bulk">Right Side Ad</label>
                                                                </div>
                                                            </label>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="width: 10%;padding: 10px 6px;">
                                                    <a style="cursor: pointer;display: none;" id="update_button<?php echo $row[0]['fb_images_id']; ?>" onclick="updateFbImages(<?php echo $row[0]['fb_images_id']; ?>)">
                                                        Update
                                                    </a>
                                                    <a onclick="editInfo(<?php echo $row[0]['fb_images_id']; ?>)" id="edit_button<?php echo $row[0]['fb_images_id']; ?>" style="cursor: pointer;display: block;">Edit</a>
                                                    <!--<a onclick="return chkDelete()" href="super_admin/deleteSubImages/">Delete</a>-->
                                                </td>

                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                            
                            <?php }?>
                                
<!--                            <tr>
                                <td style="text-align: center">  <b>Add More Sub Images:</b>  </td>
                                <td colspan="2"><input type="file" multiple name="userfile[]" class="form-control" ></td>  
                            </tr>-->
                        </table>
                    
                        <form action="admin/updateFbLogo" method="post" enctype="multipart/form-data">
                            
                            <input type="hidden" name="id" class="form-control" value="<?php echo $all_facebook[0][0]['id']; ?>">
                            
                            <div class="form-group">
                                <label for="exampleInputuname">Fan Page Name</label>
                                <input type="text" name="fan_page" class="form-control" value="<?php echo $all_facebook[0][0]['fan_page']; ?>" placeholder="Embedded Code">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Add Text</label>
                                <input type="text" name="text" class="form-control" value="<?php echo $all_facebook[0][0]['text']; ?>" placeholder="Add Text">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Headline</label>
                                <input type="text" name="headline" class="form-control" value="<?php echo $all_facebook[0][0]['headline']; ?>" placeholder="Headline">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Description</label>
                                <textarea class="form-control" name="description" style="resize: none"><?php echo $all_facebook[0][0]['description']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Fan page URL</label>
                                <input type="text" name="fan_page_url" class="form-control" value="<?php echo $all_facebook[0][0]['fan_page_url']; ?>" placeholder="Fan page URL">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Landing page URL</label>
                                <input type="text" name="landing_page_url" class="form-control" value="<?php echo $all_facebook[0][0]['landing_page_url']; ?>" placeholder="Landing page URL">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logo<span style="color:red">*</span></label>
                                <input type="file" name="logo" id="input-file-now" class="dropify" data-default-file="uploads/facebook_images/<?php echo $all_facebook[0][0]['logo']; ?>"/>
                                <input type="hidden" name="logo1" value="<?php echo $all_facebook[0][0]['logo']; ?>" id="inputEmail3">
                            </div>
                            
<!--                            <div class="form-group">
                                <label for="exampleInputuname">Facebook Type</label>
                                <div class="radio-list">

                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="bulk_fb_type" id="news_feed_bulk" value="1">
                                            <label for="news_feed_bulk">News Feed</label>
                                        </div>
                                    </label>

                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="bulk_fb_type" id="right_side_bulk" value="2">
                                            <label for="right_side_bulk">Right Side Ad</label>
                                        </div>
                                    </label>

                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputuname">Categories(For Bulk)</label>
                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_cat[]">
                                    <option value="0">Choose Categories</option>
                                    <?php foreach ($all_category as $cat) { ?>
                                        <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Countries(For Bulk)</label>
                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_country[]">
                                    <option value="0">Choose Countries</option>
                                    <?php foreach ($all_country as $country) { ?>
                                        <option value="<?php echo $country['country_id'] ?>">
                                            <?php echo $country['country_name'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Keywords(For Bulk)</label>
                                <input type="text" name="bulk_keyword[]" id="keyword_bulk" multiple class="" value="<?php echo set_value('membership_price'); ?>">
                            </div>


                            <div class="dropzone" id="myDropzone" name="file">
                                <input name="file" type="file" multiple />      
                            </div>-->
                            <!--                <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>-->



                            <div class="previews" id="preview"></div>
                            <button type="submit" class="btn btn-success">Submit</button>
                            <a href="admin/allFacebook">
                                <button type="Cancel" class="btn btn-default">Cancel</button>
                            </a>
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
    $(document).ready(function(){
    $('#keyword_bulk').select2({
    tags: true,
    tokenSeparators: [",", " "], 
    placeholder: "Add your tags here"
    
    });
    
});
    
</script>

<script>
    function editInfo(fb_images_id){
//        alert(fb_images_id);
        document.getElementById("category"+fb_images_id).style.display = "block";
        document.getElementById("country"+fb_images_id).style.display = "block";
        document.getElementById("key"+fb_images_id).style.display = "block";
        document.getElementById("update_button"+fb_images_id).style.display = "block";
        document.getElementById("fb_type"+fb_images_id).style.display = "block";
        
        document.getElementById("edit_button"+fb_images_id).style.display = "none";
        document.getElementById("country_text"+fb_images_id).style.display = "none";
        document.getElementById("cat_text"+fb_images_id).style.display = "none";
        document.getElementById("keyword_text"+fb_images_id).style.display = "none";
        document.getElementById("type_text"+fb_images_id).style.display = "none";
        
        $("#category"+fb_images_id).select2();
        $("#country"+fb_images_id).select2();
        $('#key'+fb_images_id).select2({
//            data: ["Clare","Cork","South Dublin"],
            tags: true,
            tokenSeparators: [",", " "], 
            placeholder: "Add your tags here"

        });
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

<script>
    $(document).ready(function(){
    $('#choose_usr_email').select2({
    tags: true,
    tokenSeparators: [",", " "], 
    placeholder: "Add your tags here"
    
    });
    
    
});
    
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
    function updateFbImages(fb_images_id){
        var str = $('#form_data'+fb_images_id).serialize();;
//        alert(str);
//        console.log(str);
        $.ajax({
            url: "<?php echo site_url('admin/updateFbImages'); ?>",
            type: "post",
            data: {str: str,fb_images_id: fb_images_id},
            success: function (msg) {
//                alert("" + msg);
                location.reload(true);
//                $('#quick_view_modal').html(msg);
//                $('#quick_view_modal').modal('show');
            }
        });
        
    }
</script>

<script>
    $(function() {
    Dropzone.options.myDropzone = {
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    previewsContainer: ".previews",
    paramName: "uploadfile",
    url:"admin/uploadFacebookAds",
//    method: "post",
    init: function() {
      var count = 0;
        thisDropzone = this;
        this.on("addedfile", function(file) {
              caption = file.caption == undefined ? "" : file.caption;
              file._captionLabel = Dropzone.createElement("<label for='exampleInputuname' style='width: 100%;'>Categories</label>")
              file._captionBox = Dropzone.createElement(
                      "<select id='"+file.filename+"' class='select2 m-b-10 select2-multiple' multiple='multiple' name='category["+count+"][]'>\n\
                                <option value='0'>Choose Category</option>\n\
                                <?php foreach ($all_category as $cat){?>\n\
                                <option value='<?php echo $cat['cat_id']?>'><?php echo $cat['cat_name']?></option>\n\
                                <?php }?>\n\
                       </select>");
              file.previewElement.appendChild(file._captionLabel);
              file.previewElement.appendChild(file._captionBox);
              
              select = file.select == undefined ? "" : file.select;
              file._selectLabel = Dropzone.createElement("<label for='exampleInputuname'>Countries</label>")
              file._selectBox = Dropzone.createElement(
                      "<select id='"+file.filename+"' class='select2 m-b-10 select2-multiple' multiple='multiple' name='country["+count+"][]'>\n\
                                <option value='0'>Choose Country</option>\n\
                                   <?php foreach ($all_country as $country){?>\n\
                                <option value='<?php echo $country['country_id']?>'><?php echo $country['country_name']?></option>\n\
                                   <?php }?>\n\
                       </select>");
              file.previewElement.appendChild(file._selectLabel);
              file.previewElement.appendChild(file._selectBox);
              
              keyword = file.select == undefined ? "" : file.select;
              file._keywordLabel = Dropzone.createElement("<label for='exampleInputuname'>Keyword</label>")
              file._keywordBox = Dropzone.createElement(
                      "<input type='text' name='keyword["+count+"][]' id='tags"+count+"' multiple class=''>");
              file.previewElement.appendChild(file._keywordLabel);
              file.previewElement.appendChild(file._keywordBox);
              
              fb_type = file.select == undefined ? "" : file.fb_type;
              file._fb_typeLabel = Dropzone.createElement("<label for='exampleInputuname'>Facebook Type</label>")
              file._fb_typeBox = Dropzone.createElement(
                    "<div class='radio-list'>\n\
                        <label class='radio-inline p-0'>\n\
                            <div class='radio radio-info'>\n\
                                <input type='radio' name='fb_type["+count+"]' id='news_feed"+count+"' value='1'>\n\
                                <label for='news_feed"+count+"'>News Feed</label>\n\
                            </div>\n\
                        </label>\n\
                        <label class='radio-inline'>\n\
                            <div class='radio radio-info'>\n\
                                <input type='radio' name='fb_type["+count+"]' id='right_side"+count+"' value='2'>\n\
                                <label for='right_side"+count+"'>Right Side Ad</label>\n\
                            </div>\n\
                        </label>\n\
                    </div>");
              file.previewElement.appendChild(file._fb_typeLabel);
              file.previewElement.appendChild(file._fb_typeBox);
              
              $("select").select2();
              
              $('#tags'+count).select2({
                    
                    tags: true,
                    tokenSeparators: [' '], 
                    placeholder: "Add your tags here"
                });
              count++;
              
              
        }),
 
        this.on("success", function(file, json) {
            
            var obj = json;
//            console.log(json);
//         alert(obj.width);
            $('.previews').
                    append(
                    "<input type='hidden' name='image[]' value='"+obj+"'>\n\
                     <input type='hidden' name='width[]' value='"+file.width+"'>\n\
                     <input type='hidden' name='height[]' value='"+file.height+"'>"
                    );
//                        $("select").select2();
                        
        });
        
        
    }
};
});
    
</script>