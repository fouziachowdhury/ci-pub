<section class="single-page-title">
    <div class="container text-center">
        <h2>Affiliate</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
    <section class="section-title">
        <div class="container">
            <h3>You are choosing the Custom Affiliate Package</h3>
            <p>And the options and price are : </p>
            <ol>
                <?php foreach ($optionname as $rrr) { ?>
                    <li><?php echo $rrr['option_name']; ?> - $ <?php echo $rrr['option_price']; ?></li>
                <?php } ?>
            </ol>
            <h4>And Total Price is : $ <?php echo $amount; ?></h4>
        </div>
        <div class="container text-left">
            <h3><i class="fa fa-money" aria-hidden="true"></i> Pay Affiliate Package Fee with.... </h3>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4"></div>
            <div class="col-md-4 col-xs-4 col-sm-4">
               <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="business" value="fouzia@sahajjo.com">
                    <input type="hidden" name="cmd" value="_xclick-subscriptions">
                    <input type="hidden" name="item_name" value="<?php echo $item_name; ?>">
                    <input type="hidden" name="item_number" value="DIG Weekly">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="notify_url" value="http://localhost/publyfe-test/paypal_notification">
                    <input type="hidden" name="return" value="http://localhost/publyfe-test/paypal_return_notify">
                    <input type="hidden" name="cancel_return" value="http://localhost/publyfe-test/paypal_cancle_notify">
                    <input type="hidden" name="a3" value="<?php echo $amount; ?>">
                    <input type="hidden" name="p3" value="1">
                    <input type="hidden" name="t3" value="M">
                    <input type="hidden" name="custom" value="<?php echo $custom; ?>">
                    <input type="hidden" name="src" value="1">
                    <input type="hidden" name="sra" value="1">
                    <input type="image" name="submit"
                           src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_subscribe_113x26.png" alt="Subscribe"><img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                </form>
            </div>
            <div class="col-md-4 col-xs-4 col-sm-4">
                <form id="stripeA" action="<?php echo base_url() ?>paymentwithstripe" method="POST">
                    <input type="hidden" name="plan_name" value="Custom Affiliate Package">
                    <input type="hidden" name="plan_id" value="custom-affiliate-monthly">
                    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
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
</section>
<!-- .about-text-->