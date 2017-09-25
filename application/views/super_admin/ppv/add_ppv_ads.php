<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h5 style="color: red;">
                        <?php
                        if (validation_errors()) {
                            echo validation_errors();
                        }
                        ?>
                    </h5>
                    <!-------------MODEL START -------------->
                    <div id="checkurlModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">URL Check</h4>
                                </div>
                                <div class="modal-body">
                                    <p> This <a href="" id="set_url" target="blank"> </a> URL is already in our system. Do you want to continue</p>
                                    <!--<p> This URL is already in our system. Do you want to continue</p>-->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btncancle" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="button"  data-dismiss="modal" class="btn btn-primary">Continue</button>
                                    <!--<button type="button" id="btnsavelandingpage" class="btn btn-primary">Save changes</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------------MODEL END -------------->
                    <form action="admin/savePpvAds" method="post" enctype="multipart/form-data" id="landinfpageform">
                        <div class="form-group">
                            <label for="exampleInputuname">URL</label>
                            <textarea class="form-control" onkeyup="checkUrl(this.value)" name="url" style="resize: none;"><?php echo set_value('url'); ?></textarea>
                            <!--<input type="text" id="landpageurl" name="url" class="form-control" placeholder="Landing Page URL" value="<?php echo set_value('url'); ?>">-->
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">File</label>
                            <input type="file" name="userfile" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Categories</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="cat_id[]">
                                <option value="0">Choose Categories</option>
                                <?php foreach ($all_category as $category) { ?>
                                    <option value="<?php echo $category['cat_id']; ?>" <?php echo set_select('cat_id', $category['cat_id'], (!empty($this->input->post('cat_id')) && $this->input->post('cat_id') == $category['cat_id'] ? TRUE : FALSE)); ?>><?php echo $category['cat_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Countries</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="country_id[]">
                                <option value="0">Choose Countries</option>
                                <?php foreach ($all_country as $country) { ?>
                                    <option value="<?php echo $country['country_id'] ?>" <?php echo set_select('country_id', $country['country_id'], (!empty($this->input->post('country_id')) && $this->input->post('country_id') == $country['country_id'] ? TRUE : FALSE)); ?>><?php echo $country['country_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Keywords(For Bulk)</label>
                            <input type="text" name="keyword[]" id="landpagekeyword" multiple class="" value="">
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
    function checkUrl(val){
//        alert(val);
        var table = 'ppv';
        $.ajax({
            url: "<?php echo site_url('admin/check_url'); ?>",
            type: "post",
            data: {url: val,table: table},
            success: function (msg) {
//                alert("" + msg);
                if(msg == 0){
                    console.log(msg);
                }
                else{
                    $('#checkurlModal').modal('show');
                    document.getElementById('set_url').innerHTML = msg;
                    document.getElementById("set_url").href = msg;
//                    $('#set_url').val(msg);
                }
                
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
       <?php if(isset($checkurl)){  ?>
        var check = '<?php echo $checkurl; ?>';
//        alert(check);
        if (check == 1) {
//            alert(55555);
            $('#checkurlModal').modal('show');
        }
   <?php } ?>
    });
    $('#btncancle').click(function () {
        window.location.href = "<?php echo base_url() ?>admin/allPpvAds";
    });

    $('#btnsavelandingpage').click(function () {
        var formdata = $('#landinfpageform').serialize();
//        alert(formdata);
        console.log(formdata);
        $.ajax({
            type: 'POST',
            data: $('#landinfpageform').serialize(),
            url: '<?php echo base_url() ?>admin/addPpvAds',
            success: function (data) {
                alert(data)
                var result = JSON.parse(data);
                console.log(result);
                console.log(result.success);
                if (result.success == 1) {
                    window.location.href = "<?php echo base_url() ?>admin/allPpvAds";
                }
            }
        });
    });


    $(document).ready(function () {
            $('#landpagekeyword').select2({
                tags: true,
                tokenSeparators: [",", " "],
                placeholder: "Add your tags here"

            });
    });

</script>

