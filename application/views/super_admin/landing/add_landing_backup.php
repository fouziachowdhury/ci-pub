<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h5 style="color: red;">
                        <?php if (validation_errors()) {
                               echo validation_errors();
                             } ?>
                    </h5>
                    <form action="landingPageAdmin/insertlandingpage" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputuname">URL</label>
                            <input type="text" name="url" class="form-control" value="" placeholder="Landing Page URL">
                        </div> 
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Categories</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="cat_id">
                                <option value="0">Choose Categories</option>
                                <?php foreach($all_category as $category){ ?>
                                <option value="<?php echo $category['cat_id']; ?>"><?php echo $category['cat_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Countries</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="country_id">
                                <option value="0">Choose Countries</option>
                                <?php foreach ($all_country as $country){?>
                                <option value="<?php echo $country['country_id']?>"><?php echo $country['country_name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Keywords</label>
                            <input type="text" name="keyword" class="form-control" value="<?php echo set_value('keyword'); ?>" placeholder="Keywords">
                        </div>
                        <div class="previews" id="preview"></div>
                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>


<script>
    $(function() {
    Dropzone.options.myDropzone = {
    acceptedFiles: "image/*",
    addRemoveLinks: true,
//    previewsContainer: ".previews",
    url:"admin/saveBannerAds",
//    method: "post",
    init: function() {
      
    }
};
});
    
</script>