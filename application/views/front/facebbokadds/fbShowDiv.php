<style>
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
        
        <div id="container" class="clearfix" style="padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; padding-top: 10px;">
            <div class="row">
                    <?php
                    $countryId = '';
                    if (!empty($allfbadds)) {
                        foreach ($allfbadds as $allfb) {
                            if (strpos($allfb['country_id'], ',') !== false) {
                                $countryArray = explode(',', $allfb['country_id']);
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
                                $getcountry = $this->LandingModel->getcountryimageinfo($allfb['country_id']);
                                $countryImg = $getcountry->country_image;
                                $countryName = $getcountry->country_name;
                            }
                            ?>
                            <?php
                            $categoryArray = explode(',', $allfb['cat_id']);
                            $getcategory = $this->LandingModel->getcategoryinfo($categoryArray);
                            //print_r($getcategory); exit; 
                            $string = array();
                            foreach ($getcategory as $cat) {
                                $string[] = $cat['cat_name'];
                            }
//                            print_r($id); exit;
                            $catName = implode(", ", $string);
                            ?>

                            <?php
                            $keywordArray = explode(',', $allfb['keyword']);
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
                            <div class="facebook_details">
                                <div class="col-md-12" style="height: auto;background: #fff; margin-bottom: 17px;">
                            <!--<div class="col-md-12" style="overflow-x: auto;height: 400px;background: #fff; margin-bottom: 17px;">-->
                                <?php if ($allfb['facebook_image'] != '') { ?>
                                <a class="thumbnail example-image-link" href="<?php echo base_url() ?>uploads/facebook_images/<?php echo $allfb['facebook_image']; ?>" data-lightbox="example-set" data-title="Category : <?php echo $catName; ?><br> Country : <?php echo $countryName; ?>">
                                    <img class="example-image" src="<?php echo base_url() ?>uploads/facebook_images/<?php echo $allfb['facebook_image']; ?>" alt="">
                                </a>
                                <?php
                            } else {?>
                                <div class="col-md-12">
                                    <?php echo $allfb['embedded_code']; ?> 
                                </div>
                            <?php }?>            
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        Category : 
                                        <?php
                                        if (isset($allfb['cat_id'])) {
                                            $categoryArray = explode(',', $allfb['cat_id']);
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
                                    <div class="col-md-12">
                                        <span style="font-size: 10px;" onclick="showcommentbox('<?php echo $allfb['id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $allfb['id']; ?>" data-toggle="modal" data-target="#bannercommentmodal"><img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;">  Comments</span>

                                        <?php if (in_array($allfb['id'], $favbanner)) { ?>
                                            <span style="font-size: 11px;"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" style="width: 16px; margin-left: 8px; margin-right: 8px;" src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px; font-size: 11px;">Favorite</span>
                                        <?php } else {  ?>
                                            <a style="font-size: 11px;" href="<?php echo base_url() ?>makebannerfavorites/<?php echo $allfb['id']; ?>/3"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url() ?>assets/icon/favorites.png" style="width: 16px;font-size: 11px;">  Add To Favorite</a>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        Tags : 
                                            <?php
                                            if (isset($allfb['keyword'])) {
                                                $keyArray = explode(',', $allfb['keyword']);
    //                                                                print_r($keyArray);
                                                foreach ($keyArray as $key){
                                                    if(isset($key)){
    //                                                                        echo '<pre>';print_r($key);
                                                    $getkeyword = $this->LandingModel->get_keyword_by_key($key,3);
                                                    }
    //                                                                    echo '<pre>';print_r($getkeyword);
                                                    ?>
                                                    <a onclick="search_by_tag('<?php echo $key;?>')" style="cursor: pointer">
                                                        <?php if(isset($getkeyword[0])){echo $getkeyword[0]['keyword_tags'] . ',';}?>
                                                    </a>
                                            <?php }}?>
                                    </div>
                                    <div class="col-md-12">

                                        <?php
                                        if (strpos($countryImg, ',') !== false) {
                                            $couimg = explode(',', $countryImg);
                                            ?>
                                            <span style="margin-top: 5px;">
                                                <?php foreach ($couimg as $cimg) { ?>
                                                    <img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo trim($cimg); ?>">
                                                <?php } ?>
                                            </span>
                                        <?php } else { ?>
                                            <span style="margin-top: 5px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo trim($countryImg); ?>"></span>

                                        <?php } ?>
                                    </div>
                                </div>


                                <div class="modal fade" tabindex="-1" role="dialog" id="bannercommentmodal"></div>

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



