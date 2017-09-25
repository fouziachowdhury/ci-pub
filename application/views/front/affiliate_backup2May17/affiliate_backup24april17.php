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
    <div class="container">
        <div class="row" style="text-align: center;">
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Super Affiliate Package</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>$185/month</h1>
                           <p>This Package Include Everything</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>superpackageforaffiliate/185" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Custom Package</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                           <p>This Package Set with custom offers such as</p>
                           <ul>
                               <?php foreach($membership_options as $option) { ?>
                               <li><?php echo $option['option_name']; ?></li>
                               <?php } ?>
                           </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>custompackageforaffiliate" class="btn btn-success" role="button">Active Package</a>
                    </div>
                </div>
            </div>
            
        </div> 
    </div>
</section>
<!-- .about-text-->

<!------------FOR COUNT PAGE VIEW ---------------->
<script>
   $(document).ready(function(){
         $.ajax({
            type:'POST',
            url: '<?php echo base_url()?>pagecount',
            data:{'page_id':1},
            success:function(data){
            }
        });
   });

</script>