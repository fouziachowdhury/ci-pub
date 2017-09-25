<style>
    .select2-container .select2-choice > .select2-chosen{
        color: #FFF;
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

<?php if ($this->session->flashdata('success')) { ?>
    <div class="alert alert-success alert-dismissable">
        <i class="fa fa-check-square-o"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php }
?>

<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger alert-dismissable">
        <i class="fa fa-check-square-o"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('error'); ?>
    </div>

<?php }
?>
<div class="row demosrs" id='showafflinetdata'>
    <section id="contentrs">
        
        <input type="hidden" id="searchval" value="<?php echo $this->session->userdata('searchval'); ?>">
        <input type="hidden" id="searchkey" value="<?php echo $this->session->userdata('searchkey'); ?>">
        
        <div id="container" class="clearfix" style="/*background: #FFF; */ padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">

            <table class="table table-striped" style="border: 1px solid #ddd;background: #fff;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($allresource)) {
                        foreach ($allresource as $traking) {
                            ?>
                            <tr>
                                <td> <a class="thumbnail" style="margin-top: 5px;margin-left: 5px; margin-bottom: 0px;"><img style="width: 110px;" class="img-responsive" src="<?php echo $traking['zip_file_name']; ?>" alt=""></a></td>
                                <td style="font-size: 11px; padding: 15px;"><h5 style="font-weight: bold;"><?php echo $traking['title']; ?></h5>
                                    <?php
                                    $string = strip_tags($traking['meta_description']);

                                    if (strlen($string) > 100) {
                                        $stringCut = substr($string, 0, 100);
                                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
                                    }
                                    echo $string;
                                    ?>
                                </td>
                                <td style="font-size: 11px; padding: 15px;"> 
                                            <span onclick="showcommentbox('<?php echo $traking['id']; ?>')" data-toggle="modal" data-target="#bannercommentmodal"><img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;"> Comments </span>
                                            <?php if (in_array($traking['id'], $favresource)) { ?>
                                        <span><img data-toggle="tooltip" data-placement="bottom" title="Favorites" style="width: 16px; margin-left: 8px; margin-right: 8px;" src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px;"> Favorites</span>
                                    <?php } else { ?>
                                            <span><a href="<?php echo base_url() ?>makefavoritesresource/<?php echo $traking['id']; ?>/23"><img data-toggle="tooltip" data-placement="bottom" title="Favorites" style="width: 16px; margin-left: 8px; margin-right: 8px;" src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px;">Add To Favorites </a></span>
                                    <?php } ?>
                                            <span><a href="<?php echo $traking['url']; ?>" target="_blank"><img data-toggle="tooltip" data-placement="bottom" title="View" src="<?php echo base_url() ?>assets/icon/whois.png" style="color:#3079C8; width: 16px;">View </a></span></td>
                            <div class="modal fade" tabindex="-1" role="dialog" id="bannercommentmodal"></div>
                            </tr>
                        <?php }
                    } else { ?>
                    <div>
                        <h3 style="color:red">There is no data according your criteria !!!!</h3>
                    </div>
<?php } ?>
                </tbody>
            </table>
        </div>
        </section>
    <?php echo $this->ajax_pagination->create_links(); ?>
        <div class="clearfix"></div> <br><br>
        </div>


