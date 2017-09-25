<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <!--<h3 class="box-title m-b-0">Add Native Ads </h3>-->
            <!--<p class="text-muted m-b-30"> For multiple file upload</p>-->
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
                    <input type="text" name="bulk_keyword[]" id="bulk_keyword" multiple class="" value="<?php echo set_value('membership_price'); ?>">
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
    $('#bulk_keyword').select2({
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
    url:"admin/uploadNativeAds",
    paramName: "uploadfile",
//    method: "post",
  init: function() {
      var count = 0;
        thisDropzone = this;
        this.on("addedfile", function(file) {
              caption = file.caption == undefined ? "" : file.caption;
              file._captionLabel = Dropzone.createElement("<label for='exampleInputuname' style='width: 100%;'>Categories</label>")
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
//                    alert(msg);
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