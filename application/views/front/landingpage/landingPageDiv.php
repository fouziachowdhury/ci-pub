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
                if (!empty($alllandingpageinfo)) {
                    foreach ($alllandingpageinfo as $landing) {
                        ?>
                        <!--<div class="white-box">-->
                        <div class="col-md-6 col-sm-12 col-xs-12" style="margin: 5px;width: 48%; margin-bottom: 25px;">
                            <div class="row" style="background: #fff; border: 1px solid #ddd;">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12" style="width: 48%; margin-left: 8px; margin-right: 5px;"> 
                                        <a class="thumbnail" href="<?php echo $landing['url']; ?>" target="_blank">
                                            <img class="img-responsive" src="<?php echo $landing['zip_file_name']; ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12" style="width: 48%;">
                                        <h5 style="font-weight:bold"><?php echo $landing['title']; ?></h5>
<!--                                        <div class="table-responsive" style="overflow: unset;border: 1px solid #ddd; margin-right: 3px;">
                                            <table id="myTable" class="table table-striped" style="margin: 0px;font-size: 12px;">-->
                                                <div class="table-responsive" style="margin-top: 0px;padding: 14px 0;margin-right: 10px;overflow: unset;">
                                                    <table id="myTable" class="table table-striped dataTable" style="font-size: 12px;margin: 0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: center; padding: 3px;">
                                                                    <a href="<?php echo $landing['url']; ?>" target="_blank">VIew Page</a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 3px;">Category : 

                                                                    <?php
                                                                    if (isset($landing['cat_id'])) {
                                                                        $categoryArray = explode(',', $landing['cat_id']);
                                                                        foreach ($categoryArray as $category) {
                                                                            if (isset($category)) {
                                                                                $getcategory = $this->LandingModel->getcategoryinfo($category);
//                                                                print_r($country);
                                                                            }
                                                                            ?>
                                                                            <a onclick="searchbycategory('<?php echo $category; ?>')" style="cursor: pointer">
                                                                                <?php if (isset($getcategory[0])) {
                                                                                    echo $getcategory[0]['cat_name'] . ',';
                                                                                } ?>
                                                                            </a>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 3px;">Country : 
                                                                    <!--<a href="landingByCountry/<?php echo $landing['country_id']; ?>">-->

                                                                    <?php
                                                                    if (isset($landing['country_id'])) {
                                                                        $countryArray = explode(',', $landing['country_id']);
                                                                        foreach ($countryArray as $country) {
                                                                            if (isset($country)) {
                                                                                $getcountry = $this->LandingModel->getcountryinfo($country);
//                                                                print_r($country);
                                                                            }
                                                                            ?>
                                                                            <a onclick="searchbycountry('<?php echo $country; ?>')" style="cursor: pointer">
                                                                            <?php if (isset($getcountry[0])) {
                                                                                echo $getcountry[0]['country_name'] . ',';
                                                                            } ?>
                                                                            </a>
                                                                            <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding: 3px;">Tag : 

                                                                    <?php
                                                                    if (isset($landing['keyword'])) {
                                                                        $keyArray = explode(',', $landing['keyword']);
//                                                                print_r($keyArray);
                                                                        foreach ($keyArray as $key) {
                                                                            if (isset($key)) {
//                                                                        echo '<pre>';print_r($key);
                                                                                $getkeyword = $this->LandingModel->get_keyword_by_key($key, 13);
                                                                            }
//                                                                    echo '<pre>';print_r($getkeyword);
                                                                            ?>
                                                                            <a onclick="search_by_tag('<?php echo $key; ?>')" style="cursor: pointer">
                                                                            <?php if (isset($getkeyword[0])) {
                                                                                echo $getkeyword[0]['keyword_tags'] . ',';
                                                                            } ?>
                                                                            </a>
                                                                        <?php
                                                                        }
//                                                                print_r($keyArray);
//                                                                $getkeyword = $this->LandingModel->getkeywordinfo($keyArray);
//                                                                $k = '';
//                                                                foreach ($getkeyword as $kkk) {
//                                                                    $k[] = $kkk['keyword_tags'];
////                                                                    print_r($k);
//                                                                }
////                                                                print_r($k);
//                                                                $tags = implode(", ", $k);
////                                                                print_r($tags);
//                                                                if (isset($tags)) {
                                                                        ?>

        <?php
        }
//                                                            }
        ?>

                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div>
                                                    <span class="cursoricon" style="font-size: 10px;" onclick="showcommentbox('<?php echo $landing['landing_id']; ?>');" id="landingcommbtn" landingddsid="<?php echo $landing['landing_id']; ?>" data-toggle="modal" data-target="#commentmodal"><img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;"> Comments </span>
                                                    <div class="modal fade" tabindex="-1" role="dialog" id="commentmodal" style="margin-top: 134px;"></div>
                                                    <?php if (in_array($landing['landing_id'], $favbanner)) { ?>
                                                        <span class="cursoricon" data-toggle="tooltip" data-placement="bottom" title="Favorites" style="font-size: 10px;"><i class="ti-heart"></i> Favorites</span>
                                                    <?php } else { ?>
                                                        <a class="cursoricon" data-toggle="tooltip" data-placement="bottom" title="Favorites" style="font-size: 10px;" href="<?php echo base_url() ?>makebannerfavorites/<?php echo $landing['landing_id']; ?>/13"><img src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px;">Add To Favorite</a>
                                                    <?php } ?>

                                                    <span class="cursoricon" style="margin-left: 7px;font-size: 10px;"> 
                                                <!--<a onclick="bannerdownload('<?php echo $landing['landing_id']; ?>')">-->
                                                        <a href="landingpage/download/<?php echo $landing['landing_id'] ?>/<?php echo $landing['zip_file'] ?>">
                                                            <img data-toggle="tooltip" data-placement="bottom" title="Download" src="<?php echo base_url() ?>assets/icon/download.png" style="width: 16px;"> Download
                                                        </a>
                                                    </span>
                                                    
                                                    <a hidden id="download_<?php echo $landing['landing_id'] ?>" onclick="bannimgdown('<?php echo $landing['landing_id'] ?>')" download="<?php echo $landing['zip_file_name']; ?>" href="<?php echo $landing['zip_file_name']; ?>" title="ImageName"><img src="<?php echo base_url() ?>assets/icon/download.png" style="width: 16px;"></a>
                                                    <input type="hidden" id="bannerid_<?php echo $landing['landing_id'] ?>" name="banneridtext" value="<?php echo $landing['landing_id']; ?>">
                                                </div> 
                                        </div>
                                    </div>
                                    <h4 style="text-align: center;font-weight: bold;">
                                    </h4>
                                </div>
                            </div>
                            <!--                                     </div>-->
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
        var option_id = 13;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>landingdownloadcheck',
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
        var option_id = 13;
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>landingdownloadnumberadd',
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