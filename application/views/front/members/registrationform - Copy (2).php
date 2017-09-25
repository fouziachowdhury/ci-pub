<style>
    .form-control {
    height: 30px !important;
    padding: 6px 2px 6px 30px !important;
    text-align: left;
    }
</style>
<div class="col-md-10" style="background: #F6F6F6;">
    <div class="row" style="margin-left: 4px; margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>SETTINGS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
        </div>
    </div>

<div class="row" style="margin-left: 4px;margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 100%">
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-check-square-o"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php }
            ?>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissable">
                    <i class="fa fa-check-square-o"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>

            <?php }
            ?>
            <form id="registrationform" role="form" name="registrationform" action="<?php echo base_url() ?>insertmember" method="post">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="m_name" id="m_name" class="form-control input-sm floatlabel" placeholder="Member Name" value="<?php echo set_value('m_name'); ?>">
                            <?php if (form_error('m_name')) { ?>
                                <span style="color:red"><?php echo form_error('m_name'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="email" name="m_email" class="form-control input-sm" placeholder="Email Address" value="<?php echo set_value('m_email'); ?>">
                            <?php if (form_error('m_email')) { ?>
                                <span style="color:red"><?php echo form_error('m_email'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="m_password" id="m_password" class="form-control input-sm" placeholder="Password" value="<?php echo set_value('m_password'); ?>">
                            <?php if (form_error('m_password')) { ?>
                                <span style="color:red"><?php echo form_error('m_password'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="password" name="m_password_confirmation" id="m_password_confirmation" class="form-control input-sm" placeholder="Confirm Password" value="<?php echo set_value('m_password_confirmation'); ?>">
                            <?php if (form_error('m_password_confirmation')) { ?>
                                <span style="color:red"><?php echo form_error('m_password_confirmation'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="m_address1" id="m_address1" class="form-control input-sm" placeholder="Address1" value="<?php echo set_value('m_address1'); ?>">
                            <?php if (form_error('m_address1')) { ?>
                                <span style="color:red"><?php echo form_error('m_address1'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="m_address2" id="m_address2" class="form-control input-sm" placeholder="Address2" value="<?php echo set_value('m_address2'); ?>">
                            <?php if (form_error('m_address2')) { ?>
                                <span style="color:red"><?php echo form_error('m_address2'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="m_city" id="m_city" class="form-control input-sm" placeholder="City" value="<?php echo set_value('m_city'); ?>">
                            <?php if (form_error('m_city')) { ?>
                                <span style="color:red"><?php echo form_error('m_city'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <input type="text" name="m_state" id="m_state" class="form-control input-sm" placeholder="State" value="<?php echo set_value('m_state'); ?>">
                            <?php if (form_error('m_state')) { ?>
                                <span style="color:red"><?php echo form_error('m_state'); ?></span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <select class="selectpicker form-control" name="country_id">
                                <option>Select Country : </option>
                                <?php foreach($country_info as $country){ ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="m_zip" id="m_zip" class="form-control input-sm" placeholder="Zip" value="<?php echo set_value('m_zip'); ?>">
                                <?php if (form_error('m_zip')) { ?>
                                <span style="color:red"><?php echo form_error('m_zip'); ?></span>
                            <?php } ?>
                            </div>
                        </div>
                    </div>

                    <input style="height: 34px; margin-bottom: 9px; margin-left: 12px; margin-top: -12px;" type="submit" id="m_regi_submit" value="Register" class="btn btn-info">

                    </form>
        </div>
<!-- .about-text-->
</div>
</div>

</div><!--/span-->
</div><!--/span-->

<script type="text/javascript">
    jQuery().ready(function () {
        var v = jQuery("#registrationform").validate({
            rules: {
                m_name: {
                    required: true
                },
                m_email: {
                    required: true,
                    email: true
                },
                m_password: {
                    required: true
                },
                m_password_confirmation: {
                    required: true,
                    equalTo: "#m_password"
                },
                 m_address1: {
                    required: true
                },
                 m_address2: {
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
            messages: {
                "m_password_confirmation": "Password Not Matched",
            }
        });

        $("#m_regi_submit").click(function () {
            if (v.form()) {
                //$("#loader").show();
                //setTimeout(function () {
                $("#registrationform").submit();
                // }, 1000);
                return false;
            }
        });
    });
</script>  