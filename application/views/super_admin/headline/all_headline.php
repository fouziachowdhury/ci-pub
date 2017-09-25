<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <a>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Add Headline
                </button>
            </a>
            
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Headline</h4>
                        </div>
                        <form action="admin/saveHeadline" name="myForm" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                
                                <!--<div class="form-group" id="category" style="display: none;">-->
                                <div class="form-group" id="category" style="">
                                    <label class="control-label">Category</label>
                                    <select class="form-control select2" name="category" onchange="showMyModel(this.value)">
                                        <option value="0">Choose Category</option>
                                        <?php foreach ($all_category as $cat){?>
                                        <option value="<?php echo $cat['cat_id'];?>"><?php echo $cat['cat_name'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                
                                <!--<div class="form-group" id="country" style="display: none;">-->
                                <div class="form-group" id="country" style="">
                                    <label class="control-label">Country</label>
                                    <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="country[]">
                                        <option value="0">Choose Countries</option>
                                        <?php foreach ($all_country as $country) { ?>
                                            <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                
                                <div class="optionBox1">
                                    <div class="block1">
                                        <span class="add1 btn btn-success" style="margin: 10px 0px;">Add</span>
                                    </div>

                                    <div class="block1">

                                        <label for="exampleInputuname">Headline Name</label>
                                        <input type="text" name="headline[]" id="choose_usr_email" multiple class="form-control" value="">
                                        
                                        <span class="remove1 btn btn-danger" style="margin-bottom: 10px;">Remove Option</span>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            
            <!--Modal End-->
            <h3 class="" style="text-align: center;">All Headline</h3>
            <ul class="list-unstyled list-inline" style="text-align: center;">
                <li><h4>Filter By</h4></li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Category
                            <span class="fa fa-sort-desc"></span></button>
                        <ul class="dropdown-menu dropdown-design">
                            <?php foreach ($all_category as $cat) { ?>
                                <li value="<?php echo $cat['cat_id']; ?>"><a onclick="searchbycategory(<?php echo $cat['cat_id']; ?>)"><?php echo $cat['cat_name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Country
                            <span class="fa fa-sort-desc"></span></button>
                        <ul class="dropdown-menu dropdown-design" style="height: 350px;overflow: auto;">
                            <?php foreach ($all_country as $country) { ?>
                                <li value="<?php echo $country['country_id']; ?>"><a onclick="searchbycountry(<?php echo $country['country_id']; ?>)"><?php echo $country['country_name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
            </ul>
                
               
                
                
            <div class="table-responsive">
                <div id="showallbannerdiv">
                    <?php $this->load->view('super_admin/headline/headline_div'); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $("#flowcheckall").click(function () {
        $('#myTable tbody input[type="checkbox"]').prop('checked', this.checked);
        showButton();
    });
</script>

<script>
    function showButton() {
//        var chkValue = $('#check_id').val();
//        alert(chkValue);
        if ($('.check_id').is(":checked")) {
            document.getElementById('deleteButton').style.display = "block";
        } else {
            document.getElementById('deleteButton').style.display = "none";
        }

    }

</script>

<script>
    $(document).ready(function() {
        
    $('#myTable').DataTable( {
//        "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>'
        "columnDefs": [ {
            "targets": 0,
            "orderable": false
            }]
    });
});
</script>

<script>
        var count = 0;
    $('.add1').click(function() {
        var n = $(".optionBox1 .block1").length;
        console.log(n);
        count++;
    $('.block1:last').after('<div class="block1">\n\
                                <label for="exampleInputuname">Headline Name</label>\n\
                                <input type="text" name="headline[]" id="choose_usr_email" multiple class="form-control" value="">\n\
                                <div id="hiddenDiv'+count+'" class="col-xs-12"></div>\n\
                                <span class="remove1 btn btn-danger" style="margin-bottom: 10px;">Remove Option</span></div>');
    });
    $('.optionBox1').on('click','.remove1',function() {
 	$(this).parent().remove();
    });
</script>

<script>
    
    function showDiv(val) {
        var type = val.value;
//        alert(type);
        if (type == 1) {
            document.getElementById('category').style.display = "block";
            document.getElementById('country').style.display = "none";
        }
        if (type == 2) {
            document.getElementById('country').style.display = "block";
            document.getElementById('category').style.display = "none";
        }
    }
    
</script>

<script>
    function editHeadline(headline_id){
//       var type = $('#type_id'+headline_id).val();
       var type = $('#type_id'+headline_id+':checked').val();
//        alert(type);
       if(type == 1){
           $("#category"+headline_id).show();
           $("#country"+headline_id).hide();
       }
       if(type == 2){
           $("#country"+headline_id).show();
           $("#category"+headline_id).hide();
       }
    }
     
</script>

<script>
    function chkDelete(){
        var chk = confirm("Are You Sure to Delete This ?");
        if(chk){
            return true;
        }
        else{
            return false;
        }
    }
</script>

<script type="text/javascript">

    function view_user(reg_id) {
//        alert(reg_id);
        $.ajax({
            url: "<?php echo site_url('super_admin/viewUserModal'); ?>",
            type: "post",
            data: {reg_id: reg_id},
            success: function (msg) {
//                alert("" + msg);
                $('#quick_view_modal').html(msg);
                $('#quick_view_modal').modal('show');
            }
        });
    }
</script>


<script>
    
    function changeHeadlineStatus(headline_id){
//       alert(cat_id);
       $.ajax({
            url: "<?php echo site_url('admin/changeHeadlineStatus'); ?>",
            type: "post",
            data: {headline_id: headline_id},
            success: function (msg) {
//                alert("" + msg);
                if(msg == '1'){
                    if($( "#active"+headline_id ).hasClass( "label-danger" )){
                       $('#active'+headline_id).text('Active').removeClass("label-danger").addClass("label-success");
                   } 
                    if($( "#inactive"+headline_id ).hasClass( "label-danger" )){
                        $('#inactive'+headline_id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                }
                if(msg == '0'){
                    if($( "#inactive"+headline_id ).hasClass( "label-success" )){
                        $('#inactive'+headline_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
                    if($( "#active"+headline_id ).hasClass( "label-success" )){
                        $('#active'+headline_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                   }
//                   
                }
            }
        });
    }
    
</script>

<script>

    function searchbycountry(country_id) {
//        alert(country_id);
        var table = 'headline';
        var link = 'super_admin/headline/headline_div';
        $.ajax({
            url: "<?php echo site_url('admin/search_headline_by_country'); ?>",
            type: "post",
            data: {country_id: country_id,table: table,link:link},
            success: function (result) {
//                alert(result);
                var hhh = JSON.parse(result);
                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $('#myTable').DataTable();
                $("#flowcheckall").click(function (){
                    $('#myTable tbody input[type="checkbox"]').prop('checked', this.checked);
                    showButton();
                });
            }
        });
    }
    
    
    function searchbycategory(cat_id) {
        var table = 'headline';
        var link = 'super_admin/headline/headline_div';
        
        $.ajax({
            url: "<?php echo site_url('admin/search_headline_by_category'); ?>",
            type: "post",
            data: {cat_id: cat_id,table: table,link:link},
            success: function (result) {
                var hhh = JSON.parse(result);
                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $('#myTable').DataTable();
                $("#flowcheckall").click(function () {
                    $('#myTable tbody input[type="checkbox"]').prop('checked', this.checked);
                    showButton();
                });
            }
        });
    }
    
      function searchbystatus(status) {
        var table = 'headline';
        var link = 'super_admin/headline/headline_div';
        
        $.ajax({
            url: "<?php echo site_url('admin/searchbystatus'); ?>",
            type: "post",
            data: {status_id: status,table: table,link:link},
            success: function (result) {
                var hhh = JSON.parse(result);
                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $('#myTable').DataTable();
                $("#flowcheckall").click(function () {
                    $('#myTable tbody input[type="checkbox"]').prop('checked', this.checked);
                    showButton();
                });
            }
        });
    }

    

</script>