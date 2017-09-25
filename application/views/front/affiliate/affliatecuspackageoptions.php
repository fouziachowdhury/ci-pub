<section class="single-page-title">
    <div class="container text-center">
        <h2>Affiliate</h2>
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
            <button style="float:right; margin-bottom: 15px;margin-bottom: 15px; background: #D22A4E; height: 45px; width: 120px; border-radius: 17px;" type=""><a style="color: #fff;" href="<?php echo base_url() ?>affiliate"><i class="fa fa-undo" aria-hidden="true"></i> Back</a></button>
            <form method="post" action="<?php echo base_url()?>payforaffiliate" id="payforaffi">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <?php foreach ($membership_options as $options) { ?>
                            <div class="checkbox">
                                <label><input optinval="<?php echo $options['option_price']; ?>" type="checkbox" class="optionValue" value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_id']; ?>" <?php if(isset($choose_option_id)) { foreach($choose_option_id as $opt){ if($options['option_id'] == $opt){ echo "checked"; } } }?>><?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?></label>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <?php if(isset($choose_amount) && $choose_amount !=''){?>
                        <h3>Total Amount : $ <span id="amountspan"><?php echo $choose_amount; ?></span></h3>
                         <input type='hidden' name="amount" id="packagetotal" value="<?php echo $choose_amount; ?>">
                        <?php } else { ?>
                        <h3>Total Amount : $ <span id="amountspan"></span></h3>
                         <input type='hidden' name="amount" id="packagetotal" value="">
                        <?php } ?>
                       
                    </div>
                    <input type="hidden" name="option_id" value="" class="option_id">
                    <input type="submit" id="afflipackage" value="Accept Package" class="btn btn-info" style="border-radius: 6%; margin-top: 40px;">
                </div>
            </form>

        </div> 
    </div>
</section>
<!-- .about-text-->
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
    
  $('#afflipackage').click(function(e){
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
