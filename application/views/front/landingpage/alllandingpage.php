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
            <div class="row landingallshowdiv" id="postList">
                <?php $this->load->view('front/landingpage/landingPageDiv'); ?>
            </div>
<!--            <div>
                <div style="float: right; margin-top: 34px;">
                    <?php // echo $showing; ?>
                </div>
                <div id="pagination"class="row text-center" style="float: left">
                    <ul class="tsc_pagination">
                        <?php // echo $pagination; ?>
                    </ul>
                </div>
            </div>-->
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->


<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>landingpage/ajaxPaginationData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.landingdiv);
        }
    });
}
</script>


<script>
function dataFilter(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>landingpage/ajaxPaginationFilterData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.landingdiv);
        }
    });
}
</script>

<script>
function keywordFilter(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>landingpage/ajaxPaginationKeywordData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.landingdiv);
        }
    });
}
</script>

<script>
function favoritesData(page_num) {
    page_num = page_num?page_num:0;
//    alert(page_num);
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>landingpage/ajaxFavoritesData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.landingdiv);
        }
    });
}
</script>

<script>
function commentsData(page_num) {
    page_num = page_num?page_num:0;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>landingpage/ajaxCommentsData/'+page_num,
        data: {page:page_num},
        beforeSend: function () {
            $('.loading').show();
        },
        success: function (msg) {
//            alert(msg);
            var hhh = JSON.parse(msg);
            $('#postList').html(hhh.landingdiv);
        }
    });
}
</script>

<script>
    
    function searchbycategory(cat_id) {
        var country_id = document.getElementById('country_id').value;
        var searchval = document.getElementById('searchval').value;
        var searchkey = document.getElementById('searchkey').value;
//        alert(cat_id);
        $.ajax({
            url: '<?php echo base_url(); ?>searchFilterData',
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.landingdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
    var cat_id = document.getElementById('cat_id').value;
    var searchval = document.getElementById('searchval').value;
    var searchkey = document.getElementById('searchkey').value;
    
        $.ajax({
            url: "<?php echo site_url('searchFilterData'); ?>",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.landingdiv);
            }
        });
    }
    
    
    function search_by_tag(tag_id){
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        var searchval = document.getElementById('searchval').value;

        $.ajax({
            url: "<?php echo site_url('searchFilterDataByKeyword'); ?>",
            type: "post",
            data: {
                cat_id: cat_id,country_id: country_id,searchval:searchval,tag_id:tag_id
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.landingdiv);
            }
        });
    }
    
    
</script>

<script type="text/javascript">

    $(function () {
        $("#landTag").autocomplete({
            source: "<?php echo base_url() ?>landingTagAutocomplete",
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


    //$('#landTag').change(function () {
    function landing_search() {
        var searchkey = $('#txtAllowSearchID').val();
        var searchval = document.getElementById('searchval').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
//        alert(searchkey);
        $.ajax({
            url: "<?php echo site_url('searchFilterData'); ?>",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                alert(msg);
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.landingdiv);
            }
        });
    }
    //});

    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('landingpagecommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 13
            },
            success: function (msg) {
                $('#commentmodal').html(msg);
                $('#com_option_id').val(13);
                $('#com_adds_id').val(adds_id);
                $('#commentmodal').modal('show');
            }
        });
    }

    $("#drop").change(function () {
        var searchval = this.value;
        var searchkey = document.getElementById('searchkey').value;
        var country_id = document.getElementById('country_id').value;
        var cat_id = document.getElementById('cat_id').value;
        //alert(searchval);
        $.ajax({
            url: "<?php echo site_url('searchFilterData'); ?>",
            type: "post",
            data: {
                country_id: country_id,cat_id: cat_id,searchval:searchval,searchkey:searchkey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.landingdiv);
            }
        });
    });
    
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
        $.ajax({
            url: "<?php echo site_url('searchlandingbymyfav'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 13
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.myfav);
            }
        });
    }

    function searchbymycom(member_id) {
//    alert(member_id);
        $.ajax({
            url: "<?php echo site_url('searchlandingbymycom'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 13
            },
            success: function (msg) {
//                alert(msg);
                var hhh = JSON.parse(msg);
                $('.landingallshowdiv').html(hhh.mycom);
            }
        });
    }
</script>
