<?php if (isset($permission_message)) { ?>
    <h1><?php echo $permission_message; ?> ,Click here to upgrade <a href="<?php echo base_url()?>custompackageforaffiliate"><button class="btn btn-primary">Upgrade</button></a></h1>
<?php } else { ?>
    <div class="row">
        <div id="all_time" style="display: block;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                    <!--                <div class="col-md-10" style="background: #F6F6F6;">-->
                    <div class="row" style="margin-bottom: -8px;">
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
                        <div class="col-md-4"><!--<h4>BANNERS</h4>-->
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>
                    <div class="showbandiv" id="postList">
                        <?php $this->load->view('front/ppv/ppvShowDiv'); ?>
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
        url: '<?php echo base_url(); ?>ppv/ajaxPaginationData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
            //alert(msg);
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
        url: '<?php echo base_url(); ?>ppv/ajaxPaginationFilterData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
            //alert(msg);
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
        url: '<?php echo base_url(); ?>ppv/ajaxPaginationKeywordData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
            //alert(msg);
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
        url: '<?php echo base_url(); ?>ppv/ajaxFavoritesData/'+page_num,
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
        url: '<?php echo base_url(); ?>ppv/ajaxCommentsData/'+page_num,
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
            data: {'page_id': 5},
            success: function (data) {
                var obj = JSON.parse(data);
                console.log(obj.result);
                 if (obj.result == '1') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 5},
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
            source: "<?php echo base_url() ?>ppvTagAutocomplete",
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
            url: "<?php echo site_url('ppvcommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 5
            },
            success: function (msg) {
                $('#ppvcommentmodal').html(msg);
                $('.com_option_id').val(5);
                $('.com_adds_id').val(adds_id);
                $('#ppvcommentmodal').modal('show');

            }
        });
    }
    
    
     $("#bannerdrop").change(function () {
        var searchval = this.value;
        var searchkey = document.getElementById('searchkey').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
//        alert(searchval);
        $.ajax({
            url: "<?php echo site_url('ppv/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                //alert(msg);
                var hhh = JSON.parse(msg);
                console.log(hhh);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    });
    
    function ppv_search(){
        var searchkey = $("#txtAllowSearchID").val();
        var cat_id = document.getElementById('cat_id').value;
        var country_id = document.getElementById('country_id').value;
        var searchval = document.getElementById('searchval').value;
//        alert(searchkey);
        $.ajax({
            url: "<?php echo site_url('ppv/search_filter_data'); ?>",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                //alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbycategory(cat_id){
    
        var country_id = document.getElementById('country_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('searchkey').value;
        
        $.ajax({
            url: "<?php echo site_url('ppv/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                //alert(msg)
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
            url: "<?php echo site_url('ppv/search_filter_data'); ?>",
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
            url: "<?php echo site_url('ppv/search_filter_data_by_keyword'); ?>",
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
            searchbymyfavppv(member_id);
        }
        
        if(display_type == 2){
            searchbymycomppv(member_id);
        }
//        alert(display_type);
    }
    
    function searchbymyfavppv(member_id){
      $.ajax({
            url: "<?php echo site_url('searchppvbymyfav'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 5
            },
            success: function (msg) {
                //alert(msg);
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.myfav);
            }
        });
    }
    
    function searchbymycomppv(member_id){
        $.ajax({
            url: "<?php echo site_url('searchppvbymycom'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 5
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.showbandiv').html(hhh.mycom);
            }
        });
    }
    
</script>