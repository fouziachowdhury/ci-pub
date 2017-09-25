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
                    <form class="form-horizontal" action="super_admin/updateAccountSettings" method="post">
                       
                        <input type="hidden" value="<?php echo $this->session->userdata('reg_id');?>" name="reg_id">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $this->session->userdata('first_name');?>" name="first_name" class="form-control" id="inputEmail3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $this->session->userdata('last_name');?>" name="last_name" class="form-control" id="inputEmail3" placeholder="Last Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $this->session->userdata('user_name');?>" name="user_name" class="form-control" id="inputEmail3" placeholder="User Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Email Address</label>
                            <div class="col-sm-10">
                                <input type="email" value="<?php echo $this->session->userdata('email');?>" name="email" class="form-control" id="inputEmail3" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $this->session->userdata('mobile');?>" name="mobile" class="form-control" id="inputEmail3" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select name="gender" class="form-control">
                                    <option name="">--SELECT--</option>
                                    <option value="1" <?php if($this->session->userdata('gender') == 1){echo 'selected';}?>>Male</option>
                                    <option value="2" <?php if($this->session->userdata('gender') == 2){echo 'selected';}?>>Female</option>
                                    <option value="3" <?php if($this->session->userdata('gender') == 3){echo 'selected';}?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Date of Birth</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $this->session->userdata('dob');?>" name="dob" class="form-control datepicker-inline" id="inputEmail3" placeholder="Date of birth">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea name="address" class="form-control" rows="4"style="resize:none;"><?php echo $this->session->userdata('address');?></textarea>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-10">
                                <input name="userfile" class="form-control" type="file" accept="images/*"/>
                            </div>
                        </div>-->
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
