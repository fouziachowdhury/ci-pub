
                <?php
                foreach ($alllandingpageinfo as $landing) {
                    ?>
                    <!--                                <div class="white-box">-->
                    <div class="col-md-6" style="margin: 5px;width: 48%; margin-bottom: 25px;">
                        <div class="row" style="background: #fff; border: 1px solid #ddd;">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12"> 
                                    <a class="thumbnail" href="#"><img class="img-responsive" src="<?php echo $landing['zip_file_name']; ?>" alt=""></a>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h5>Title of the website</h5>
                                    <div class="table-responsive" style="border: 1px solid #ddd; margin-right: 3px; margin-left: -11px;">
                                        <table id="myTable" class="table table-striped" style="font-size: 12px;">
                                            <thead>
                                            </thead>
                                            <tbody>
                                                <tr><td style="text-align: center; padding: 6px 6px;"><a href="<?php echo $landing['url']; ?>" target="_blank">VIew Page</a></td></tr>
                                                <tr><td style="padding: 6px 6px;">Category :<?php
                                                        $categoryArray = explode(',', $landing['cat_id']);
                                                        $getcategory = $this->LandingModel->getcategoryinfo($categoryArray);
                                                        $string = '';
                                                        foreach ($getcategory as $cat) {
                                                            $string[] = $cat['cat_name'];
                                                        }
                                                        echo implode(", ", $string);
                                                        ?>
                                                    </td></tr>
                                                <tr><td style="padding: 6px 6px;">Country : 
                                                        <?php
                                                        $countryArray = explode(',', $landing['country_id']);
                                                        $getcountry = $this->LandingModel->getcountryinfo($countryArray);
                                                        //print_r($getcountry); exit;
                                                        $coun = '';
                                                        foreach ($getcountry as $ccc) {
                                                            $coun[] = $ccc['country_name'];
                                                        }
                                                        echo implode(", ", $coun);
                                                        ?>
                                                    </td></tr>
                                                <tr><td style="padding: 6px 6px;">Tag : 
                                                        <?php
                                                        $keyArray = explode(',', $landing['keyword']);
                                                        $getkeyword = $this->LandingModel->getkeywordinfo($keyArray);
                                                        $k = '';
                                                        foreach ($getkeyword as $kkk) {
                                                            $k[] = $kkk['keyword_tags'];
                                                        }
                                                        //print_r($k); 
                                                        $tags = implode(", ", $k);
                                                        if (isset($tags)) {
                                                            echo $tags;
                                                        }
                                                        ?></td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        <span style="font-size: 10px;" onclick="showcommentbox('<?php echo $landing['landing_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $landing['landing_id']; ?>" data-toggle="modal" data-target="#commentmodal"><i class="fa fa-comment-o" aria-hidden="true" style="color:#3079C8"></i> Comments <?php //echo count($allcomments);         ?></span>
                                        <div class="modal fade" tabindex="-1" role="dialog" id="commentmodal"></div>
                                        <?php if (in_array($landing['landing_id'], $favbanner)) { ?>
                                            <span style="font-size: 10px;"><i class="ti-heart"></i>Add To Favorite</span>
                                        <?php } else { ?>
                                            <a style="font-size: 10px;" href="<?php echo base_url() ?>makebannerfavorites/<?php echo $landing['landing_id']; ?>/13"><i class="ti-heart"></i>Add To Favorite</a>
    <?php } ?>

                                        <span style="margin-left: 7px;font-size: 10px;"> <a download="<?php echo $landing['zip_file_name']; ?>" href="<?php echo $landing['zip_file_name']; ?>" title="ImageName"><i class="ti-cloud-down"></i> Download</a></span>
                                    </div> 
                                </div>
                            </div>
                            <h4 style="text-align: center;font-weight: bold;">

                            </h4>


                        </div>
                    </div>
                    <!--                                     </div>-->
<?php } ?>
                <div class="clearfix"></div>
                <div class="row text-center"><button loadbtn="2" class="btn btn-success show_more" style="width: 210px; height: 30px;">LOAD MORE</button></div>