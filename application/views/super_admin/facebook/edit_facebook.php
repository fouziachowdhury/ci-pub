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
                                            <input type="radio" name="type" id="radio1" value="1" <?php echo set_radio('type', '1'); ?> onclick="showDiv()">
                                            <label for="radio1">Embedded Code</label>
                                        </div>
                                    </label>

                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="type" id="radio2" checked="" value="2" <?php echo set_radio('type', '2'); ?> onclick="showDiv()">
                                            <label for="radio2">Manually Entry</label>
                                        </div>
                                    </label>

                                </div>
                            </div>
                        </div>


                        <div id="code" style="display: none;">
                            <div class="form-group">
                                <label for="exampleInputuname">Embedded Code<span style="color:red">*</span></label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Embedded Code">
                            </div>
                        </div>


                        <div id="manual" style="display: none;">
                            <div class="form-group">
                                <label for="exampleInputuname">Fan Page Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Embedded Code">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Add Text</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Add Text">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Headline</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Headline">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Description</label>
                                <textarea class="form-control" name="address" style="resize: none"><?php echo set_value('address'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Fan page URL</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Fan page URL">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputuname">Landing page URL</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>" placeholder="Landing page URL">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Logo<span style="color:red">*</span></label>
                                <input type="file" name="slider_image" value="<?php echo set_value('slider_image'); ?>" id="input-file-now" class="dropify"/>
                            </div>

                        </div>


                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                        <!--<button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="col-sm-12 ol-md-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">File Upload1</h3>
                <label for="input-file-now">Image</label>
                
            </div>
        </div>-->




</div>


<script>

$(document).ready(function (){
    showDiv();
});
    function showDiv() {
        var type = $("input[name='type']:checked").val();
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




