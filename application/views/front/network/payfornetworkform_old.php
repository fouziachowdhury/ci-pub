<section class="single-page-title">
    <div class="container text-center">
        <h2>Network</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
    <section class="section-title">
        <div class="container">
            <h3>You are choosing the Custom Network Package</h3>
            <p>And the options and price are : </p>
            <ol>
                <?php foreach ($optionname as $rrr) { ?>
                    <li><?php echo $rrr['option_name']; ?> - $ <?php echo $rrr['option_price']; ?></li>
                <?php } ?>
            </ol>
            <h4>And Total Price is : $ <?php echo $amount; ?></h4>
        </div>
        <div class="container text-left">
            <h3><i class="fa fa-money" aria-hidden="true"></i> Pay Network Package Fee with.... </h3>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4"></div>
            <div class="col-md-4 col-xs-4 col-sm-4">
                <form class="paypal" action="https://www.sandbox.paypal.com" method="post" id="paypal_form" target="_blank">
                    <input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="business" value="<?php echo $email; ?>" />
                    <input type="hidden" name="fee_amount" value="<?php echo $amount; ?>" />
                    <input type="hidden" name="a3" value="<?php echo $amount; ?>">
                    <input type="hidden" name="quantity" value="1" />
                    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                    <input type="hidden" name="no_note" value="1" />
                    <input type="hidden" name="lc" value="UK" />
                    <input type="hidden" name="currency_code" value="USD"/>
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                    <input type="hidden" name="custom" value="<?php echo $custom; ?>/<?php echo $option_id; ?>">
                    <input type="hidden" name="user_name" value="<?php //echo $user_name;   ?>" />
                    <input type="hidden" name="item_name" value="<?php //echo $paypalfor;  ?>" />
                     <input type="hidden" name="option_id" value="<?php echo $option_id; ?>">
                    <input type="hidden" name="notify_url" value="https://rs7.beshijoss.com/publyfe/paypal_notification">
                    <input type="hidden" name="return" value="https://rs7.beshijoss.com/publyfe/paypal_return_notify">
                    <input type="hidden" name="cancel_return" value="https://rs7.beshijoss.com/publyfe/paypal_cancle_notify">
                    <input style="margin-top: 2px;height: 30px;" type="image" name="submit" src="https://www.paypalobjects.com/webstatic/en_AU/i/buttons/btn_paywith_primary_s.png" alt="PayPal - The safer, easier way to pay online" style=" margin-top: -15px;">
                </form>  
<!--                                    <button class="btn btn-warning" style="border-radius: 6%;"><a id="paypalA" mem_name ="" mem_email="" href="<?php echo base_url() ?>paypalform/0">Via Paypal</a></button>-->
            </div>
            <div class="col-md-4 col-xs-4 col-sm-4">
                <form id="stripeA" action="<?php echo base_url() ?>paymentwithstripe" method="POST">
                    <input type="hidden" name="plan_name" value="Custom Network Package">
                    <input type="hidden" name="plan_id" value="custom-network-monthly">
                    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <?php foreach ($optionname as $rrr) { ?>
                        <input type="hidden" name="option_id[]" value="<?php echo $rrr['option_id']; ?>">
                        <input type="hidden" name="option_price[]" value="<?php echo $rrr['option_price']; ?>">
                    <?php }?>
                    <input type="hidden" name="option_id1" value="">
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