<?php echo $headerlink; ?>
<body>
    <!-- Preloader -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <div id="wrapper">
        
        <!--            Admin Header                 -->
        
        <?php echo $header;?>
        
        <!-- Left navbar-header -->
        
        <!--            Admin Leftbar Menu                 -->
        
        <?php echo $leftnav; ?>
        
        
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?php echo $page_title;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="admin">Dashboard</a></li>
                            <li class="active"><?php echo $page_title;?></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 
                

                <!--            Admin Main Content                 -->
                
                <?php echo $admin_maincontent; ?>


                <!--            Admin Footer                 -->
                
                <?php echo $footer; ?>
                
                
            </div>
            
            <!-- /#page-wrapper -->
            
        </div>
        
        <!-- /#wrapper -->
        
<!--            Admin Footerlink               -->

        <?php echo $footerlink; ?>

</body>

<!-- Mirrored from eliteadmin.themedesigner.in/demos/eliteadmin-material/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 24 Sep 2016 09:16:08 GMT -->
</html>
