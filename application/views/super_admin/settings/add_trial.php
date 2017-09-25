<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
<!--                    <h5 style="color: red;"><?php if (validation_errors()) {
                                                    echo validation_errors();
                                            } ?>
                    </h5>-->
                    <form action="admin/saveTrialSettings" method="post" enctype="multipart/form-data">
                        <h4 class="page-title">Set Trial for Different Pages</h4>
                        <div class="form-group col-xs-12">
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="1">
                                    <input type="hidden" id="option0" value="<?php echo $all_info[0]['is_active']?>">
                                    <input type="checkbox" id="opt0" name="is_active[0]" <?php if($all_info[0]['is_active'] == 1){echo 'checked';}?> value="1" >
                                    <label for="opt0">Banner Ads</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="2">
                                    <input type="hidden" id="option1" value="<?php echo $all_info[1]['is_active']?>">
                                    <input type="checkbox" name="is_active[1]" id="opt1" value="1" <?php if($all_info[1]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt1">Native Ads</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="3">
                                    <input type="hidden" id="option2" value="<?php echo $all_info[2]['is_active']?>">
                                    <input type="checkbox" name="is_active[2]" id="opt2" value="1" <?php if($all_info[2]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt2">Facebook Ads</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="4">
                                    <input type="hidden" id="option3" value="<?php echo $all_info[3]['is_active']?>">
                                    <input type="checkbox" name="is_active[3]" id="opt3" value="1" <?php if($all_info[3]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt3">Facebook E-commerce Ads</label>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="5">
                                    <input type="hidden" id="option4" value="<?php echo $all_info[4]['is_active']?>">
                                    <input type="checkbox" name="is_active[4]" id="opt4" value="1" <?php if($all_info[4]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt4">PPV Ads</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="13">
                                    <input type="hidden" id="option5" value="<?php echo $all_info[5]['is_active']?>">
                                    <input type="checkbox" name="is_active[5]" id="opt5" value="1" <?php if($all_info[5]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt5">Landing Pages</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="6">
                                    <input type="hidden" id="option6" value="<?php echo $all_info[6]['is_active']?>">
                                    <input type="checkbox" name="is_active[6]" id="opt6" value="1" <?php if($all_info[6]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt6">Affiliate Landing Page Feed</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="7">
                                    <input type="hidden" id="option7" value="<?php echo $all_info[7]['is_active']?>">
                                    <input type="checkbox" name="is_active[7]" id="opt7" value="1" <?php if($all_info[7]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt7">Advertise Offer Feed</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="16">
                                    <input type="hidden" id="option8" value="<?php echo $all_info[8]['is_active']?>">
                                    <input type="checkbox" name="is_active[8]" id="opt8" value="1" <?php if($all_info[8]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt8">Network</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="14">
                                    <input type="hidden" id="option9" value="<?php echo $all_info[9]['is_active']?>">
                                    <input type="checkbox" name="is_active[9]" id="opt9" value="1" <?php if($all_info[9]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt9">Whois</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="option_id[]" value="15">
                                    <input type="hidden" id="option10" value="<?php echo $all_info[10]['is_active']?>">
                                    <input type="checkbox" name="is_active[10]" id="opt10" value="1" <?php if($all_info[10]['is_active'] == 1){echo 'checked';}?>>
                                    <label for="opt10">Affiliate</label>
                                </div>
                            </div>
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

<script>
    $(document).ready(function (){
        for(i = 0; i < 11; i++){
//            alert($('#option'+i).val());
            if($('#option'+i).val() == 1){
                $("#opt"+i).prop("checked", true);
            }
//            if($('#trl'+i).val() == 1){
//                $("#trial"+i).prop("checked", true);
//            }
        }

    });

</script>