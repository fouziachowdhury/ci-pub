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
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-xs-12 col-md-4">
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
            <div class="col-xs-12 col-md-4">
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
            <div class="col-xs-12 col-md-4">
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

</script>