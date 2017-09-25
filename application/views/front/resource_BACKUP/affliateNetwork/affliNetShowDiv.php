<div class="row demosrs" id='showafflinetdata'>
    <section id="contentrs">
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
                      if (!empty($allaffiliatenetwork)) {
                foreach ($allaffiliatenetwork as $affli) {
                            ?>
                            <tr>
                                <td> <a class="thumbnail" style="margin-top: 5px;margin-left: 5px; margin-bottom: 0px;"><img style="width: 110px;" class="img-responsive" src="<?php echo $affli['zip_file_name']; ?>" alt=""></a></td>
                                <td style="font-size: 11px; padding: 15px;"><h5 style="font-weight: bold;"><?php echo $affli['title']; ?></h5>
                                    <?php
                                    $string = strip_tags($affli['meta_description']);

                                    if (strlen($string) > 100) {
                                        $stringCut = substr($string, 0, 100);
                                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
                                    }
                                    echo $string;
                                    ?>
                                </td>
                                <td style="font-size: 11px; padding: 15px;"> <span><img data-toggle="tooltip" data-placement="bottom" title="Comment" src="<?php echo base_url() ?>assets/icon/comment.png" style="color:#3079C8; width: 16px;"> Comments <img data-toggle="tooltip" data-placement="bottom" title="Favorites" style="width: 16px; margin-left: 8px; margin-right: 8px;" src="<?php echo base_url() ?>assets/icon/favorites.png" style="color:red;width: 16px;">Add To Favorites <a href="<?php echo $affli['url']; ?>" target="_blank"><img data-toggle="tooltip" data-placement="bottom" title="View" src="<?php echo base_url() ?>assets/icon/whois.png" style="color:#3079C8; width: 16px;">View </a></span></td>
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
        <div class="clearfix"></div> <br><br>
        </div>


