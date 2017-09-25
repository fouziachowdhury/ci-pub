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
            <form method="post" id="networkcustompage" action="<?php echo base_url() ?>payfornetwork">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <?php foreach ($membership_options as $options) { ?>
                            <div class="checkbox">
                                <label><input getradiocheck="0" optinval="<?php echo $options['option_price']; ?>" class="optionValue" type="checkbox" value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_id']; ?>"><?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?></label>
                            </div>
                        <?php } ?>
                        <?php foreach ($mem_opt as $opt) { ?>
                            <div class="radio">
                                <label class="radio-inline"><input getradiocheck="1" optinval="<?php echo $opt['option_price']; ?>" class="optionValue" value="<?php echo $opt['option_id']; ?>" type="radio" name="optionradio"><?php echo $opt['option_name']; ?> - $ <?php echo $opt['option_price']; ?></label>
    <!--                                <label><input optinval="<?php echo $options['option_price']; ?>" class="optionValue" type="checkbox" value="<?php echo $options['option_id']; ?>" name="<?php echo $options['option_id']; ?>"><?php echo $options['option_name']; ?> - $ <?php echo $options['option_price']; ?></label>-->
                            </div>
                        <?php } ?>

                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4">
                        <h3>Total Amount : $ <span id="showamountspan"></span></h3>
                        <input type='hidden' name="amount" id="packagetotalamount" value="">
                    </div>
                    <input type="submit" id="network_package" value="Accept Package" class="btn btn-info" style="border-radius: 6%;">
                </div>
                <input type="hidden" name="preval" value="" class="preValue">
                <input type="hidden" name="option_id" value="" class="option_id">
            </form>

        </div> 
    </div>
</section>
<!-- .about-text-->
<script>
    $(document).ready(function () {
        $('.optionValue').click(function () {
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
    
    $('#network_package').click(function(e){
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