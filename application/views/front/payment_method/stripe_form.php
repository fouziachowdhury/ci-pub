<link href="<?php echo base_url(); ?>assets/front/css/template/templatestyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/mainstyle.css" rel="stylesheet">
<section class="single-page-title">
    <div class="container text-center">
        <h2>Stripe</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-md-6 main-div" style="">
                <form action="/create_subscription.php" method="POST">
                    <script
                        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
                        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                        data-amount="999"
                        data-name="Emma's Farm CSA"
                        data-description="Subscription for 1 weekly box"
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
</section>