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
    .col3 img { max-width: 263px; }
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
<div class="row demosrs" id='showbannerdata'>
    <section id="contentrs">
        <div id="container" class="clearfix" style="background: #FFF; padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <?php
            $clear = "";
            if(!empty($allnativadds)){
            foreach ($allnativadds as $nativadd) {
                $flag = str_replace(' ','-',$nativadd['country_image']);
                ?>
                <div class="box photo col3 " style="">
                    <a class="thumbnail example-image-link" href="<?php echo base_url()?>uploads/native_images/<?php echo $nativadd['image']; ?>" data-lightbox="example-set" data-title="Category : <?php echo $nativadd['cat_name']; ?><br> Country : <?php echo $nativadd['country_name']; ?><br>Size : <?php echo $nativadd['width'];?> - <?php echo $nativadd['height'];?>">
                        <img class="example-image" src="<?php echo base_url()?>uploads/native_images/<?php echo $nativadd['image']; ?>" alt="">
                    </a>
                    <div style="">
                        <h4 style="margin: 5px; color: #0000FF; font-weight: bold;"><i class="fa fa-tags" aria-hidden="true"></i> <?php echo $nativadd['headline']; ?></h4>
                        <span style="color: #3079C8; text-align: right"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> DOWNLOAD</span>
                        <span style="margin-left: 30px;" id="nativcommnets" nativaddsid="<?php echo $nativadd['native_id']; ?>" data-toggle="modal" data-target="#nativcommentmodal"><i class="fa fa-commenting-o" aria-hidden="true" style="color:#3079C8"></i> <?php //echo count($allcomments);    ?> COMMENTS</span>
                        <?php if (in_array($nativadd['native_id'], $favbanner)) { ?>
                         <span><i class="fa fa-heart" aria-hidden="true" style="color: red; float: right;margin:7px"></i></span>
                        <?php } else { ?>
                        <a href="<?php echo base_url() ?>makenativaddsfavorites/<?php echo $nativadd['native_id']; ?>/<?php echo $optionid->option_id; ?>"><i class="fa fa-heart" aria-hidden="true" style="color: blue; float: right;margin:7px"></i></a>
                        <?php } ?>
                        <span style="float: right;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo $flag; ?>"></span>
                    </div>
                </div>
            <?php } 
            } else { ?>
            <div>
                <h3 style="color:red">There is no data according your criteria !!!!</h3>
            </div>
            <?php } ?>
        </div>
        <div class="clearfix"></div> <br><br>
        </div>
        <script src="<?php echo base_url() ?>assets/front/masonry/js/jquery-1.7.1.min.js"></script>
        <script src="<?php echo base_url() ?>assets/front/masonry/jquery.masonry.min.js"></script>

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
        </script>



