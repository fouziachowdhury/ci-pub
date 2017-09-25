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
    .col3 { width: 280px; }
    .col4 { width: 380px; }
    .col5 { width: 480px; }

    .col1 img { max-width: 80px; }
    .col2 img { max-width: 180px; }
    .col3 img { max-width: 262px; }
    .col4 img { max-width: 380px; }
    .col5 img { max-width: 480px; }
    .box {
        margin: 5px;
        padding: 5px;
        background: #D8D5D2;
        font-size: 11px;
        line-height: 1.4em;
        float: left;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
    }
    .cleardiv {clear: both;}
</style>

<!---------------------------LIGHT GALLERY MASTER----------------------------->
<link rel="stylesheet" href="<?php echo base_url() ?>assets/front/lightbox/dist/css/lightbox.min.css">
<script src="<?php echo base_url() ?>assets/front/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>


<div class="row demosrs" id='showbannerdata'>
    <section id="contentrs">
        <div id="container" class="clearfix" style="background: #FFF; padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <?php
            if (!empty($allbanners)) {
                foreach ($allbanners as $banners){
                    $flag = str_replace(' ', '-', $banners['country_image']);
                    ?>
                    <div class="box photo col3" style="">
                        <a class="thumbnail example-image-link" href="<?php echo base_url()?>uploads/banner_images/<?php echo $banners['image']; ?>" data-lightbox="example-set" data-title="Category : <?php echo $banners['cat_name']; ?><br> Country : <?php echo $banners['country_name']; ?><br>Size : <?php echo $banners['width'];?> - <?php echo $banners['height'];?>">
                            <img class="example-image" src="<?php echo base_url()?>uploads/banner_images/<?php echo $banners['image']; ?>" alt="">
                        </a>
                        <div style="">
                            <span style="color: #3079C8; text-align: right"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> DOWNLOAD</span>
                            <?php if (in_array($banners['banner_id'], $favbanner)) { ?>
                                <span><i class="fa fa-heart" aria-hidden="true" style="color: red; float: right;margin:7px"></i></span>
                            <?php } else { ?>
                                <a href="<?php echo base_url() ?>makebannerfavorites/<?php echo $banners['banner_id']; ?>"><i class="fa fa-heart" aria-hidden="true" style="color: blue; float: right;margin:7px"></i></a>
                            <?php } ?>
                            <span style="float: right;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo $flag; ?>"></span>
                        </div>
                    </div>
                <?php }
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
            $(function (){
                var $container = $('#container');
                $container.imagesLoaded(function (){
                    $container.masonry({
                        itemSelector: '.box'
                    });
                });

            });
        </script>



