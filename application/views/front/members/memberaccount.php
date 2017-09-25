<style>
    .form-control {
        height: 30px !important;
        padding: 6px 2px 6px 30px !important;
        text-align: left;
    }
</style>
<div class="col-md-12" style="background: #fff;">
    <div class="container-fluid">
        <div class="row" style="margin-left: 4px; margin-top: 19px; margin-bottom: -8px;">
        </div>
        <form id="profile_edit" role="form" name="profile_edit" action="<?php echo base_url() ?>updateprofile/<?php echo $this->uri->segment('2'); ?>" method="post">
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
            <div class="row">
                <div class="tabbable">
                    <div class="col-sm-3">
                        <ul class="nav nav-pills nav-stacked" style="border:1px solid #2281AD">
                            <li class="active"><a href="#menu1" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> User Information </a></li>
                            <li><a href="#menu2" data-toggle="tab"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> Section Permission </a></li>
                            <li><a href="#menu3" data-toggle="tab"><i class="fa fa-certificate"></i> Packages / Payment </a> </li>
                            <!--<li><a href="#menu4" data-toggle="tab"><i class="fa fa-certificate"></i> Invoice </a> </li>-->
                            <!--<li><a href="#menu5" data-toggle="tab"><i class="fa fa-key" aria-hidden="true"></i> Password Change</a></li>-->
                            <li><a href="#menu6" data-toggle="tab"> <i class="fa fa-trash-o"></i> Inactive / Delete Account </a></li>
                        </ul><!-- /.nav -->
                    </div>
                    <div class="col-sm-9">
                        <!-- resumt -->
                        <div class="panel panel-default tab-content clearfix">

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

                            <!-----------------------------TAB 1 START ----------------------------------->
                            <div class="panel-heading resume-heading tab-pane active" id="menu1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="col-xs-12 col-sm-12">
                                            <ul class="list-group">
                                                <li class="list-group-item"><i class="fa fa-arrow-right" aria-hidden="true"></i> Name : <?php echo $memberinfo->name; ?> </li>
                                                <li class="list-group-item"><i class="fa fa-arrow-right" aria-hidden="true"></i> Email : <?php echo $memberinfo->email; ?> </li>
                                                <li class="list-group-item"><i class="fa fa-arrow-right" aria-hidden="true"></i> Address : <?php echo $memberinfo->address_1; ?></li>
                                                <li class="list-group-item"><i class="fa fa-arrow-right" aria-hidden="true"></i> Status :  <?php if (isset($memberinfo->status) && $memberinfo->status == '1') { ?><span style="font-size: 16px;" class="label label-success">Active</span><?php } else { ?> <span style="font-size: 16px;" class="label label-warning">Inactive</span> <?php } ?></li>
                                            </ul>
                                            <button class="btn btn-sm btn-warning" style="float: right; border-radius: 5%;"><a style="color:#fff; text-decoration: none" href="<?php echo base_url() ?>editaccount/<?php echo $this->uri->segment('2'); ?>">Edit Account</a></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-----------------------------TAB 1 END ----------------------------------->

                            <!-----------------------------TAB 2 START ----------------------------------->
                            <div class="panel-heading resume-heading tab-pane" id="menu2">
                                <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <?php
                                        $memberpackageinfo = $this->MembersModel->userPermission($memberinfo->package_id);
                                        $permissionId = $memberpackageinfo->option_id;
                                        $permi = explode(',', $permissionId);
                                        $getpermisetting = $this->MembersModel->etpermisettinginfo($permi);
                                        //echo '<pre>'; print_r($permi); 
                                        $string = array();
                                        foreach ($getpermisetting as $get) {
                                            $string[] = $get['is_active'];
                                        }
                                        $access = $string;
                                       //echo '<pre>'; print_r($access); 
                                        $arrr = explode(',', $memberinfo->membership_package_options);
                                        ?>
                                                <?php foreach ($membership_options as $options) {    //echo '<pre>'; print_r($options); ?>
                                            <div class="option" style="margin: 10px 0px;padding-left: 10px;">
                                                <?php
                                                    foreach($permi as $per){
                                                        if ($options['option_id'] == $per) {?>
                                                        <label class="glyphicon glyphicon-ok" style="color: green;"></label>
                                                    <?php }}?> <?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?>
                                            </div>
<?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-------------------------tab 3 START --------------------->
                            <div class="panel-heading resume-heading tab-pane" id="menu3">
                                <h4>Packages / Payment Info</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Packages Name</th>
                                            <th>Payment Method</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php foreach ($paymentinfo as $payment) { ?>
                                            <tr>
                                                <td><?php echo $payment['option_name']; ?></td>
                                                <td><?php echo $payment['name']; ?></td>
                                                <td>$ <?php echo $payment['fee_amount']; ?></td>
                                                <td><?php echo $payment['date']; ?></td>
                                            </tr>
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-----------------------------TAB 3 END ----------------------------------->

                            <!-----------------------------TAB 4 START ----------------------------------->
                            <!--<div class="panel-heading resume-heading tab-pane" id="menu4">
                                <h4>Invoice Info</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>john@example.com</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>-->

                            <!-----------------------------TAB 4 END ----------------------------------->

                            <!-----------------------------TAB 5 START ----------------------------------->
                            <!--<div class="panel-heading resume-heading tab-pane" id="menu5">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <div class="panel-title">Password Reset</div>
                                        <div style="float:right; font-size: 85%; position: relative; top:-10px"></div>
                                    </div>  
                                    <div class="panel-body" >
                                        <form id="changepasswordform" class="form-horizontal" role="form" method="post" action="<?php echo base_url() ?>changepassword/<?php echo $this->uri->segment('2'); ?>">
                                            <div class="form-group">
                                                <label for="password" class="col-md-3 control-label">New Password : </label>
                                                <div class="col-md-9">
                                                    <input type="password" id="chn_password" class="form-control" name="password" placeholder="Password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="col-md-3 control-label">Re Type Password : </label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" name="re_password" placeholder="Password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button id="btn-changepasswordform" type="button" class="btn btn-warning">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>-->

                            <!-----------------------------TAB 5 END ----------------------------------->

                            <!-----------------------------TAB 6 START ----------------------------------->
                            <div class="panel-heading resume-heading tab-pane" id="menu6">
                                <h4>Account Delete or Inactive</h4>
                                <div class="row m-profile-btn">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <a style="border-radius: 3%;" class="btn btn-lg btn-success alertForInactive"><i class="fa fa-times" aria-hidden="true"></i> <span>Inactive Account</span></a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <a style="border-radius: 3%;" class="btn btn-lg btn-danger alertForDelete"><i class="fa fa-trash" aria-hidden="true"></i> <span>Delete Account</span></a> 
                                    </div>
                                    </ul>
                                </div>
                            </div>
                            <!-----------------------------TAB 6 END ----------------------------------->
                        </div>
                    </div>
                    <!-- resume -->
                </div>
            </div>

            <button class="btn btn-info" style="float: right; border-radius: 5%;"><a style="color:#fff;" href="<?php echo base_url() ?>memberlogout">Log Out</a></button>
        </form>
        <div class="row" style="border: 1px solid #ddd; background: #fff; height: 50px"> 
            <input type="submit" id="m_profile_edit" value="Update" class="btn btn-info" style="height: 33px; margin-top:7px; margin-left:7px">
        </div>
        <!-- .about-text-->
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