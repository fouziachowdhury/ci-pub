<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <!--                    <h5 style="color: red;"><?php
                    if (validation_errors()) {
                        echo validation_errors();
                    }
                    ?>
                                        </h5>-->
                    <form action="admin/saveFacebookAds" method="post" enctype="multipart/form-data">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Type<span style="color:red">*</span></label>
                                <div class="radio-list">

                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="type" id="radio1" value="1" onclick="showDiv(this)">
                                            <label for="radio1">Embedded Code</label>
                                        </div>
                                    </label>

                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="type" id="radio2" value="2" onclick="showDiv(this)">
                                            <label for="radio2">Manually Entry</label>
                                        </div>
                                    </label>

                                </div>
                            </div>
                        </div>


                        <div id="code" style="display: none;">
                            <div class="form-group">
                                <label for="exampleInputuname">Embedded Code<span style="color:red">*</span></label>
                                <textarea class="form-control" name="embedded_code" style="resize: none"><?php echo set_value('address'); ?></textarea>
                            </div>
                        </div>


                        <div id="manual" style="display: none;">
                            <div class="form-group">
                                <label for="exampleInputuname">Fan Page Name</label>
                                <input type="text" name="fan_page" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Embedded Code">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Add Text</label>
                                <input type="text" name="text" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Add Text">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Headline</label>
                                <input type="text" name="headline" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Headline">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Description</label>
                                <textarea class="form-control" name="description" style="resize: none"><?php echo set_value('address'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Fan page URL</label>
                                <input type="text" name="fan_page_url" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Fan page URL">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Landing page URL</label>
                                <input type="text" name="landing_page_url" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Landing page URL">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logo<span style="color:red">*</span></label>
                                <input type="file" name="logo" id="input-file-now" class="dropify"/>
                            </div>
                            
                            <div class="form-group">
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

                            <div class="dropzone" id="myDropzone">
                                
                            </div>
                            <div class="previews" id="preview"></div>
                            
                            
                        </div>


                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <!--<button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>-->
                    </form>
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


    function showDiv(val) {
        var type = val.value;
//        alert(type);
        if (type == 1) {
            document.getElementById('code').style.display = "block";
            document.getElementById('manual').style.display = "none";
        }
        if (type == 2) {
            document.getElementById('manual').style.display = "block";
            document.getElementById('code').style.display = "none";
        }
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
