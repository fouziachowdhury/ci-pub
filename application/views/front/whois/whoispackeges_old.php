<section class="single-page-title">
    <div class="container text-center">
        <h2>Whois</h2>
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
    <div class="alert alert-success alert-dismissable" id="packagewhoissuccess" style="display:none;width: 80%; margin: 0 auto;margin-bottom: 20px;">
        <i class="fa fa-check-square-o"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <div id="showwhoismessage"></div>
    </div>
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Free Trial</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <p>This Package Include Everything Based On Criteria</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                          <?php if (isset($_SESSION['member_id']) && $_SESSION['member_id'] != '') { ?>
                        <a href="" onclick="whoisfree()" class="btn btn-success" role="button">Active Package</a>
                        <?php } else { ?>
                        <a href="<?php echo base_url() ?>freepack/3" class="btn btn-success" role="button">Active Package</a>
                        <?php } ?>
                        </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $whoisS->option_name; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>$ <?php echo $whoisS->option_price; ?></h1>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>activewhoissilver/<?php echo $whoisS->option_price;?>" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $whoisG->option_name; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>$ <?php echo $whoisG->option_price; ?></h1>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>activewhoisgold/<?php echo $whoisG->option_price; ?>" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $whoisP->option_name; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>$ <?php echo $whoisP->option_price; ?></h1>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>activewhoisplatinum/<?php echo $whoisP->option_price; ?>" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
        </div> 
    </div>
</section>
<!-- .about-text-->
<script>
   $(document).ready(function(){
         $.ajax({
            type:'POST',
            url: '<?php echo base_url()?>pagecount',
            data:{'page_id':3},
            success:function(data){
            }
        });
   });

function whoisfree() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>activefreepackage',
            data: {
                'package_id': 3,
                'package': 'Whois'
            },
            success: function (data) {
                console.log(data);
                var hhh = JSON.parse(data);
                console.log(hhh);
                $('#showwhoismessage').html(hhh.insertmessage);
                $("#packagewhoissuccess").show();
                //setTimeout(function(){ 
                 // $("#packagesuccess").hide();   
              //}, 180000);
            }
        });
    }
</script>