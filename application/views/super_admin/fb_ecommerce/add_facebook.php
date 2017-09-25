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
                    <form action="admin/saveFbEcomAds" method="post" enctype="multipart/form-data">

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
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Embedded Code<span style="color:red">*</span></label>
                            <textarea class="form-control" name="embedded_code" style="resize: none"><?php echo set_value('address'); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Landing page URL</label>
                            <input type="text" name="landing_page_url" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Landing page URL">
                        </div>

<!--                        <div class="dropzone" id="myDropzone">

                        </div>
                        <div class="previews" id="preview"></div>-->
                            
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