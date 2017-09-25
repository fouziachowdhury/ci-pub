<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All User</h3>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <p style="text-align: right;color: red;">Search By Name, Email, Fee Paid</p>
                        <tr>
                            <!--<th style="text-align: center;">Sl No.</th>-->
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center;">Email</th>
                            <th style="text-align: center;">Paid</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;foreach ($all_user as $row){?>
                        <tr style="text-align: center;">
                            <!--<td><?php echo $i;?></td>-->
                            <td><a href="admin/viewUser/<?php echo $row['member_id']?>"><?php echo $row['name']?></a></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php if($row['fee_amount']){echo 'Paid';}else{echo 'Unpaid';}?></td>
                            <td>
                                <?php if($row['status'] == 0){?>
                                <label class="label label-danger" style="line-height: 2">Inactive</label>
                                <?php }?>
                                <?php if($row['status'] == 1){?>
                                <label class="label label-success" style="line-height: 2">Active</label>
                                <?php }?>
                                <?php if($row['status'] == 2){?>
                                <label class="label label-warning" style="line-height: 2">Trial</label>
                                <?php }?>
                            </td>
                            <td>
                                
                                <a href="admin/userStatus/<?php echo $row['member_id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="Set Trial" class="glyphicon glyphicon-refresh"></span>
                                </a>&nbsp;
<!--                                <a href="super_admin/editUser/">
                                    <span data-toggle="tooltip" data-placement="top" title="Edit User" class="glyphicon glyphicon-edit"></span>
                                </a>&nbsp;-->
                                <a href="admin/deleteUser/<?php echo $row['member_id'];?>" onclick="return chkDelete()">
                                    <span data-toggle="tooltip" data-placement="top" title="Remove" class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                        </tr>
                        <?php }?>
                        
                    </tbody>
                </table>
                
                
                <div class="modal fade" id="quick_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                </div>
                
                
            </div>
        </div>
    </div>
</div>

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