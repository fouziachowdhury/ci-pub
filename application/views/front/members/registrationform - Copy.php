<section class="single-page-title">
    <div class="container text-center">
        <h2>Registration Form</h2>
    </div>
</section>
<!-- .page-title -->

<section class="about-text ptb-100">
    <section class="section-title">
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
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <textarea rows="4" cols="50" placeholder="Address" name="m_address" class="form-control input-sm"></textarea>
                        </div>
                    </div>
                </div>

                <input type="submit" id="m_regi_submit" value="Register" class="btn btn-info btn-block">

            </form><br><br>
            <div class="panel-group" id="accordion">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a  data-toggle="collapse" data-parent="#accordion" data-target="#membership">
                                Upgrade Membership
                            </a>
                        </h4>
                    </div>
                    <div id="membership" class="panel-collapse collapse">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-xs-1 col-sm-1 col-md-1">

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <h3><i class="fa fa-check" aria-hidden="true"></i> Select What Do You Want In Package Membership.</h3>
                                    <?php foreach ($membership_options as $options) { ?>
                                        <div class="checkbox">
                                            <label><input optinval="<?php echo $options['option_price']; ?>" class="optionValue" type="checkbox" value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_id']; ?>"><?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?></label>
                                        </div>
                                    <?php } ?>

                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <h3>Total Amount : $ <span id="amountspan"></span></h3>
                                </div>
                            </div><br><br>
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4"><h3><i class="fa fa-money" aria-hidden="true"></i> Pay Membership Fee with.... </h3></div>
                                <div class="col-md-4 col-xs-4 col-sm-4">
                                    <form class="paypal" action="https://www.sandbox.paypal.com" method="post" id="paypal_form" target="_blank">
                                        <input type="hidden" name="cmd" value="_xclick" />
                                        <input type="hidden" name="business" value="<?php //echo $business_email;  ?>" />
                                        <input type="hidden" name="item_price" value="<?php echo $amount; ?>" />
                                        <input type="hidden" name="quantity" value="1" />
                                        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                                        <input type="hidden" name="no_note" value="1" />
                                        <input type="hidden" name="lc" value="UK" />
                                        <input type="hidden" name="currency_code" value="USD"/>
                                        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                                        <input type="hidden" name="custom" value="<?php //echo $custom;  ?>">
                                        <input type="hidden" name="user_name" value="<?php //echo $user_name;  ?>" />
                                        <input type="hidden" name="item_name" value="<?php echo $paypalfor; ?>" />
                                        <input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>">
                                        <input type="hidden" name="return" value="<?php echo $paypal_return_notify; ?>">
                                        <input type="hidden" name="cancel_return" value="<?php echo $paypal_cancle_notify; ?>">
                                        <input style="margin-top: 2px;height: 30px;" type="image" name="submit" src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_s.png" alt="PayPal - The safer, easier way to pay online" style=" margin-top: -15px;">
                                    </form>  
                    <!--                                    <button class="btn btn-warning" style="border-radius: 6%;"><a id="paypalA" mem_name ="" mem_email="" href="<?php echo base_url() ?>paypalform/0">Via Paypal</a></button>-->
                                </div>
                                <div class="col-md-4 col-xs-4 col-sm-4">
                                    <form id="stripeA" action="<?php echo base_url()?>paymentwithstripe/100" method="POST">
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_04crfWc6kiCcto4wovQT8u6y"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-amount="999"
                                            data-name="Publyfe"
                                            data-description="Membership Fee"
                                            data-amount="2000"
                                            data-label="Pay With Stripe!"
                                            data-locale="auto"
                                            data-zip-code="true"
                                            data-notrack>
                                        </script>
                                    </form>
<!--<button class="btn btn-warning" style="border-radius: 6%;"><a id="stripeA" mem_name ="" mem_email="" href="<?php echo base_url() ?>stripeform/0">Via Stripe</a></button>-->
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div><br><br>
            <div id="membership" class="collapse"></div>

        </div>
    </div>

</section>
<!-- .about-text-->

<script type="text/javascript">

    jQuery().ready(function () {

// validate form on keyup and submit
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

    $('.optionValue').click(function () {
        var optvalue = $(this).attr("optinval");
        var priValue = $("#amountspan").text();
        if (priValue != '') {
            var totalAmount = (+priValue) + (+optvalue);
            $("#amountspan").text(totalAmount);
        } else {
            $("#amountspan").text(optvalue);
        }

        setpaypalhref();
        setstripehref();
    });

    function setpaypalhref() {
        var tValue = $("#amountspan").text();
        if (tValue != '') {
            var newhref = "<?php echo base_url() ?>paypalform/" + tValue;
            $("#paypalA").attr("href", newhref);
        } else {
            // alert('emptyyyyyyyyyyyyy');
        }
    }

    function setstripehref() {
        var tValue = $("#amountspan").text();
        alert(tValue);
        if (tValue != '') {
            var newhref = "<?php echo base_url() ?>paymentwithstripe/" + tValue;
            alert(newhref);
             $("#stripeA").attr("action", newhref);
        } else {
            // alert('emptyyyyyyyyyyyyy');
        }
    }
</script>  