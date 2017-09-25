<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
<!--                    <h5 style="color: red;"><?php if (validation_errors()) {
                                                    echo validation_errors();
                                            } ?>
                    </h5>-->
                    <form action="admin/savePpvsettings" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Monthly Membership Price</label>
                            <input type="text" name="membership_price" class="form-control" value="<?php if($ppv_settings){echo $ppv_settings[0]['membership_price'];}?>" placeholder="Monthly Membership Price">
                        </div> 
                        
                        <div class="form-group">
                            <label for="exampleInputuname">View Page Count</label>
                            <input type="text" name="view_count" class="form-control" value="<?php if($ppv_settings){echo $ppv_settings[0]['view_count'];}?>" placeholder="Count View Page">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputuname">Domain Tools limit</label>
                            <input type="text" name="download_count" class="form-control" value="<?php if($ppv_settings){echo $ppv_settings[0]['download_count'];}?>" placeholder="Count Download">
                        </div>
                        
                        <button type="submit" id="myBtn" class="btn btn-success waves-effect waves-light m-r-10">Submit</button>
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


<script>
    
    function chkUser(user){
        var user_name = user.value;
        
        $.ajax({
            type: 'POST',
           url: "super_admin/check_user_name",
           data: {user_name : user_name},
           success: function (data) {
               if(data == 0){
                   document.getElementById('chk_user_msg').style.display = "block";
                   $(":submit").attr("disabled", true);
               }
              if(data == 1){
                   document.getElementById('chk_user_msg').style.display = "none";
                   $(":submit").removeAttr("disabled");
               }
           }
           
        });
    }
    
    function chkEmail(email){
        var email_address = email.value;
//        alert(email_address);
        $.ajax({
            type: 'POST',
           url: "super_admin/check_email",
           data: {email : email_address},
           success: function (data) {
               if(data == 0){
                   document.getElementById('chk_email_msg').style.display = "block";
                   $(":submit").attr("disabled", true);
               }
               else{
                   document.getElementById('chk_email_msg').style.display = "none";
                   $(":submit").removeAttr("disabled");
               }
           }
           
        });
    }
    
    function chkValidEmail(email){
        var email_add = email.value;
        var filter = /^([a-z0-9_\.\-])+([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
//        alert(email_add);

        if (!filter.test(email_add)){
            document.getElementById('valid_email_msg').style.display = 'block';
            $(":submit").attr("disabled", true);
        }
        else{
            document.getElementById('valid_email_msg').style.display = 'none';
            $(":submit").removeAttr("disabled");
        }
        
    }
    
    function chkValidMobile(mobile){
        var mobile_no = mobile.value;
//        alert(mobile_no);
        if (isNaN(mobile_no)){
                document.getElementById('valid_mobile_msg').style.display = 'block';
                $(":submit").attr("disabled", true);
            }
            else{
                $(":submit").removeAttr("disabled");
            }
    }
    
</script>

<script type="text/javascript">
    
    function getActivities() {
        var value = $( "#activities option:selected").val();
        if(value == 'Add'){
//          $('#activities option').attr('disabled',true);
            $('#modal-content').modal({
            show: true
        });
        } 
    }
    
    function showMyModel(val)
    {
        if (val == "add") {
            $('#modal-site').modal({
                show: true
            });
        }
    }
    
    function showHobbiesModel(val)
    {
        if (val == "add_hobbies") {
            $('#modal-hobbies').modal({
                show: true
            });
        }
    }
        
        
    

</script>
