<link href="<?php echo base_url(); ?>assets/front/css/template/templatestyle.css" rel="stylesheet">
<section class="single-page-title">
    <div class="container text-center">
        <h2>Network</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
    <section class="section-title">
        <div class="container text-left">
            <h3><i class="fa fa-check" aria-hidden="true"></i>Select Section For Access</h3>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <button style="float:right; margin-bottom: 15px; background: #D22A4E; height: 45px; width: 120px; border-radius: 17px;" type=""><a style="color: #fff;" href="<?php echo base_url() ?>network"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button>
            <form method="post" id="networkcustompage" action="<?php echo base_url()?>payfornetwork">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <?php foreach ($membership_options as $options) { ?>
                            <div class="checkbox">
                                <label><input optinval="<?php echo $options['option_price']; ?>" class="optionValue" type="checkbox" value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_id']; ?>"><?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?></label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <h3>Total Amount : $ <span id="showamountspan"></span></h3>
                        <input type='hidden' name="amount" id="packagetotalamount" value="">
                    </div>
                    <input type="submit" id="network_package" value="Accept Package" class="btn btn-info" style="border-radius: 6%;">
                </div>
            </form>

        </div> 
    </div>
</section>
<!-- .about-text-->
<script>
    $(document).ready(function () {
        $('.optionValue').click(function () {
            alert('fouzia');
            var optvalue = $(this).attr("optinval");
            var priValue = $("#showamountspan").text();
            alert(optvalue);
            alert(priValue);
            if (priValue != '') {
                var totalAmount = (+priValue) + (+optvalue);
                alert(totalAmount);
                $("#showamountspan").text(totalAmount);
                $('#packagetotalamount').val(totalAmount);
            } else {
                alert('elseeeeee');
                $("#showamountspan").text(optvalue);
                $('#packagetotalamount').val(optvalue);
            }
        });
    });
</script>