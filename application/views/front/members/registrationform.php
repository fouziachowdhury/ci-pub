<div class="mobile-menu-wrap">
    <ul class="clearfix">
        <li><a href="home">Home</a></li>
        <li><a href="networks">Network</a></li>
        <li><a href="affiliate">Affiliate</a></li>
        <li><a href="whois">Whois</a></li>
    </ul>
    <div class="mobile-menu-btn">
        <?php if (isset($_SESSION['member_id']) != '') { ?>
            <a href="<?php echo base_url() ?>userhome">User Home</a>
        <?php } else { ?>
            <a href="loginform" class="btn btn-outline">Login</a>
            <a href="registrationform" class="btn">Join for Free</a>
        <?php } ?>
    </div>
</div>

<div class="main-wrapper">
    <!-- Header start -->
    <div class="header-wrap">
        <div class="top-navbar">
            <div class="container">
                <div class="logo">
                    <a href="home"><img src="assets/images/logo_1.png" alt="Publyfe" /></a>
                </div>
                <div class="menu-bar">
                    <ul class="clearfix">
                        <li><a href="home">Home</a></li>
                        <li><a href="network">Network</a></li>
                        <li><a href="affiliate">Affiliate</a></li>
                        <li><a href="whois">Whois</a></li>
                    </ul>
                </div>
                <div class="top-btns">
                    <?php if (isset($_SESSION['member_id']) != '') { ?>
                        <a class="btn" href="<?php echo base_url() ?>userhome">User Home</a>
                    <?php } else { ?>
                        <a href="loginform" class="btn btn-outline">Login</a>
                        <a href="registrationform" class="btn">Join for Free</a>
                    <?php } ?>
                </div>
                <div class="top-social-icon">
                    <ul class="social-icon clearfix">
                        <li><a href="https://www.facebook.com/publyfe"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
                <div class="mobile-menu">
                    <a href="#" class="mobile-menu-icon navicon"><i class="fa fa-bars"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        
    </div>


<section class="single-page-title">
    <div class="container text-center">
        <h2>Registration Form</h2>
    </div>
</section>
<!-- .page-title -->

<section class="about-text ptb-100">
    <section class="section_title">
        <div class="container text-center">
            <h2>If New User Please Registration First</h2>
            <span class="bordered-icon"><i class="fa fa-circle-thin"></i></span>
        </div>
    </section>

    <div class="container">
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
            <form id="registrationform" role="form" name="registrationform" action="insertmember" method="post">
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
                            <?php //if (form_error('m_address2')) { ?>
                                <!--<span style="color:red"><?php //echo form_error('m_address2');        ?></span>-->
                            <?php //} ?>
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
                                <?php foreach ($country_info as $country) { ?>
                                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                                <?php } ?>
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
                <?php
                if (isset($_SESSION['redirect'])) {
                    if (preg_match('/[^a-zA-Z]+/', $_SESSION['redirect'])) {
                        $rrr = explode("/", $_SESSION['redirect']);
                        $redirect = $rrr[0];
                    } else {
                        $redirect = $_SESSION['redirect'];
                    }
                    if (isset($redirect) && $redirect == 'superpackageforaffiliate') {
                        $redi = 'You Are Choosing Super Affiliate Package';
                    } else if (isset($redirect) && $redirect == 'custompackageforaffiliate') {
                        $redi = 'You Are Choosing Custom Affiliate Package';
                        $membership_options = $this->MembersModel->getoptionbypackages();
                        //echo '<pre>'; print_r($membership_options); exit;
                    } else if (isset($redirect) && $redirect == 'affiliate') {
                        $redi = 'You Are Choosing Free Affiliate Package';
                    } else if (isset($redirect) && $redirect == 'network') {
                        $redi = 'You Are Choosing Free Network Package';
                    } else if (isset($redirect) && $redirect == 'whois') {
                        $redi = 'You Are Choosing Free Whois Package';
                    } else if (isset($redirect) && $redirect == 'approveNetworkPackage') {
                        $redi = 'You Are Choosing Super Network Package';
                    } else if (isset($redirect) && $redirect == 'selectcustompackageoption') {
                        $redi = 'You Are Choosing Custom Network Package';
                        $networkmembership_options = $this->MembersModel->getoptionbynetpack();
                        $mem_opt = $this->MembersModel->getoptionbynetwhoispack();
                        //$membership_options = array_merge($membership_options1,$membership_options2);
                    } else if (isset($redirect) && $redirect == 'activewhoissilver') {
                        $redi = 'You Are Choosing Whois Silver Package';
                    } else if (isset($redirect) && $redirect == 'activewhoisgold') {
                        $redi = 'You Are Choosing Whois Gold Package';
                    } else if (isset($redirect) && $redirect == 'activewhoisplatinum') {
                        $redi = 'You Are Choosing Whois Platinum Package';
                    }
                    ?>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="" id="" class="form-control input-sm" value="<?php
                                if (isset($redi)) {
                                    echo $redi;
                                }
                                ?>" readonly />
                                <?php if($redi == 'You Are Choosing Custom Network Package' || $redi == 'You Are Choosing Custom Affiliate Package'){?>
                                    <?php $options_id = ($this->session->userdata('option_id'));?>
                                <?php }?>
                                       <?php
//                                       if (isset($membership_options) && $membership_options != '') {
//                                           foreach ($membership_options as $options) {
                                               ?>
<!--                                        <div class="checkbox">
                                            <label>
                                                <input optinval="<?php echo $options['option_price']; ?>" type="checkbox" class="optionValue" value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_name']; ?>"><?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?>
                                            </label>
                                        </div>-->
                                    <?php // } ?>

<!--                                    <h3>Total Amount : $ <span id="amountspan"></span></h3>
                                    <input type='hidden' name="amount" id="packagetotal" value="">-->
                                <?php // } ?>


                                <?php
                                if (isset($options_id) && $options_id != '') {
                                    $sum_price = 0;
//                                if (isset($networkmembership_options) && $networkmembership_options != '') {
                                    foreach ($options_id as $options) {
                                        $option_info = $this->MembersModel->get_option_info_by_id($options);
                                        $sum_price = $sum_price + $option_info[0]['option_price']
//                                        print_r($networkmembership_options[0]);
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input getradiocheck="0" optinval="<?php echo $option_info[0]['option_price']; ?>" type="checkbox" checked="" style="height: 0px;"
                                                       class="networkoptionValue" value="<?php echo $option_info[0]['option_id']; ?>" name="<?php echo $option_info[0]['option_name'];?>">
                                                
                                                    <?php echo $option_info[0]['option_name']; ?> - $ <?php echo $option_info[0]['option_price']; ?>
                                            </label>
                                        </div>
                                    <?php } ?>

                                    <?php // foreach ($mem_opt as $opt) { ?>
<!--                                        <div class="radio">
                                            <label class="radio-inline">
                                                <input getradiocheck="1" optinval="<?php echo $opt['option_price']; ?>" class="networkoptionValue" value="<?php echo $opt['option_id']; ?>" type="radio" name="optionradio">
                                                <?php echo $opt['option_name']; ?> - $ <?php echo $opt['option_price']; ?>
                                            </label>
                                        </div>-->
                                    <?php // } ?>

                                    <h3>Total Amount : $ <span id="showamountspan"><?php echo $sum_price;?></span></h3>
                                    <input type='hidden' name="amount" id="packagetotalamount" value="">
                                    <input type="hidden" name="preval" value="" class="preValue">
                                    <input type="hidden" name="option_id" value="" class="option_id">
                                <?php }else{?>
                                    <?php
                                       if (isset($membership_options) && $membership_options != '') {
                                           foreach ($membership_options as $options) {
                                               ?>
                                        <div class="checkbox">
                                            <label><input optinval="<?php echo $options['option_price']; ?>" type="checkbox" class="optionValue" style="height: 0px;"
                                                          value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_name']; ?>">
                                                              
                                                              <?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?></label>
                                        </div>
                                    <?php } ?>

                                    <h3>Total Amount : $ <span id="amountspan"></span></h3>
                                    <input type='hidden' name="amount" id="packagetotal" value="">
                                <?php } ?>
                                    
                                <?php
                                if (isset($networkmembership_options) && $networkmembership_options != '') {
                                    foreach ($networkmembership_options as $options) {
                                        ?>
                                        <div class="checkbox">
                                            <label>
                                                <input getradiocheck="0" optinval="<?php echo $options['option_price']; ?>" type="checkbox" class="networkoptionValue" style="height: 0px;" 
                                                          value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_name']; ?>">
                                                    
                                                    <?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?>
                                            </label>
                                        </div>
                                    <?php } ?>

                                    <?php foreach ($mem_opt as $opt) { ?>
                                        <div class="radio">
                                            <label class="radio-inline">
                                                <input getradiocheck="1" optinval="<?php echo $opt['option_price']; ?>" class="networkoptionValue" style="height: 0px;" 
                                                                               value="<?php echo $opt['option_id']; ?>" type="radio" name="optionradio">
                                                        <?php echo $opt['option_name']; ?> - $ <?php echo $opt['option_price']; ?>
                                            </label>
                                        </div>
                                    <?php } ?>

                                    <h3>Total Amount : $ <span id="showamountspan"></span></h3>
                                    <input type='hidden' name="amount" id="packagetotalamount" value="">
                                    <input type="hidden" name="preval" value="" class="preValue">
                                    <input type="hidden" name="option_id" value="" class="option_id">
                                <?php } ?>
                                    
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <input type="submit" id="m_regi_submit" value="Register" class="btn btn-info btn-block" style="padding: 10px">

            </form>
        </div>
    </div>
</section>
<!-- .about-text-->

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
                // m_address2: {
                //required: true
                //},
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

<script>
    $(document).ready(function () {
        $('.optionValue').click(function () {
            var optvalue = $(this).attr("optinval");
            var priValue = $("#amountspan").text();
            if (priValue != '') {
                var totalAmount = (+priValue) + (+optvalue);
                $("#amountspan").text(totalAmount);
                $('#packagetotal').val(totalAmount);
            } else {
                $("#amountspan").text(optvalue);
                $('#packagetotal').val(optvalue);
            }
        });
    });

    $('#afflipackage').click(function (e) {
        e.preventDefault();
        var check = $("input[type='checkbox']:checked");
        var checkval = check.val();
        // var radio = $("input[type='radio']:checked");
        // var rdata = radio.val();
        // alert(checkval);
        var option_id = checkval;
        $('.option_id').val(option_id);
        $('form#payforaffi').submit();
    });
</script>

<script>
    $(document).ready(function () {
        $('.networkoptionValue').click(function () {
            var radioYes = $(this).attr("getradiocheck");
            var optvalue = $(this).attr("optinval");

            //if radio clicked
            if (radioYes == 1) {
                //check pre radio value
                var hidprice = $('.preValue').val();
                //first time radio pre value is empty
                var priValue = $("#showamountspan").text();

                if (hidprice == '') {
                    if (priValue != '') {
                        var totalAmount = (+priValue) + (+optvalue);
                        $("#showamountspan").text(totalAmount);
                        $('#packagetotalamount').val(totalAmount);
                        $('.preValue').val('');
                        $('.preValue').val(optvalue);
                    } else {
                        $("#showamountspan").text(optvalue);
                        $('#packagetotalamount').val(optvalue);
                    }
                } else {
                    //radio has pre value 
                    if (priValue != '') {
                        var tAmount = (+priValue) + (-hidprice);
                        var totalAmount = tAmount + (+optvalue);
                        $("#showamountspan").text(totalAmount);
                        $('#packagetotalamount').val(totalAmount);
                        $('.preValue').val('');
                        $('.preValue').val(optvalue);
                    } else {
                        $("#showamountspan").text(optvalue);
                        $('#packagetotalamount').val(optvalue);
                    }

                }

            } else {
                //if radio not clicked
                var priValue = $("#showamountspan").text();
                if (priValue != '') {
                    var totalAmount = (+priValue) + (+optvalue);
                    $("#showamountspan").text(totalAmount);
                    $('#packagetotalamount').val(totalAmount);
                } else {
                    $("#showamountspan").text(optvalue);
                    $('#packagetotalamount').val(optvalue);
                }
            }

        });
    });

    $('#network_package').click(function (e) {
        e.preventDefault();
        var check = $("input[type='checkbox']:checked");
        var checkval = check.val();
        // var radio = $("input[type='radio']:checked");
        // var rdata = radio.val();
        // alert(checkval);
        //alert(rdata);
        var option_id = checkval;
        $('.option_id').val(option_id);
        $('form#networkcustompage').submit();
    });
</script>