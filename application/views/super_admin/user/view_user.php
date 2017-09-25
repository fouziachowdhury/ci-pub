<div class="row">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Permission</strong></h3>
        </div>
        <div class="panel-body">
            <form action="admin/updateAccessInfo" method="post">
                <input type="hidden" name="member_id" value="<?php echo $user_info[0]['member_id']?>">
                <div class="table-responsive">
                    <a>
                        <button type="submit" class="btn btn-success pull-right" style="margin: 5px 0px;">Update</button>
                    </a>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <td><strong>Add Type</strong></td>
                                <td class="text-center"><strong>Active</strong></td>
                                <td class="text-center"><strong>Trial</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            <tr>
                        
                                <td>Banner Ads
                                    <input type="hidden" name="package_id[0]" value="1">
                                    <input type="hidden" name="ads_type[]" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv0" value="<?php if(isset($access_info[1][0])){echo $access_info[1][0]['active'];}?>" >
                                    <input type="checkbox" id="active0" name="active[0]" 
                                        <?php if(isset($access_info[1][0])){
                                        if($access_info[1][0]['active'] == 1){echo 'checked';}}?> value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl0" value="<?php if(isset($access_info[1][0])){echo $access_info[1][0]['trial'];}?>">
                                    <input type="checkbox" id="trial0" name="trial[0]" <?php if(isset($access_info[1][0])){if($access_info[1][0]['trial'] == 1){echo 'checked';}}?> value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[0]" value="<?php if(isset($access_info[1][0])){echo $access_info[1][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                            
                                <td>Native Ads
                                    <input type="hidden" name="package_id[1]" value="1">
                                    <input type="hidden" name="ads_type[]" value="2">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv1" value="<?php if(isset($access_info[2][0])){echo $access_info[2][0]['active'];}?>">
                                    <input type="checkbox" id="active1" name="active[1]" 
                                        <?php if(isset($access_info[2][0])){
                                            if($access_info[2][0]['active'] == 1){echo 'checked';}}?> value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl1" value="<?php if(isset($access_info[2][0])){echo $access_info[2][0]['trial'];}?>">
                                    <input type="checkbox" id="trial1" name="trial[1]" 
                                        <?php if(isset($access_info[2][0])){
                                            if($access_info[2][0]['trial'] == 1){echo 'checked';}}?> value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[1]" value="<?php if(isset($access_info[2][0])){echo $access_info[2][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Facebook Ads
                                    <input type="hidden" name="package_id[2]" value="1">
                                    <input type="hidden" name="ads_type[]" value="3">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv2" value="<?php if(isset($access_info[3][0])){echo $access_info[3][0]['active'];}?>">
                                    <input type="checkbox" id="active2" name="active[2]" <?php if(isset($access_info[3][0])){if($access_info[3][0]['active'] == 1){echo 'checked';}}?> class="facebook_ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl2" value="<?php if(isset($access_info[3][0])){echo $access_info[3][0]['trial'];}?>">
                                    <input type="checkbox" id="trial2" name="trial[2]" <?php if(isset($access_info[3][0])){if($access_info[3][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[2]" value="<?php if(isset($access_info[3][0])){echo $access_info[3][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Facebook E-commerce Ads
                                    <input type="hidden" name="package_id[3]" value="1">
                                    <input type="hidden" name="ads_type[]" value="4">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv3" value="<?php if(isset($access_info[4][0])){echo $access_info[4][0]['active'];}?>">
                                    <input type="checkbox" id="active3" name="active[3]" <?php if(isset($access_info[4][0])){if($access_info[4][0]['active'] == 1){echo 'checked';}}?> class="fbecom_ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl3" value="<?php if(isset($access_info[4][0])){echo $access_info[4][0]['trial'];}?>">
                                    <input type="checkbox" id="trial3" name="trial[3]" <?php if(isset($access_info[4][0])){if($access_info[4][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[3]" value="<?php if(isset($access_info[4][0])){echo $access_info[4][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>PPV Ads
                                    <input type="hidden" name="package_id[4]" value="1">
                                    <input type="hidden" name="ads_type[]" value="5">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv4" value="<?php if(isset($access_info[5][0])){echo $access_info[5][0]['active'];}?>">
                                    <input type="checkbox" id="active4" name="active[4]" <?php if(isset($access_info[5][0])){if($access_info[5][0]['active'] == 1){echo 'checked';}}?> class="landing_ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl4" value="<?php if(isset($access_info[5][0])){echo $access_info[5][0]['trial'];}?>">
                                    <input type="checkbox" id="trial4" name="trial[4]" <?php if(isset($access_info[5][0])){if($access_info[5][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[4]" value="<?php if(isset($access_info[5][0])){echo $access_info[5][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Affiliate Landing Page Feed
                                    <input type="hidden" name="package_id[5]" value="2">
                                    <input type="hidden" name="ads_type[]" value="6">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv5" value="<?php if(isset($access_info[6][0])){echo $access_info[6][0]['active'];}?>">
                                    <input type="checkbox" id="active5" name="active[5]" <?php if(isset($access_info[6][0])){if($access_info[6][0]['active'] == 1){echo 'checked';}}?> class="ppv_ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl5" value="<?php if(isset($access_info[6][0])){echo $access_info[6][0]['trial'];}?>">
                                    <input type="checkbox" id="trial5" name="trial[5]" <?php if(isset($access_info[6][0])){if($access_info[6][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[5]" value="<?php if(isset($access_info[6][0])){echo $access_info[6][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Advertiser Offer Feed<?php // print_r($access_info);?>
                                    <input type="hidden" name="package_id[6]" value="2">
                                    <input type="hidden" name="ads_type[]" value="7">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv6" value="<?php if(isset($access_info[7][0])){echo $access_info[7][0]['active'];}?>">
                                    <input type="checkbox" id="active6" name="active[6]" <?php if(isset($access_info[7][0])){if($access_info[7][0]['active'] == 1){echo 'checked';}}?> class="" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl6" value="<?php if(isset($access_info[7][0])){echo $access_info[7][0]['trial'];}?>">
                                    <input type="checkbox" id="trial6" name="trial[6]" <?php if(isset($access_info[7][0])){if($access_info[7][0]['trial'] == 1){echo 'checked';}}?> class="affiliate_ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[6]" value="<?php if(isset($access_info[7][0])){echo $access_info[7][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Landing Page
                                    <input type="hidden" name="ads_type[]" value="13">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv7" value="<?php if(isset($access_info[13][0])){echo $access_info[13][0]['active'];}?>">
                                    <input type="checkbox" id="active7" name="active[7]" <?php if(isset($access_info[13][0])){if($access_info[13][0]['active'] == 1){echo 'checked';}}?> class="ppv_ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl7" value="<?php if(isset($access_info[13][0])){echo $access_info[13][0]['trial'];}?>">
                                    <input type="checkbox" id="trial7" name="trial[7]" <?php if(isset($access_info[13][0])){if($access_info[13][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[7]" value="<?php if(isset($access_info[13][0])){echo $access_info[13][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Whois
                                    <input type="hidden" name="package_id[8]" value="3">
                                    <input type="hidden" name="ads_type[]" value="19">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv8" value="<?php if(isset($access_info[14][0])){echo $access_info[14][0]['active'];}?>">
                                    <input type="checkbox" id="active8" name="active[8]" <?php if(isset($access_info[14][0])){if($access_info[14][0]['active'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl8" value="<?php if(isset($access_info[14][0])){echo $access_info[14][0]['trial'];}?>">
                                    <input type="checkbox" id="trial8" name="trial[8]" <?php if(isset($access_info[14][0])){if($access_info[14][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[8]" value="<?php if(isset($access_info[14][0])){echo $access_info[14][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>
<!--                            <tr>
                                <td>Whois
                                    <input type="hidden" name="ads_type[]" value="14">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="actv9" value="<?php if(isset($access_info[14][0])){echo $access_info[14][0]['active'];}?>">
                                    <input type="checkbox" id="active9" name="active[9]" <?php if(isset($access_info[14][0])){if($access_info[14][0]['active'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <input type="hidden" id="trl9" value="<?php if(isset($access_info[14][0])){echo $access_info[14][0]['trial'];}?>">
                                    <input type="checkbox" id="trial9" name="trial[9]" <?php if(isset($access_info[14][0])){if($access_info[14][0]['trial'] == 1){echo 'checked';}}?> class="ads" id="promotion" value="1">
                                </td>
                                <td class="text-center">
                                    <div class="input-group">
                                        <span class="input-group-addon" id="basic-addon1">$</span>
                                        <input type="text" class="form-control" name="price[9]" value="<?php if(isset($access_info[14][0])){echo $access_info[14][0]['price'];}?>" style="text-align: center;">
                                    </div>
                                </td>
                            </tr>-->
                        </tbody>
                    </table>
                    <a>
                        <button type="submit" class="btn btn-success pull-right" style="margin: 5px 0px;">Update</button>
                    </a>
                </div>
            </form>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>User Info</strong></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form action="admin/updateUserInfo" method="post">
                        <input type="hidden" name="member_id" class="form-control" value="<?php echo $user_info[0]['member_id']?>">
                    <div class="form-group">
                        <label for="exampleInputuname">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $user_info[0]['name']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputuname">Email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $user_info[0]['email']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputuname">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php //echo $user_info[0]['password']?>">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputuname">Address</label>
                        <textarea class="form-control" name="address_1" style="resize: none"><?php echo $user_info[0]['address_1']?>
                        </textarea>
                    </div>

<!--                    <div class="form-group">
                        <label for="exampleInputuname">City</label>
                        <input type="text" name="city" class="form-control" value="<?php echo $user_info[0]['city']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputuname">State</label>
                        <input type="text" name="state" class="form-control" value="<?php echo $user_info[0]['state']?>">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputuname">Country</label>
                        <input type="text" name="country" class="form-control" value="<?php echo $user_info[0]['country_name']?>">
                    </div>-->
                    <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Invoice Info</strong></h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <td><strong>Invoice Code</strong></td>
                            <td class="text-center"><strong>Payment Type</strong></td>
                            <td class="text-center"><strong>Date</strong></td>
                            <td class="text-center"><strong>Status</strong></td>
                            <td class="text-center"><strong>Action</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $i = 1; foreach ($invoice_info as $inv){?>
                        <tr>
                            <td>INV# <?php echo $inv['invoice_code'];?></td>
                            <td class="text-center"><?php echo $inv['name'];?></td>
                            <td class="text-center">
                                <?php $timestamp = strtotime($inv['date']);
                                echo date('d-m-Y', $timestamp);?>
                            </td>
                            <td class="text-center">
                                <?php if($inv['fee_amount']){?>
                                <label class="label label-success" style="line-height: 2">Paid</label>
                                <?php }else{?>
                                <label class="label label-danger" style="line-height: 2">Unpaid</label>
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <a href="admin/viewInvoice/<?php echo $inv['invoice_id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="View User" class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </td>
                        </tr>
                        
                        <?php $i++;if($i==7) break;}?>

                    </tbody>
                </table>
                <a href="admin/allInvoice/<?php echo $user_info[0]['member_id']?>">View All Invoice</a>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function (){
//        alert($('#actv9').val());
        for(i = 0; i < 10; i++){
            if($('#actv'+i).val() == 1){
                $("#active"+i).prop("checked", true);
            }
            if($('#trl'+i).val() == 1){
                $("#trial"+i).prop("checked", true);
            }
        }
        
//         $(".banner_ads").prop("checked", true);
//         $(".landing_ads").prop("checked", true);
//         $(".facebook_ads").prop("checked", true);
//         $(".native_ads").prop("checked", true);
//         $(".fbecom_ads").prop("checked", true);
//         $(".affiliate_ads").prop("checked", true);
////        

    });

</script>
