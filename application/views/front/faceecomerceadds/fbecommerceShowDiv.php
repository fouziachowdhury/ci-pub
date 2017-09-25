<style>
    .cursoricon { cursor: pointer; cursor: hand;}
    .cursoricon a:hover { cursor: pointer; cursor: hand;}

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
<div class="row demosrs" id='showbannerdata'>
    <section id="contentrs">
        
        <input type="hidden" id="cat_id" value="<?php echo $this->session->userdata('cat_id'); ?>">
        <input type="hidden" id="country_id" value="<?php echo $this->session->userdata('country_id'); ?>">
        <input type="hidden" id="searchval" value="<?php echo $this->session->userdata('searchval'); ?>">
        <input type="hidden" id="searchkey" value="<?php echo $this->session->userdata('searchkey'); ?>">
        
        <div id="container" class="clearfix" style="padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; padding-top: 10px;">
            <div class="row">
                <?php
                if (!empty($allfbeco)) {
                    foreach ($allfbeco as $fbeco) {
                        //echo '<pre>';
                        // print_r($fbeco); 
                        ?>
                        <?php
                        $categoryArray = explode(',', $fbeco['cat_id']);
                        $getcategory = $this->LandingModel->getcategoryinfo($categoryArray);
                        //print_r($getcategory); exit; 
                        $string = array();
                        foreach ($getcategory as $cat) {
                            $string[] = $cat['cat_name'];
                        }
                        //print_r($string); exit;
                        $catName = implode(", ", $string);
                        ?>
                        <?php
                        if (strpos($fbeco['country_id'], ',') !== false) {
                            $countryArray = explode(',', $fbeco['country_id']);
                            $getcountry = $this->LandingModel->getcountryinfo($countryArray);
                            $coun = '';
                            $counImg = '';
                            foreach ($getcountry as $ccc) {
                                $coun[] = $ccc['country_name'];
                                $counImg[] = $ccc['country_image'];
                            }
                            $countryName = implode(", ", $coun);
                            $countryImg = implode(", ", $counImg);
                        } else {
                            $getcountry = $this->LandingModel->getcountryimageinfo($fbeco['country_id']);
                            $countryImg = $getcountry->country_image;
                            $countryName = $getcountry->country_name;
                        }
                        ?>

                        <?php
                        $keywordArray = explode(',', $fbeco['keyword']);
                        $getkeyword = $this->LandingModel->getkeywordinfo($keywordArray);
                        //print_r($getkeyword); exit; 
                        $string = array();
                        foreach ($getkeyword as $key) {
                            $string[] = $key['keyword_tags'];
                        }
                        //print_r($string); exit;
                        $key = implode(", ", $string);
                        ?>
                        <div class="col-md-6" style="">
                            <div class="col-md-12" style="height: auto;background: #fff; margin-bottom: 17px;">
                            <?php if ($fbeco['facebook_image'] != '') { ?>
                                <a class="thumbnail example-image-link" href="<?php echo base_url() ?>uploads/facebook_images/<?php echo $fbeco['facebook_image']; ?>" data-lightbox="example-set" data-title="Category : <?php echo $catName; ?><br> Country : <?php echo $countryName; ?>">
                                    <img class="example-image" src="<?php echo base_url() ?>uploads/facebook_images/<?php echo $fbeco['facebook_image']; ?>" alt="">
                                </a>
                                <?php
                            } else {?>
                                <div class="col-md-12">
                                    <?php echo $fbeco['embedded_code']; ?> 
                                </div>
                            <?php }?>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        Category : 
                                            <?php
                                        if (isset($fbeco['cat_id'])) {
                                            $categoryArray = explode(',', $fbeco['cat_id']);
                                            foreach ($categoryArray as $category){
                                                if(isset($category)){
                                                    $getcategory = $this->LandingModel->getcategoryinfo($category);
//                                                                print_r($country);
                                                }
                                                ?>
                                                <a onclick="searchbycategory('<?php echo $category;?>')" style="cursor: pointer">
                                                    <?php if(isset($getcategory[0])){echo $getcategory[0]['cat_name'] . ',';}?>
                                                </a>
                                            <?php }
                                             }
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <span style="float: right;">Tags : 
                                            <?php
                                            if (isset($fbeco['keyword'])) {
                                                $keyArray = explode(',', $fbeco['keyword']);
                                                foreach ($keyArray as $key){
                                                    if(isset($key)){
                                                    $getkeyword = $this->LandingModel->get_keyword_by_key($key,4);
                                                    }
                                                    ?>
                                                    <a onclick="search_by_tag('<?php echo $key;?>')" style="cursor: pointer">
                                                        <?php if(isset($getkeyword[0])){echo $getkeyword[0]['keyword_tags'] . ',';}?>
                                                    </a>
                                            <?php }}?>
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <span class="cursoricon" style="font-size: 10px;" onclick="showcommentbox('<?php echo $fbeco['fb_ecom_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $fbeco['fb_ecom_id']; ?>" data-toggle="modal" data-target="#bannercommentmodal"><img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;">  Comments</span>
                                    <div class="modal fade" tabindex="-1" role="dialog" id="bannercommentmodal"></div>
                                    <?php if (in_array($fbeco['fb_ecom_id'], $favbanner)) { ?>
                                        <span class="cursoricon"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px;"></i> Favorite</span>
                                    <?php } else { ?>
                                        <a class="cursoricon" href="<?php echo base_url() ?>makebannerfavorites/<?php echo $fbeco['fb_ecom_id']; ?>/4"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px;"></i>  Add To Favorite</a>
                                    <?php } ?>
                                    <?php
                                    if (strpos($countryImg, ',') !== false) {
                                        $couimg = explode(',', $countryImg);
                                        ?>
                                        <span style="float: right;margin-top: 5px; margin-right: 8px;">
                                            <?php foreach ($couimg as $cimg) { ?>
                                                <img style="width:17px;" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo trim($cimg); ?>">
                                            <?php } ?>
                                        </span>
                                    <?php } else { ?>
                                        <span style="float: right;margin-top: 5px; margin-right: 8px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo trim($countryImg); ?>"></span>

                                    <?php } ?>  


                                </div>
                            </div>
                        </div>
                        </div>
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
        <div class="clearfix"></div> <br><br>
        </div>

        <script>
            $(function () {
                var $container = $('#container');
                $container.imagesLoaded(function () {
                    $container.masonry({
                        itemSelector: '.box'
                    });
                });

            });
        </script>



