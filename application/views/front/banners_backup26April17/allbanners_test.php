<style>

    /**** Content ****/

    #contentrs {
        padding: 10px 10px 10px 210px;
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
    width: 280px;
}
.col1 { width: 80px; }
.col2 { width: 180px; }
.col3 { width: 280px; }
.col4 { width: 380px; }
.col5 { width: 480px; }

.col1 img { max-width: 80px; }
.col2 img { max-width: 180px; }
.col3 img { max-width: 280px; }
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
</style>
<div class="demosrs" id='showbannerdata'>
    <section id="contentrs">
        <div id="container" class="clearfix" style="background: #FFF;
             padding: 5px;
             margin-bottom: 20px;
             border-radius: 5px;
             clear: both;
             -webkit-border-radius: 5px;
             -moz-border-radius: 5px;
             border-radius: 5px;">
             <?php
             foreach ($allbanners as $key => $banners) {
                 ?>
                <div class="box photo col3">
                    <a href="<?php echo $banners['image']; ?>">
                        <img src="<?php echo $banners['image']; ?>" alt="">
                    </a>
                </div> 
            <?php } ?>
        </div>
</div>


</div><!--/span-->
</div><!--/span-->
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
<script>
    $(document).ready(function () {
        $(document).on('click', '.show_more', function () {
            var ID = $(this).attr('loadbtn');
            $('.show_more').hide();
            //$('.loding').show();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>loadmorebanners',
                data: 'last_limit=' + ID,
                success: function (html) {
                    console.log(html);
                    var hhh = JSON.parse(html);
                    console.log(hhh);
                    $('#showbannerdata').html(html);
                }
            });
        });
    });
</script>


