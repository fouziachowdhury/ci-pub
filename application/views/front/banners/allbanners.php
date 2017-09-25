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
                            <h4>BANNERS</h4>
                        </div>
                        <!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>
                    <div class="showbandiv" id="postList">
                        <?php $this->load->view('front/banners/bannerShowDiv'); ?>
                        
                    </div>
                    <div>
                        <div style="float: right; margin-top: 34px;">
                            <?php // echo $showing; ?>
                        </div>
                        
                        
<!--                        <div id="pagination"class="row text-center" style="float: left">
                            <ul class="tsc_pagination">
                                <?php // echo $pagination; ?>
                            </ul>
                        </div>-->
                    </div>
                    <!--<div class="row text-center"><button loadbtn="8" class="btn btn-success show_more" style="width: 210px; height: 30px;">LOAD MORE</button></div><br>-->
                    
                </div><!--/span-->
            </div><!--/span-->
        </div>
    </div>
<?php } ?>
    
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>banners/ajaxPaginationData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>

<script>
function dataFilter(page_num) {
    page_num = page_num?page_num:0;
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>banners/ajaxPaginationFilterData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>

<script>
function favoritesData(page_num) {
    page_num = page_num?page_num:0;
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>banners/ajaxFavoritesData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>

<script>
function commentsData(page_num) {
    page_num = page_num?page_num:0;
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>banners/ajaxCommentsData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>
    
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

<!------------FOR COUNT PAGE VIEW ---------------->
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>accesspage',
            data: {'page_id': 1},
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.result == '1') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 1},
                        success: function (data) {
                        }
                    });
                } else if (obj.result == '0') { 
                  location.href = "<?php echo base_url('permissionerror'); ?>";
                }
            }
        });

    });

</script>
<!--------------------------FOR AUTOCOMPLETE-------------------->
<script>
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
    
    $(function () {
        $("#banTag").autocomplete({
            source: "<?php echo base_url() ?>bannerTagAutocomplete",
            focus: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
                // manually update the textbox
                $(this).val(ui.item.label);
            },
            select: function(event, ui) {
                // prevent autocomplete from updating the textbox
                event.preventDefault();
                // manually update the textbox and hidden field
                $(this).val(ui.item.label);
                $("#txtAllowSearchID").val(ui.item.value);
            }
        });
    });
    
    
    function bannersearch(){
        var searchKey = $("#txtAllowSearchID").val();
//        alert(searchKey);
        $.ajax({
            url: "<?php echo site_url('searchbannerbyautokey'); ?>",
            type: "post",
            data: {
                searchKey: searchKey
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
        }
        
        function keywordFilter(page_num) {
            page_num = page_num?page_num:0;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>banners/ajaxPaginationKeywordData/'+page_num,
                data: {page:page_num},
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (msg) {
        //            alert(msg);
                    var hhh = JSON.parse(msg);
                    $('#postList').html(hhh.bannerdiv);
                }
            });
        }
        
        
        $("#bannerdrop").change(function () {
        var searchval = this.value;
//        alert(searchval);
        $.ajax({
            url: "<?php echo site_url('searchbannerbyentries'); ?>",
            type: "post",
            data: {
                searchval: searchval
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                console.log(hhh);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
        });
        
 
        function limitFilter(page_num) {
            page_num = page_num?page_num:0;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>banners/ajaxPaginationLimitData/'+page_num,
                data: {page:page_num},
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (msg) {
        //            alert(msg);
                    var hhh = JSON.parse(msg);
                    $('#postList').html(hhh.bannerdiv);
                }
            });
        }

    
    function searchbycategory(cat_id){
        var country_id = document.getElementById('country_id').value;
        var width = document.getElementById('width').value;
        var height = document.getElementById('height').value;
//        alert(country_id);
        $.ajax({
            url: "<?php echo site_url('searchbannerbycatid'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,width: width,height: height
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
    var cat_id = document.getElementById('cat_id').value;
    var width = document.getElementById('width').value;
    var height = document.getElementById('height').value;
    
        $.ajax({
            url: "<?php echo site_url('searchbannerbycountryid'); ?>",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,width: width,height: height
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbysize(items){
    var list = items.split(",");
    var width = ( list[0] );
    var height = ( list[1] );
    
    var cat_id = document.getElementById('cat_id').value;
    var country_id = document.getElementById('country_id').value;
//    alert(width);
//    alert(height);
       $.ajax({
            url: "<?php echo site_url('searchbannerbysize'); ?>",
            type: "post",
            data: {
                width: width,height: height,country_id: country_id,cat_id: cat_id
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbydisplay(val){
        var display_type = val;
        var member_id = <?php echo $_SESSION['member_id']; ?>;
//        alert(member_id);
        if(display_type == 1){
            searchbymyfavban(member_id);
        }
        
        if(display_type == 2){
            searchbymycomban(member_id);
        }
//        alert(display_type);
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
//                alert(msg);
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