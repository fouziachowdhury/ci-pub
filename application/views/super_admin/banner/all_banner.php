<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Banner Ads</h3>
            
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
                <li>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Size
                            <span class="fa fa-sort-desc"></span></button>
                        <ul class="dropdown-menu dropdown-design">
                            <?php foreach ($allsize as $size) { //print_r($size); exit; ?>
                                <li value="<?php echo $size['width']; ?> - <?php echo $size['height']; ?>">
                                    <a onclick="searchbySize(<?php echo $size['width']; ?>, <?php echo $size['height']; ?>)">
                                        <?php echo $size['width']; ?> - <?php echo $size['height']; ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Status
                            <span class="fa fa-sort-desc"></span></button>
                        <ul class="dropdown-menu dropdown-design">
                            <li value="1"><a onclick="searchbystatus(1)">Active</a></li>
                            <li value="0"><a onclick="searchbystatus(0)">Inactive</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <div class="table-responsive">
                <div id="showallbannerdiv">
                    <?php $this->load->view('super_admin/banner/adminbannershowdiv'); ?>
                </div>
                <div class="modal fade" id="quick_view_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                </div>


            </div>
        </div>
    </div>
</div>
<script src="assets/admin/bower_components/jquery/dist/lightbox-plus-jquery.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function(){
        $('#choose_usr_email').select2({
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

    function changeBannerStatus(banner_id) {
//       alert(banner_id);
        $.ajax({
            url: "<?php echo site_url('admin/changeBannerStatus'); ?>",
            type: "post",
            data: {banner_id: banner_id},
            success: function (msg) {
//                alert("" + msg);
                if (msg == '1') {
                    if ($("#active" + banner_id).hasClass("label-danger")) {
                        $('#active' + banner_id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                    if ($("#inactive" + banner_id).hasClass("label-danger")) {
                        $('#inactive' + banner_id).text('Active').removeClass("label-danger").addClass("label-success");
                    }
                }
                if (msg == '0') {
                    if ($("#inactive" + banner_id).hasClass("label-success")) {
                        $('#inactive' + banner_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
                    if ($("#active" + banner_id).hasClass("label-success")) {
                        $('#active' + banner_id).text('Inactive').removeClass("label-success").addClass("label-danger");
                    }
//                   
                }
            }
        });
    }

</script>

<script>
    function showButton() {
//        var chkValue = $('#check_id').val();
//        alert(chkValue);
        if ($('.check_id').is(":checked")) {
            document.getElementById('editButton').style.display = "block";
            document.getElementById('statusButton').style.display = "block";
            document.getElementById('deleteButton').style.display = "block";
        } else {
            document.getElementById('editButton').style.display = "none";
            document.getElementById('statusButton').style.display = "none";
            document.getElementById('deleteButton').style.display = "none";
        }

    }

</script>

<script>
    $(document).ready(function () {
        $("#active").prop("checked", true);
        $("#inactive").prop("checked", true);
        $("#trial").prop("checked", true);

    });

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

<script>

    function searchbycountry(country_id) {
        var table = 'banner';
        var link = 'super_admin/banner/adminbannershowdiv';
        var option_id = 1;
        $.ajax({
            url: "<?php echo site_url('admin/searchbycountry'); ?>",
            type: "post",
            data: {country_id: country_id,table: table,link:link,option_id:option_id},
            success: function (result) {
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
        var table = 'banner';
        var link = 'super_admin/banner/adminbannershowdiv';
        var option_id = 1;
        
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
    
      function searchbystatus(status) {
        var table = 'banner';
        var link = 'super_admin/banner/adminbannershowdiv';
        var option_id = 1;
        $.ajax({
            url: "<?php echo site_url('admin/searchbystatus'); ?>",
            type: "post",
            data: {status_id: status,table: table,link:link,option_id:option_id},
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

    function searchbySize(width, height) {
        var table = 'banner';
        var link = 'super_admin/banner/adminbannershowdiv';
        var option_id = 1;
        $.ajax({
            url: "<?php echo site_url('admin/searchbysize'); ?>",
            type: "post",
            data: {
                width: width,
                height: height,
                table: table,
                link:link,
                option_id:option_id
            },
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
