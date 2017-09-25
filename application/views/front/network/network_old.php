<link href="<?php echo base_url(); ?>assets/front/css/template/templatestyle.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/front/css/mainstyle.css" rel="stylesheet">
<section class="single-page-title">
    <div class="container text-center">
        <h2>Network</h2>
    </div>
</section>
<!-- .page-title -->
<section class="about-text ptb-100">
    <section class="section-title">
        <div class="container text-left">
            <h3><i class="fa fa-check" aria-hidden="true"></i>Select Network Package : </h3>
        </div>
    </section>
    <div class="alert alert-success alert-dismissable" id="packagenetsuccess" style="display:none;width: 80%; margin: 0 auto;margin-bottom: 20px;">
        <i class="fa fa-check-square-o"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="shownetmessage"></div>
    </div>
    <div class="container">
        <div class="row" style="margin-left: 4px;margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 100%; text-align: center">
            <div class="col-xs-8 col-md-4" style="margin-top:20px">
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
                        <a href="" onclick="networkfree()" class="btn btn-success" role="button">Active Package</a>
                        <?php } else { ?>
                        <a href="<?php echo base_url() ?>freepack/2" class="btn btn-success" role="button">Active Package</a>
                        <?php } ?>
                   </div>
                </div>
            </div>
            <div class="col-xs-8 col-md-4" style="margin-top:20px">
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
                        <a href="<?php echo base_url() ?>approveNetworkPackage/499" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            <div class="col-xs-8 col-md-4" style="margin-top:20px">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Custom Package</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p>This Package Set with custom offers</p>
                            <ul>
                                <?php foreach ($membership_options as $option) { ?>
                                    <li><?php echo $option['option_name']; ?> - $ <?php echo $option['option_price']; ?></li>
                                <?php } ?>
                                    <?php foreach ($mem_opt as $opt) { ?>
                                    <li><?php echo $opt['option_name']; ?> - $ <?php echo $opt['option_price']; ?></li>
                                <?php } ?>
                            </ul>
                            
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url() ?>selectcustompackageoption" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>

        </div> 

    </div> 
</section>

<script>
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>pagecount',
            data: {'page_id': 2},
            success: function (data) {
            }
        });
    });

    function networkfree() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>activefreepackage',
            data: {
                'package_id': 2,
                'package': 'Netowrk'
            },
            success: function (data) {
                var hhh = JSON.parse(data);
                $('#shownetmessage').html(hhh.insertmessage);
                $("#packagenetsuccess").show();
                //setTimeout(function(){ 
                // $("#packagesuccess").hide();   
                //}, 180000);
            }
        });
    }

</script>