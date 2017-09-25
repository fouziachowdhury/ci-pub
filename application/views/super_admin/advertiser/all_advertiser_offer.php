<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Advertiser Offer Feed</h3>
            
                <ul class="list-unstyled list-inline" style="text-align: right;">
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
                    <?php $this->load->view('super_admin/advertiser/advertiser_show_div'); ?>
                </div>
            </div>
                
           
        </div>
    </div>
</div>
<script src="assets/admin/bower_components/jquery/dist/lightbox-plus-jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('#keyword').select2({
        tags: true,
        tokenSeparators: [",", " "], 
        placeholder: "Add your tags here"

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
    function showButton() {
//        var chkValue = $('#check_id').val();
//        alert(chkValue);
        if ($('.check_id').is(":checked")) {
            document.getElementById('editButton').style.display = "block";
            document.getElementById('deleteButton').style.display = "block";
//            document.getElementById('statusButton').style.display = "block";
        } else {
            document.getElementById('editButton').style.display = "none";
            document.getElementById('deleteButton').style.display = "none";
//            document.getElementById('statusButton').style.display = "none";
        }

    }

</script>

<script>
    function chkDelete() {
        var chk = confirm("Are You Sure to Delete This ?");
        if (chk) {
            return true;
        } else {
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
    function searchbycountry(country_id) {
//        alert(country_id);
        var table = 'advertise_offer_feed';
        var link = 'super_admin/advertiser/advertiser_show_div';
        var option_id = 6;
        $.ajax({
            url: "<?php echo site_url('admin/searchbycountry'); ?>",
            type: "post",
            data: {country_id: country_id,table: table,link:link,option_id:option_id},
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
        var table = 'advertise_offer_feed';
        var link = 'super_admin/advertiser/advertiser_show_div';
        var option_id = 6;
        
        $.ajax({
            url: "<?php echo site_url('admin/searchbycategory'); ?>",
            type: "post",
            data: {cat_id: cat_id,table: table,link:link,option_id:option_id},
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