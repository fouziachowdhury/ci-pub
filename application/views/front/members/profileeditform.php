<link href="<?php echo base_url(); ?>assets/front/css/template/templatestyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/mainstyle.css" rel="stylesheet">
<style>
    .form-control {
    height: 30px !important;
    padding: 6px 2px 6px 30px !important;
    text-align: left;
    }
</style>
<div class="col-md-10" style="background: #F6F6F6;">
    <div class="container-fluid">
    <div class="row" style="margin-left: 4px; margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>SETTINGS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
        </div>
    </div>
<form id="profile_edit" role="form" name="profile_edit" action="<?php echo base_url() ?>updateprofile/<?php echo $this->uri->segment('2'); ?>" method="post">
    <div class="row">
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
         
        <div class="col-md-6" style="border: 1px solid #ddd; background: #fff; height: 100%; width: 540px; margin-right: 15px;">
            <div class="row" style="margin-top: 5px">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Member Name : </label>
                        <input type="text" name="m_name" id="m_name" class="form-control input-sm floatlabel" value="<?php echo $memberinfo->name; ?>">
                        <?php if (form_error('m_name')) { ?>
                            <span style="color:red"><?php echo form_error('m_name'); ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                       <label for="exampleInputEmail1">Address 1 : </label>
                        <input type="text" name="m_address1" id="m_address1" class="form-control input-sm" value="<?php echo $memberinfo->address_1; ?>">
                        <?php if (form_error('m_address1')) { ?>
                            <span style="color:red"><?php echo form_error('m_address1'); ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address 2 : </label>
                        <input type="text" name="m_address2" id="m_address2" class="form-control input-sm" value="<?php echo $memberinfo->address_2; ?>">
                        <?php if (form_error('m_address2')) { ?>
                            <span style="color:red"><?php echo form_error('m_address2'); ?></span>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">City : </label>
                        <input type="text" name="m_city" id="m_city" class="form-control input-sm" value="<?php echo $memberinfo->city; ?>">
                        <?php if (form_error('m_city')) { ?>
                            <span style="color:red"><?php echo form_error('m_city'); ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">State : </label>
                        <input type="text" name="m_state" id="m_state" class="form-control input-sm" value="<?php echo $memberinfo->state; ?>">
                        <?php if (form_error('m_state')) { ?>
                            <span style="color:red"><?php echo form_error('m_state'); ?></span>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                       <label for="exampleInputEmail1">Country : </label>
                        <select class="selectpicker form-control" name="country_id">
                            <?php foreach ($country_info as $country) { ?>
                                <option value="<?php echo $country['country_id']; ?>" <?php if ($country['country_id'] == $memberinfo->country_id) {
                                echo "selected";
                            } ?> ><?php echo $country['country_name']; ?></option>
<?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Zip : </label>
                        <input type="text" name="m_zip" id="m_zip" class="form-control input-sm" value="<?php echo $memberinfo->zip; ?>">
                        <?php if (form_error('m_zip')) { ?>
                            <span style="color:red"><?php echo form_error('m_zip'); ?></span>
<?php } ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                       <label for="exampleInputEmail1">Email : </label>
                        <input type="email" name="m_email" class="form-control input-sm" value="<?php echo $memberinfo->email; ?>">
                        <?php if (form_error('m_email')) { ?>
                            <span style="color:red"><?php echo form_error('m_email'); ?></span>
<?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" style="border: 1px solid #ddd; background: #fff; height: 323px; width: 538px;">
            <h4 style="margin-top: 10px">CHANGE PASSWORD : </h4>
            <div class="row" style="margin-top: 5px">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                       <label for="exampleInputEmail1">Current Password : </label>
                        <input type="password" name="password" id="password" class="form-control" value="">
                        <?php if (form_error('password')) { ?>
                            <span style="color:red"><?php echo form_error('password'); ?></span>
<?php } ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">New Password : </label>
                        <input type="text" name="new_password" id="new_password" class="form-control input-sm" value="">
                        <?php if (form_error('new_password')) { ?>
                            <span style="color:red"><?php echo form_error('new_password'); ?></span>
<?php } ?>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Confirm New Password : </label>
                        <input type="text" name="re_password" id="re_password" class="form-control input-sm" value="">
                        <?php if (form_error('re_password')) { ?>
                            <span style="color:red"><?php echo form_error('re_password'); ?></span>
<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
     </form>
    <div class="row" style="border: 1px solid #ddd; background: #fff; height: 50px"> 
        <input type="submit" id="m_profile_edit" value="Update" class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">
    </div>
    <!-- .about-text-->
</div>
</div>
</div>

</div><!--/span-->
</div><!--/span-->

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
        });

        $("#m_profile_edit").click(function () {
            if (v.form()) {
                $("#profile_edit").submit();
                return false;
            }
        });
    });
</script>