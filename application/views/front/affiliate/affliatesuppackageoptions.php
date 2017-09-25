<link href="<?php echo base_url(); ?>assets/front/css/template/templatestyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/mainstyle.css" rel="stylesheet">
<section class="single-page-title">
    <div class="container text-center">
        <h2>Affiliate</h2>
    </div>
</section>
<!-- .page-title -->

<section class="about-text ptb-100">
    <section class="section-title">
        <div class="container">
            <h3>You are choosing the Super Affiliate Package</h3>
            <h4>And Total Price is : $ <?php echo $this->uri->segment('2'); ?></h4>
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
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4"><h3><i class="fa fa-money" aria-hidden="true"></i> Pay Membership Fee with.... </h3></div>
                <div class="col-md-4 col-xs-4 col-sm-4">
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="business" value="fouzia@sahajjo.com">
                        <input type="hidden" name="cmd" value="_xclick-subscriptions">
                        <input type="hidden" name="item_name" value="<?php echo $item_name; ?>">
                        <input type="hidden" name="item_number" value="DIG Weekly">
                        <input type="hidden" name="currency_code" value="USD">
                        <input type="hidden" name="notify_url" value="https://rs7.beshijoss.com/publyfe/paypal_notification">
                        <input type="hidden" name="return" value="https://rs7.beshijoss.com/publyfe/paypal_return_notify">
                        <input type="hidden" name="cancel_return" value="https://rs7.beshijoss.com/publyfe/paypal_cancle_notify">
                        <input type="hidden" name="a3" value="<?php echo $amount; ?>">
                        <input type="hidden" name="p3" value="1">
                        <input type="hidden" name="t3" value="M">
                        <input type="hidden" name="custom" value="<?php echo $custom; ?>/<?php echo $package_id; ?>/<?php echo $option_id; ?>">
                        <input type="hidden" name="fee_amount" value="<?php echo $amount; ?>" />
                        <input type="hidden" name="src" value="1">
                        <input type="hidden" name="sra" value="1">
                        <input type="image" name="submit"
                               src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png" alt="Subscribe"><img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                    </form>
                </div>
                <div class="col-md-4 col-xs-4 col-sm-4">
                    <form id="stripeA" action="<?php echo base_url() ?>supaffpaymentwithstripe" method="POST">
                        <input type="hidden" name="plan_name" value="Super Affiliate">
                        <input type="hidden" name="plan_id" value="super-affiliate-monthly">
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                        <input type="hidden" name="email" value="<?php echo $email; ?>">
                        <input type="hidden" name="option_id[]" value="<?php echo $option_id; ?>">
                        <input type="hidden" name="option_price[]" value="<?php echo $this->uri->segment('2'); ?>">
                        <input type="hidden" name="option_id1" value="">
                        <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_ceRV8tlLuX6Iw1k6rnuXWcEp"
                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                            data-amount="999"
                            data-name="Publyfe"
                            data-description="Super Affiliate Package"
                            data-amount="2000"
                            data-label="Pay With Stripe!"
                            data-locale="auto"
                            data-zip-code="true"
                            data-notrack>
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- .about-text-->