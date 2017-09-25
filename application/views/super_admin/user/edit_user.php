<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    
                    <form action="super_admin/update_user" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="reg_id" class="form-control" value="<?php echo $user->reg_id;?>">
                        <div class="form-group">
                            <label for="exampleInputuname">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name;?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name;?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">User Name</label>
                            <input type="text" name="user_name" class="form-control" value="<?php echo $user->user_name;?>">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">User's Company Name</label>
                            <input type="text" name="company_name" class="form-control" value="<?php echo $user->user_company_name; ?>" placeholder="Company Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $user->email;?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Mobile</label>
                            <input type="text" name="mobile" class="form-control" value="<?php echo $user->mobile?>">
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Gender</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="gender" id="radio1" value="1" <?php if($user->gender == 1){echo 'checked';}?>>
                                            <label for="radio1">Male</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="gender" id="radio2" value="2" <?php if($user->gender == 2){echo 'checked';}?>>
                                            <label for="radio2">Female</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="gender" id="radio3" value="3" <?php if($user->gender == 3){echo 'checked';}?>>
                                            <label for="radio3">Other</label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
<!--                        <div class="form-group">
                            <label class="control-label">Type</label>
                            <select class="form-control select2" name="user_type">
                                <option value="0">Choose User Type</option>
                                <option value="2" <?php if($user->type == 2){echo 'selected';}?>>Owner</option>
                                <option value="3" <?php if($user->type == 3){echo 'selected';}?>>User</option>
                            </select>
                        </div>-->
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Date Of Birth</label>
                            <input type="text" name="dob" class="form-control mydatepicker" value="<?php echo $user->dob;?>" placeholder="yyyy/mm/dd">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Address</label>
                            <textarea class="form-control" name="address" style="resize: none"><?php echo $user->address;?>
                            </textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="trusted_status" value="<?php echo $user->trusted_status?>">
                                <label class="control-label col-md-12">Type</label>
                                <div class="col-sm-4">
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" name="trusted_facility" id="facility_check" onclick="showFacDiv(this)" value="0" 
                                               <?php if ($user->trusted_status == 0 || $user->trusted_status == 2) {
                                                   echo 'checked';
                                               } ?>>
                                        <label for="facility_check">Trusted Facility</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" name="trusted_user" id="user_check" onclick="showDiv()" value="1" 
                                               <?php if ($user->trusted_status == 1 || $user->trusted_status == 2) {
                                                   echo 'checked';
                                               } ?>>
                                        <label for="user_check">Trusted User</label>
                                    </div>
                                </div>
<!--                                <div class="radio-list">
                                    <label class="radio-inline p-0">
                                        <div class="radio radio-info">
                                            <input type="radio" name="trusted_status" id="facility_check" onclick="showDiv()" value="0" <?php if($user->trusted_status == 0){echo 'checked';}?>>
                                            <label for="facility_check">Trusted Facility</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="trusted_status" id="user_check" onclick="showDiv()" value="1" <?php if($user->trusted_status == 1){echo 'checked';}?>>
                                            <label for="user_check">Trusted User</label>
                                        </div>
                                    </label>
                                    
                                </div>-->
                            </div>
                            
                        </div>
                        
<!--<div id="facDiv">-->
                        <?php //if($user->trusted_status == 0 || $user->trusted_status == 2){ ?>
                            <div class="form-group" id="facDiv" style="display: none;">
                                <label for="exampleInputuname">Facility</label>
                                <select class="select2 m-b-10 select2-multiple" id="facility_id" multiple="multiple" name="facility_id[]">
                                    <option value="0">Choose Facility</option>
                                    <?php foreach ($all_facility as $facility) { ?>
                                        <option value="<?php echo $facility->facility_id; ?>" 
                                            <?php if($user->trusted_status == 0 || $user->trusted_status == 2) {
                                                foreach ($facility_id as $fac) {
                                                    if ($fac == $facility->facility_id) {
                                                        echo 'selected';
                                                    }
                                                }
                                            } ?>><?php echo $facility->facility_title; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        <?php// } ?>
<!--</div>-->
                        <div class="form-group">
                            <label for="exampleInputuname">Interested Activities</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="intersted_activities[]">
                                <option value="0">Choose Activities</option>
                                <option value="1" <?php foreach ($intersted_activities as $row){if($row == 1){echo 'selected';}}?>>Activities 1</option>
                                <option value="2" <?php foreach ($intersted_activities as $row){if($row == 2){echo 'selected';}}?>>Activities 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputuname">Hobbies</label>
                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="hobbies[]">
                                <option value="0">Choose Activities</option>
                                <option value="1" <?php foreach ($hobbies as $hobby){if($hobby == 1){echo 'selected';}}?>>Hobbies 1</option>
                                <option value="2" <?php foreach ($hobbies as $hobby){if($hobby == 2){echo 'selected';}}?>>Hobbies 2</option>
                            </select>
                            <!--<input type="text" name="intersted_activities" class="form-control" value="<?php echo set_value('intersted_activities'); ?>"  placeholder="Interested Activities">-->
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">How Know About The Site</label>
                            <select class="form-control select2" name="about_site">
                                <option value="0">Choose</option>
                                <option value="1" <?php if($user->about_site == 1){echo 'selected';}?>>By Browsing</option>
                                <option value="2" <?php if($user->about_site == 2){echo 'selected';}?>>By Know Someone</option>
                            </select>
                        </div>

                        <a href="super_admin/allUser"><button type="button" class="btn btn-default waves-effect waves-light m-r-10">Cancel</button></a>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Edit</button>
                        <!--<button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>-->
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

<script>
    $(document).ready(function (){
        showDiv();
        
    });
    function showDiv(){
        var type = document.getElementById('trusted_status').value;
        
       // alert(type)
        if(type == 0 || type == 2){
            $("#facility_check").prop("checked", true); 
            $('#facDiv').show();
        }
        if(type == 1){
            $("#user_check").prop("checked", true); 
        }
        
        
    }
    
    function showFacDiv(val){
        var user_check = val.value;
      //  alert(user_check);
        if(user_check){
            $('#facDiv').hide();
        }
    }
    
    
</script>
