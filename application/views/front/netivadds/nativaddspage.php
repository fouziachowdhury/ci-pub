<?php if (isset($permission_message)) { ?>
   <h1><?php echo $permission_message; ?> ,Click here to upgrade <a href="<?php echo base_url()?>custompackageforaffiliate"><button class="btn btn-primary">Upgrade</button></a></h1>
<?php } else { ?>
    <div class="row">
        <div id="all_time" style="display: block;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
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
                    <div class="row" style="margin-top: 19px; margin-bottom: -8px;">
                        <div class="col-md-4"><h4>Native Adds Section </h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>

                    <div class="showbandiv" id="postList">
                        <?php $this->load->view('front/netivadds/nativAddShowDiv'); ?>
                    </div>
<!--                    <div>
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
    </div><!--/span-->
<?php } ?>
    

<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
//    var keywords = $('#keywords').val();
//    var sortBy = $('#sortBy').val();
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>nativadd/ajaxPaginationData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
            //alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.nativadds);
        }
    });
}
</script>

<script>
function dataFilter(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>nativadd/ajaxPaginationFilterData/'+page_num,
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
        url: '<?php echo base_url(); ?>nativadd/ajaxFavoritesData/'+page_num,
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
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>nativadd/ajaxCommentsData/'+page_num,
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
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() ?>loadmorenativadds',
                data: 'last_limit=' + ID,
                success: function (result) {
                    var hhh = JSON.parse(result);
                    var attrval = hhh.nativaddscount;
                    $('.showbandiv').html(hhh.nativadds);
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
            data: {'page_id': 2},
            success: function (data) {
                var obj = JSON.parse(data);
                console.log(obj.result);
                if (obj.result == '1') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 2},
                        success: function (data) {
                        }
                    });
                } else if (obj.result == '0') {
                    location.href = "<?php echo base_url('permissionerror'); ?>";
                }
            }
        });



    });


    function searchbycategory(cat_id){
//        alert(cat_id);
        var country_id = document.getElementById('country_id').value;
        var width = document.getElementById('width').value;
        var height = document.getElementById('height').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('txtAllowSearchID').value;
//        alert(searchkey);
        $.ajax({
            url: "<?php echo site_url('nativadd/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,width: width,height: height,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                //alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
    var cat_id = document.getElementById('cat_id').value;
    var width = document.getElementById('width').value;
    var height = document.getElementById('height').value;
    var searchval = document.getElementById('searchval').value;
    var searchkey = document.getElementById('txtAllowSearchID').value;
    
        $.ajax({
            url: "<?php echo site_url('nativadd/search_filter_data'); ?>",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,width: width,height: height,searchval:searchval,searchkey:searchkey
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
    var searchval = document.getElementById('searchval').value;
    var searchkey = document.getElementById('txtAllowSearchID').value;
//    alert(width);
//    alert(height);
       $.ajax({
            url: "<?php echo site_url('nativadd/search_filter_data'); ?>",
            type: "post",
            data: {
                width: width,height: height,country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function native_search(){
        var searchkey = $("#txtAllowSearchID").val();
        
        var cat_id = document.getElementById('cat_id').value;
        var country_id = document.getElementById('country_id').value;
        var width = document.getElementById('width').value;
        var height = document.getElementById('height').value;
        var searchval = document.getElementById('searchval').value;
//        alert(searchKey);
        $.ajax({
            url: "<?php echo site_url('nativadd/search_filter_data'); ?>",
            type: "post",
            data: {
                width: width,height: height,country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
//                alert(msg);
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
//    alert(member_id);
        $.ajax({
            url: "<?php echo site_url('nativadd/searchnativbymyfav'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 2
            },
            success: function (msg) {
                //alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.myfav);
            }
        });
    }
    
    function searchbymycom(member_id){
//    alert(member_id);
     $.ajax({
            url: "<?php echo site_url('nativadd/searchnativbymycom'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 2
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.mycom);
            }
        });
    }
    
    $(function () {
        $("#banTag").autocomplete({
            source: "<?php echo base_url() ?>nativTagAutocomplete",
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
    
    
    
    $("#bannerdrop").change(function () {
        var searchval = this.value;
        var searchkey = document.getElementById('txtAllowSearchID').value;
        var country_id = document.getElementById('country_id').value;
        var width = document.getElementById('width').value;
        var height = document.getElementById('height').value;
        var cat_id = document.getElementById('cat_id').value;
        $.ajax({
            url: "<?php echo site_url('nativadd/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,width: width,height: height,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                console.log(hhh);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    });
    
    
    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('nativeCommentModal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 2
            },
            success: function (msg) {
                $('#native_comment_modal').html(msg);
                $('.com_option_id').val(2);
                $('.com_adds_id').val(adds_id);
                $('#native_comment_modal').modal('show');

            }
        });
    }
    
</script>

