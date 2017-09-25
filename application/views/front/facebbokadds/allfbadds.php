<?php if (isset($permission_message)) { ?>
    <h1><?php echo $permission_message; ?></h1>
<?php } else { ?>
    <div class="row">
        <div id="all_time" style="display: block;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                    <!--                <div class="col-md-10" style="background: #F6F6F6;">-->
                    <div class="row" style="margin-bottom: -8px;">
                        <div class="col-md-4"><h4></h4>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4"><!--<h4 style="float: right;"><i class="fa fa-question-circle" aria-hidden="true"></i> DISCLAIMER</h4>-->
                        </div>
                    </div>
                    <div id="postList" class="fbaddsshowresultdiv">
                        <?php $this->load->view('front/facebbokadds/fbShowDiv'); ?>
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
        url: '<?php echo base_url(); ?>facebookadds/ajaxPaginationData/'+page_num,
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
        url: '<?php echo base_url(); ?>facebookadds/ajaxPaginationFilterData/'+page_num,
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
function favoritesData(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>facebookadds/ajaxFavoritesData/'+page_num,
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
        url: '<?php echo base_url(); ?>facebookadds/ajaxCommentsData/'+page_num,
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
                url: '<?php echo base_url(); ?>facebookadds/ajaxPaginationKeywordData/'+page_num,
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
    
<!------------FOR COUNT PAGE VIEW ---------------->
<script type="text/javascript">
    $(document).ready(function () {

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>accesspage',
            data: {'page_id': 3},
            success: function (data) {
                var obj = JSON.parse(data);
               if (obj.result == '1') {
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url() ?>pagecount',
                        data: {'page_id': 3},
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
            source: "<?php echo base_url() ?>fbTagAutocomplete",
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
    
    $("#fbdrop").change(function () {
        var searchval = this.value;
        var searchkey = document.getElementById('txtAllowSearchID').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        
        $.ajax({
            url: "<?php echo site_url('facebookadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
    });
    
    function fbsearch(){
   // $('#banTag').change(function () {
       var searchkey = $('#txtAllowSearchID').val();
       var cat_id = document.getElementById('cat_id').value;
       var country_id = document.getElementById('country_id').value;
       var searchval = document.getElementById('searchval').value;
      // alert(searchKey);
       $.ajax({
            url: "<?php echo site_url('facebookadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
   // });
    }
    
    function searchbycategory(cat_id){
//    alert(cat_id);
        var country_id = document.getElementById('country_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('txtAllowSearchID').value;
        $.ajax({
            url: "<?php echo site_url('facebookadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
//        alert(country_id);
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('txtAllowSearchID').value;
        $.ajax({
            url: "<?php echo site_url('facebookadds/search_filter_data'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function search_by_tag(tag_id){
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;

        $.ajax({
            url: "<?php echo site_url('facebookadds/searchFilterDataByKeyword'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,tag_id:tag_id
            },
            success: function (msg) {
                //alert(msg);
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbydisplay(val){
        var display_type = val;
        var member_id = <?php echo $_SESSION['member_id']; ?>;
//        alert(member_id);
        if(display_type == 1){
            searchbymyfavfb(member_id);
        }
        
        if(display_type == 2){
            searchbymycomfb(member_id);
        }
//        alert(display_type);
    }
    
    function searchbymyfavfb(member_id){
      $.ajax({
            url: "<?php echo site_url('searchfbbymyfav'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 3
            },
            success: function (msg) {
               // alert(msg);
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function searchbymycomfb(member_id){
        $.ajax({
            url: "<?php echo site_url('searchfbbymycom'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 3
            },
            success: function (msg) {
                
                var hhh = JSON.parse(msg);
                $('.fbaddsshowresultdiv').html(hhh.bannerdiv);
            }
        });
    }
    
    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('fbcommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 3
            },
            success: function (msg) {
                $('#bannercommentmodal').html(msg);
                $('.com_option_id').val(3);
                $('.com_adds_id').val(adds_id);
                $('#bannercommentmodal').modal('show');

            }
        });
    }
</script>