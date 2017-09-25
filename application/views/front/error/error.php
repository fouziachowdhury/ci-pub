<style type="text/css">

    * { margin: 0; padding: 0; }
    
    body {
      background-color: #000;
      background-image: url("<?php echo base_url()?>assets/front/images/error/404_background.jpg");
      /*width: 800px;
      height: 600px; */
      margin-left: auto;
      margin-right: auto;
    }
    
    #text {
      display:none;
    }

</style>
<?php echo $headerlink; ?>
<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper" style="background-color: #fff">
        <?php echo $header; ?>
        <?php
        if (isset($sidebar)) {
            echo $sidebar;
        }
        ?>

        <div id="page-wrapper">
            <div class="container-fluid">
                <!---------------------------------MAIN TEMPLATE START -------------------------->
                <div class="row bg-title" style="overflow: visible; margin-top:20px">
                    <div id="text">404 Not Found</div>
                    <div class="image" style="position: relative; ">
                        <img src="<?php echo base_url() ?>assets/front/images/error/404.jpg" width="1102" height="900">
                        <h2 style="position: absolute; top: 37px; left: 63px; width: 100%;">You Need to Upgrade to Unlock This feature..........<a href="<?php echo base_url() ?>userhome">BACK TO THE SITE</a></h2>
                    </div>
                </div> 
                <!---------------------------------MAIN TEMPLATE END -------------------------->
                <?php echo $footer; ?>
            </div>
        </div>
        <?php echo $footerlink; ?>
</body>
</html>





















<!--<div class="row">
    <div id="all_time" style="display: block;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="">
                <div class="row" style="margin-bottom: -8px;">
                    <div class="col-md-4">
                        <h4>Error</h4>
                    </div>
                </div>
            </div>
            <div class="showbandiv" id="postList">
                <style>
                    * { margin: 0; padding: 0; }

                    body {
                        background-color: #000;
                        background-image: url("<?php echo base_url() ?>assets/front/images/error/404_background.jpg");
                        width: 800px;
                        height: 600px;
                        margin-left: auto;
                        margin-right: auto;
                    }

                    #text {
                        display:none;
                    }


                </style>

                -------------------------LIGHT GALLERY MASTER---------------------------
                <div class="row demosrs" id='showbannerdata'>
                    <section id="contentrs">
                        <div id="container" class="clearfix" style="/*background: #FFF; */ padding: 5px; margin-bottom: 20px; border-radius: 5px; clear: both; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;">
                            <div class="box photo col3" style="">
                                <div id="text">404 Not Found</div>
                                <div class="image" style="position: relative; ">
                                    <img src="<?php echo base_url() ?>assets/front/images/error/404.jpg" width="800" height="600">
                                    <h2 style="position: absolute; top: 37px; left: 63px; width: 100%;">You Need to Upgrade to Unlock This feature..........<a href="<?php echo base_url() ?>userhome">BACK TO THE SITE</a></h2>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
            <div>
                <div style="float: right; margin-top: 34px;">
                </div>
            </div>
        </div>/span
    </div>/span
</div>
</div>-->
