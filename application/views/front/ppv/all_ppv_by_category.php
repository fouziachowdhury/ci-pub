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
            <div class="row" id="landingallshowdiv">
                <?php $this->load->view('front/ppv/ppvShowDiv'); ?>
            </div>
            <div>
<!--                <div style="float: right; margin-top: 34px;">
                    <?php // echo $showing; ?>
                </div>-->
                <div id="pagination"class="row text-center" style="float: left">
                    <ul class="tsc_pagination">
                        <?php foreach ($links as $link) {
                            echo "<li>" . $link . "</li>";
                        }?>
                        <?php // echo $pagination; ?>
                    </ul>
                </div>
            </div>
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->


<script type="text/javascript">

    $(function () {
        $("#landTag").autocomplete({
            source: "<?php echo base_url() ?>landingTagAutocomplete"
        });
    });


    //$('#landTag').change(function () {
    function landingsearch() {
        var searchKey = $('#landTag').val();
        // alert(searchKey);
        $.ajax({
            url: "<?php echo site_url('searchlandingbyautokey'); ?>",
            type: "post",
            data: {
                searchKey: searchKey
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#landingallshowdiv').html(hhh.bannerdiv);
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
        //alert(searchval);
        $.ajax({
            url: "<?php echo site_url('searchlandingbyentries'); ?>",
            type: "post",
            data: {
                searchval: searchval
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#landingallshowdiv').html(hhh.landingdiv);
            }
        });
    });

    function searchbymyfav(member_id) {
        $.ajax({
            url: "<?php echo site_url('searchlandingbymyfav'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 13
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#landingallshowdiv').html(hhh.myfav);
            }
        });
    }

    function searchbymycom(member_id) {
        $.ajax({
            url: "<?php echo site_url('searchlandingbymycom'); ?>",
            type: "post",
            data: {
                member_id: member_id,
                option_id: 13
            },
            success: function (msg) {
                var hhh = JSON.parse(msg);
                $('#landingallshowdiv').html(hhh.mycom);
            }
        });
    }
</script>
