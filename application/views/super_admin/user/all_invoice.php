<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Invoice of <?php echo $user_info[0]['name']?></h3>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Invoice Code</th>
                            <th style="text-align: center;">Payment Type</th>
                            <th style="text-align: center;">Date</th>
                            <th class="text-center">Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($invoice_info as $inv){?>
                        <tr style="text-align: center">
                            <td>INV# <?php echo $inv['invoice_code'];?></td>
                            <td><?php echo $inv['name'];?></td>
                            <td>
                                <?php $timestamp = strtotime($inv['date']);
                                echo date('d-m-Y', $timestamp);?>
                            </td>
                            <td>
                                <?php if($inv['fee_amount']){?>
                                <label class="label label-success" style="line-height: 2">Paid</label>
                                <?php }else{?>
                                <label class="label label-danger" style="line-height: 2">Unpaid</label>
                                <?php }?>
                            </td>
                            <td class="text-center">
                                <a href="admin/viewInvoice/<?php echo $inv['invoice_id'];?>">
                                    <span data-toggle="tooltip" data-placement="top" title="View User" class="glyphicon glyphicon-eye-open"></span>
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