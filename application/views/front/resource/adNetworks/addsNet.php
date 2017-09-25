<?php if (isset($permission_message)) { ?>
    <h1><?php echo $permission_message; ?></h1>
<?php } else { ?>
    <div class="row">
        <div id="all_time" style="display: block;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                    <!--                <div class="col-md-10" style="background: #F6F6F6;">-->
                    <div class="row" style="margin-bottom: -8px;">
                        <div class="col-md-4"><h4><?php echo $page_title; ?></h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>
                    <div class="showbandiv" id="postList">
                        <?php $this->load->view('front/resource/adNetworks/addsNetShowDiv'); ?>
                    </div>
                </div><!--/span-->
            </div><!--/span-->
        </div>
    </div>
<?php } ?>
    
<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var table = 'ad_networks';
    var page_link = 'front/resource/adNetworks/addsNetShowDiv';
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>resource/ajaxPaginationData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link},
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
    var table = 'ad_networks';
    var page_link = 'front/resource/adNetworks/addsNetShowDiv';
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>resource/ajaxPaginationFilterData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link},
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
    var table = 'ad_networks';
    var col_name = 'id';
    var page_link = 'front/resource/adNetworks/addsNetShowDiv';
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>resource/ajaxFavoritesData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link,col_name:col_name},
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
    var table = 'ad_networks';
    var col_name = 'resource_id';
    var page_link = 'front/resource/adNetworks/addsNetShowDiv';
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>resource/ajaxCommentsData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link,col_name:col_name},
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
    
    function keywordFilter(page_num) {
            page_num = page_num?page_num:0;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>resource/ajaxPaginationKeywordData/'+page_num,
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
    function limitFilter(page_num) {
        page_num = page_num?page_num:0;
        var table = 'ad_networks';
        var page_link = 'front/resource/adNetworks/addsNetShowDiv';
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>resource/ajaxPaginationLimitData/'+page_num,
            data: {page:page_num,table:table,page_link:page_link},
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


<!--------------------------FOR AUTOCOMPLETE-------------------->
<script>
    $(function () {
        $("#banTag").autocomplete({
            source: "<?php echo base_url() ?>resource/adNetworksTagAutocomplete",
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
            url: "<?php echo site_url('resourcecommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 21
            },
            success: function (msg) {
                $('#bannercommentmodal').html(msg);
                $('.com_option_id').val(21);
                $('.com_adds_id').val(adds_id);
                $('#bannercommentmodal').modal('show');

            }
        });
    }
    
    
     $("#bannerdrop").change(function () {
        var table = 'ad_networks';
        var searchval = this.value;
        var searchkey = document.getElementById('searchkey').value;
        var page_link = 'front/resource/adNetworks/addsNetShowDiv';
        //alert(searchval);
        $.ajax({
                url: "<?php echo site_url('resource/searchFilterData'); ?>",
                type: "post",
                data: {
                    searchval: searchval,searchkey:searchkey,table:table,page_link:page_link
                },
                success: function (msg) {
                    //alert(msg);
                    var hhh = JSON.parse(msg);
                    console.log(hhh);
                    $('.showbandiv').html(hhh.bannerdiv);
                }
            });
    });
    
    function resource_search() {
        var table = 'ad_networks';
        var searchkey = $('#txtAllowSearchID').val();
        var searchval = document.getElementById('searchval').value;
        var page_link = 'front/resource/adNetworks/addsNetShowDiv';
//        alert(searchkey);
        $.ajax({
            url: "<?php echo site_url('resource/searchFilterData'); ?>",
            type: "post",
            data: {
                searchval:searchval,searchkey:searchkey,table:table,page_link:page_link
            },
            success: function (msg) {
                //alert(msg);
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
            searchbymyfav(member_id);
        }
        
        if(display_type == 2){
            searchbymycom(member_id);
        }
//        alert(display_type);
    }

    function searchbymyfav(member_id) {
        var table = 'ad_networks';
        var page_link = 'front/resource/adNetworks/addsNetShowDiv';
        var col_name = 'id';
        $.ajax({
            url: "<?php echo site_url('resource/searchbymyfav');?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 21,
                table:table,
                page_link:page_link,
                col_name:col_name
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }

    function searchbymycom(member_id) {
//    alert(member_id);
        var table = 'ad_networks';
        var page_link = 'front/resource/adNetworks/addsNetShowDiv';
        var col_name = 'id';
        $.ajax({
            url: "<?php echo site_url('resource/searchbymycom');?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 21,
                table:table,
                page_link:page_link,
                col_name:col_name
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
</script>