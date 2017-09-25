<style>
    * { box-sizing: border-box; }

    body { font-family: sans-serif; }

    /* ---- grid ---- */

    .grid {
        background: #EEE;
        max-width: 1200px;
    }

    /* clearfix */
    .grid:after {
        content: '';
        display: block;
        clear: both;
    }

    /* ---- grid-item ---- */

    .grid-sizer,
    .grid-item {
        width: 20%;
    }

    .grid-item {
        height: 120px;
        float: left;
        background: #D26;
        border: 2px solid #333;
        border-color: hsla(0, 0%, 0%, 0.5);
        border-radius: 5px;
    }

    .grid-item--width2 { width:  40%; }
    .grid-item--width3 { width:  60%; }

    .grid-item--height2 { height: 200px; }
    .grid-item--height3 { height: 260px; }
    .grid-item--height4 { height: 360px; }

    .cleardiv {clear: both;}
</style>
<div class="col-md-10" style="background: #F6F6F6;">
    <div class="row" style="margin-left: 4px; margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>BANNERS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
        </div>
    </div>
    <div class="row" style="margin-left: 4px;margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 40px">
        <form action="<?php echo base_url() ?>bannersearch" method="post" name="banner_search">
            <div class="col-lg-3 col-md-4 col-xs-6">
                CATEGORY : 
                <select style="width: 156px; height: 25px; margin-top: 7px;" name="category">
                    <option>All</option>
                    <?php foreach ($allcategory as $category) { ?>
                        <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6">
                COUNTRY : 
                <select style="width: 168px; height: 25px; margin-top: 7px;" name="country">
                    <option>All</option>
                    <?php foreach ($allcountry as $country) { ?>
                        <option value="<?php echo $country['country_id']; ?>"><?php echo $country['country_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6">
                SIZE : 
                <select style="width: 182px; height: 25px; margin-top: 7px; width: 170px;" name="size">
                    <option>All</option>
                    <?php foreach ($allsize as $size) { ?>
                        <option value="<?php echo $size['id']; ?>"><?php echo $size['weight_size']; ?> - <?php echo $size['height_size']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6" style="margin-left: -43px;">
                TAG : 
                <select style="width: 120px; height: 25px; margin-top: 7px;" name="tag">
                    <option>All</option>
                    <?php foreach ($alltag as $tag) { ?>
                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['keyword_tags']; ?></option>
                    <?php } ?>
                </select>
                <button type="submit" style="height: 29px;margin-top: 5px; float: right; width:80px" class="btn btn-success">FILTER</button>
            </div>
        </form>
    </div>
    <div class="row" id='showbannerdata'>

        <?php
        $clear = "";
        foreach ($allbanners as $key => $banners) {
            $var = (($key) % 4);
            if ($var == 0) {
                echo '<div style="clear:both;"></div>';
            } else {
                $clear = "";
            }
            ?>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb" style="background: #fff; border: 1px solid #ddd; padding-bottom: 6px; padding-top: 8px;margin-left: 10px; width: 24%; margin-bottom: 5px">
                <a class="thumbnail example-image-link" href="<?php echo $banners['image']; ?>" data-lightbox="example-set" data-title="Click the right half of the image to move forward.">
                    <img style="margin-bottom: 20px; width:240px; height:180px"class="img-responsive example-image" src="<?php echo $banners['image']; ?>" alt="">
                </a>
                <div style="border: 1px solid #ddd; width: 260px; background: #F6F6F6; margin-left: -8px;">
                    <span style="color: #3079C8; text-align: right"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> DOWNLOAD</span>
                    <?php if (in_array($banners['banner_id'], $favbanner)) { ?>
                        <span><i class="fa fa-heart" aria-hidden="true" style="color: red; float: right;margin:7px"></i></span>
                    <?php } else { ?>
                        <a href="<?php echo base_url() ?>makebannerfavorites/<?php echo $banners['banner_id']; ?>"><i class="fa fa-heart" aria-hidden="true" style="color: blue; float: right;margin:7px"></i></a>
    <?php } ?>
                    <span style="float: right;"><img style="width:17px" src="<?php echo base_url() ?>assets/front/images/country_flag/<?php echo $banners['country_image']; ?>"></span>
                </div>

            </div>
<?php } ?>
        <div class="clearfix"></div> <br><br>
        <div class="row text-center"><button loadbtn="4" class="btn btn-success show_more" style="width: 210px; height: 30px;">LOAD MORE</button></div><br>
    </div>
    
    
    <!--    <div class="grid" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 200 }'>
            <div class="grid-item"><img style="width:240px;" src="https://s-media-cache-ak0.pinimg.com/originals/3d/d6/1f/3dd61f6ca74afa7196878eaae78fd259.jpg"></div>
            <div class="grid-item grid-item--width2"><img style="width:240px;" src="https://s-media-cache-ak0.pinimg.com/originals/3d/d6/1f/3dd61f6ca74afa7196878eaae78fd259.jpg"></div>
            <div class="grid-item grid-item--height2"><img style="width:240px;" src="https://s-media-cache-ak0.pinimg.com/originals/3d/d6/1f/3dd61f6ca74afa7196878eaae78fd259.jpg"></div>
        </div>-->

       <div class="grid">
      <div class="grid-sizer"></div>
      <div class="grid-item"><img style="width:240px;" src="https://s-media-cache-ak0.pinimg.com/originals/3d/d6/1f/3dd61f6ca74afa7196878eaae78fd259.jpg"></div>
      <div class="grid-item grid-item--width2 grid-item--height2"><img style="width:100%" src="https://s-media-cache-ak0.pinimg.com/originals/3d/d6/1f/3dd61f6ca74afa7196878eaae78fd259.jpg"></div>
      <div class="grid-item grid-item--height3"><img style="width:100%" src="http://wvs.topleftpixel.com/photos/2008/12/san-fransisco_long-street_-01.jpg"></div>
      <div class="grid-item grid-item--height2"></div>
      <div class="grid-item grid-item--width3"></div>
      <!--
      <div class="grid-item"></div>
      <div class="grid-item"></div>
      <div class="grid-item grid-item--height2"></div>
      <div class="grid-item grid-item--width2 grid-item--height3"></div>
      <div class="grid-item"></div>
      <div class="grid-item grid-item--height2"></div>
      <div class="grid-item"></div>
      <div class="grid-item grid-item--width2 grid-item--height2"></div>
      <div class="grid-item grid-item--width2"></div>
      <div class="grid-item"></div>
      <div class="grid-item grid-item--height2"></div>
      <div class="grid-item"></div>
      <div class="grid-item"></div>
      <div class="grid-item grid-item--height3"></div>
      <div class="grid-item grid-item--height2"></div>
      <div class="grid-item"></div>
      <div class="grid-item"></div>
      <div class="grid-item grid-item--height2"></div>
    </div>-->

</div>

</div><!--/span-->
</div><!--/span-->
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $('.grid').masonry({
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });
    var elem = document.querySelector('.grid');
    var msnry = new Masonry(elem, {
        // options
        itemSelector: '.grid-item',
        columnWidth: 200
    });

    var msnry = new Masonry('.grid', {
        // options
    });
</script>
<script>
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('loadbtn');
        $('.show_more').hide();
        //$('.loding').show();
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>loadmorebanners',
            data:'last_limit='+ID,
            success:function(html){
                console.log(html);
                var hhh = JSON.parse(html);
                console.log(hhh);
                $('#showbannerdata').html(html);
            }
        }); 
    });
});
</script>


