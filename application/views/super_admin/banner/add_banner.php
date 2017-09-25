<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <!--<h3>Banner Ads Upload</h3>-->
            <form action="admin/saveBannerAds" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="exampleInputuname">Categories(For Bulk)</label>
                    <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_cat[]">
                        <option value="0">Choose Categories</option>
                        <?php foreach ($all_category as $cat){?>
                        <option value="<?php echo $cat['cat_id']?>"><?php echo $cat['cat_name']?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputuname">Countries(For Bulk)</label>
                    <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_country[]">
                        <option value="0">Choose Countries</option>
                        <?php foreach ($all_country as $country) { ?>
                            <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                        <?php } ?>
                    </select>
                    
                </div>

                <div class="form-group">
                    <label for="exampleInputuname">Keywords(For Bulk)</label>
                    <input type="text" name="bulk_keyword[]" id="choose_usr_email" multiple class="" value="<?php echo set_value('membership_price'); ?>">
                </div>
                
                
                <div class="dropzone" id="myDropzone" name="file">
                    <!--<input name="file" type="file" multiple />-->      
                </div>
<!--                <div class="fallback">
                    <input name="file" type="file" multiple />
                </div>-->

                
                
                <div class="previews" id="preview"></div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
            
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
    $('#choose_usr_email').select2({
    tags: true,
    tokenSeparators: [",", " "], 
    placeholder: "Add your tags here"
    
    });
    
});
    
</script>
<script>
    $(function() {
    Dropzone.options.myDropzone = {
    acceptedFiles: "image/*",
    addRemoveLinks: true,
    previewsContainer: ".previews",
    url:"admin/uploadBannerAds",
    paramName: "uploadfile",
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
            // console.log(json);
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