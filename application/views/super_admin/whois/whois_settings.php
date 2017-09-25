<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h5 style="color: red;"><?php
                        if (validation_errors()) {
                            echo validation_errors();
                        }
                        ?>
                    </h5>
                     <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('success'); ?>
                        </div>
                       <?php } ?>

                       <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-check-square-o"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $this->session->flashdata('error'); ?>
                        </div>

                       <?php } ?>
                    <form action="WhoisAdmin/updatewhoissetting" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputuname">Monthly Membership Price</label>
                            <input type="text" name="mothly_membership_price" class="form-control" value="<?php echo $whoisdata->mothly_membership_price; ?>">
                        </div> 
                        <div class="form-group">
                            <label for="exampleInputuname">Query Count(Trial)</label>
                            <input type="text" name="trial_query_count" class="form-control" value="<?php echo $whoisdata->trial_query_count; ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputuname">Query Count(Membership)</label>
                            <input type="text" name="membership_query_count" class="form-control" value="<?php echo $whoisdata->membership_query_count; ?>">
                        </div>
                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>