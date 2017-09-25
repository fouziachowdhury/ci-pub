<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    
                    <form action="admin/savePaypalSettings" method="post" enctype="multipart/form-data">
                        <!--<h4 class="page-title">Paypal </h4>-->
                        <div class="form-group col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Paypal Type<span style="color:red">*</span></label>
                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="paypal_type" id="radio1" value="1" 
                                                   onclick="paypalType()" <?php if($all_info && $all_info[0]['paypal_type'] == 1){echo 'checked';}?>>
                                            <label for="radio1">Paypal</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="paypal_type" id="radio2" value="2" onclick="paypalType()" <?php if($all_info && $all_info[0]['paypal_type'] == 2){echo 'checked';}?>>
                                            <label for="radio2">Paypal Sandbox</label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div style="display: none" id="paypal">
                            <div class="form-group">
                                <label for="exampleInputuname">Paypal Link</label>
                                <input type="text" name="paypal_action" class="form-control" value="<?php if($all_info && $all_info[0]['paypal_type'] == 1){echo $all_info[0]['paypal_action'];}?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Paypal Business Account</label>
                                <input type="text" name="paypal_account" class="form-control" value="<?php if($all_info && $all_info[0]['paypal_type'] == 1){echo $all_info[0]['paypal_account'];}?>">
                            </div>
                        </div>
                        
                        <div style="display: none" id="paypal_sandbox">
                            <div class="form-group">
                                <label for="exampleInputuname">Paypal Sandbox Link</label>
                                <input type="text" name="sandbox_action" class="form-control" value="<?php if($all_info && $all_info[0]['paypal_type'] == 2){echo $all_info[0]['paypal_action'];}?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Paypal Sandbox Business Account</label>
                                <input type="text" name="sandbox_account" class="form-control" value="<?php if($all_info && $all_info[0]['paypal_type'] == 2){echo $all_info[0]['paypal_account'];}?>">
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
    $(document).ready(function (){
        paypalType();
    });
    function paypalType(){
        if($('input[name=paypal_type]:checked').val() == 1){
            $("#paypal").show();
            $("#paypal_sandbox").hide();
        }
        if($('input[name=paypal_type]:checked').val() == 2){
            $("#paypal_sandbox").show();
            $("#paypal").hide();
        }
    }
    
    
</script>
