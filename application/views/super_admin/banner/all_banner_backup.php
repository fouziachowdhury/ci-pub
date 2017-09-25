<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Banner Ads</h3>
            <div class="table-responsive">
                <ul class="list-unstyled list-inline" style="text-align: right;">
<!--                    <li><h4>Filter By</h4></li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Category
                                <span class="fa fa-sort-desc"></span></button>
                            <ul class="dropdown-menu dropdown-design">
                                <li><a href="#">A</a></li>
                                <li><a href="#">B</a></li>
                                <li><a href="#">C</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Country
                                <span class="fa fa-sort-desc"></span></button>
                            <ul class="dropdown-menu dropdown-design">
                                <li><a href="#">A</a></li>
                                <li><a href="#">B</a></li>
                                <li><a href="#">C</a></li>
                            </ul>
                        </div>
                    </li>-->
                </ul>
                <form action="admin/editMultipleBanner" method="post">
                    <ul class="list-inline list-unstyled">
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="statusButton">
                                <button type="submit" name="status" class="btn btn-success">Status</button>
                            </a> 
                        </li>
                        
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="editButton">
                                <button type="submit" name="edit" class="btn btn-info">Edit</button>
                            </a>
                        </li>
                        
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="deleteButton" onclick="return chkDelete()">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </a> 
                        </li>
                    </ul>
                    
                    
                <table id="myTable" class="table table-striped">
                    <thead>
                        <!--<p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>-->
                        <tr>
                            <th style="text-align: center;"></th>
                            <th style="text-align: center;">Image</th>
                            <th style="text-align: center;">Size</th>
                            <th style="text-align: center;">Category</th>
                            <th style="text-align: center;">Country</th>
                            <th style="text-align: center;">Keyword</th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($all_banner as $row){?>
                        
                        <tr style="text-align: center;">
                            <td>
                                <input class="check_id" name="banner_id[]" type="checkbox" value="<?php echo $row['banner_id'];?>" onclick="showButton()">
                            </td>
                            <td>
                                <a class="example-image-link" href="uploads/banner_images/<?php echo $row['image']?>" data-lightbox="example-1">
                                    <img class="example-image" src="uploads/banner_images/<?php echo $row['image']?>" alt="Banner Image" style="width: 100px;height: 50px;"/>
                                </a>
                            </td>
                            <td><?php echo $row['width'];?> * <?php echo $row['height']?></td>
                            <td>
                                <?php $category = explode(',', $row['cat_id']);
//                                    print_r($category);
                                foreach ($category as $cat){
                                foreach ($all_category as $all_cat){
                                    if($all_cat['cat_id'] == $cat){
                                        echo $all_cat['cat_name'].'<br>';
                                    }
                                }}?>
                            </td>
                            <td>
                                <?php $country = explode(',', $row['country_id']);
//                                    print_r($category);
                                foreach ($country as $cnt){
                                foreach ($all_country as $country){
                                    if($country['country_id'] == $cnt){
                                        echo $country['country_name'].'<br>';
                                    }
                                }}?>
                            </td>
                            <td>
                                <?php $keyword = explode(',', $row['keyword']);
//                                    print_r($category);
                                foreach ($keyword as $key){
                                foreach ($all_keyword as $all_key){
                                    if($all_key['id'] == $key){
                                        echo $all_key['keyword_tags'].'<br>';
                                    }
                                }}?>
                            </td>
                            <td><?php echo $row['date'];?></td>
                            <td>
                                <?php if($row['status'] == 1){?>
                                <a onclick="changeBannerStatus('<?php echo $row['banner_id']; ?>')">
                                    <label class="label label-success" id="active<?php echo $row['banner_id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                                </a>
                                <?php }?>
                                <?php if($row['status'] == 0){?>
                                <a onclick="changeBannerStatus('<?php echo $row['banner_id']; ?>')" style="">
                                    <label class="label label-danger" id="inactive<?php echo $row['banner_id'];?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                                </a>
                                <?php }?>
                            </td>
                            <td>
<!--                                <a onclick="changeBannerStatus('<?php echo $row['banner_id'];?>')">
                                    <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>
                                </a>&nbsp;-->
                                <a href="admin/editBanner/<?php echo $row['banner_id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Banner" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;<!--
                                <a href="admin/delete_user/" onclick="return chkDelete()">
                                    <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                </a>-->
                            </td>
                        </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
                </form>
                
                <div class="modal fade" id="quick_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                </div>
                
                
            </div>
        </div>
    </div>
</div>
<script src="assets/admin/bower_components/jquery/dist/lightbox-plus-jquery.min.js" type="text/javascript"></script>
<script>
    
    function changeBannerStatus(banner_id){
//       alert(banner_id);
       $.ajax({
            url: "<?php echo site_url('admin/changeBannerStatus'); ?>",
            type: "post",
            data: {banner_id: banner_id},
            success: function (msg) {
//                alert("" + msg);
                if(msg == '1'){
                    if($( "#active"+banner_id ).hasClass( "label-danger" )){
                       $('#active'+banner_id).text('Active').removeClass("label-danger").addClass("label-success");
                   } 
                    if($( "#inactive"+banner_id ).hasClass( "label-danger" )){
                        $('#inactive'+banner_id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                }
                if(msg == '0'){
                    if($( "#inactive"+banner_id ).hasClass( "label-success" )){
                        $('#inactive'+banner_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
                    if($( "#active"+banner_id ).hasClass( "label-success" )){
                        $('#active'+banner_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                   }
//                   
                }
            }
        });
    }
    
</script>

<script>
    function showButton(){
//        var chkValue = $('#check_id').val();
//        alert(chkValue);
        if ($('.check_id').is(":checked")){
            document.getElementById('editButton').style.display = "block";
            document.getElementById('statusButton').style.display = "block";
            document.getElementById('deleteButton').style.display = "block";
        }
        else{
            document.getElementById('editButton').style.display = "none";
            document.getElementById('statusButton').style.display = "none";
            document.getElementById('deleteButton').style.display = "none";
        }
        
    }
    
</script>

<script>
    $(document).ready(function (){
        $("#active").prop("checked", true);
        $("#inactive").prop("checked", true);
        $("#trial").prop("checked", true);
        
    });
     
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
