<?php if (isset($permission_message)) { ?>
    <h1><?php echo $permission_message; ?></h1>
<?php } else { ?>

<div class="row">
    <div id="all_time" style="display: block;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="white-box">
<!--                <div class="col-md-10" style="background: #F6F6F6;">-->
    <div class="row" style="margin-top: 19px; margin-bottom: -8px;">
        <div class="col-md-4"><h4>BANNERS</h4>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"><h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>
        </div>
    </div>
    <div class="row" style="margin-top: 19px; margin-bottom: 11px; border: 1px solid #ddd; background: #fff; height: 40px">
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
                       <option value="<?php echo $size['width']; ?>-<?php echo $size['height']; ?>"><?php echo $size['width']; ?> - <?php echo $size['height']; ?></option>
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
    <div class="showbandiv">
    <?php $this->load->view ('front/banners/bannerShowDiv'); ?>
    </div>
     <div class="row text-center"><button loadbtn="8" class="btn btn-success show_more" style="width: 210px; height: 30px;">LOAD MORE</button></div><br>
<!--</div>-->
</div><!--/span-->
</div><!--/span-->
</div>
</div>
<?php } ?>
<script>
$(document).ready(function(){
    $(document).on('click','.show_more',function(){
        var ID = $(this).attr('loadbtn');
        //$('.show_more').hide();
        //$('.loding').show();
        
        $.ajax({
            type:'POST',
            url:'<?php echo base_url()?>loadmorebanners',
            data:'last_limit='+ID,
            success:function(result){
                console.log(result);
                console.log(result.bannerdiv);
                var hhh = JSON.parse(result);
                console.log(hhh);
                var attrval = hhh.bannercount;
                $('.showbandiv').html(hhh.bannerdiv);
                $(".show_more").attr("loadbtn", attrval);
            }
        }); 
    });
});
</script>

<!------------FOR COUNT PAGE VIEW ---------------->
<script type="text/javascript">
    $(document).ready(function () {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>accesspage',
            data: {'page_id': 1},
            success: function (data) {
                var obj = JSON.parse(data);
                console.log(obj.result);
                if (obj.result == 1) {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 1},
                        success: function (data) {
                        }
                    });
                } else {
                    location.href = "<?php echo base_url('permissionerror'); ?>";
                }
            }
        });



    });

</script>
