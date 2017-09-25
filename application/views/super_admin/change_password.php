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
                    <form class="form-horizontal" action="super_admin/updatePassword" method="post">

                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Old Password</label>
                            <div class="col-sm-10">
                                <input type="password" value="" class="form-control" id="inputEmail3" placeholder="Old Password">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" value="" class="form-control" id="inputEmail3" placeholder="New Password">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Authorization Password</label>
                            <div class="col-sm-10">
                                <input type="password" value="" class="form-control" id="inputEmail3" placeholder="Authorization Password">
                            </div>
                        </div>
                        
                        <div class="form-group">

                            <div class="col-md-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Edit</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="col-sm-12 ol-md-12 col-xs-12">
            <div class="white-box">
                <h3 class="box-title">File Upload1</h3>
                <label for="input-file-now">Image</label>
                
            </div>
        </div>-->
</div>
