<div class="row">
    <div id="all_time" style="display: block;">
        <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="row" id="landingallshowdiv">
         <?php $this->load->view('front/landingpage/landingPageDiv'); ?>
                      </div>
        </div><!--/span-->
    </div><!--/span-->
</div><!--/span-->


<script type="text/javascript">
    function showcommentbox(adds_id) {
        $.ajax({
            url: "<?php echo site_url('landingpagecommentmodal'); ?>",
            type: "post",
            data: {
                addsId: adds_id,
                option_id: 5
            },
            success: function (msg) {
                $('#commentmodal').html(msg);
                $('#commentmodal').modal('show');
                $('#com_option_id').val(5);
                $('#com_adds_id').val(adds_id);
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

</script>
