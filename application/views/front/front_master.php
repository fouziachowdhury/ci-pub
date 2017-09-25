<?php echo $headerlink; ?>
<body>
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper" style="background-color: #fff">
        <?php echo $header;?>
        <?php if(isset($sidebar)){ echo $sidebar; } ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <!--<ol class="breadcrumb">
                            <li><a href="admin"><?php echo $page_title;?></a></li>
                        </ol>-->
                    </div>
                </div> 
                <?php echo $front_maincontent; ?>
                <?php echo $footer; ?>
            </div>
        </div>
        <?php echo $footerlink; ?>
</body>
</html>
