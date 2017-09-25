<?php if (isset($permission_message)) { ?>
    <h1><?php echo $permission_message; ?> ,Click here to upgrade <a href="<?php echo base_url()?>custompackageforaffiliate"><button class="btn btn-primary">Upgrade</button></a></h1>
<?php } else { ?>
    <div class="row">
        <div id="all_time" style="display: block;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                    <!--                <div class="col-md-10" style="background: #F6F6F6;">-->
                    <div class="row" style="margin-bottom: -8px;">
                        <div class="col-md-4">
                             <!--<h4><?php echo $page_title; ?></h4>-->
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>
                    <div class="showbandiv">
                        <?php $this->load->view('front/service/programming/programmingShowDiv'); ?>
                    </div>
                </div><!--/span-->
            </div><!--/span-->
        </div>
    </div>
<?php } ?>
<script>
    $(document).ready(function () {
        $(document).on('click', '.show_more', function () {
            var ID = $(this).attr('loadbtn');
            //$('.show_more').hide();
            //$('.loding').show();

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>loadmorebanners',
                data: 'last_limit=' + ID,
                success: function (result) {
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


<!--------------------------FOR AUTOCOMPLETE-------------------->
<script>
    $(function () {
        $("#banTag").autocomplete({
            source: "<?php echo base_url() ?>bannerTagAutocomplete"
        });
    });

    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('bannercommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 1
            },
            success: function (msg) {
                $('#bannercommentmodal').html(msg);
                $('.com_option_id').val(1);
                $('.com_adds_id').val(adds_id);
                $('#bannercommentmodal').modal('show');

            }
        });
    }
    
    
     $("#bannerdrop").change(function () {
        var searchval = this.value;
        //alert(searchval);
        $.ajax({
            url: "<?php echo site_url('searchbannerbyentries'); ?>",
            type: "post",
            data: {
                searchval: searchval
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    });
    
    $('#banTag').change(function () {
       var searchKey = $('#banTag').val();
      // alert(searchKey);
       $.ajax({
            url: "<?php echo site_url('searchbannerbyautokey'); ?>",
            type: "post",
            data: {
                searchKey: searchKey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    });
    
    function searchbycategory(cat_id){
        $.ajax({
            url: "<?php echo site_url('searchbannerbycatid'); ?>",
            type: "post",
            data: {
                cat_id: cat_id
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
        $.ajax({
            url: "<?php echo site_url('searchbannerbycountryid'); ?>",
            type: "post",
            data: {
                country_id: country_id
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbysize(width, height){
       $.ajax({
            url: "<?php echo site_url('searchbannerbysize'); ?>",
            type: "post",
            data: {
                width: width,
                height: height
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbymyfavban(member_id){
      $.ajax({
            url: "<?php echo site_url('searchbanbymyfav'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 1
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.myfav);
            }
        });
    }
    
    function searchbymycomban(member_id){
        $.ajax({
            url: "<?php echo site_url('searchbanbymycom'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 1
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.mycom);
            }
        });
    }
</script>