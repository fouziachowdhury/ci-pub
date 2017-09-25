<div class="row">
    <div id="all_time" style="display: block;">
         <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success alert-dismissable">
                                <i class="fa fa-check-square-o"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
                        <?php }
                        ?>

                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger alert-dismissable">
                                <i class="fa fa-check-square-o"></i>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?php echo $this->session->flashdata('error'); ?>
                            </div>

                        <?php }
                        ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row afffeedshowdiv" id="postList">
                <?php $this->load->view('front/affiliate/affiliatefeedPageDiv'); ?>
            </div>
<!--            <div>
                <div style="float: right; margin-top: 34px;">
                    <?php echo $showing; ?>
                </div>
                <div id="pagination"class="row text-center" style="float: left">
                    <ul class="tsc_pagination">
                        <?php echo $pagination; ?>
                    </ul>
                </div>
            </div>-->
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->

<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var table = 'affiliate_landing_page';
    var page_link = 'front/affiliate/affiliatefeedPageDiv';
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>affiliate/ajaxPaginationData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.offerdiv);
        }
    });
}
</script>


<script>
function dataFilter(page_num) {
    page_num = page_num?page_num:0;
    var table = 'affiliate_landing_page';
    var page_link = 'front/affiliate/affiliatefeedPageDiv';
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>affiliate/ajaxPaginationFilterData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.offerdiv);
        }
    });
}
</script>

<script>
function keywordFilter(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>affiliate/ajaxPaginationKeywordData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.offerdiv);
        }
    });
}
</script>

<script>
function favoritesData(page_num) {
    page_num = page_num?page_num:0;
    var table = 'affiliate_landing_page';
    var page_link = 'front/affiliate/affiliatefeedPageDiv';
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>affiliate/ajaxFavoritesData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.offerdiv);
        }
    });
}
</script>

<script>
function commentsData(page_num) {
    page_num = page_num?page_num:0;
    var table = 'affiliate_landing_page';
    var page_link = 'front/affiliate/affiliatefeedPageDiv';
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>affiliate/ajaxCommentsData/'+page_num,
        data: {page:page_num,table:table,page_link:page_link},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.offerdiv);
        }
    });
}
</script>

<script type="text/javascript">

    $(function () {
        $("#afffeedTag").autocomplete({
            source: "<?php echo base_url() ?>afffeedTagTagAutocomplete"
        });
    });
    
    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('feedcommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 6
            },
            success: function (msg) {
                $('#feedcommentmodal').html(msg);
                $('#com_option_id').val(6);
                $('#com_adds_id').val(adds_id);
                $('#feedcommentmodal').modal('show');
            }
        });
    }

    function searchbycategory(cat_id){
            var country_id = document.getElementById('country_id').value;
            var searchval = document.getElementById('searchval').value;
            var searchkey = document.getElementById('searchkey').value;
            var table = 'affiliate_landing_page';
            var page_link = 'front/affiliate/affiliatefeedPageDiv';
    //        alert(cat_id);
            $.ajax({
                url: '<?php echo base_url(); ?>affiliate/search_Filter_Data',
                type: "post",
                data: {
                    country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey,table:table,page_link:page_link
                },
                success: function (msg) {
    //                alert(msg);
                    var hhh = JSON.parse(msg);
                    $('.afffeedshowdiv').html(hhh.offerdiv);
                }
            });
        }
    
    function searchbycountry(country_id){
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('searchkey').value;
        var table = 'affiliate_landing_page';
        var page_link = 'front/affiliate/affiliatefeedPageDiv';
        
        $.ajax({
            url: "<?php echo base_url(); ?>affiliate/search_Filter_Data",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey,table:table,page_link:page_link
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
//                alert(hhh);
                console.log(hhh);
                $('.afffeedshowdiv').html(hhh.offerdiv);
            }
        });
    }
    
    function search_by_tag(tag_id){
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;
        var table = 'affiliate_landing_page';
        var page_link = 'front/affiliate/affiliatefeedPageDiv';

        $.ajax({
            url: "<?php echo base_url(); ?>affiliate/search_by_keyword_Data",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,tag_id:tag_id,table:table,page_link:page_link
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
//                console.log(hhh);
//                alert('hello');
                $('.afffeedshowdiv').html(hhh.offerdiv);
            }
        });
    }

    $("#offerdrop").change(function () {
        var searchval = this.value;
        var searchkey = document.getElementById('searchkey').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        var table = 'affiliate_landing_page';
        var page_link = 'front/affiliate/affiliatefeedPageDiv';
        //alert(searchval);
        $.ajax({
            url: "<?php echo base_url(); ?>affiliate/search_Filter_Data",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey,table:table,page_link:page_link
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.afffeedshowdiv').html(hhh.offerdiv);
            }
        });
    });
    
    function feed_search() {
        var searchkey = $('#txtAllowSearchID').val();
        var searchval = document.getElementById('searchval').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        var table = 'affiliate_landing_page';
        var page_link = 'front/affiliate/affiliatefeedPageDiv';
//        alert(searchkey);
        $.ajax({
            url: "<?php echo base_url(); ?>affiliate/search_Filter_Data",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey,table:table,page_link:page_link
            },
            success: function (msg) {
                alert(msg);
                var hhh = JSON.parse(msg);
                $('.afffeedshowdiv').html(hhh.offerdiv);
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
        var table = 'affiliate_landing_page';
        var page_link = 'front/affiliate/affiliatefeedPageDiv';
//        var col_name = 'resource_id';
        $.ajax({
            url: "<?php echo base_url(); ?>affiliate/searchbymyfav",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 6,
                table:table,
                page_link:page_link
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.afffeedshowdiv').html(hhh.offerdiv);
            }
        });
    }

    function searchbymycom(member_id) {
        var table = 'affiliate_landing_page';
        var page_link = 'front/affiliate/affiliatefeedPageDiv';
//    alert(member_id);
        $.ajax({
            url: "<?php echo base_url(); ?>affiliate/searchbymycom",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 6,
                table:table,
                page_link:page_link
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.afffeedshowdiv').html(hhh.offerdiv);
            }
        });
    }
    
</script>

<!------------FOR COUNT PAGE VIEW ---------------->
<script type="text/javascript">
    $(document).ready(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>accesspage',
            data: {'page_id': 6},
            success: function (data) {
                var obj = JSON.parse(data);
                if (obj.result == '1') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 6},
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