<style>
.cursoricon { cursor: pointer; cursor: hand;}
.cursoricon a:hover { cursor: pointer; cursor: hand;}

.select2-container .select2-choice > .select2-chosen{
        color: #fff !important;
        font-weight: 700;
    }
    
    /* Pagination */
    div.pagination {
        font-family: "Lucida Sans Unicode", "Lucida Grande", LucidaGrande, "Lucida Sans", Geneva, Verdana, sans-serif;
        padding:2px;
        margin: 20px 10px;
        float: right;
    }

    div.pagination a {
        margin: 2px;
        padding: 0.5em 0.64em 0.43em 0.64em;
        background-color: #FD1C5B;
        text-decoration: none; /* no underline */
        color: #fff;
    }
    div.pagination a:hover, div.pagination a:active {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #FD1C5B;
        color: #fff;
    }
    div.pagination span.current {
        padding: 0.5em 0.64em 0.43em 0.64em;
        margin: 2px;
        background-color: #f6efcc;
        color: #6d643c;
    }
    div.pagination span.disabled {
        display:none;
    }
    .pagination ul li{display: inline-block;}
    .pagination ul li a.active{opacity: .5;}
    
</style>
<div class="alert alert-danger" id="downloaderror" style="display:none">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Danger!</strong> You have cross your limit of download this add. Renew your package Now.
</div>

<div class="row demosrs" id='showfbaddsdata'>
    <section id="contentrs">
        
        <input type="hidden" id="cat_id" value="<?php echo $this->session->userdata('cat_id'); ?>">
        <input type="hidden" id="country_id" value="<?php echo $this->session->userdata('country_id'); ?>">
        <input type="hidden" id="searchval" value="<?php echo $this->session->userdata('searchval'); ?>">
        <input type="hidden" id="searchkey" value="<?php echo $this->session->userdata('searchkey'); ?>">
        
        <div id="container" class="clearfix" style="padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <div class="row">
                
                <h4 style="color: red;"><?php
                    $msg = $this->session->userdata('message');
                    if($msg){
                        echo $msg;
                        $this->session->unset_userdata('message');
                    }
                ?></h4>
                
                <?php
                if (!empty($allppv)) {
                    foreach ($allppv as $ppv) {
                        ?>
                        <!--                                <div class="white-box">-->
                        <div class="col-md-6" style="margin: 5px;width: 48%; margin-bottom: 25px;">
                            <div class="row" style="background: #fff; border: 1px solid #ddd;">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12"> 
                                        <a class="thumbnail" href="#" style="margin-top: 5px;margin-left: 5px; margin-bottom: 0px;"><img class="img-responsive" src="<?php echo $ppv['zip_file_name']; ?>" alt=""></a>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <h5 style="font-weight:bold"><?php echo $ppv['title']; ?></h5>
                                        <div class="table-responsive" style="overflow: unset;border: 1px solid #ddd; margin-right: 3px;">
                                            <table id="myTable" class="table table-striped" style="margin: 0px;font-size: 12px;">
                                                <thead>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center; padding: 3px;">
                                                            <a href="<?php echo $ppv['url']; ?>" target="_blank">VIew Page</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 3px;">Category :
                                                            
                                                            <?php
                                                            if (isset($ppv['cat_id'])) {
                                                                $categoryArray = explode(',', $ppv['cat_id']);
                                                                foreach ($categoryArray as $category){
                                                                    if(isset($category)){
                                                                        $getcategory = $this->LandingModel->getcategoryinfo($category);
//                                                                print_r($country);
                                                                    }
                                                                    ?>
                                                                    <a onclick="searchbycategory('<?php echo $category;?>')" style="cursor: pointer">
                                                                        <?php if(isset($getcategory[0])){echo $getcategory[0]['cat_name'] . ',';}?>
                                                                    </a>
                                                                <?php }
                                                                 }
                                                            ?>
<!--                                                            <a href="ppvByCategory/<?php echo $ppv['cat_id'];?>">
                                                                <?php
//                                                                    $categoryArray = explode(',', $ppv['cat_id']);
//                                                                    $getcategory = $this->LandingModel->getcategoryinfo($categoryArray);
//                                                                    $string = '';
//                                                                    if(isset($getcategory)){
//                                                                    foreach ($getcategory as $cat) {
//                                                                        $string[] = $cat['cat_name'];
//                                                                    }
//                                                                        echo implode(", ", $string);
//                                                                    }
                                                                ?>
                                                            </a>-->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 3px;">Country : 
                                                            <?php
                                                                if (isset($ppv['country_id'])) {
                                                                    $countryArray = explode(',', $ppv['country_id']);
                                                                    foreach ($countryArray as $country){
                                                                      if(isset($country)){
                                                                        $getcountry = $this->LandingModel->getcountryinfo($country);
//                                                                print_r($country);
                                                                    }
                                                                    ?>
<!--                                                                    <a href="ppvByCountry/<?php echo $country; ?>">-->
                                                                    <a onclick="searchbycountry('<?php echo $country;?>')" style="cursor: pointer">
                                                                        <?php if(isset($getcountry[0])){echo $getcountry[0]['country_name'] . ',';}?>
                                                                    </a>
                                                                <?php }
                                                                 }
                                                            ?>
<!--                                                            <a href="ppvByCountry/<?php echo $ppv['country_id'];?>">
                                                                <?php
//                                                                    $countryArray = explode(',', $ppv['country_id']);
//                                                                    $getcountry = $this->LandingModel->getcountryinfo($countryArray);
//                                                                    //print_r($getcountry); exit;
//                                                                    $coun = '';
//                                                                    foreach ($getcountry as $ccc) {
//                                                                        $coun[] = $ccc['country_name'];
//                                                                    }
////                                                                    print_r($coun);
//                                                                    echo implode(", ", $coun);
                                                                ?>
                                                            </a>-->
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 3px;">Tag : 
                                                            
                                                            
                                                            <?php
                                                            if (isset($ppv['keyword'])) {
                                                                $keyArray = explode(',', $ppv['keyword']);
//                                                                print_r($keyArray);
                                                                foreach ($keyArray as $key){
                                                                    if(isset($key)){
//                                                                        echo '<pre>';print_r($key);
                                                                    $getkeyword = $this->LandingModel->get_keyword_by_key($key,5);
                                                                    }
//                                                                    echo '<pre>';print_r($getkeyword);
                                                                    ?>
                                                                    <!--<a href="ppvByTag/<?php echo $key; ?>">-->
                                                                    <a onclick="search_by_tag('<?php echo $key;?>')" style="cursor: pointer">
                                                                        <?php if(isset($getkeyword[0])){
                                                                            echo $getkeyword[0]['keyword_tags'] . ',';
                                                                            }
                                                                        ?>
                                                                    </a>
                                                            <?php }
                                                            }?>
                                                            
                                                            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <span class="cursoricon" style="font-size: 10px;" onclick="showcommentbox('<?php echo $ppv['ppv_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $ppv['ppv_id']; ?>" data-toggle="modal" data-target="#ppvcommentmodal"><img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url()?>assets/icon/comment.png" style="color:#3079C8; width: 16px;"> Comments </span>
                                            <div class="modal fade" tabindex="-1" role="dialog" id="ppvcommentmodal"></div>
                                            <?php if (in_array($ppv['ppv_id'], $favbanner)) { ?>
                                                <span class="cursoricon" style="font-size: 10px;"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url()?>assets/icon/favorites.png" style="color:red;width: 16px;">Favorites</span>
                                            <?php } else { ?>
                                                <a class="cursoricon" style="font-size: 10px;" href="<?php echo base_url() ?>makebannerfavorites/<?php echo $ppv['ppv_id']; ?>/5"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" src="<?php echo base_url()?>assets/icon/favorites.png" style="color:red;width: 16px;">Add To Favorite</a>
                                            <?php } ?>

                                            <span class="cursoricon" style="margin-left: 7px;font-size: 10px;"> 
                                                <a href="ppv/download/<?php echo $ppv['ppv_id'] ?>/<?php echo $ppv['zip_file'] ?>">
                                                    <img data-toggle="tooltip" data-placement="bottom" title="Download" src="<?php echo base_url() ?>assets/icon/download.png" style="width: 16px;"> Download
                                                </a>
                                            </span>
                                          <a hidden id="download_<?php echo $ppv['ppv_id']?>" onclick="bannimgdown('<?php echo $ppv['ppv_id']?>')" download="<?php echo $ppv['zip_file_name']; ?>" href="<?php echo $ppv['zip_file_name']; ?>"><img data-toggle="tooltip" data-placement="bottom" title="Download" src="<?php echo base_url() ?>assets/icon/download.png" style="width: 16px;"></a>
                                             <input type="hidden" id="bannerid_<?php echo $ppv['ppv_id']?>" name="banneridtext" value="<?php echo $ppv['ppv_id']; ?>">
                                        </div> 
                                    </div>
                                </div>
                                <h4 style="text-align: center;font-weight: bold;">

                                </h4>


                            </div>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                </div>
                <div>
                    <h3 style="color:red">There is no data according your criteria !!!!</h3>
                </div>
<?php } ?>
        </div>
    </section>
    
    <?php echo $this->ajax_pagination->create_links(); ?>
        <div class="clearfix"></div>
</div>

<script>
     function bannerdownload(item_id) {
                var option_id = 5;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>downloadcheck',
                    data: {
                        'item_id': item_id,
                        'option_id': option_id
                    },
                    success: function (result) {
                        var hhh = JSON.parse(result);
                        if (hhh.downloadresult == 1) {
                            var bannerimage = hhh.bannerimage;
                            var bannerimagehref = "<?php echo base_url() ?>uploads/banner_images/" + bannerimage;
                            document.getElementById('download_' + item_id).click();

                        } else if (hhh.downloadresult == 0) {
                            $('#downloaderror').show();
                            setInterval(function () {
                                $('#downloaderror').hide();
                            }, 50000);

                        }
                    }
                });
            }

            function bannimgdown(item_id) {
                var bannerid = $("#bannerid_" + item_id).val();
                var option_id = 5;
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() ?>downloadnumberadd',
                    data: {
                        'item_id': bannerid,
                        'option_id': option_id
                    },
                    success: function (result) {
                        console.log(result);
                    }
                });
            }
</script>    