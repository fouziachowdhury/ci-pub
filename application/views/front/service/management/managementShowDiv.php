<div class="row demosrs" id='showafflinetdata'>
    <section id="contentrs">
        <div id="container" class="clearfix" style="/*background: #FFF; */ padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
            <?php if (!empty($allmanagement)) { ?>
                <div class="row">
                    <div id="all_time" style="display: block;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="white-box">
                                <p><?php echo $allmanagement->service_details; ?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div>
                        <h3 style="color:red">There is no data according your criteria !!!!</h3>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div> <br><br>
        </div>