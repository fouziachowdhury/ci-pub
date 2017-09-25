<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                  <h5 style="color: red;"><?php if (validation_errors()) {
                                                    echo validation_errors();
                                            } ?>
                    </h5>
                    <form action="admin/updatelandingpage/<?php echo $this->uri->segment('3');?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputuname">URL</label>
                            <input type="text" name="url" class="form-control" value="<?php echo $edit_landing_info[0]['url']; ?>" placeholder="Landing Page URL">
                        </div>
                        
                        <!--<div class="form-group">-->
                        <!--    <label for="exampleInputuname">Title</label>-->
                        <!--    <input type="text" name="title" class="form-control" value="<?php echo $edit_landing_info[0]['title']; ?>">-->
                        <!--</div>-->
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Categories</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="cat_id[]">
                                <option value="0">Choose Categories</option>
                                <?php foreach ($all_category as $all_cat) { ?>
                                    <option value="<?php echo $all_cat['cat_id']; ?>" 
                                    <?php
                                    $category = explode(',', $edit_landing_info[0]['cat_id']);
                                    foreach ($category as $cat) {
                                        if ($all_cat['cat_id'] == $cat) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $all_cat['cat_name']; ?></option>
<?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Countries</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="country_id[]">
                                <option value="0">Choose Country</option>
                                <?php foreach ($all_country as $all_count) { ?>
                                    <option value="<?php echo $all_count['country_id']; ?>" 
                                    <?php
                                    $country = explode(',', $edit_landing_info[0]['country_id']);
                                    foreach ($country as $count) {
                                        if ($all_count['country_id'] == $count) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $all_count['country_name']; ?></option>
<?php } ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Keywords</label>
                            <input type="text" name="keyword[]" multiple class="" id="landpagekeyword"
                                               value="<?php
                                                $keyword = explode(',', $edit_landing_info[0]['keyword']);
                                                foreach ($all_keyword as $all_key) {
                                                    foreach ($keyword as $key) {
                                                        if ($all_key['id'] == $key) {
                                                            echo $all_key['keyword_tags'] . ',';
                                                        }
                                                    }
                                                }
                                            ?>">                        
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