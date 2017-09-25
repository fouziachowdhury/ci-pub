<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h5 style="color: red;"><?php if (validation_errors()) {
                                                    echo validation_errors();
                                            } ?>
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
                    <form action="landingPageAdmin/updatelandingpagesetting" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Monthly Membership Price</label>
                            <input type="text" name="mothly_membership_price" class="form-control" value="<?php echo $landing_settings->mothly_membership_price; ?>" placeholder="Monthly Membership Price">
                        </div> 
                        
                        <div class="form-group">
                            <label for="exampleInputuname">View Page Count</label>
                            <input type="text" name="view_page_count" class="form-control" value="<?php echo $landing_settings->view_page_count; ?>" placeholder="Count View Page">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Download Count</label>
                            <input type="text" name="download_count" class="form-control" value="<?php echo $landing_settings->download_count; ?>" placeholder="Count Download">
                        </div>
                        
                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>

<script>
    
    
    function showDiv(){
        var type = $("input[name=trusted_facility]:checked").val();
//        var facility = document.getElementById('facility_check').value;
//        var user = document.getElementById('user_check').value;
//        alert(type);
        if(type == 0){
            document.getElementById('showFacility').style.display = "block";
        }
        else{
            document.getElementById('showFacility').style.display = "none";
        }
    }
</script>
