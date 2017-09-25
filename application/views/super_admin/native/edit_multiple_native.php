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
                                <td style="width: 20%;">Headline</td>
                                <td style="width: 20%;">Keywords</td>
                                <td style="width: 10%;">Action</td>
                            </tr>
                            <?php foreach ($native as $row){?>
                            <tr>
                                <td colspan="6" style="padding: 0px;">
                                    <form action="" id="form_data<?php echo $row[0]['native_id'];?>">
                                        <table class="table table-bordered" style="padding: 0px;">
                                            <tr style="text-align: center" id="row_data<?php echo $row[0]['native_id'];?>">

                                    <td style="width: 10%;padding: 10px 6px;">
                                        <img src="uploads/native_images/<?php echo $row[0]['image']?>" style="width:100%; height: 50px;" alt="images">
                                    </td>
                                    <td style="width: 20%;padding: 10px 6px;">
                                        <p style="display: block;" id="cat_text<?php echo $row[0]['native_id'];?>">
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
                                        <select class="select2 m-b-10 select2-multiple" id="category<?php echo $row[0]['native_id'];?>" multiple="multiple"
                                                onchange="getEditInfo('<?php echo $row[0]['native_id'];?>')" name="category[]" style="display: none;">
                                            <option value="0">Choose Categories</option>
                                            <?php foreach ($all_category as $all_cat) {?>
                                                <option value="<?php echo $all_cat['cat_id'];?>" 
                                                        <?php foreach ($category as $cat) {
                                                            if ($all_cat['cat_id'] == $cat) {
                                                            echo 'selected';
                                                        }}?>><?php echo $all_cat['cat_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                    <td style="width: 20%;padding: 10px 6px;">
                                        <p style="display: block;" id="country_text<?php echo $row[0]['native_id'];?>">
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
                                        <select class="select2 m-b-10 select2-multiple" id="country<?php echo $row[0]['native_id'];?>" 
                                                onchange="getEditInfo('<?php echo $row[0]['native_id'];?>')" multiple="multiple" name="country[]" style="display: none;">
                                            <option value="0">Choose Country</option>
                                            <?php foreach ($all_country as $all_count) {?>
                                                <option value="<?php echo $all_count['country_id'];?>" 
                                                        <?php $country = explode(',', $row[0]['country_id']);
                                                        foreach ($country as $count) {
                                                            if ($all_count['country_id'] == $count) {
                                                            echo 'selected';
                                                        }}?>><?php echo $all_count['country_name'];?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                    <td style="width: 20%;padding: 10px 6px;">
                                        <p style="display: block;" id="headline_text<?php echo $row[0]['native_id'];?>">
                                                <?php
                                                $headline = explode(',', $row[0]['headline']);
//                                    print_r($category);
                                                foreach ($headline as $head) {
                                                    foreach ($all_headline as $heading) {
                                                        if ($heading['headline_id'] == $head) {
                                                            echo $heading['headline'] . '<br>';
                                                        }
                                                    }
                                                }
                                                ?>
                                        </p>
                                        <select class="select2 m-b-10 select2-multiple" id="headline<?php echo $row[0]['native_id'];?>" multiple="multiple"
                                                name="headline[]" style="display: none;">
                                            
                                        </select>
                                    </td>
                                    
                                    <td style="width: 20%;padding: 10px 6px;">
                                        <p style="display: block;" id="keyword_text<?php echo $row[0]['native_id']; ?>">
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
                                        <input type="text" name="keyword" id="key<?php echo $row[0]['native_id'];?>" multiple class="" style="display: none;"
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
                                    
                                    <td style="width: 10%;padding: 10px 6px;">
                                        <a style="cursor: pointer;display: none;" id="update_button<?php echo $row[0]['native_id'];?>" onclick="updatenative(<?php echo $row[0]['native_id'];?>)">
                                            Update
                                        </a>
                                        <a onclick="editInfo(<?php echo $row[0]['native_id'];?>)" id="edit_button<?php echo $row[0]['native_id'];?>" style="cursor: pointer;display: block;">Edit</a>
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
                    
                        <form action="admin/saveNativeAds" method="post" enctype="multipart/form-data">
                
                <div class="form-group" id="">
                    <label for="exampleInputuname">Categories(For Bulk)</label>
                    <select class="select2 m-b-10" multiple="multiple" name="bulk_cat[]" id="bulk_category" onchange="bulkCategory()">
                        <option value="0">Choose Category</option>
                        <?php foreach ($all_category as $cat) { ?>
                            <option value="<?php echo $cat['cat_id']; ?>"><?php echo $cat['cat_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputuname">Countries(For Bulk)</label>
                    <select class="select2 m-b-10" multiple="multiple" name="bulk_country[]" id="bulk_country" onchange="bulkCountry()">
                        <option value="0">Choose Countries</option>
                        <?php foreach ($all_country as $country) { ?>
                            <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                        <?php } ?>
                    </select>
                    
                </div>
                
                <div class="form-group" id="">
                    <label for="exampleInputuname">Headline(For Bulk)</label>
                    <select class="select2 m-b-10" multiple="multiple" id="headline" name="bulk_headline[]">
                        
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputuname">Keywords(For Bulk)</label>
                    <input type="text" name="bulk_keyword[]" id="bulk_keyword" multiple class="">
                </div>
                
                <div class="dropzone" id="myDropzone" name="file">
                    <!--<input name="file" type="file" multiple />-->      
                </div>
<!--                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>-->
                
                <div class="previews" id="preview"></div>
                
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="admin/allBanner">
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
        $('#bulk_keyword').select2({
        tags: true,
        tokenSeparators: [",", " "], 
        placeholder: "Add your tags here"

        });
    });
</script>
    

<script>
    function editInfo(native_id){
//        alert(native_id);
        document.getElementById("category"+native_id).style.display = "block";
        document.getElementById("country"+native_id).style.display = "block";
        document.getElementById("key"+native_id).style.display = "block";
        document.getElementById("headline"+native_id).style.display = "block";
        document.getElementById("update_button"+native_id).style.display = "block";
        
        document.getElementById("edit_button"+native_id).style.display = "none";
        document.getElementById("country_text"+native_id).style.display = "none";
        document.getElementById("cat_text"+native_id).style.display = "none";
        document.getElementById("keyword_text"+native_id).style.display = "none";
        document.getElementById("headline_text"+native_id).style.display = "none";
        
        $("#category"+native_id).select2();
        $("#country"+native_id).select2();
        $("#headline"+native_id).select2();
        $('#key'+native_id).select2({
            tags: true,
            tokenSeparators: [",", " "], 
            placeholder: "Add your tags here"
        });
        
        var country_id = $('#form_data'+native_id).serialize();
        $.ajax({
            url: "<?php echo site_url('admin/get_headline'); ?>",
            type: "post",
            data: {country_id: country_id},
            success: function (msg) {
//                alert("" + msg);
                $('#headline'+native_id).html(msg);
//                $("#headline"+native_id).select2();
            }
        });
//        alert(country_id);
    }
    
    function getEditInfo(native_id){
//        alert(native_id);
        var country_id = $('#form_data'+native_id).serialize();
        $.ajax({
            url: "<?php echo site_url('admin/get_headline'); ?>",
            type: "post",
            data: {country_id: country_id},
            success: function (msg) {
//                alert("" + msg);
                $('#headline'+native_id).html(msg);
//                $("#headline"+native_id).select2();
            }
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
    function updatenative(native_id){
        var str = $('#form_data'+native_id).serialize();
//        alert(str);
//        console.log(str);
        $.ajax({
            url: "<?php echo site_url('admin/updateNative'); ?>",
            type: "post",
            data: {str: str,native_id: native_id},
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
    url:"admin/uploadNativeAds",
    paramName: "uploadfile",
//    method: "post",
  init: function() {
      var count = 0;
        thisDropzone = this;
        this.on("addedfile", function(file) {
              caption = file.caption == undefined ? "" : file.caption;
              file._captionLabel = Dropzone.createElement("<label for='exampleInputuname'>Categories</label>")
              file._captionBox = Dropzone.createElement(
                      "<select id='catgory"+count+"' class='select2 m-b-10 select2-multiple' multiple='multiple' name='category["+count+"][]' onchange='getCategory("+count+")'>\n\
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
                      "<select id='country"+count+"' class='select2 m-b-10 country' multiple='multiple' name='country["+count+"][]' onchange='getCategory("+count+")'>\n\
                                <option value='0'>Choose Country</option>\n\
                                   <?php foreach ($all_country as $country){?>\n\
                                <option value='<?php echo $country['country_id']?>'><?php echo $country['country_name']?></option>\n\
                                   <?php }?>\n\
                        </select>");
              file.previewElement.appendChild(file._selectLabel);
              file.previewElement.appendChild(file._selectBox);
              
              headline = file.headline == undefined ? "" : file.headline;
              file._headlineLabel = Dropzone.createElement("<label for='exampleInputuname'>Headline</label>")
              file._headlineBox = Dropzone.createElement(
                      "<select id='heading"+count+"' class='headline' multiple='multiple' name='headline["+count+"][]'>\n\
                        </select>");
              file.previewElement.appendChild(file._headlineLabel);
              file.previewElement.appendChild(file._headlineBox);
              
              keyword = file.select == undefined ? "" : file.select;
              file._keywordLabel = Dropzone.createElement("<label for='exampleInputuname'>Keyword</label>")
              file._keywordBox = Dropzone.createElement(
                      "<input type='text' name='keyword["+count+"][]' id='tags"+count+"' multiple class=''>");
              file.previewElement.appendChild(file._keywordLabel);
              file.previewElement.appendChild(file._keywordBox);
              $("select").select2();
              
              $('#tags'+count).select2({
                    
                    tags: true,
                    tokenSeparators: [",", " "], 
                    placeholder: "Add your tags here"
                });
                
                count++;
        }),
        
        this.on("success", function(file, json) {
            
            var obj = json;
//            console.log(json);
//         alert(obj);
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

<script>
    
    function getCategory(count){
        var cat_id = $("#catgory"+count).val();
        var country = $("#country"+count).val();
//        console.log(cat_id);
//        alert(cat_id);
        $.ajax({
            url: "admin/select_headline",
            type: "post",
            data: {cat_id:cat_id,country_id:country},
            success: function(msg) {
//                            alert(msg);
                $('#heading'+count).html(msg);
                $("select").select2();
            }
        });
//        $("#headline").show();
    }
</script>


<script>
    
    function bulkCategory(){
        var cat = $("#bulk_category").val();
        var country = $("#bulk_country").val();
//        alert(cat);
        $.ajax({
            url: "admin/select_headline",
            type: "post",
            data: {cat_id:cat,country_id:country},
            success: function(msg) {
//                            alert(msg);
                $('#headline').html(msg);
            }

        });
    }
    
    function bulkCountry(){
        var cat = $("#bulk_category").val();
        var country = $("#bulk_country").val();
        $.ajax({
            url: "admin/select_headline",
            type: "post",
            data: {cat_id:cat,country_id:country},
            success: function(msg) {
//                            alert(msg);
                $('#headline').html(msg);
            }

        });
    }
    
</script>