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
                                <td style="width: 25%;">Categories</td>
                                <td style="width: 25%;">Countries</td>
                                <td style="width: 30%;">Keywords</td>
                                <td style="width: 10%;">Action</td>
                            </tr>
                            <?php foreach ($banner as $row){?>
                            <tr>
                                <td colspan="5" style="padding: 0px;">
                                    <form action="" id="form_data<?php echo $row[0]['banner_id'];?>">
                                        <table class="table table-bordered" style="padding: 0px;">
                                            <tr style="text-align: center" id="row_data<?php echo $row[0]['banner_id']; ?>">

                                                    <td style="width: 10%;padding: 10px 6px;">
                                                        <img src="uploads/banner_images/<?php echo $row[0]['image'] ?>" style="width:100%; height: 50px;" alt="images">
                                                    </td>
                                                    <td style="width: 25%;padding: 10px 6px;">
                                                        <p style="display: block;" id="cat_text<?php echo $row[0]['banner_id']; ?>">
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
                                                        <select class="select2 m-b-10 select2-multiple" id="category<?php echo $row[0]['banner_id']; ?>" multiple="multiple" name="category[]" style="display: none;">
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
                                                    <td style="width: 25%;padding: 10px 6px;">
                                                        <p style="display: block;" id="country_text<?php echo $row[0]['banner_id']; ?>">
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
                                                        <select class="select2 m-b-10 select2-multiple" id="country<?php echo $row[0]['banner_id']; ?>" multiple="multiple" name="country[]" style="display: none;">
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
                                                    <td style="width: 30%;padding: 10px 6px;">
                                                        <p style="display: block;" id="keyword_text<?php echo $row[0]['banner_id']; ?>">
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
                                                        <input type="text" name="keyword" id="key<?php echo $row[0]['banner_id']; ?>" multiple class="" style="display: none;"
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
                                                        <a style="cursor: pointer;display: none;" id="update_button<?php echo $row[0]['banner_id']; ?>" onclick="updateBanner(<?php echo $row[0]['banner_id']; ?>)">
                                                            Update
                                                        </a>
                                                        <a onclick="editInfo(<?php echo $row[0]['banner_id']; ?>)" id="edit_button<?php echo $row[0]['banner_id']; ?>" style="cursor: pointer;display: block;">Edit</a>
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
                    
                        <form action="admin/saveBannerAds" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="exampleInputuname">Categories(For Bulk)</label>
                                <select class="select2 m-b-10 select2-multiple" id="bulk_category" multiple="multiple" name="bulk_cat[]">
                                    <option value="0">Choose Categories</option>
                                    <?php foreach ($all_category as $cat) { ?>
                                        <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Countries(For Bulk)</label>
                                <select class="select2 m-b-10 select2-multiple" id="bulk_country" multiple="multiple" name="bulk_country[]">
                                    <option value="0">Choose Countries</option>
                                    <?php foreach ($all_country as $country) { ?>
                                        <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Keywords(For Bulk)</label>
            <!--                    <select multiple="" name="choose_usr_email[]" id="choose_usr_email" class=" select2">
                                    <option value="Something">Something</option>
                                    <option value="Anything">Anything</option>
                                    <option value="Helo World">Helo World</option>
                                </select>-->
                                <input type="text" name="bulk_keyword[]" id="choose_usr_email" multiple class="" value="<?php echo set_value('membership_price'); ?>" placeholder="Keywords">
                            </div>


                            <div class="dropzone" id="myDropzone" name="file">
                                <!--<input name="file" type="file" multiple />-->      
                            </div>
                            <!--                <div class="fallback">
                                                <input name="file" type="file" multiple />
                                            </div>-->



                            <div class="previews" id="preview"></div>
                            <button type="submit" class="btn btn-success">Edit</button>
                            <a href="admin/allBanner">
                                <button type="Cancel" class="btn btn-default">Cancel</button>
                            </a>
                        </form>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function editInfo(banner_id){
//        alert(banner_id);
        document.getElementById("category"+banner_id).style.display = "block";
        document.getElementById("country"+banner_id).style.display = "block";
        document.getElementById("key"+banner_id).style.display = "block";
        document.getElementById("update_button"+banner_id).style.display = "block";
        
        document.getElementById("edit_button"+banner_id).style.display = "none";
        document.getElementById("country_text"+banner_id).style.display = "none";
        document.getElementById("cat_text"+banner_id).style.display = "none";
        document.getElementById("keyword_text"+banner_id).style.display = "none";
        
        $("#category"+banner_id).select2();
        $("#country"+banner_id).select2();
        $('#key'+banner_id).select2({
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
    function updateBanner(banner_id){
        var str = $('#form_data'+banner_id).serialize();;
//        alert(str);
//        console.log(str);
        $.ajax({
            url: "<?php echo site_url('admin/updateBanner'); ?>",
            type: "post",
            data: {str: str,banner_id: banner_id},
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
    url:"admin/uploadBannerAds",
//    method: "post",
    init: function() {
      var count = 0;
        thisDropzone = this;
        this.on("addedfile", function(file) {
              caption = file.caption == undefined ? "" : file.caption;
              file._captionLabel = Dropzone.createElement("<label for='exampleInputuname'>Categories</label>")
              file._captionBox = Dropzone.createElement(
                      "<select id='category"+count+"' class='select2 m-b-10 select2-multiple category' multiple='multiple' name='category["+count+"][]'>\n\
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
                      "<select id='country"+count+"' class='select2 m-b-10 select2-multiple country' multiple='multiple' name='country["+count+"][]'>\n\
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
              $("#category"+count).select2();
              $("#country"+count).select2();
//              $("select").select2();
              
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