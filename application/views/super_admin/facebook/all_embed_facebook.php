<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Facebook Ads</h3>
            <div class="table-responsive">
                <form action="admin/editMultipleFbEcom" method="post">
<!--                    <ul class="list-inline list-unstyled">
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="statusButton">
                                <button type="submit" name="status" class="btn btn-success">Status</button>
                            </a> 
                        </li>
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="editButton" data-toggle="modal" data-target="#editLink">
                                <button type="button" name="edit" class="btn btn-info">Edit</button>
                                <button type="submit" name="edit" class="btn btn-info">Edit</button>
                            </a>
                        </li>
                        <li>
                            <a style="display: none;margin: 5px 0px;" id="deleteButton" onclick="return chkDelete()">
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </a> 
                        </li>
                    </ul>-->
                <table id="myTable" class="table table-striped">
                    
                    <thead>
                
                        <!--<p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>-->
                        
                        <tr>
                            <th style="text-align: center;" class="check">Sl No.</th>
                            <th style="text-align: center;">Embed Code</th>
                            <!--<th style="text-align: center;">Status</th>-->
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($all_info as $row){?>
                        <tr style="text-align: center;">
                            <td>
                                <?php echo $i;?>
                            </td>
                            <td>
                                <p><?php echo $row['embedded_code'];?></p>
                            </td>
                            
<!--                            <td>
                                <?php if($row['status'] == 1){?>
                                <a onclick="changeFbEcomStatus('<?php echo $row['id']; ?>')">
                                    <label class="label label-success" id="active<?php echo $row['id']; ?>" style="line-height: 2;cursor: pointer;">Active</label>
                                </a>
                                <?php }?>
                                <?php if($row['status'] == 0){?>
                                <a onclick="changeFbEcomStatus('<?php echo $row['id']; ?>')" style="">
                                    <label class="label label-danger" id="inactive<?php echo $row['id'];?>" style="line-height: 2;cursor: pointer;">Inactive</label>
                                </a>
                                <?php }?>
                            </td>-->
                            <td>
<!--                                <a href="super_admin/change_type/">
                                    <span data-toggle="tooltip" data-placement="top" title="Change Status" class="glyphicon glyphicon-refresh"></span>
                                </a>&nbsp;-->
                                <a href="admin/editFbEcomImage/<?php echo $row['id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Facebook Ads" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
<!--                                <a href="admin/editFcaebookImage/">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit Facebook Image" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;
                                <a href="super_admin/delete_user/" onclick="return chkDelete()">
                                    <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                </a>-->
                            </td>
                            
                            
                            
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
    
    function changeFbEcomStatus(id){
//       alert(id);
       $.ajax({
            url: "<?php echo site_url('admin/changeFbEcomStatus'); ?>",
            type: "post",
            data: {id: id},
            success: function (msg) {
//                alert("" + msg);
                if(msg == '1'){
                    if($( "#active"+id ).hasClass( "label-danger" )){
                       $('#active'+id).text('Active').removeClass("label-danger").addClass("label-success");
                   } 
                    if($( "#inactive"+id ).hasClass( "label-danger" )){
                        $('#inactive'+id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                }
                if(msg == '0'){
                    if($( "#inactive"+id ).hasClass( "label-success" )){
                        $('#inactive'+id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
                    if($( "#active"+id ).hasClass( "label-success" )){
                        $('#active'+id).text('Inactive').removeClass("label-success").addClass("label-danger");
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