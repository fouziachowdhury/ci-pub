<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <h5 style="color: red;">
                        <?php if (validation_errors()) {
                            echo validation_errors();
                        } ?>
                    </h5>
                    
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
                    <form action="serviceAdmin/updateserviceinfo" method="post" enctype="multipart/form-data">
                        <div class="form-group col-sm-12">
                            <h3 class="box-title">Description<span style="color:red">*</span></h3>
                            <textarea class="summernote" name="service_details" id="description1"><?php echo $servicedata->service_details; ?></textarea>
                            <input type="hidden" name="service_name" value="Programing Integration">
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>




