<div class="row">
    <div id="all_time" style="display: block;">
        <!--------------------------------------FIRST ROW START---------------------------->
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="white-box">
    <!--                <form id="profile_edit" role="form" name="profile_edit" action="<?php echo base_url() ?>updateprofile/<?php echo $this->uri->segment('2'); ?>" method="post">-->
                    <div class="row">
                        <div class="col-md-12" style="background: #fff;">
                            <h4>My Account</h4><hr>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <span><?php
                                        if (isset($memberinfo->name) && $memberinfo->name != '') {
                                            echo $memberinfo->name;
                                        }
                                        ?></span><br>
                                    <span><?php
                                        if (isset($memberinfo->address_1) && $memberinfo->address_1 != '') {
                                            echo $memberinfo->address_1;
                                        }
                                        ?></span><br>
                                    <span><?php
                                        if (isset($memberinfo->address_2) && $memberinfo->address_2 != '') {
                                            echo $memberinfo->address_2;
                                        }
                                        ?></span><br>
                                    <span><?php
                                    if (isset($memberinfo->city) && $memberinfo->city != '') {
                                        echo $memberinfo->city;
                                    }
                                    ?></span><br>
                                    <span><?php
                                        if (isset($memberinfo->state) && $memberinfo->state != '') {
                                            echo $memberinfo->state;
                                        }
                                        ?></span><br>
                                        <?php
//                                        echo $memberinfo->country_id;
                                        if($memberinfo->country_id){
                                            $countryinfo = $this->MembersModel->getcountrynamebyid($memberinfo->country_id);
                                            $country = $countryinfo->country_name;
                                        }
//                                        print_r($country);die();
                                        ?>
                                                                            <span><?php
                                        if (isset($country) && $country != '') {
                                            echo $country;
                                        }
                                        ?></span><br><br>
                                        <span><strong>Email : </strong><?php
                                        if (isset($memberinfo->email) && $memberinfo->email != '') {
                                            echo $memberinfo->email;
                                        }
                                        ?></span><br>
                                </div>
                            </div>
                        </div>
                        <input type="button" id="m_profile_edit" value="Edit" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="height: 33px; margin-top:7px; margin-left:7px">
                        <input type="button" id="m_profile_edit" value="Change Password" class="btn btn-info" data-toggle="modal" data-target="#passwordModal" style="height: 33px; margin-top:7px; margin-left:7px">
                    </div>
                </div>
                
                <!-- Modal For Edit -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Account Info</h4>
                        </div>
                        <form action="members/editAccountInfo" id="profile_edit" role="form" name="profile_edit" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="member_id" id="m_name" class="form-control" value="<?php echo $memberinfo->member_id; ?>">
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="m_name" id="m_name" class="form-control" value="<?php echo $memberinfo->name; ?>">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Email</label>
                                    <input type="email" name="m_email" id="m_email" class="form-control" value="<?php echo $memberinfo->email; ?>">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Address 1</label>
                                    <input type="text" name="m_address1" id="m_email" class="form-control" value="<?php echo $memberinfo->address_1; ?>">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Address 2</label>
                                    <input type="text" name="m_address2" id="m_email" class="form-control" value="<?php echo $memberinfo->address_2; ?>">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Country</label>
                                    <select class="selectpicker form-control" name="country_id">
                                        <option>Select Country : </option>
                                        <?php foreach ($country_info as $country) { ?>
                                            <option value="<?php echo $country['country_id']; ?>" <?php if($country['country_id'] == $memberinfo->country_id){echo 'selected';}?>>
                                                <?php echo $country['country_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">City</label>
                                    <input type="text" name="m_city" id="m_email" class="form-control" value="<?php echo $memberinfo->city; ?>">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">State</label>
                                    <input type="text" name="m_state" id="m_email" class="form-control" value="<?php echo $memberinfo->state; ?>">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Zip Code</label>
                                    <input type="text" name="m_zip" id="m_zip" class="form-control input-sm" placeholder="Zip" value="<?php echo $memberinfo->zip; ?>">
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="edit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <!--Modal End-->
            
            <!-- Modal For Edit -->
            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Password</h4>
                        </div>
                        <form action="members/updatePassword" id="password_edit" role="form" name="password_edit" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" name="member_id" id="m_name" class="form-control" value="<?php echo $memberinfo->member_id; ?>">
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">New Password</label>
                                    <input type="password" name="m_password" id="newPassword" class="form-control" value="">
                                </div>
                                
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Confirm Password</label>
                                    <input type="password" name="m_confirm_password" id="confirmPassword" class="form-control" value="">
                                </div>
                                <div class="registrationFormAlert" id="divCheckPasswordMatch" style="color: red;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="passButton" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <!--Modal End-->
                <br>
                <!--                </form>          -->
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="white-box">
    <!--                <form id="profile_edit" role="form" name="profile_edit" action="<?php echo base_url() ?>updateprofile/<?php echo $this->uri->segment('2'); ?>" method="post">-->
                    <div class="row">
                        <div class="col-md-12" style="background: #fff;">
                            <h4>Membership</h4><hr>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-xs-12">
                                    <?php foreach ($access_info as $access){?>
                                    <p style="line-height: 0.08;">
                                            <strong><?php echo $access->option_name?></strong> : 
                                            <?php if($access->active){?>
                                            <span class="text-success">Active</span>
                                            <?php }if($access->trial){?>
                                            <span class="text-warning">Trial</span>
                                            <?php }?>
                                        </p><br>
                                    <?php }?>
                                </div>

                            </div>
                        </div>
                        <!--<a href="custompackageforaffiliate"><button class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">Update</button></a>-->
                        <a href="affiliate"><button class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">Update</button></a>
                        <!--<input type="submit" id="m_profile_edit" value="Update" class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">-->
                        <input type="submit" id="m_profile_edit" value="Cancle" class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">
                    </div>
                </div><br>
                <!--                </form>          -->
            </div>
        </div>

        <!--------------------------------------FIRST ROW END---------------------------->
        <!--------------------- SECOND ROW START----------------->

        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="white-box">
    <!--                <form id="profile_edit" role="form" name="profile_edit" action="<?php echo base_url() ?>updateprofile/<?php echo $this->uri->segment('2'); ?>" method="post">-->
                    <div class="row">
                        <div class="col-md-12" style="background: #fff;">
                            <h4>Invoices</h4><hr>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <?php foreach ($invoice_info as $invoice){?>
                                            <tr style="text-align: center;">
                                                <td><?php echo $invoice->option_name?></td>
                                                <td><?php echo $invoice->name?></td>
                                                <td>$<?php echo $invoice->option_price?></td>
                                                <td>
                                                    <?php $timestamp = strtotime($invoice->date);
                                                            echo date('m-d-Y', $timestamp);?>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <!--                </form>          -->
                <!-- .about-text-->
            </div>

            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="white-box">
    <!--                <form id="profile_edit" role="form" name="profile_edit" action="<?php echo base_url() ?>updateprofile/<?php echo $this->uri->segment('2'); ?>" method="post">-->
                    <div class="row">
                        <div class="col-md-12" style="background: #fff;">
                            <h3 class="box-title">Comments</h3>
                            <div class="row" style="margin-top: 5px">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <?php 
                                         echo $this->session->flashdata('email_sent'); 
                                      ?>
                                    <form action="members/sendMessage" method="post" class="form-horizontal" id="commentForm" role="form"> 
                                        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                        <input type="hidden" name="email" id="" class="form-control" value="<?php echo $memberinfo->email; ?>">
                                        <div class="form-group col-xs-12">
                                            <h5>Send us a message and we'll get back to you shortly</h5><hr>
                                            <textarea class="form-control" name="comments" id="description1" style="resize: none;"></textarea>
                                        </div>
                                        <input type="submit" id="" value="Send" class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <br>
                <!--                </form>          -->
            </div>
        </div>
        <!--------------------------------------SECOND ROW END---------------------------->

    </div>
</div>
<script type="text/javascript">

    jQuery().ready(function () {
        var v = jQuery("#profile_edit").validate({
            rules: {
                m_name: {
                    required: true
                },
                m_email: {
                    required: true,
                    email: true
                },
                m_address1: {
                    required: true
                },
                m_city: {
                    required: true
                },
                m_state: {
                    required: true
                },
                m_zip: {
                    required: true
                }
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $("#edit").click(function () {
            if (v.form()) {
                $("#profile_edit").submit();
                return false;
            }
        });
    });
</script>

<script>
   
   jQuery().ready(function () {
        var v = jQuery("#password_edit").validate({
            rules: {
                m_password: {
                    required: true
                },
                m_confirm_password: {
                    required: true,
                    equalTo: "#newPassword"
                }
                
            },
            errorElement: "span",
            errorClass: "help-inline-error",
        });

        $("#passButton").click(function () {
            if (v.form()) {
                $("#password_edit").submit();
                return false;
            }
        });
    });
    
</script>

<script>
    
    function checkPasswordMatch() {
    var password = $("#newPassword").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password != confirmPassword){
        $("#divCheckPasswordMatch").html("Passwords do not match!");
    }
    else
        $("#divCheckPasswordMatch").html("");
}

$(document).ready(function () {
   $("#confirmPassword").keyup(checkPasswordMatch);
});
    
</script>