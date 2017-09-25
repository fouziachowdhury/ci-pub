<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    
                    <form action="admin/saveStripeSettings" method="post" enctype="multipart/form-data">
                        <!--<h4 class="page-title">Stripe </h4>-->
                        <div class="form-group col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Stripe Type<span style="color:red">*</span></label>
                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="stripe_type" id="radio1" value="1" 
                                                   onclick="StripeType()" <?php if($all_info && $all_info[0]['stripe_type'] == 1){echo 'checked';}?>>
                                            <label for="radio1">Stripe Live</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="stripe_type" id="radio2" value="2" 
                                                   onclick="StripeType()" <?php if($all_info && $all_info[0]['stripe_type'] == 2){echo 'checked';}?>>
                                            <label for="radio2">Stripe Test</label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div style="display: none" id="Stripe">
                            <div class="form-group">
                                <label for="exampleInputuname">Public Key</label>
                                <input type="text" name="test_public_key" class="form-control" 
                                       value="<?php if($all_info && $all_info[0]['stripe_type'] == 1){echo $all_info[0]['public_key'];}?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Secret Key</label>
                                <input type="text" name="test_secret_key" class="form-control" 
                                       value="<?php if($all_info && $all_info[0]['stripe_type'] == 1){echo $all_info[0]['secret_key'];}?>">
                            </div>
                        </div>
                        
                        <div style="display: none" id="Stripe_sandbox">
                            <div class="form-group">
                                <label for="exampleInputuname">Public Key</label>
                                <input type="text" name="live_public_key" class="form-control" value="<?php if($all_info && $all_info[0]['stripe_type'] == 2){echo $all_info[0]['public_key'];}?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputuname">Secret Key</label>
                                <input type="text" name="live_secret_key" class="form-control" value="<?php if($all_info && $all_info[0]['stripe_type'] == 2){echo $all_info[0]['secret_key'];}?>">
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
        StripeType();
    });
    function StripeType(){
        if($('input[name=stripe_type]:checked').val() == 1){
            $("#Stripe").show();
            $("#Stripe_sandbox").hide();
        }
        if($('input[name=stripe_type]:checked').val() == 2){
            $("#Stripe_sandbox").show();
            $("#Stripe").hide();
        }
    }
    
    
</script>
