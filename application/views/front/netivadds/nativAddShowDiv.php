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
    .col3 img { max-width: 260px; }
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
        border:1px solid #ddd
    }

    .cleardiv {clear: both;}
    .cursoricon a:hover { cursor: pointer; cursor: hand;}
    #landingcommbtn:hover { cursor: pointer; cursor: hand;}
    
    .lb-data .lb-number {display:none !important;}
    .lb-data {color: #000 !important; padding: 7px !important;}
    .lb-dataContainer { background:#fff;}
    
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


<div class="alert alert-danger" id="downloaderror" style="display:none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Danger!</strong> You have cross your limit of download this add. Renew your package Now.
</div>

<div class="row demosrs" id='showbannerdata'>
    <section id="contentrs">
        
        <input type="hidden" id="cat_id" value="<?php echo $this->session->userdata('cat_id'); ?>">
        <input type="hidden" id="country_id" value="<?php echo $this->session->userdata('country_id'); ?>">
        <input type="hidden" id="width" value="<?php echo $this->session->userdata('width'); ?>">
        <input type="hidden" id="height" value="<?php echo $this->session->userdata('height'); ?>">
        <input type="hidden" id="searchval" value="<?php echo $this->session->userdata('searchval'); ?>">
        
        <div id="container" class="clearfix" style="padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <?php
            $clear = "";
            if (!empty($allnativadds)) {
                foreach ($allnativadds as $nativadd) {
                    // $flag = str_replace(' ', '-', $nativadd['country_image']);
                    ?>
                    <?php
                    $categoryArray = explode(',', $nativadd['cat_id']);
                    $getcategory = $this->LandingModel->getcategoryinfo($categoryArray);
                    $string = array();
                    foreach ($getcategory as $cat) {
                        $string[] = $cat['cat_name'];
                    }
                    $catName = implode(", ", $string);
                    ?>
                   <?php
                    if (strpos($nativadd['country_id'], ',') !== false) {
                     $countryArray = explode(',', $nativadd['country_id']);
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
                        $getcountry = $this->LandingModel->getcountryimageinfo($nativadd['country_id']);
                        $countryImg = $getcountry->country_image;
                        $countryName = $getcountry->country_name;
                    }
                    ?>
                    <?php
                    $heidingArray = explode(',', $nativadd['headline']);
//                    print_r($heidingArray);
                    $getheading = $this->NativaddModel->getHeading($heidingArray);
                    $head = '';
                    foreach ($getheading as $hhh) {
                        $head[] = $hhh['headline'];
                    }
                    $headingName = implode(", ", $head);
                    ?>
                    <div class="box photo col3 " style="">
                        <a class="thumbnail example-image-link" href="<?php echo base_url() ?>uploads/native_images/<?php echo $nativadd['image']; ?>" data-lightbox="example-set" data-title="Category : <?php echo $catName; ?><br> Country : <?php echo $countryName; ?><br> Headline : <?php echo $headingName; ?><br>Size : <?php echo $nativadd['width']; ?> - <?php echo $nativadd['height']; ?>">
                            <img class="example-image" src="<?php echo base_url() ?>uploads/native_images/<?php echo $nativadd['image']; ?>" alt="">
                        </a>
                        <div style="">
                            <h4 style="margin: 5px; color: #0000FF; font-weight: bold;"> <?php echo $headingName; ?></h4>
                           <span class="cursoricon" style="color: #3079C8; text-align: center; margin-left: 70px; font-size: 14px; font-weight: bold;">
                                <a class ="downloadclass" onclick="bannerdownload('<?php echo $nativadd['native_id']; ?>')" data-toggle="tooltip" data-placement="bottom" title="Download"><img src="<?php echo base_url() ?>assets/icon/download.png" style="width: 16px;"></a>
                            </span>
                            <a hidden id="download_<?php echo $nativadd['native_id']?>" onclick="bannimgdown('<?php echo $nativadd['native_id']?>')" download="<?php echo $nativadd['image']; ?>" href="<?php echo base_url() ?>uploads/native_images/<?php echo $nativadd['image']; ?>" title="ImageName">
                                <img src="<?php echo base_url() ?>assets/icon/download.png" style="width: 16px;">
                            </a>
                              <input type="hidden" id="bannerid_<?php echo $nativadd['native_id']?>" name="banneridtext" value="<?php echo $nativadd['native_id']; ?>">
                            
		                    <span style="font-size: 10px;" onclick="showcommentbox('<?php echo $nativadd['native_id']; ?>');" 
                                    id="landingcommbtn" landingddsid="<?php echo $nativadd['native_id']; ?>" data-toggle="modal" data-target="#native_comment_modal">
                                  
                                <img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;">  
                            </span>
                              
                            <!-- Comments Modal -->
                              
                              <div class="modal fade" tabindex="-1" role="dialog" id="native_comment_modal"></div>
                            
                            <!-- Comments Modal End -->
                              
                            <?php if (in_array($nativadd['native_id'], $favbanner)) { ?>
                                <span><img src="<?php echo base_url()?>assets/icon/favorites.png" style="color:red;width: 16px; margin-left: 8px; margin-right: 8px;"></span>
                            <?php } else { ?>
                                <a href="<?php echo base_url() ?>makenativaddsfavorites/<?php echo $nativadd['native_id']; ?>/<?php echo $optionid->option_id; ?>">
                                    <img data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url()?>assets/icon/favorites.png" style="width: 16px; margin-left: 8px; margin-right: 8px;">
                                    </i>
                                </a>
                            <?php } ?>
                            <?php
                            if (strpos($countryImg, ',') !== false) {
                                $couimg = explode(',', $countryImg);
                                ?>
                                <span style="float: right;margin-top: 5px;">
                                    <?php foreach ($couimg as $cimg) { ?>
                                        <img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo trim($cimg); ?>">
                                <?php } ?>
                                </span>
                            <?php } else { ?>
                                <span style="float: right;margin-top: 5px;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo trim($countryImg); ?>"></span>

                            <?php } ?> 
                        </div>
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
    </section>
        <?php echo $this->ajax_pagination->create_links(); ?>
        <div class="clearfix"></div> <br><br>
        </div>
        

        <!-------------MODAL------------>
        <div class="modal fade" tabindex="-1" role="dialog" id="nativcommentmodal">
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
                            <input type="hidden" name="option_id" value="<?php echo $optionid->option_id; ?>">
                            <input type="hidden" name="adds_id" id="addsId" value="">
                            <div class="form-group">
                                <div class="col-sm-10">                    
                                    <button style="width: 68px;" class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><i class="fa fa-paper-plane" aria-hidden="true"></i> POST</button>
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

            $('#nativcommnets').click(function () {
                var adds_id = $(this).attr('nativaddsid');
                $('#addsId').val(adds_id);

                $('#nativcommentmodal').on('shown.bs.modal', function () {
                    $('#myInput').focus()
                })
            });
            
             function bannerdownload(item_id) {
                var option_id = 2;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>downloadcheck',
                    data: {
                        'item_id': item_id,
                        'option_id': option_id
                    },
                    success: function (result) {
                        var hhh = JSON.parse(result);
                        if (hhh.downloadresult == 1) {
                            var bannerimage = hhh.bannerimage;
                            var bannerimagehref = "<?php echo base_url() ?>uploads/banner_images/" + bannerimage;
                            document.getElementById('download_' + item_id).click();

                        } else if (hhh.downloadresult == 0) {
                            $('#downloaderror').show();
                            setInterval(function () {
                                $('#downloaderror').hide();
                            }, 50000);

                        }
                    }
                });
            }

            function bannimgdown(item_id) {
                var bannerid = $("#bannerid_" + item_id).val();
                var option_id = 2;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>downloadnumberadd',
                    data: {
                        'item_id': bannerid,
                        'option_id': option_id
                    },
                    success: function (result) {
                        console.log(result);
                    }
                });
            }
        </script>



