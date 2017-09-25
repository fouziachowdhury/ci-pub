<?php 
//echo count($all_info);die();
?>

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <h3 class="" style="text-align: center;">All Facebook Ads</h3>
            <span>Show</span>
            <select onchange="numberOfEntries(this.value)">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
            </select><span>Entries</span>
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
<!--                    <li>
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
                    </li>-->
                </ul>
            
            <div class="table-responsive">
                <div id="showallbannerdiv">
                    <?php $this->load->view('super_admin/fb_ecommerce/facebook_show_div'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/admin/bower_components/jquery/dist/lightbox-plus-jquery.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
    $('.keyword').select2({
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


<script>

    function searchbycountry(country_id) {
        var table = 'facebook_ecommerce_ads';
        var link = 'super_admin/fb_ecommerce/facebook_show_div';
        var option_id = 4;
//        alert(country_id)
        $.ajax({
            url: "<?php echo site_url('admin/search_ecom_fb_by_country'); ?>",
            type: "post",
            data: {country_id: country_id,table: table,link:link,option_id:option_id},
            success: function (result) {
//                alert(result);
                var hhh = JSON.parse(result);
//                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $(".select2").select2();
                $('.keyword').select2({
                    tags: true,
                    tokenSeparators: [",", " "], 
                    placeholder: "Add your tags here"

                });
            }
        });
    }
    
    
    function searchbycategory(cat_id) {
        var table = 'facebook_ecommerce_ads';
        var link = 'super_admin/fb_ecommerce/facebook_show_div';
        var option_id = 4;
        var country_id = document.getElementById('country_id').value;
        $.ajax({
            url: "<?php echo site_url('admin/search_ecom_fb_by_category'); ?>",
            type: "post",
            data: {cat_id: cat_id,table: table,link:link,option_id:option_id,country_id:country_id},
            success: function (result) {
               // alert(result);
                var hhh = JSON.parse(result);
//                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $(".select2").select2();
                $('.keyword').select2({
                    tags: true,
                    tokenSeparators: [",", " "], 
                    placeholder: "Add your tags here"

                });
            }
        });
    }
    
      function searchbystatus(status) {
        var table = 'facebook_ecommerce_ads';
        var link = 'super_admin/fb_ecommerce/facebook_show_div';
        
        $.ajax({
            url: "<?php echo site_url('admin/search_by_fb_status'); ?>",
            type: "post",
            data: {status_id: status,table: table,link:link},
            success: function (result) {
                var hhh = JSON.parse(result);
//                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $(".select2").select2();
            }
        });
    }

    function numberOfEntries(val){
        var table = 'facebook_ecommerce_ads';
        var link = 'super_admin/fb_ecommerce/facebook_show_div';
        var option_id = 4;
        var page_link = 'admin/allFbEcom';
        
        $.ajax({
            url: "<?php echo site_url('admin/search_by_limit'); ?>",
            type: "post",
            data: {limit: val,table: table,link:link,option_id:option_id,page_link:page_link},
            success: function (result) {
//                alert(result);
                var hhh = JSON.parse(result);
//                console.log(hhh);
                $('#showallbannerdiv').html(hhh.bannerdiv);
                $(".select2").select2();
                $('.keyword').select2({
                    tags: true,
                    tokenSeparators: [",", " "], 
                    placeholder: "Add your tags here"

                });
            }
        });
    }

</script>