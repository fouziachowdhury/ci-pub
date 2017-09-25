<div class="col-md-10" style="background: #F6F6F6;">
    <div class="row" style="margin-left: 4px; margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>SETTINGS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
        </div>
    </div>

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
                        <a href="<?php echo base_url()?>selectnetworkpackageoption/499" class="btn btn-success" role="button">Active Package</a></div>
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
 <!-- .about-text-->
</div>
</div>

</div><!--/span-->
</div><!--/span-->

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