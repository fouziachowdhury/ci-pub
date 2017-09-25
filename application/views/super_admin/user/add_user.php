<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
<!--                    <h5 style="color: red;"><?php if (validation_errors()) {
                                                    echo validation_errors();
                                            } ?>
                    </h5>-->
                    <form action="admin/save_user" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo set_value('first_name'); ?>" placeholder="Member Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">Email</label>
                                <input type="text" name="email" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Email Address" onkeyup="chkEmail(this);chkValidEmail(this);">
                                <span id="chk_email_msg" style="display: none;color: red;">This Email Exist</span>
                                <span id="valid_email_msg" style="display: none;color: red;">Please use only letters (a-z), numbers, and periods.</span>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">Address 1</label>
                                <input type="text" name="address1" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="Address 1">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">Address 2</label>
                                <input type="text" name="address2" class="form-control" value="<?php echo set_value('mobile'); ?>" placeholder="Address 2">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">State</label>
                                <input type="text" name="state" class="form-control" value="<?php echo set_value('email'); ?>" placeholder="State">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo set_value('mobile'); ?>" placeholder="City">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">Country</label>
                                <select class="form-control select2" name="country_id" onchange="showMyModel(this.value)">
                                    <option value="0">Choose Category</option>
                                    <?php foreach ($all_country as $country) { ?>
                                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputuname">Zip</label>
                                <input type="text" name="zip" class="form-control" value="<?php echo set_value('mobile'); ?>" placeholder="Zip Code" onkeyup="chkValidMobile(this)">
                                <span id="valid_mobile_msg" style="display: none;color: red;">This Input Field Contain Only Numbers</span>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Packages</label>
                                <div class="checkbox checkbox-success">
                                    <input type="checkbox" name="package[]" id="affiliate_package" onclick="showDiv()" value="1">
                                    <label for="affiliate_package">Affiliate</label>
                                </div>
                            </div>
                            <div class="col-md-12" id="affiliate" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label">Affiliate Packages</label>
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="affiliate_package" id="freeAffiliate" value="1">
                                                <label for="freeAffiliate">Free Affiliate</label>
                                            </div>
                                        </label>
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="affiliate_package" id="superAffiliate" value="2">
                                                <label for="superAffiliate">Super Affiliate</label>
                                            </div>
                                        </label>
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="affiliate_package" id="customAffiliate" value="3">
                                                <label for="customAffiliate">Custom Package</label>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12" id="custom_affiliate" style="display: none;">
                                    <div class="form-group">
                                        <input type="hidden" id="trusted_status" value="">
                                        <label class="control-label col-md-12">Affiliate Custom Packages</label>
                                        <?php foreach ($affiliate_package as $affiliate){?>
                                        <div class="col-sm-4">
                                            <div class="checkbox checkbox-success">
                                                <input type="hidden" name="option_price[]" value="<?php echo $affiliate['option_price']?>">
                                                <input type="checkbox" name="option_id[]" id="<?php echo $affiliate['option_id']?>" onclick="showFacDiv(this)" value="<?php echo $affiliate['option_id']?>">
                                                <label for="<?php echo $affiliate['option_id']?>"><?php echo $affiliate['option_name'] . ' - ' . '$'.$affiliate['option_price']?></label>
                                            </div>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input type="checkbox" name="package[]" id="network_package" onclick="showDiv()" value="2">
                                    <label for="network_package">Network</label>
                                </div>
                            </div>

                            <div class="col-md-12" id="network" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label">Network Packages</label>
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="network_package" id="freeNetwork" value="1">
                                                <label for="freeNetwork">Free Network</label>
                                            </div>
                                        </label>
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="network_package" id="superNetwork" value="2">
                                                <label for="superNetwork">Super Network</label>
                                            </div>
                                        </label>
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="network_package" id="customNetwork" value="3">
                                                <label for="customNetwork">Custom Package</label>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12" id="custom_network" style="display: none;">
                                    <div class="form-group">
                                        <label class="control-label col-md-12">Network Custom Packages</label>
                                        <?php foreach ($network_package as $network){?>
                                        <div class="col-sm-4">
                                            <div class="checkbox checkbox-success">
                                                <input type="hidden" name="network_price[]" value="<?php echo $network['option_price']?>">
                                                <input type="checkbox" name="network_option[]" id="network<?php echo $network['option_id']?>" onclick="showFacDiv(this)" value="<?php echo $network['option_id']?>">
                                                <label for="network<?php echo $network['option_id']?>">
                                                    <?php echo $network['option_name'].' - '.$network['option_price']?>
                                                </label>
                                            </div>
                                        </div>
                                        <?php }?>
                                        <?php foreach ($whois_package as $whois){?>
                                        <div class="col-sm-4">
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="hidden" name="network_price[]" value="<?php echo $whois['option_price']?>">
                                                    <input type="radio" name="network_option[]" id="network<?php echo $whois['option_id']?>" value="<?php echo $whois['option_id']?>">
                                                    <label for="network<?php echo $whois['option_id']?>"><?php echo $whois['option_name'].' - '.$whois['option_price']?></label>
                                                </div>
                                            </label>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input type="hidden" name="whois_package" id="who_pack" value="">
                                    <input type="checkbox" name="package[]" id="whois_package" onclick="showDiv()" value="3">
                                    <label for="whois_package">Whois</label>
                                </div>
                            </div>
                            <div class="col-md-12" id="whois" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label">Whois Packages</label>
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <div class="radio radio-info">
                                                <input type="radio" name="whois_free" id="free_whois" value="1">
                                                <label for="free_whois">Free Whois</label>
                                            </div>
                                        </label>
                                        <?php foreach ($whois_package as $whois){?>
                                            <label class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input type="hidden" name="whois_price[]" value="<?php echo $whois['option_price']?>">
                                                    <input type="radio" name="whois_option" id="whois<?php echo $whois['option_id']?>" value="<?php echo $whois['option_id']?>">
                                                    <label for="whois<?php echo $whois['option_id']?>"><?php echo $whois['option_name'].' - '.$whois['option_price']?></label>
                                                </div>
                                            </label>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="checkbox checkbox-success">
                                    <input type="checkbox" name="all_free" id="all_free" onclick="showDiv()" value="4">
                                    <label for="all_free">All Free</label>
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
    <!--    <div class="col-sm-12 ol-md-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">File Upload1</h3>
                <label for="input-file-now">Image</label>
                
            </div>
        </div>-->
    
    
    
    
</div>

<script>
    
//    function showDiv(){
////        var type = $('input[name="package"]:checked').val();
//        var type = $("input[type='checkbox']").val();;
//        alert(type);
//    }

//    $('#all_free').click(function() {
//        if ($(this).is(':checked')) {
//            $('#affiliate').attr('checked', false);
//        } else {
////            $('input:checkbox').attr('checked', true);
//        }
//    });
    
    $(document).ready(function() {
        var others = $('input[name="package[]"]').not('#all_free');
        $('#all_free').change(function () {
            if (this.checked) {
                others.prop('checked', false);
                $('#affiliate').fadeOut('slow');
                $('#network').fadeOut('slow');
                $('#whois').fadeOut('slow');
            }
        });
        others.change(function () {
            if (this.checked) {
                $('#all_free').prop('checked', false)
            }
        });
        
        
        $('#affiliate_package').change(function () {
            if (!this.checked) 
               $('#affiliate').fadeOut('slow');
            else 
                $('#affiliate').fadeIn('slow');
        });
        
        $('#network_package').change(function () {
            if (!this.checked) 
               $('#network').fadeOut('slow');
            else 
                $('#network').fadeIn('slow');
        });
        
        $('#whois_package').change(function () {
            
            if (!this.checked) {
               $('#whois').fadeOut('slow');
               document.getElementById('who_pack').value = '';
           }
            else {
                $('#whois').fadeIn('slow');
                document.getElementById('who_pack').value = 3;
            }
        });
    
    $('input:radio[name=affiliate_package]').change(function() {
        if (this.value == 1) {
            document.getElementById("custom_affiliate").style.display = "none";
        }
        if (this.value == 2) {
            document.getElementById("custom_affiliate").style.display = "none";
        }
        if (this.value == 3) {
            document.getElementById("custom_affiliate").style.display = "block";
        }
    });
    
    $('input:radio[name=network_package]').change(function() {
        if (this.value == 1) {
            document.getElementById("custom_network").style.display = "none";
        }
        if (this.value == 2) {
            document.getElementById("custom_network").style.display = "none";
        }
        if (this.value == 3) {
            document.getElementById("custom_network").style.display = "block";
        }
    });
});
</script>


<script>
    
    function chkEmail(email){
        var email_address = email.value;
//        alert(email_address);
        $.ajax({
            type: 'POST',
           url: "super_admin/check_email",
           data: {email : email_address},
           success: function (data) {
               if(data == 0){
                   document.getElementById('chk_email_msg').style.display = "block";
                   $(":submit").attr("disabled", true);
               }
               else{
                   document.getElementById('chk_email_msg').style.display = "none";
                   $(":submit").removeAttr("disabled");
               }
           }
           
        });
    }
    
    function chkValidEmail(email){
        var email_add = email.value;
        var filter = /^([a-z0-9_\.\-])+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//        alert(email_add);

        if (!filter.test(email_add)){
            document.getElementById('valid_email_msg').style.display = 'block';
            $(":submit").attr("disabled", true);
        }
        else{
            document.getElementById('valid_email_msg').style.display = 'none';
            $(":submit").removeAttr("disabled");
        }
        
    }
    
    function chkValidMobile(mobile){
        var mobile_no = mobile.value;
//        alert(mobile_no);
        if (isNaN(mobile_no)){
                document.getElementById('valid_mobile_msg').style.display = 'block';
                $(":submit").attr("disabled", true);
            }
            else{
                $(":submit").removeAttr("disabled");
            }
    }
    
</script>
