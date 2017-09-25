<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <h5 style="color: red;"><?php if (validation_errors()) {
                                                    echo validation_errors();
                                            } ?>
                    </h5>
                    <form action="landingPageAdmin/updatelandingpage/<?php echo $this->uri->segment('3');?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputuname">URL</label>
                            <input type="text" name="url" class="form-control" value="<?php echo $edit_landing_info->url; ?>" placeholder="Landing Page URL">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">File</label>
                            <input type="file" name="userfile" class="form-control">
                            <input type="hidden" name="userfile1" value="<?php echo $edit_landing_info->zip_file; ?>">
                        </div>
                        
<!--                        <div class="form-group">
                            <label for="exampleInputuname">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $edit_landing_info->title; ?>">
                        </div>-->
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Categories</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="cat_id[]">
                                <option value="0">Choose Categories</option>
                                <?php foreach($all_category as $cat){ ?>
                                <option value="<?php echo $cat['cat_id']; ?>" 
                                    <?php 
                                    $category_id = explode(',', $edit_landing_info->cat_id);
//                                    print_r($cntry_id);die;
                                    foreach ($category_id as $land_cat) {
                                    if($cat['cat_id'] == $land_cat){
                                        echo 'selected'; 
                                    }}?>><?php echo $cat['cat_name']; ?></option>
                                 <?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Countries</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="country_id[]">
                                <option value="0">Choose Countries</option>
                                <?php foreach ($all_country as $country){?>
                                <option value="<?php echo $country['country_id']?>" 
                                    <?php 
                                    $cntry_id = explode(',', $edit_landing_info->country_id);
//                                    print_r($cntry_id);die;
                                    foreach ($cntry_id as $land_country) {
                                    if ($country['country_id'] == $land_country) {
                                        echo "selected";
                                    }} ?>
                                ><?php echo $country['country_name']?></option>
                                <?php }?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Keywords</label>
                            <input type="text" name="keyword[]" id="landpagekeyword" class="" 
                                   value="<?php $keyword = explode(',', $edit_landing_info->keyword);
                                    foreach ($all_keyword as $all_key) {
                                       foreach ($keyword as $key) {
//                                        print_r($key);
                                           if ($all_key['id'] == $key) {
                                               echo $all_key['keyword_tags'] . ',';
                                           }
                                       }
                                   }
                                   //echo $edit_landing_info->keyword_tags; ?>" 
                                   >
                        </div>
                        
                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function () {
            $('#landpagekeyword').select2({
                tags: true,
                tokenSeparators: [",", " "],
                placeholder: "Add your tags here"

            });
    });
    
</script>