<div class="col-md-10" style="background: #F6F6F6;">
    <div class="row" style="margin-left: 4px; margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>BANNERS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
        </div>
    </div>
    <div class="row" style="margin-left: 4px;margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 40px">
        <div class="col-lg-6 col-md-8 col-xs-8">
            SEARCH : 
            <input type="text" name="directory_search" class="input-lg" style="height: 34px;margin-top: 2px;width: 316px;">
        </div>
        <div class="col-lg-4 col-md-5 col-xs-7">
            SORT : 
            <select style="width: 182px; height: 25px; margin-top: 7px;">
                <option>NEWEST</option>
                <option>OLDEST</option>   
            </select>
            <button style="height: 29px;margin-top: 5px; float: right" class="btn btn-success">FILTER</button>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 15px;">
            <div class="row" style="background: #fff; border: 1px solid #ddd;">
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php echo base_url()?>assets/front/images/affliate/affiliate.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-9 col-md-8 col-xs-6 thumb">
                    <div class="row" style="width: 100%; margin-top:10px">
                        <div class="col-md-6">
                             <h4>AFFILIATE NETWORK NAME HERE </h4>
                             <p>Affiliate description goes here. Affiliate description goes here.</p>
                             <p>Affiliate description goes here.</p>
                        </div>
                        <div class="col-md-3" style="float: right">
                            <h2 style="font-weight: bold;">4.94</h2>
                            <input type="text" class="kv-gly-star rating rating-loading" value="2" data-size="xs" title="">
                            <button style="height: 31px;float: right; width: 119px;" class="btn btn-primary">VIEW MORE</button>
                        </div>
                    </div>
                 
                    <div class="row thumb" style="margin-top: 10px;margin-right: -7px;">
                            <div style="border: 1px solid #ddd;width: 100%; background: #F6F6F6;">
                                <span><i class="fa fa-heart" aria-hidden="true" style="color: red;margin:3px;"></i> ADD TO FAVORITES</span>
                                <span style="margin-left: 30px;"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#3079C8"></i> (2) COMMENTS</span>
                                <span style="margin-left: 30px;"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color:#449D44"></i> DOMAIN INFO</span>
                                <span style="margin-left: 30px;"><i class="fa fa-cloud-download" aria-hidden="true" style="color:red"></i> DOWNLOAD</span>
                              
                                <span style="float: right; margin-left: 5px; margin-right: 5px"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/Canada.png"></span>
                                <span style="float: right; margin-left: 5px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/Australia.png"></span>
                                <span style="float: right;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/United-States.png"></span>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center"><button class="btn btn-success" style="width: 210px; height: 30px;">LOAD MORE</button></div><br>
    </div>
</div>

</div><!--/span-->
</div><!--/span-->
<script>
    $(document).on('ready', function () {
        $('.kv-gly-star').rating({
            containerClass: 'is-star'
        });
    });
    </script>


