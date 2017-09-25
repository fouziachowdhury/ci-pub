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
                    <form action="<?php echo base_url() ?>landingsearch" method="post" name="landing_search">
                    <div class="col-lg-3 col-md-4 col-xs-6">
                        CATEGORY : 
                        <select style="width: 156px; height: 25px; margin-top: 7px;" name="cat_name">
                            <option>All</option>
                            <?php foreach ($allcategory as $category) { ?>
                                <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-xs-6">
                        COUNTRY : 
                        <select style="width: 168px; height: 25px; margin-top: 7px;" name="country_name">
                            <option>All</option>
                            <?php foreach ($allcountry as $country) { ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-xs-5">
                        TAG : 
                        <select style="width: 106px; height: 25px; margin-top: 7px;" name="keyword_tags">
                            <option>All</option>
                            <?php foreach ($alltag as $tag) { ?>
                                <option value="<?php echo $tag['id']; ?>"><?php echo $tag['keyword_tags']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-5 col-xs-7">
                        SORT : 
                        <select style="width: 182px; height: 25px; margin-top: 7px;" name="sorting">
                            <option value="1">NEWEST</option>
                            <option value="2">OLDEST</option>

                        </select>
                        <button type="submit" style="height: 29px;margin-top: 5px; float: right" class="btn btn-success">FILTER</button>
                    </div>
                </form>
                </div>
                <div class="row">
                    <?php
                    foreach ($alllandingpageinfo as $landing) {
                        // echo '<pre>';
                        //print_r($alllandingpageinfo);
                        ?>
                        <div class="col-md-6" style="margin: 5px;width: 48%; margin-bottom: 25px;">
                            <div class="row" style="background: #fff; border: 1px solid #ddd;">
                                <?php
                                $keyArray = explode(',', $landing['keyword']);
                                $getkeyword = $this->LandingModel->getkeywordinfo($keyArray);
                                ?>
                                <h4 style="text-align: center;font-weight: bold;">
                                    <?php
                                    $k = '';
                                    foreach ($getkeyword as $kkk) {
                                        echo $k = '*' . $kkk['keyword_tags'];
                                    }
                                    ?>
                                </h4>
                                <a class="thumbnail" href="#">
                                    <img class="img-responsive" src="<?php echo $landing['zip_file_name']; ?>" alt="">
                                </a>
                                <div style="border: 1px solid #ddd;width: 100%; background: #F6F6F6;">
                                    <?php if (in_array($landing['landing_id'], $favbanner)) {    ?>
                                    <span><i class="fa fa-heart" aria-hidden="true" style="color: red; margin:7px"></i></span>
                                    <?php } else {    ?>
                                   <a href="<?php echo base_url() ?>makebannerfavorites/<?php echo $landing['landing_id']; ?>/13"><i class="fa fa-heart" aria-hidden="true" style="color: blue; margin:7px"></i></a>
                                    <?php }    ?>
                                    <span style="" onclick="showcommentbox('<?php echo $landing['landing_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $landing['landing_id']; ?>" data-toggle="modal" data-target="#commentmodal"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#3079C8"></i> <?php //echo count($allcomments);      ?></span>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="commentmodal"></div>
                                    <span style="margin-left: 7px;"> <a download="<?php echo $landing['zip_file_name']; ?>" href="<?php echo $landing['zip_file_name']; ?>" title="ImageName"><i class="fa fa-cloud-download" style="color:red"></i></a></span>
                                    <?php
                                    $countryArray = explode(',', $landing['country_id']);
                                    $getcountry = $this->LandingModel->getcountryinfo($countryArray);
                                    foreach ($getcountry as $ccc) {  ?>
                                        <span style="float: right; margin: 5px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo $ccc['country_image']; ?>"></span>
                                    <?php } ?>
                                    <span style="float: right; margin: 5px;">Category : 
                                        <?php
                                        $categoryArray = explode(',', $landing['cat_id']);
                                        $getcategory = $this->LandingModel->getcategoryinfo($categoryArray);
                                        foreach ($getcategory as $cat) {  ?>
                                            <span class="label label-info m-r-10">
                                                <?php echo $cat['cat_name']; ?>
                                            </span>
                                        <?php } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                   <div class="row text-center"><button loadbtn="2" class="btn btn-success show_more" style="width: 210px; height: 30px;">LOAD MORE</button></div>
                </div>
            </div><!--/span-->
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->


<script type="text/javascript">
    function showcommentbox(adds_id) {
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
