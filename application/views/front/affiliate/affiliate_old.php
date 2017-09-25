<section class="single-page-title">
    <div class="container text-center">
        <h2>Affiliate</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
    <section class="section-title">
        <div class="container text-center">
            <h2>Packages</h2>
            <span class="bordered-icon"><i class="fa fa-circle-thin"></i></span>
        </div>
    </section>
    <div class="alert alert-success alert-dismissable" id="packagesuccess" style="display:none;width: 80%; margin: 0 auto;margin-bottom: 20px;">
        <i class="fa fa-check-square-o"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="showmessage"></div>
    </div>
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-xs-8 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Free Trial</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>Free</h1>
                            <p>This Package Include Everything Based On Criteria</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                         <?php if (isset($_SESSION['member_id']) && $_SESSION['member_id'] != '') { ?>
                            <a href="" onclick="affiliatefree()" class="btn btn-success" role="button">Active Package</a></div>
                    <?php } else { ?>
                        <a href="<?php echo base_url() ?>freepack/1" class="btn btn-success" role="button">Active Package</a></div>
                <?php } ?>
                </div>
            </div>
            <div class="col-xs-8 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $superpackageinfo->option_name; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>$ <?php echo $superpackageinfo->option_price; ?>/month</h1>
                            <p>This Package Include Everything</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url() ?>superpackageforaffiliate/185" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            <div class="col-xs-8 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Custom Package</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p>This Package Set with custom offers such as</p>
                            <ul>
                                <?php foreach ($membership_options as $option) { ?>
                                    <li><?php echo $option['option_name']; ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url() ?>custompackageforaffiliate" class="btn btn-success" role="button">Active Package</a>
                    </div>
                </div>
            </div>

        </div> 
    </div>
</section>
<!-- .about-text-->

<!------------FOR COUNT PAGE VIEW ---------------->
<script>
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>pagecount',
            data: {'page_id': 1},
            success: function (data) {
            }
        });
    });

    function affiliatefree() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>activefreepackage',
            data: {
                'package_id': 1,
                'package': 'Affiliate'
            },
            success: function (data) {
                console.log(data);
                var hhh = JSON.parse(data);
                console.log(hhh);
                $('#showmessage').html(hhh.insertmessage);
                $("#packagesuccess").show();
                //setTimeout(function(){ 
                 // $("#packagesuccess").hide();   
              //}, 180000);
            }
        });
    }
</script>