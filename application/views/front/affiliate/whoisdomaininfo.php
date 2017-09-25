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
            <div class="row" id="offerallshowdiv">
                <?php $this->load->view('front/affiliate/whoisdomainPageDiv'); ?>
            </div>
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->


<script type="text/javascript">

    $(function () {
        $("#offerTag").autocomplete({
            source: "<?php echo base_url() ?>offerTagAutocomplete"
        });
    });
    
    
    $('#offerTag').change(function () {
       var searchKey = $('#offerTag').val();
      // alert(searchKey);
       $.ajax({
            url: "<?php echo site_url('searchofferbyautokey'); ?>",
            type: "post",
            data: {
                searchKey: searchKey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#offerallshowdiv').html(hhh.offerdiv);
            }
        });
    });
    
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

    $("#offerdrop").change(function () {
        var searchval = this.value;
        //alert(searchval);
        $.ajax({
            url: "<?php echo site_url('searchofferbyentries'); ?>",
            type: "post",
            data: {
                searchval: searchval
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#offerallshowdiv').html(hhh.offerdiv);
            }
        });
    });

function searchbymyfavoffer(member_id) {
        $.ajax({
            url: "<?php echo site_url('searchlandingbymyfavoffer'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 7
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#offerallshowdiv').html(hhh.myfav);
            }
        });
    }
    
    function searchbymycomoffer(member_id){
     $.ajax({
            url: "<?php echo site_url('searchlandingbymycomoffer'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 7
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#offerallshowdiv').html(hhh.mycom);
            }
        });
    }
    
    function searchbycategory(cat_id){
        $.ajax({
            url: "<?php echo site_url('searchofferbycatid'); ?>",
            type: "post",
            data: {
                cat_id: cat_id
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#offerallshowdiv').html(hhh.offerdiv);
            }
        });
    }
    
    function searchbycountry(country_id){
        $.ajax({
            url: "<?php echo site_url('searchofferbycountryid'); ?>",
            type: "post",
            data: {
                country_id: country_id
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#offerallshowdiv').html(hhh.offerdiv);
            }
        });
    }
    
</script>
