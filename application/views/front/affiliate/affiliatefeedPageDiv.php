<style>
    .cursoricon a:hover { cursor: pointer; cursor: hand;}
    .favclass:hover { cursor: pointer; cursor: hand;}
    .commnetclass:hover { cursor: pointer; cursor: hand;}
    .whoisclass:hover { cursor: pointer; cursor: hand;}
    .contactclass:hover { cursor: pointer; cursor: hand;}
    
    
    .select2-container .select2-choice > .select2-chosen{
        color: #fff !important;
        font-weight: 700;
    }
    
    /* Pagination */
    div.pagination {
        font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
        padding:2px;
        margin: 20px 10px;
        float: right;
    }

    div.pagination a {
        margin: 2px;
        padding: 0.5em 0.64em 0.43em 0.64em;
        background-color: #FD1C5B;
        text-decoration: none; /* no underline */
        color: #fff;
    }
    div.pagination a:hover, div.pagination a:active {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #FD1C5B;
        color: #fff;
    }
    div.pagination span.current {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #f6efcc;
        color: #6d643c;
    }
    div.pagination span.disabled {
        display:none;
    }
    .pagination ul li{display: inline-block;}
    .pagination ul li a.active{opacity: .5;}
    
</style>
<div class="row demosrs" id='showfbaddsdata'>
    <section id="contentrs">
        
        <input type="hidden" id="cat_id" value="<?php echo $this->session->userdata('cat_id'); ?>">
        <input type="hidden" id="country_id" value="<?php echo $this->session->userdata('country_id'); ?>">
        <input type="hidden" id="searchval" value="<?php echo $this->session->userdata('searchval'); ?>">
        <input type="hidden" id="searchkey" value="<?php echo $this->session->userdata('searchkey'); ?>">
        
        <div id="container" class="clearfix" style="padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <div class="row">
                <?php
                if (!empty($allfeed)) {
                    foreach ($allfeed as $afflanding) {
                        $date = date("m-d-Y", strtotime($afflanding['date']));
                        ?>
                        <div class="row" style="background: #fff; border: 1px solid #ddd; margin: 0 auto; margin-bottom: 20px;">
                            <div class="col-md-9 col-sm-12 col-xs-12" style=" margin-bottom: 10px;"> 
                                <div class="row">
                                    <div class="col-md-3">
                                        <a class="thumbnail" style="border:none" href="#">
                                            <img style="width:200px; float: left; border: 1px solid #ddd;" class="img-responsive" src="<?php echo $afflanding['zip_file_name']; ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row" style=" margin-top:10px">
                                            <h4><?php echo $afflanding['title']; ?></h4>
                                        </div>
                                        <div class="row">
                                            <span style="float: left;">URL :</span><div class="col-md-11" style="border: 1px solid #ddd;">
                                                <p><?php echo $afflanding['url']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row thumb" style="margin-top: 10px;margin-right: -7px;">
                                            <div>
                                                <?php if (in_array($afflanding['id'], $favbanner)) { ?>
                                                    <span class="favclass" style="margin-left: 10px; font-size:10px">
                                                        <img  data-toggle="tooltip" data-placement="bottom" title="Favorites" style="width: 14px; font-size: 10px;" src="<?php echo base_url() ?>assets/icon/favorites.png"> FAVORITES
                                                    </span>
                                                <?php } else { ?>
                                                    <a class="favclass" style="font-size: 10px; margin-left: 10px; color: inherit;" href="<?php echo base_url();?>makebannerfavorites/<?php echo $afflanding['id']; ?>/6">
                                                        <img  data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url() ?>assets/icon/favorites.png" style="width: 14px;"> ADD TO FAVORITES
                                                    </a>
                                                <?php } ?>
                                                
                                                <span class="favclass" style="font-size: 10px; margin-left: 10px;" onclick="showcommentbox('<?php echo $afflanding['id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $afflanding['id']; ?>" data-toggle="modal" data-target="#feedcommentmodal">
                                                    <img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;">  COMMENTS
                                                </span>
                                                
                                                <div class="modal fade" tabindex="-1" role="dialog" id="feedcommentmodal"></div>
                                                <span class="whoisclass" style="font-size: 10px; margin-left: 10px;">
                                                    <a style="color: inherit;" href="<?php echo base_url();?>getwhoisinfo/<?php echo base64_encode($afflanding['url']); ?>" title="ImageName">
                                                        <img data-toggle="tooltip" data-placement="bottom" title="Whois" src="<?php echo base_url() ?>assets/icon/whois.png" style="width: 16px;"> WHOIS
                                                    </a>
                                                </span>
                                                
                                                <span class="contactclass" style="font-size: 10px; margin-left: 10px;"><a style="color: inherit;" href="" title="ImageName"><img data-toggle="tooltip" data-placement="bottom" title="Contact" src="<?php echo base_url() ?>assets/icon/contact.png" style="width: 16px;"> CONTACT</a></span>
                                                
                                                <span style="font-size: 10px; float: right; margin-right: 23px;"><?php echo $date; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-5 col-xs-5">
                                <div class="table-responsive" style="margin-top: 0px;padding: 14px 0;margin-right: 10px;overflow: unset;">
                                    <table id="myTable" class="table table-striped dataTable" style="font-size: 12px;margin: 0px;">
                                        <tr>
                                            <td style="text-align: center; padding: 6px 6px;">
                                                <a href="<?php echo $afflanding['url']; ?>" target="_blank">VIew Site</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 12px;">
                                                <p style="line-height: 0;margin: 0px;margin-left: 5px">Category :
                                                    <?php
                                                    if (isset($afflanding['cat_id'])) {
                                                        $categoryArray = explode(',', $afflanding['cat_id']);
                                                        foreach ($categoryArray as $category) {
                                                            if (isset($category)) {
                                                                $getcategory = $this->LandingModel->getcategoryinfo($category);
                                                            }
                                                            ?>
                                                            <a onclick="searchbycategory('<?php echo $category;?>')" style="cursor: pointer">
                                                                <?php
                                                                if (isset($getcategory[0])) {
                                                                    echo $getcategory[0]['cat_name'] . ',';
                                                                }
                                                                ?>
                                                            </a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </p>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 12px;">
                                                <p style="line-height: 0;margin: 0px;margin-left: 5px">Country : 
                                                    <?php
                                                    if (isset($afflanding['country_id'])) {
                                                        $countryArray = explode(',', $afflanding['country_id']);
                                                        foreach ($countryArray as $country) {
                                                            if (isset($country)) {
                                                                $getcountry = $this->LandingModel->getcountryinfo($country);
                                                            }
                                                            ?>
                                                            <a onclick="searchbycountry('<?php echo $country;?>')" style="cursor: pointer">
                                                                <?php
                                                                if (isset($getcountry[0])) {
                                                                    echo $getcountry[0]['country_name'] . ',';
                                                                }
                                                                ?>
                                                            </a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding: 12px;">
                                                <p style="line-height: 0;margin: 0px;margin-left: 5px">Tag : 
                                                    <?php
                                                    if (isset($afflanding['keyword'])) {
                                                        $keyArray = explode(',', $afflanding['keyword']);
                                                        foreach ($keyArray as $key) {
                                                            if (isset($key)) {
                                                                $getkeyword = $this->LandingModel->get_keyword_by_key($key, 7);
                                                            }
                                                            ?>
                                                            <a onclick="search_by_tag('<?php echo $key;?>')" style="cursor: pointer">
                                                                <?php
                                                                if (isset($getkeyword[0])) {
                                                                    echo $getkeyword[0]['keyword_tags'] . ',';
                                                                }
                                                                ?>
                                                            </a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!--                                     </div>-->
                        <?php
                    }
                } else {
                    ?>
                </div>
                <div>
                    <h3 style="color:red">There is no data according your criteria !!!!</h3>
                </div>
            <?php } ?>
        </div>
    </section>
    <?php echo $this->ajax_pagination->create_links(); ?>
        <div class="clearfix"></div>
</div>