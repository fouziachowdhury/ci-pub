<style>

    /**** Content ****/

    #contentrs {
        padding: 10px 10px 10px 17px;
        /*padding: 10px 10px 10px 210px; */
    }



    .demosrs #copy,
    .docs #contentrs {
        max-width: 640px;
    }

    .docs #contentrs h2 {
        border-top: 2px solid #FFF;
        padding-top: 10px;
    }

    .docs #contentrs h2:target { 
        background: #D26;
        color: white;
        padding: 10px 5px 5px;
    }


    /**** Transitions ****/

    .transitions-enabled.masonry,
    .transitions-enabled.masonry .masonry-brick {
        -webkit-transition-duration: 0.7s;
        -moz-transition-duration: 0.7s;
        -ms-transition-duration: 0.7s;
        -o-transition-duration: 0.7s;
        transition-duration: 0.7s;
    }

    .transitions-enabled.masonry {
        -webkit-transition-property: height, width;
        -moz-transition-property: height, width;
        -ms-transition-property: height, width;
        -o-transition-property: height, width;
        transition-property: height, width;
    }

    .transitions-enabled.masonry  .masonry-brick {
        -webkit-transition-property: left, right, top;
        -moz-transition-property: left, right, top;
        -ms-transition-property: left, right, top;
        -o-transition-property: left, right, top;
        transition-property: left, right, top;
    }


    /* disable transitions on container */
    .transitions-enabled.infinite-scroll.masonry {
        -webkit-transition-property: none;
        -moz-transition-property: none;
        -ms-transition-property: none;
        -o-transition-property: none;
        transition-property: none;
    }
    .col3 {
        width: 271px;
    }
    .col1 { width: 80px; }
    .col2 { width: 180px; }
    .col3 { width: 235px; }
    .col4 { width: 380px; }
    .col5 { width: 480px; }

    .col1 img { max-width: 80px; }
    .col2 img { max-width: 180px; }
    .col3 img { max-width: 218px; }
    .col4 img { max-width: 380px; }
    .col5 img { max-width: 480px; }
    .box {
        margin: 5px;
        padding: 5px;
        background: #fff; 
        font-size: 11px;
        line-height: 1.4em;
        float: left;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 1px solid #ddd
    }
    .cleardiv {clear: both;}
</style>

<!---------------------------LIGHT GALLERY MASTER----------------------------->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/lightbox/dist/css/lightbox.min.css">
<script src="<?php echo base_url() ?>assets/front/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>


<div class="row demosrs" id='showbannerdata'>
    <section id="contentrs">
        <div id="container" class="clearfix" style="/*background: #FFF; */ padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <?php
            if (!empty($allbanners)) {
                foreach ($allbanners as $banners) {                    
                    //$flag = str_replace(' ', '-', $banners['country_image']); 
                    //$flag = $banners['country_image'];
                    ?>
                    <?php
                    $categoryArray = explode(',', $banners['cat_id']);
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
                    $countryArray = explode(',', $banners['country_id']);
                    $getcountry = $this->LandingModel->getcountryinfo($countryArray);
                    //print_r($getcountry); exit;
                    $coun = '';
                    foreach ($getcountry as $ccc) {
                        $coun[] = $ccc['country_name'];
                        $counImg[] = $ccc['country_image'];
                    }
                    $countryName = implode(", ", $coun);
                    $countryImg = implode(", ", $counImg);
                    ?>
                    <div class="box photo col3" style="">
                        <a class="thumbnail example-image-link" href="<?php echo base_url() ?>uploads/banner_images/<?php echo $banners['image']; ?>" data-lightbox="example-set" data-title="Category : <?php echo $catName; ?><br> Country : <?php echo $countryName; ?><br>Size : <?php echo $banners['width']; ?> - <?php echo $banners['height']; ?>">
                            <img class="example-image" src="<?php echo base_url() ?>uploads/banner_images/<?php echo $banners['image']; ?>" alt="">
                        </a>
                        <span style="color: #3079C8; text-align: center; margin-left: 70px; font-size: 14px; font-weight: bold;"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> DOWNLOAD</span><br>
                        <span style="">Category : <?php echo $catName; ?></span>
                        <span style="font-size: 10px;" onclick="showcommentbox('<?php echo $banners['banner_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $banners['banner_id']; ?>" data-toggle="modal" data-target="#bannercommentmodal"><i class="fa fa-comment-o" aria-hidden="true" style="color:#3079C8"></i>  <?php //echo count($allcomments);            ?></span>
                        <div class="modal fade" tabindex="-1" role="dialog" id="bannercommentmodal"></div>
                        <span style="float: right;margin-top: 5px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo $countryImg; ?>"></span>
                        <?php if (in_array($banners['banner_id'], $favbanner)) { ?>
                            <span><i class="fa fa-heart" aria-hidden="true" style="color: red; margin:7px"></i></span>
                        <?php } else { ?>
                            <a href="<?php echo base_url() ?>makebannerfavorites/<?php echo $banners['banner_id']; ?>/1"><i class="fa fa-heart" aria-hidden="true" style="color: blue; margin:7px"></i></a>
                        <?php } ?>

                        <!--                        </div>-->
                    </div>
                    <?php
                }
            } else {
                ?>
                <div>
                    <h3 style="color:red">There is no data according your criteria !!!!</h3>
                </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div> <br><br>
        </div>
        <script src="<?php echo base_url() ?>assets/front/masonry/js/jquery-1.7.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/front/masonry/jquery.masonry.min.js"></script>
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



