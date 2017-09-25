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
    <div class="container">
<div class="row" style="margin-left: 4px;margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 100%">
            <div class="col-xs-12 col-md-6" style="margin-top:20px">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Network</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                            <h1>$499/month</h1>
                           <p>This Package Include Everything</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>approveNetworkPackage/499" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6" style="margin-top:20px">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"> Custom Package</h3>
                    </div>
                    <div class="panel-body">
                        <div class="the-price">
                           <p>This Package Set with custom offers</p>
                           <ul>
                               <?php foreach($membership_options as $option){ ?>
                               <li><?php echo $option['option_name'];  ?> - $ <?php echo $option['option_price'];  ?></li>
                               <?php } ?>
                           </ul>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url()?>selectcustompackageoption" class="btn btn-success" role="button">Active Package</a></div>
                </div>
            </div>
            
        </div> 
            
        </div> 
</section>

<script>
   $(document).ready(function(){
         $.ajax({
            type:'POST',
            url: '<?php echo base_url()?>pagecount',
            data:{'page_id':2},
            success:function(data){
            }
        });
   });

</script>