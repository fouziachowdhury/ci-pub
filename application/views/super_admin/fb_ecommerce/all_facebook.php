<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Facebook Ads</h3>
            <div class="table-responsive">
                <ul class="list-unstyled list-inline" style="text-align: right;">
                    <!--<li><h4>Filter By</h4></li>-->
<!--                    <li><button class="btn btn-success">Newest</button></li>
                    <li><button class="btn btn-success">Oldest</button></li>
                    <li><button class="btn btn-success">Size</button></li>-->
<!--                    <li>
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
                <form action="admin/editMultipleFbEcom" method="post">
                    <ul class="list-inline list-unstyled">
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="statusButton">
                                <button type="submit" name="status" class="btn btn-success">Status</button>
                            </a> 
                        </li>
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="editButton" data-toggle="modal" data-target="#editLink">
                                <button type="button" name="edit" class="btn btn-info">Edit</button>
                                <!--<button type="submit" name="edit" class="btn btn-info">Edit</button>-->
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
                            <th style="text-align: center;" class="check">
                                <input type="checkbox" id="flowcheckall" value="" />&nbsp;All
                            </th>
                            <th style="text-align: center;">Image</th>
                            <th style="text-align: center;">Size</th>
                            <th style="text-align: center;">Category</th>
                            <th style="text-align: center;">Country</th>
                            <th style="text-align: center;">Keyword</th>
                            <th style="text-align: center;">Type</th>
                            <th style="text-align: center;">Date</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($all_facebook_ads as $row){?>
                        <tr style="text-align: center;">
                            <td>
                                <input class="check_id" name="fb_ecom_images_id[]" type="checkbox" value="<?php echo $row['fb_ecom_images_id'];?>" onclick="showButton()">
                            </td>
                            <td>
                                <a class="example-image-link" href="uploads/facebook_ads/<?php echo $row['image']?>" data-lightbox="example-1">
                                    <img class="example-image" src="uploads/facebook_ads/<?php echo $row['image']?>" alt="Banner Image" style="width: 100px;height: 50px;">
                                </a>
                                
                            </td>
                            <td><?php echo $row['width']?> * <?php echo $row['height']?></td>
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
                                foreach ($keyword as $key){
                                foreach ($all_keyword as $all_key){
//                                    print_r($all_key);
                                    if($all_key['id'] == $key){
                                        echo $all_key['keyword_tags'].'<br>';
                                    }
                                }}?>
                            </td>
                            <td>
                                <?php if($row['facebook_type'] == 1){
                                        echo 'News Feed';
                                }else{
                                    echo 'Right Side Ad';
                                }?>
                            </td>
                            <td><?php $timestamp = strtotime($row['date']);
                                echo date('d-m-Y', $timestamp);?></td>
                            <td>
                                <?php if($row['status'] == 1){?>
                                <a onclick="changeFbEcomStatus('<?php echo $row['fb_ecom_images_id']; ?>')">
                                    <label class="label label-success" id="active<?php echo $row['fb_ecom_images_id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                                </a>
                                <?php }?>
                                <?php if($row['status'] == 0){?>
                                <a onclick="changeFbEcomStatus('<?php echo $row['fb_ecom_images_id']; ?>')" style="">
                                    <label class="label label-danger" id="inactive<?php echo $row['fb_ecom_images_id'];?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                                </a>
                                <?php }?>
                            </td>
                            <td>
<!--                                <a href="super_admin/change_type/">
                                    <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>
                                </a>&nbsp;-->
                                <a href="admin/editFbEcomImage/<?php echo $row['fb_ecom_images_id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Facebook Ads" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
<!--                                <a href="admin/editFcaebookImage/">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Facebook Image" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
                                <a href="super_admin/delete_user/" onclick="return chkDelete()">
                                    <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                </a>-->
                            </td>
                            
                            <div id="editLink" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    Modal content

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="text-align: center">Edit</h4>
                                        </div>
                                        <!--<form action="admin/updateBanner" class="form-horizontal" method="post" enctype="multipart/form-data">-->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label for="exampleInputuname">Facebook Type</label>
                                                        <div class="radio-list">

                                                            <label class="radio-inline p-0">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="bulk_fb_type" id="news_feed_bulk" value="1">
                                                                    <label for="news_feed_bulk">News Feed</label>
                                                                </div>
                                                            </label>

                                                            <label class="radio-inline">
                                                                <div class="radio radio-info">
                                                                    <input type="radio" name="bulk_fb_type" id="right_side_bulk" value="2">
                                                                    <label for="right_side_bulk">Right Side Ad</label>
                                                                </div>
                                                            </label>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputuname">Categories(For Bulk)</label>
                                                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_cat[]">
                                                            <option value="0">Choose Categories</option>
                                                            <?php foreach ($all_category as $cat) { ?>
                                                                <option value="<?php echo $cat['cat_id'] ?>"><?php echo $cat['cat_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputuname">Countries(For Bulk)</label>
                                                        <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="bulk_country[]">
                                                            <option value="0">Choose Countries</option>
                                                            <?php foreach ($all_country as $country) { ?>
                                                                <option value="<?php echo $country['country_id'] ?>"><?php echo $country['country_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputuname">Keywords(For Bulk)</label>
                                                        <input type="text" name="bulk_keyword[]" id="keyword_bulk" multiple class="" value="<?php echo set_value('membership_price'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger btn-rounded"
                                                        data-dismiss="modal">Close
                                                </button>
                                                <button type="submit" name="edit" id="sub_button" class="btn btn-success btn-rounded">Submit
                                                </button>
                                            </div>
<!--                                        </form>-->
                                    </div>
                                </div>
                            </div>
                            
                        </tr>
                        <?php $i++;}?> 

                    </tbody>
                </table>

                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/admin/bower_components/jquery/dist/lightbox-plus-jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
    $('#keyword_bulk').select2({
    tags: true,
    tokenSeparators: [",", " "], 
    placeholder: "Add your tags here"
    
    });
    
    $('#myTable').dataTable( {
        "columnDefs": [ {
        "targets": 0,
        "orderable": false
        }]
    });
    
});
    
</script>

<script>
    $("#flowcheckall").click(function () {
        $('#myTable tbody input[type="checkbox"]').prop('checked', this.checked);
        showButton();
    });
</script>

<script>
    function showButton(){
        if ($('.check_id').is(":checked")){
            document.getElementById('statusButton').style.display = "block";
            document.getElementById('editButton').style.display = "block";
            document.getElementById('deleteButton').style.display = "block";
        }
        else{
            document.getElementById('statusButton').style.display = "none";
            document.getElementById('editButton').style.display = "none";
            document.getElementById('deleteButton').style.display = "none";
        }
    }
    
</script>

<script>
    
    function changeFbEcomStatus(fb_ecom_images_id){
//       alert(fb_ecom_images_id);
       $.ajax({
            url: "<?php echo site_url('admin/changeFbEcomStatus'); ?>",
            type: "post",
            data: {fb_ecom_images_id: fb_ecom_images_id},
            success: function (msg) {
//                alert("" + msg);
                if(msg == '1'){
                    if($( "#active"+fb_ecom_images_id ).hasClass( "label-danger" )){
                       $('#active'+fb_ecom_images_id).text('Active').removeClass("label-danger").addClass("label-success");
                   } 
                    if($( "#inactive"+fb_ecom_images_id ).hasClass( "label-danger" )){
                        $('#inactive'+fb_ecom_images_id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                }
                if(msg == '0'){
                    if($( "#inactive"+fb_ecom_images_id ).hasClass( "label-success" )){
                        $('#inactive'+fb_ecom_images_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
                    if($( "#active"+fb_ecom_images_id ).hasClass( "label-success" )){
                        $('#active'+fb_ecom_images_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                   }
//                   
                }
            }
        });
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