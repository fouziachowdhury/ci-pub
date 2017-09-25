<div class="row">
    <div id="all_time" style="display: block;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
                  <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('success'); ?>
                        </div>
                       <?php } ?>

                       <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('error'); ?>
                        </div>

                       <?php } ?>
                <div class="row" style="margin-top: 19px; margin-bottom: -8px;">
                    <div class="col-md-4"><h4>Landing Page</h4>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
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
                    <?php
                    foreach ($alllandingpageinfo as $landing) {
                        //$allcomments = $this->LandingModel->getlandingcomments($landing['landing_id']);
                        //echo '<pre>';  print_r($landing); 
                        ?>
                        <div class="col-md-12" style="margin-bottom: 15px;">
                            <div class="row" style="background: #fff; border: 1px solid #ddd;">
                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                    <a class="thumbnail" href="#">
                                        <img class="img-responsive" src="<?php echo $landing['zip_file_name']; ?>" alt="">
                                    </a>
                                </div>
                                <div class="col-lg-9 col-md-8 col-xs-6 thumb">
                                    <div class="row" style="width: 100%; margin-top:10px">
                                        <h4>Famous TV Doctor Outsmarts Plastic Surgeons <span style="float: right;margin:3px; font-size: 10px;">Date Added : <?php echo $landing['date']; ?></span></h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10" style="border: 1px solid #ddd;">
                                            <p> <?php
                                                if (strlen($landing['url']) > 50) {
                                                    echo substr($landing['url'], 0, 50);
                                                } else {
                                                    echo $landing['url'];
                                                }
                                                ?></p>
                                        </div>
                                        <div class="col-md-2">
                                            <button style="height: 31px;float: right; width: 119px;" class="btn btn-primary">VIEW</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <p>Category : <?php echo $landing['cat_name']; ?></p>
                                            <p>Two other landing page found on this domain</p>
                                        </div>
                                        <div class="col-md-5">
                                            <p>Found Running On : Facebook Ads</p>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                    <div class="row thumb" style="margin-top: 10px;margin-right: -7px;">
                                        <div style="border: 1px solid #ddd;width: 100%; background: #F6F6F6;">
                                            <?php //if (in_array($banners['banner_id'], $favbanner)) {  ?>
                                            <span><i class="fa fa-heart" aria-hidden="true" style="color: red; margin:7px"></i> ADD TO FAVORITES</span>
                                            <?php //} else {  ?>
            <!--                                <a href="<?php echo base_url() ?>makebannerfavorites/<?php echo $banners['banner_id']; ?>"><i class="fa fa-heart" aria-hidden="true" style="color: blue; float: right;margin:7px"></i> ADD TO FAVORITES</a>-->
                                            <?php //}  ?>
                                            <span style="margin-left: 30px;" onclick="showcommentbox('<?php echo $landing['landing_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $landing['landing_id']; ?>" data-toggle="modal" data-target="#commentmodal"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#3079C8"></i> <?php //echo count($allcomments); ?> COMMENTS</span>
                                            <div class="modal fade" tabindex="-1" role="dialog" id="commentmodal"></div>
            <!--                            <span style="margin-left: 30px;" id="nativcommnets11" nativaddsid="1" data-toggle="modal" data-target="#commentmodal"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#3079C8"></i> <?php //echo count($allcomments); ?> COMMENTS</span>-->
                                            <span style="margin-left: 30px;"><i class="fa fa-exclamation-circle" aria-hidden="true" style="color:#449D44"></i> DOMAIN INFO</span>
                                            <span style="margin-left: 30px;"><i class="fa fa-cloud-download" aria-hidden="true" style="color:red"></i> <a download="<?php echo $landing['zip_file_name']; ?>" href="<?php echo $landing['zip_file_name']; ?>" title="ImageName">DOWNLOAD</a></span>

        <!--                            <span style="float: right; margin-left: 5px; margin-right: 5px"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/Canada.png"></span>
                                    <span style="float: right; margin-left: 5px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/Australia.png"></span>-->
                                            <span style="float: right;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo $landing['country_image']; ?>"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div> 

                    <div class="row text-center"><button class="btn btn-success" style="width: 210px; height: 30px;">LOAD MORE</button></div><br>
                </div>


            </div><!--/span-->
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->


<script type="text/javascript">
    $(document).on('ready', function () {
        $('.kv-gly-star').rating({
            containerClass: 'is-star'
        });
    });

  function showcommentbox(adds_id){
        $.ajax({
            url: "<?php echo site_url('landingpagecommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 5
            },
            success: function (msg) {
                $('#commentmodal').html(msg);
                $('#commentmodal').modal('show');
                $('#com_option_id').val(5);
                $('#com_adds_id').val(adds_id);
            }
  });
  }

</script>
