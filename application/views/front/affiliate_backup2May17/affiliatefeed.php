<div class="row">
    <div id="all_time" style="display: block;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
    <div class="row" style="margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>BANNERS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
        </div>
    </div>
    <div class="row" style="margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 40px">
        <div class="col-lg-3 col-md-4 col-xs-6">
            CATEGORY : 
            <select style="width: 156px; height: 25px; margin-top: 7px;">
                <option>All</option>
                <?php foreach ($allcategory as $category) { ?>
                    <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
            COUNTRY : 
            <select style="width: 168px; height: 25px; margin-top: 7px;">
                <option>All</option>
                <?php foreach ($allcountry as $country) { ?>
                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-lg-2 col-md-3 col-xs-5">
            TAG : 
            <select style="width: 106px; height: 25px; margin-top: 7px;">
                <option>All</option>
                <?php foreach ($alltag as $tag) { ?>
                    <option value="<?php echo $tag['id']; ?>"><?php echo $tag['keyword_tags']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-lg-4 col-md-5 col-xs-7">
            SORT : 
            <select style="width: 182px; height: 25px; margin-top: 7px;">
                <option value="1">NEWEST</option>
                <option value="2">OLDEST</option>

            </select>
            <button style="height: 29px;margin-top: 5px; float: right" class="btn btn-success">FILTER</button>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 15px;">
            <div class="row" style="background: #fff; border: 1px solid #ddd;">
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a class="thumbnail" href="#">
                        <img class="img-responsive" src="<?php echo base_url() ?>assets/front/images/affliate/affiliate.jpg" alt="">
                    </a>
                </div>
                <div class="col-lg-9 col-md-8 col-xs-6 thumb">
                    <div class="row" style="width: 100%; margin-top:10px">
                        <h4>Famous TV Doctor Outsmarts Plastic Surgeons <span style="float: right;margin:3px; font-size: 10px;">Date Added : 3/18/2017</span></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-10" style="border: 1px solid #ddd;">
                            <p>http://localhost/publyfe-test/affiliatefeed</p>
                        </div>
                        <div class="col-md-2">
                            <button style="height: 31px;float: right; width: 119px;" class="btn btn-primary">VIEW</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <p>Category : Skincare</p>
                            <p>Two other landing page found on this domain</p>
                        </div>
                        <div class="col-md-5">
                            <p>Found Running On : Facebook Ads</p>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class="row thumb" style="margin-top: 10px;margin-right: -7px;">
                        <div style="border: 1px solid #ddd;width: 100%; background: #F6F6F6;">
                            <?php //if (in_array($banners['banner_id'], $favbanner)) { ?>
                                <span><i class="fa fa-heart" aria-hidden="true" style="color: red; margin:7px"></i> ADD TO FAVORITES</span>
                            <?php //} else { ?>
<!--                                <a href="<?php echo base_url() ?>makebannerfavorites/<?php echo $banners['banner_id']; ?>"><i class="fa fa-heart" aria-hidden="true" style="color: blue; float: right;margin:7px"></i> ADD TO FAVORITES</a>-->
                            <?php //} ?>
                            <span style="margin-left: 30px;" id="nativcommnets11" nativaddsid="1" data-toggle="modal" data-target="#commentmodal"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#3079C8"></i> <?php echo count($allcomments); ?> COMMENTS</span>
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
        <div class="clearfix"></div> 

        <div class="row text-center"><button class="btn btn-success" style="width: 210px; height: 30px;">LOAD MORE</button></div><br>
    </div>


</div><!--/span-->
</div><!--/span-->
</div><!--/span-->
</div><!--/span-->
<!-------------MODAL------------>
<div class="modal fade" tabindex="-1" role="dialog" id="commentmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form action="<?php echo base_url() ?>addComments" method="post" class="form-horizontal" id="commentForm" role="form"> 
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="form-group">
                        <label for="email" class="control-label" style="margin-left: 14px;font-size: 18px; font-weight: bold;">COMMENT</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" name="comment" id="addComment" rows="5"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="option_id" value="2">
                    <input type="hidden" name="adds_id" id="addsId" value="">
                    <div class="form-group">
                        <div class="col-sm-10">                    
                            <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><i class="fa fa-paper-plane" aria-hidden="true"></i> POST</button>
                        </div>
                    </div>            
                </form>
                <div class="media-body">
                    <?php foreach ($allcomments as $comm) { ?>
                        <div class="well well-lg">
                            <span class="media-heading text-uppercase reviews" style="color: #000;font-weight: bold;"><?php echo $comm['name']; ?></span><span style="float: right;"><?php echo $comm['date']; ?></span>
                            <p class="media-comment">
                                <?php echo $comm['comment']; ?>
                            </p>
                        </div>    
                    <?php } ?>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(document).on('ready', function () {
        $('.kv-gly-star').rating({
            containerClass: 'is-star'
        });
    });


    $('#nativcommnets11').click(function () {
        var adds_id = $(this).attr('nativaddsid');
        $('#addsId').val(adds_id);

        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').focus()
        })
    });


</script>
