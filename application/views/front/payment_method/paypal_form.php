<link href="<?php echo base_url(); ?>assets/front/css/template/templatestyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/mainstyle.css" rel="stylesheet">
<section class="single-page-title">
    <div class="container text-center">
        <h2>PayPal</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
<div class="container">
   <div class="row">
    <div class="col-md-6 main-div" style="">
                <form class="paypal" action="https://www.sandbox.paypal.com" method="post" id="paypal_form" target="_blank">
                    <input type="hidden" name="cmd" value="_xclick" />
                    <input type="hidden" name="business" value="<?php //echo $business_email; ?>" />
                    <input type="hidden" name="item_price" value="<?php echo $amount; ?>" />
                    <input type="hidden" name="quantity" value="1" />
                    <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
                    <input type="hidden" name="no_note" value="1" />
                    <input type="hidden" name="lc" value="UK" />
                    <input type="hidden" name="currency_code" value="USD"/>
                    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                    <input type="hidden" name="custom" value="<?php //echo $custom; ?>">
                    <input type="hidden" name="user_name" value="<?php //echo $user_name; ?>" />
                    <input type="hidden" name="item_name" value="<?php echo  $paypalfor; ?>" />
                    <input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>">
                    <input type="hidden" name="return" value="<?php echo $paypal_return_notify; ?>">
                    <input type="hidden" name="cancel_return" value="<?php echo $paypal_cancle_notify; ?>">
</br></br>
                    <input type="image" name="submit" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/gold-rect-paypal-60px.png" alt="PayPal - The safer, easier way to pay online" style=" margin-top: -15px;">
                </form>  
            </div> 
        </div> 
    </div>
    </section>