<?php if (isset($permission_message)) { ?>
    <h1><?php echo $permission_message; ?></h1>
<?php } else { ?>
    <div class="row">
        <div id="all_time" style="display: block;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                    <!--                <div class="col-md-10" style="background: #F6F6F6;">-->
                    <div class="row" style="margin-bottom: -8px;">
                        <div class="col-md-4"><h4>FB Ecommerce Adds</h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>
                    <div id="postList" class="showbandiv">
                        <?php $this->load->view('front/faceecomerceadds/fbecommerceShowDiv'); ?>
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
        url: '<?php echo base_url(); ?>fbecommerceadds/ajaxPaginationData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
            
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>

<script>
function dataFilter(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>fbecommerceadds/ajaxPaginationFilterData/'+page_num,
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
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>fbecommerceadds/ajaxFavoritesData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>

<script>
function commentsData(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>fbecommerceadds/ajaxCommentsData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.bannerdiv);
        }
    });
}
</script>

<script>
    
    function keywordFilter(page_num) {
            page_num = page_num?page_num:0;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>fbecommerceadds/ajaxPaginationKeywordData/'+page_num,
                data: {page:page_num},
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (msg) {
        //            
                    var hhh = JSON.parse(msg);
                    $('#postList').html(hhh.bannerdiv);
                }
            });
        }
    
</script>

<script>
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
        //            
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
            data: {'page_id': 4},
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.result == '1') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 4},
                        success: function (data) {
                        }
                    });
                } else if (obj.result == '0'){
                    location.href = "<?php echo base_url('permissionerror'); ?>";
                }
            }
        });



    });

</script>
<!--------------------------FOR AUTOCOMPLETE-------------------->
<script>
    $(function () {
        $("#banTag").autocomplete({
            source: "<?php echo base_url() ?>fbecoTagAutocomplete",
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

    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('fbecocommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 4
            },
            success: function (msg) {
                $('#bannercommentmodal').html(msg);
                $('.com_option_id').val(4);
                $('.com_adds_id').val(adds_id);
                $('#bannercommentmodal').modal('show');

            }
        });
    }
    
    
    function fbecomsearch(){
    // $("#fbecodrop").change(function () {
        var searchkey =  $("#txtAllowSearchID").val();
        var cat_id = document.getElementById('cat_id').value;
        var country_id = document.getElementById('country_id').value;
        var searchval = document.getElementById('searchval').value;
        //alert(searchval);
        $.ajax({
            url: "<?php echo site_url('fbecommerceadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    //});
    } 
    
    
    $('#fbecodrop').change(function () {
       var searchval = this.value;
        var searchkey = document.getElementById('searchkey').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
      // alert(searchKey);
       $.ajax({
            url: "<?php echo site_url('fbecommerceadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    });
    
    function searchbycategory(cat_id){
    
        var country_id = document.getElementById('country_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('searchkey').value;
    
        $.ajax({
            url: "<?php echo site_url('fbecommerceadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('searchkey').value;
    
        $.ajax({
            url: "<?php echo site_url('fbecommerceadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function search_by_tag(tag_id){
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;

        $.ajax({
            url: "<?php echo site_url('fbecommerceadds/searchFilterDataByKeyword'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,tag_id:tag_id
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
            search_by_favorites(member_id);
        }
        
        if(display_type == 2){
            search_by_comments(member_id);
        }
//        alert(display_type);
    }
    
    function search_by_favorites(member_id){
      $.ajax({
            url: "<?php echo site_url('fbecommerceadds/searchbyfavorites'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 4
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function search_by_comments(member_id){
        $.ajax({
            url: "<?php echo site_url('fbecommerceadds/searchbycomments'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 4
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
</script>